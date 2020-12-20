<?php

namespace App\Http\Controllers\Api;

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
use App\Models\Location;
use App\Models\Order;
use App\Models\AssignOrders;
use App\Models\DistrictsPrices;
use App\Models\Notifications;
use Carbon\Carbon;
use Reflector;

class PickUpController extends Controller
{
    public function getPickUpStatistics(Request $request)
    {
        $orders = Order::with('client')->with('assigned_order');

        if ($request->filter == 'from-to') {

            $orders = Order::with('client')->whereHas('assigned_order', function ($query) use ($request) {
                return $query->whereBetween('assign_orders.delivery_date', [$request->from, $request->to]);
            })->get();

            $response = [
                'status' => 200,
                'message' => 'success',
                'orders' => $orders,
            ];

            return response()->json($response, 200);
        }

        $orders = $orders->get();

        $all_orders = [];
        foreach ($orders as $key => $value) {
            switch ($request->filter) {
                case 'previous':
                    if (isset($value->assigned_order->delivery_date)) {
                        if ($request->has('filterByDate') && isset($request->filterByDate)) {
                            if (strtotime($value->assigned_order->delivery_date) == strtotime($request->filterByDate)) {
                                array_push($all_orders, $value);
                            }
                            break;
                        }
                        if (strtotime($value->assigned_order->delivery_date) < strtotime(Carbon::now()->format('Y-m-d'))) {
                            array_push($all_orders, $value);
                        }
                    }
                    break;
                case 'upcoming':
                    if (isset($value->assigned_order->delivery_date)) {
                        if ($request->has('filterByDate') && isset($request->filterByDate)) {
                            if (strtotime($value->assigned_order->delivery_date) == strtotime($request->filterByDate)) {
                                array_push($all_orders, $value);
                            }
                            break;
                        }
                        if (strtotime($value->assigned_order->delivery_date) > strtotime(Carbon::now()->format('Y-m-d'))) {
                            array_push($all_orders, $value);
                        }
                    }
                    break;
                case 'today':
                    if (strtotime(Carbon::parse($value->created_at)->format('Y-m-d')) == strtotime(Carbon::now()->format('Y-m-d'))) {
                        array_push($all_orders, $value);
                    }
                    break;
                case 'ready': 
                    if ($value->status == 'Ready') {
                        array_push($all_orders, $value);
                    }
                    break;
                default:
                    array_push($all_orders, $value);
                    break;
            }
        }

        $response = [
            'status' => 200,
            'message' => 'success',
            'orders' => $all_orders,
            'total_orders' => count($all_orders),
            'net_profit' => '0',
        ];

        return response()->json($response, 200);
    }
}
