<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\User;
use App\Models\Client;
use App\Models\Dispatcher;
use App\Models\Finance;
use App\Models\Monitor;
use App\Models\Driver;
use App\Models\Pickedup;
use App\Models\Location;
use App\Models\Order;
use App\Models\AssignOrders;
use App\Models\FinancialAccounts;
use App\Models\DistrictsPrices;
use App\Models\City;
use App\Models\Notifications;
use Reflector;

class PickupsController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where('status', 'Ready')->orWhere('status', 'Picked up')->get();

        return view('pickups.index', compact('orders'));
    }

    public function changeStatus(Request $request){
        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Success');
    }

    public function multiStatusChange(Request $request)
    {
        foreach ($request->order_ids as $key => $value) {
            $order = Order::find($value);
            $order->status = $request->status;
            $order->save();
        }
        return true;
    }
    
    public function editpickup(Request $request)
    {
        $Admin = Pickedup::where('user_id', $request->get('id'))->first();
        $User = User::where('id', $request->get('id'))->first();
        return view("pickups.editpickup", compact('Admin', 'User'));
    }
    
    public function deletepickup(Request $request)
    {
        Pickedup::where('id', $request->id)->delete();
        User::where('id', $request->user_id)->delete();

        return back()->with('error', 'Pickup was deleted successfully');;
    }
}