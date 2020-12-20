<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Order;
use App\Models\CancelledOrders;
use App\Imports\OrdersImport;
use Excel;

class OrderController extends Controller
{
    public function requestUserLocation(Request $request)
    {
        $order = Order::find($request->order_id);

        
    }

    public function confirmLocation(Request $request)
    {
        $oid = $request->oid;
        $order = Order::find($oid);
        
        $lat = $order->lat;
        $lon = $order->lon;
        
        return view('map.map', compact(['lat', 'lon', 'oid']));
    }
    
    public function changeOrderLocation(Request $request)
    {
        $lat = $request->lat;
        $lon = $request->lon;
        $oid = $request->oid;
        
        $order = Order::find($oid);
        $order->lat = $request->lat;
        $order->lon = $request->lon;
        $order->confirmed_location = '1';
        $order->save();
        
        return redirect()->route('/');
    }

    public function addFromExel(Request $request)
    {
        return view('admin.addOrdersExel');
    }

    public function importExcel(Request $request) 
    {
        $import = new OrdersImport;
        Excel::import($import, $request->file('excel')->store('temp'));
        // dd($import);
        if (isset($import->data)) {
            if(array_key_exists('error', $import->data)) {
                return back()->with('error', $import->data['error']);
            }
        }
        return back()->with('success', 'Orders Added');
    }

    public function cancellOrder(Request $request) 
    {
        $order = Order::find($request->id);
        $order->status = 'Cancelled';
        $order->save();

        $cancelledOrder = CancelledOrders::firstOrNew(array('order_id' => $request->order_id));;
        $cancelledOrder->order_id = $request->id;
        $cancelledOrder->reason = $request->text;
        $cancelledOrder->save();
        
        return true;
    }
    
    public function setLocationConfirmSent(Request $request)
    {
        $order = Order::find($request->id);
        $order->confirm_location_sent = '1';
        $order->save();
        
        return true;
    }
}