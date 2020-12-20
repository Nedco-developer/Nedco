<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\client;
use App\Models\Dispatcher;
use App\Models\Finance;
use App\Models\Monitor;
use App\Models\Driver;
use App\Models\User;
use App\Models\Order;
use App\Models\AssignOrders;
use App\Models\DistrictsPrices;

class driverController extends Controller
{
    public function ViewDetailsDriver(Request $request){
        
        $itemsPrices = [];
        $deliveryPrices = [];
        $totalPrices = [];
        $driverID = [];
        $DistrictsID = [];
        $districtsPrices = DistrictsPrices::where('user_id',$request->id)->with('Districts')->get();
        // return $districtsPrices;
        $Driver = Driver::where('user_id', $request->id)->with('user')->first();
        $AssignOrders = AssignOrders::with('order')->where('Driver_id', $Driver->id)
            ->whereHas('order', function ($query) {
                return $query->where('orders.status', 'Delivered');
            })
            ->get();
        foreach($AssignOrders as $AssignOrder) {
            array_push($itemsPrices, $AssignOrder->order->itemPrice);
            array_push($deliveryPrices, $AssignOrder->order->deliveryPrice);
            array_push($totalPrices, $AssignOrder->order->totalPrice);
            $driverD = Driver::where('id',$AssignOrder->Driver_id)->first();
            array_push($driverID, $driverD->user_id);
            array_push($DistrictsID, $AssignOrder->order->districts);
        }
        
        $totaldriver = DistrictsPrices::whereIn('user_id',$driverID)->whereIn('district_id',$DistrictsID)->pluck('price')->sum();

        $items = array_sum($itemsPrices);
        $delivery = array_sum($deliveryPrices);
        $total = array_sum($totalPrices);
        $totalnet = $total - $totaldriver;
        return view('driver.View-Details_driver',compact('AssignOrders','items','delivery','total','Driver','totaldriver','totalnet','districtsPrices'));        
    } 
    
    public function driverOrders(Request $request){

        $Driver = Driver::where('user_id', Auth::user()->id)->first();//get driver

        $AssignOrders = AssignOrders::with('order')->where('Driver_id',$Driver->id)->get();//get all order

        $AssignOrdersToday = AssignOrders::with('order')->where('Driver_id',$Driver->id)->where('delivery_date', date('Y-m-d'))->with('cancelledOrder')->get();//to day

        $AssignOrdersLargerToday = AssignOrders::with('order')->where('Driver_id',$Driver->id)->where('delivery_date','>', date('Y-m-d'))->get();//> to day

        $AssignOrdersLessToday = AssignOrders::with('order')->where('Driver_id',$Driver->id)->where('delivery_date','<', date('Y-m-d'))->get();//> to day

        return view('driver.driverOrder',compact('AssignOrders','AssignOrdersToday','AssignOrdersLargerToday','AssignOrdersLessToday'));        
    }  

    public function changeStatus(Request $request){
        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $order->save();

        return null;
    }
}
