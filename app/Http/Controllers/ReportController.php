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
use DB;

class ReportController extends Controller
{
    public function ordersReports(Request $request){
        if ($request->type == 'today') {
            $all_orders = Order::where('created_at' , 'LIKE', '%'.date('Y-m-d').'%')->with('assigned_order')->get();
        } else {
            $all_orders = Order::with('assigned_order')->get();
        }
        $orders = array();
        
        $totalItemsPrices = array();
        $totalDeliveryPrices = array();
        $totalDriverDelivey = array();
        $totalNet = array();
        
        foreach($all_orders as $order){
            $client = Client::find($order->client_id);
            // user is the rest of the client info
            $user = User::find($client->user_id);
            if (isset($order->assigned_order->Driver_id)) {
                $driver = Driver::find($order->assigned_order->Driver_id);
                if (isset($driver)) {
                    $driver_user = User::find($driver->user_id);
                    $order->driver = $driver_user;
                    $driver_delivery_price = DistrictsPrices::where('user_id',$driver->user_id)->where('district_id', $order->districts)->first();
                    if (isset($driver_delivery_price)) {
                        $order->driver_delivery_price = $driver_delivery_price->price;
                        array_push($totalDriverDelivey, $driver_delivery_price->price);
                    } else {
                        $order->driver_delivery_price = null;
                    }
                } else {
                    $driver_user = null;
                    $order->driver = null;
                    $order->driver_delivery_price = null;
                }
            } else {
                $order->driver = null;
                $order->driver_delivery_price = null;
            }
            if (isset($user->name)) {
                $order->client->name = $user->name;
            }
            if ($request->from != '' && $request->to != '') {
                if (strtotime($order->created_at) > strtotime($request->from) && strtotime($order->created_at) < strtotime($request->to)) {
                    array_push($orders, $order);
                } else {
                    continue;
                }
            } elseif ($request->from != '' && $request->to == '') {
                if (strtotime($order->created_at) >= strtotime($request->from)) {
                    array_push($orders, $order);
                } else {
                    continue;
                }
            } elseif ($request->to != '' && $request->from == '') {
                if (strtotime($order->created_at) <= strtotime($request->to)) {
                    array_push($orders, $order);
                } else {
                    continue;
                }
            } else {
                array_push($orders, $order);
            }
            array_push($totalItemsPrices, $order->itemPrice);
            array_push($totalDeliveryPrices, $order->deliveryPrice);
            array_push($totalNet, $order->totalPrice - $order->itemPrice);
        }
        
        return view('Reports.ordersReport', 
        compact(
            'orders',
            'totalItemsPrices',
            'totalDeliveryPrices',
            'totalDriverDelivey',
            'totalNet'
        ));
    }
    
    public function Reports(Request $request){
        if ($request->filterType == 'today') {
            $orders = Order::where('created_at' , 'LIKE', '%'.date('Y-m-d').'%')->where('status', '!=', 'Ready')->get();
        } else if ($request->filterType == 'weekly') {
            $orders = Order::where('created_at' ,'>=',date('Y-m-d',strtotime('-7 days')))->where('status', '!=', 'Ready')->get();
        } else if ($request->filterType == 'monthly') {
            $orders = Order::where('created_at', '>=', date('Y-m-d',strtotime('-1 month')))->where('status', '!=', 'Ready')->get();
        } else {
            $orders = Order::where('status', '!=', 'Ready')->get();
        }
        $itemPrice = array();
        $deliveryPrice = array();
        $totalPrice = array();
        $driverID = array();
        $DistrictsID = array();
        foreach($orders as $order)
        {
            array_push($itemPrice,$order->itemPrice);
            array_push($deliveryPrice,$order->deliveryPrice);
            array_push($totalPrice,$order->totalPrice);
            array_push($DistrictsID,$order->districts);
            $assignOrders = AssignOrders::where('Order_id',$order->id)->get();
                foreach($assignOrders as $Orders)
                {
                    $driverD = Driver::where('id',$Orders->Driver_id)->with('user')->first();
                    array_push($driverID,$driverD->user_id);
                }
        }
        $districtsPrices = DistrictsPrices::whereIn('user_id',$driverID)->whereIn('district_id',$DistrictsID)->pluck('price')->sum();
        
        $itemPrice = array_sum($itemPrice);
        $deliveryPrice = array_sum($deliveryPrice);
        $totalPrice = array_sum($totalPrice);
        $totalDriver = $districtsPrices;
        $totalNet = $deliveryPrice - $totalDriver;

        if ($request->type != 'ajax') {
            return view('Reports.Admin_Reports',compact(
                'orders',
                'itemPrice',
                'deliveryPrice',
                'totalPrice',
                'totalDriver',
                'totalNet',
            ));
        }

        return array('orders' => $orders,'itemPrice' => $itemPrice, 'deliveryPrice' => $deliveryPrice,'totalPrice' => $totalPrice,'totalDriver' => $totalDriver,'totalNet' => $totalNet);
    }
    
    public function Search(Request $request){
        $yearlyOrder = [];
        $allOrders = Order::where('status','!=','out for delivery')->where('status','!=','pending')->get();
        $yearlyItemPrice = array();
        $yearlyDeliveryPrice = array();
        $yearlyTotalPrice = array();
        $driverID = array();
        $DistrictsID = array();
        foreach($allOrders as $yearly)
        {
            if (date("Y-m-d", strtotime($yearly->created_at)) >= date($request->FromDate) && date("Y-m-d", strtotime($yearly->created_at)) <= date($request->ToDate)) {
                array_push($yearlyOrder,$yearly);
            }
        }
        foreach($yearlyOrder as $yearly)
        {
            array_push($yearlyItemPrice,$yearly->itemPrice);
            array_push($yearlyDeliveryPrice,$yearly->deliveryPrice);
            array_push($yearlyTotalPrice,$yearly->totalPrice);
            array_push($DistrictsID,$yearly->districts);
            $assignOrders = AssignOrders::where('Order_id',$yearly->id)->get();
                foreach($assignOrders as $Orders)
                {
                    $driverY = Driver::where('id',$Orders->Driver_id)->with('user')->first();
                    array_push($driverID,$driverY->user_id);
                }
        }
        $districtsPricesY = DistrictsPrices::whereIn('user_id',$driverID)->whereIn('district_id',$DistrictsID)->pluck('price')->sum();
        
        $OrdersY = $yearlyOrder;
        $yearlyItem = array_sum($yearlyItemPrice);
        $yearlyDelivery = array_sum($yearlyDeliveryPrice);
        $yearlyTotal = array_sum($yearlyTotalPrice);
        $TotalyearlyDriver = $districtsPricesY;
        $totalyearlyNet = $yearlyDelivery - $TotalyearlyDriver;

        return array('yearlyOrder' => $yearlyOrder,'yearlyItem' => $yearlyItem, 'yearlyDelivery' => $yearlyDelivery,'yearlyTotal' => $yearlyTotal,'TotalyearlyDriver' => $TotalyearlyDriver,'totalyearlyNet' => $totalyearlyNet);
    }

}