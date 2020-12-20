<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\Client;
use App\Models\Dispatcher;
use App\Models\Finance;
use App\Models\Monitor;
use App\Models\Driver;
use App\Models\Location;
use App\Models\Order;
use App\Models\City;
use App\Models\Districts;
use App\Models\DistrictsPrices;
use App\Models\AssignOrders;
use App\Models\FinancialAccounts;
use DB;

class FinancialAccountsController extends Controller
{
    public function DriverFinance(Request $request){
        $driver = Driver::find($request->driver_id);
        
        if ($request->delivery_Date != '') {
            $driver_orders = AssignOrders::with('order')
            ->where('Driver_id', $request->driver_id)
            ->where('delivery_date', $request->delivery_Date)
            ->get();
        } else {
            $driver_orders = AssignOrders::with('order')
            ->where('Driver_id', $request->driver_id)
            ->get();
        }
        
        
        $all_orders_total_price = array();
        $total_price_of_delivered_orders = array();
        $total_price_of_notDelivered_orders = array();
        $total_delivery_price_for_driver = array();
        $orders_not_deliverd = array();
        $cash = array();
        
        foreach($driver_orders as $driver_order) {
            $client = Client::where('id', $driver_order->order->client_id)->with('user')->first();
            $driver_order->client = $client;
            
            $districtsPrice = DistrictsPrices::where('user_id', $driver->user_id)->where('district_id', $driver_order->order->districts)->first();
            if (isset($districtsPrice->price)) {
                $driver_order->driver_delivery_price = $districtsPrice->price;
            } else {
                $driver_order->driver_delivery_price = '';
            }
            
            $status = $driver_order->order->status;
            
            if ($status == 'Amount received from driver') {
                array_push($all_orders_total_price, $driver_order->order->totalPrice);
            } elseif ($status == 'Delivered') {
                array_push($total_price_of_delivered_orders, $driver_order->order->totalPrice);
                array_push($cash, $driver_order->order->totalPrice - $districtsPrice->price);
                array_push($total_delivery_price_for_driver, $driver_order->driver_delivery_price);
                array_push($all_orders_total_price, $driver_order->order->totalPrice);
            } elseif ($status == 'Assigned' && $status == 'Out For Delivery' && $status == 'Pending' && $status == 'Ready') {
                array_push($orders_not_deliverd, $districtsPrice->price);
                array_push($all_orders_total_price, $driver_order->order->totalPrice);
            } else {
                array_push($total_price_of_notDelivered_orders, $driver_order->order->totalPrice);
                array_push($all_orders_total_price, $driver_order->order->totalPrice);
            }
        }

        return view('FinancialAccounts.DriverFinance', 
        compact(
            'driver', 
            'driver_orders',
            'all_orders_total_price',
            'total_price_of_delivered_orders',
            'total_price_of_notDelivered_orders',
            'total_delivery_price_for_driver',
            'orders_not_deliverd',
            'cash'
            ));
    }
    
    public function amountRecived(Request $request) {
        // decode array of orders coming from fornt end
        $driver_orders = unserialize(base64_decode($request->orders));
        
        foreach ($driver_orders as $driver_order) {
            if ($driver_order->order->status == 'Delivered') {
                $order = Order::find($driver_order->order->id);
                $order->status = 'Amount received from driver';
                $order->save();
            }
        }
        
        $driver = Driver::where('id', $request->driver_id)->with('user')->first();
        
        return back()->with('success','Recived '.$request->amount.' from'.' '.$driver->user->name);
    }
    
    public function ClientFinance(Request $request){
        $client = Client::where('id' ,$request->client_id)->with('user')->first();

        if ($request->delivery_Date != '') {
            $client_orders = Order::where('client_id', $request->client_id)->whereHas('assigned_order', function ($query) use ($request) {
                return $query->where('assign_orders.delivery_date', $request->delivery_Date);
            })->with('assigned_order')->get();
        } else {
            $client_orders = Order::with('assigned_order')
            ->where('client_id', $request->client_id)
            ->get();
        }
        
        $total_prices_of_orders = array();
        $total_delivery_prices = array();
        $total_drivers_delivery_price = array();
        $client_amount = array();
        $total_price_of_notDelivered_orders = array();
        foreach($client_orders as $client_order) {
            $driver = Driver::where('id', $client_order->assigned_order->Driver_id)->with('user')->first();
            $client_order->driver = $driver;
            
            $districtsPrice = DistrictsPrices::where('user_id', $driver->user_id)->where('district_id', $client_order->districts)->first();
            if (isset($districtsPrice->price)) {
                $client_order->driver_delivery_price = $districtsPrice->price;
            } else {
                $client_order->driver_delivery_price = '';
            }
            
             $status = $client_order->status;
            
            if ($status == 'Amount received from driver') {
                array_push($total_prices_of_orders, $client_order->totalPrice);
                
            } elseif ($status == 'Delivered') {
                array_push($total_prices_of_orders, $client_order->totalPrice);
                array_push($total_delivery_prices, $client_order->deliveryPrice);
                array_push($total_drivers_delivery_price, $client_order->totalPrice - $districtsPrice->price);
                array_push($client_amount, $client_order->totalPrice - $client_order->deliveryPrice);
                
            } else {
                array_push($total_price_of_notDelivered_orders, $client_order->totalPrice);
                array_push($total_prices_of_orders, $client_order->totalPrice);
            }
        }
        
        return view('FinancialAccounts.ClientFinance', 
        compact(
            'client',
            'client_orders',
            'total_prices_of_orders',
            'total_delivery_prices',
            'total_drivers_delivery_price',
            'client_amount',
            'total_price_of_notDelivered_orders'
        ));
    }
    
    
    // /////////////////////////////////////////////////////////////////////////////////////////
    
    public function FinancialAccountsPage(Request $request){
        $clients = Client::where('status','approved')->with('user')->get();
        $drivers = Driver::where('status','approved')->with('user')->get();
        return view('FinancialAccounts.FinancialAccounts' , compact('clients','drivers'));
    }
    
    public function Accounts(Request $request){
        $Accounts = FinancialAccounts::where('user_id',$request->get('user_id'))->get();
        $price = array();
            foreach($Accounts as $accounts){
                array_push($price,$accounts->price);
            }
        $TotalPrice = array_sum($price);
        $Orders = array();
        $ItemPrice = array();
        $DeliveryPrice = array();
        $TotalPricee = array();
            if($request->get('name') == 'driver'){
                $Admin = Driver::where('user_id',$request->get('user_id'))->with('user')->first();
                $AssignOrders = AssignOrders::where('Driver_id',$Admin->id)->get();
                foreach($AssignOrders as $assignorders)
                {
                    $Order = Order::where('id',$assignorders->Order_id)->where('status','!=','Pending')->where('status','!=','out for delivery')->get();
                        foreach($Order as $order)
                        {
                            $DistrictsPrices = DistrictsPrices::where('district_id',$order->districts)->first();
                            array_push($Orders,$order);
                            array_push($ItemPrice,$order->itemPrice);
                            array_push($DeliveryPrice,$DistrictsPrices->price);
                            array_push($TotalPricee,$order->totalPrice);
                        }
                }
            }elseif($request->get('name') == 'client'){
                $Admin = Client::where('user_id',$request->get('user_id'))->with('user')->first();
                $Order = Order::where('client_id' , $Admin->id)->where('status','!=','Pending')->where('status','!=','out for delivery')->get();
                foreach($Order as $order)
                {
                    array_push($Orders,$order);
                    array_push($ItemPrice,$order->itemPrice);
                    array_push($DeliveryPrice,$order->deliveryPrice);
                    array_push($TotalPricee,$order->totalPrice);
                }
            }
        $item = array_sum($ItemPrice);
        $delivery = array_sum($DeliveryPrice);
        $total = $item + $delivery;

        return view('FinancialAccounts.Accounts' , compact('item','Orders','delivery','total','Admin','TotalPrice'));
    }
    
    public function SaveAccounts(Request $request){
        $Accounts = new FinancialAccounts();
        $Accounts->user_id = $request->get('user_id');
        $Accounts->price = '-'.$request->get('Price');
        $Accounts->save();
        return redirect('FinancialAccounts')->with('success', 'The account has been modified successfully');
    }

}