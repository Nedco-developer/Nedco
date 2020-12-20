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

class DisptcherController extends Controller
{
    public function getDisptcherStatistics(Request $request)
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
                case 'pending': 
                    if ($value->status == 'Pending') {
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

    public function getDisptcherHomeStatistics(Request $request)
    {
        $orders = Order::with('client')->with('assigned_order')->get();

        $notificaions = Notifications::where('type', Auth::user()->type)->where('is_seen', 0)->count();

        $orders_total = [];
        $all_orders = [];
        $net_profit = [];
        foreach ($orders as $key => $value) {
            switch ($request->filter) {
                case 'weekly':
                    if (isset($value->assigned_order->delivery_date)) {
                        if (strtotime($value->assigned_order->delivery_date) >= strtotime(Carbon::now()->subWeek()->format('Y-m-d')) && strtotime($value->assigned_order->delivery_date) < strtotime(Carbon::now()->addWeek()->format('Y-m-d'))) {
                            array_push($all_orders, $value);
                            array_push($orders_total, (float)$value->totalPrice);
                            array_push($net_profit, (float)$value->deliveryPrice); 
                        };
                    }
                    break;
                case 'monthly':
                    if (isset($value->assigned_order->delivery_date)) {
                        if (strtotime($value->assigned_order->delivery_date) > strtotime(Carbon::now()->subMonth()->format('Y-m-d'))) {
                            array_push($all_orders, $value);
                            array_push($orders_total, (float)$value->totalPrice);
                            array_push($net_profit, (float)$value->deliveryPrice); 
                        };
                    }
                    break;
                case 'today':
                    if (isset($value->assigned_order->delivery_date)) {
                        if (strtotime($value->assigned_order->delivery_date) == strtotime(Carbon::now()->format('Y-m-d'))) {
                            array_push($all_orders, $value);
                            array_push($orders_total, (float)$value->totalPrice);
                            array_push($net_profit, (float)$value->deliveryPrice);   
                        };
                    }
                    break;
                default:
                    array_push($all_orders, $value);
                    array_push($orders_total, (float)$value->totalPrice);
                    break;
            }
        }

        $response = [
            'status' => 200,
            'message' => 'success',
            'orders' => $all_orders,
            'orders_total' => number_format(array_sum($orders_total), 2),
            'total_orders' => count($all_orders),
            'net_profit' => number_format(array_sum($net_profit), 2),
            'notificaions' => $notificaions
        ];

        return response()->json($response, 200);
    }
}
