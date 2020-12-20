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
use App\Models\Districts;
use App\Models\DistrictsPrices;
use App\Models\Notifications;
use Carbon\Carbon;
use Reflector;

class DriverController extends Controller
{
    public function getDriverHomeStatistics(Request $request)
    {
        $driver = Driver::with('user')->where('user_id', auth()->id())->first();

        $assigned_orders = AssignOrders::with('order')
            ->where('Driver_id', $driver->id)
            ->get();
            
        $notificaions = Notifications::where('user_Id', Auth::id())->where('is_seen', 0)->count();
 
        $all_orders = [];
        $orders_total = [];
        $net_profit = [];
        foreach ($assigned_orders as $key => $value) {
            switch ($request->filter) {
                case 'weekly':
                    if (isset($value->delivery_date)) {
                        if (strtotime($value->delivery_date) >= strtotime(Carbon::now()->subWeek()->format('Y-m-d')) && strtotime($value->delivery_date) < strtotime(Carbon::now()->addWeek()->format('Y-m-d'))) {
                            array_push($all_orders, $value);
                            array_push($orders_total, (float)$value->order->totalPrice);
                        };
                    }
                    break;
                case 'monthly':
                    if (isset($value->delivery_date)) {
                        if (strtotime($value->delivery_date) > strtotime(Carbon::now()->subMonth()->format('Y-m-d'))) {
                            array_push($all_orders, $value);
                            array_push($orders_total, (float)$value->order->totalPrice);
                        };
                    }
                    break;
                case 'today':
                    if (isset($value->delivery_date)) {
                        if (strtotime($value->delivery_date) == strtotime(Carbon::now()->format('Y-m-d'))) {
                            array_push($all_orders, $value);
                            array_push($orders_total, (float)$value->order->totalPrice);
                        };
                    }
                    break;
                default:
                    array_push($all_orders, $value);
                    array_push($orders_total, (float)$value->order->totalPrice);
                    break;
            }
        }
        
        foreach($all_orders as $order) {
            $districtsPrices = DistrictsPrices::where('user_id', $driver->user_id)->where('district_id',$value->order->districts)->first();
            if (isset($districtsPrices->price)) {
                array_push($net_profit, (float)$districtsPrices->price);   
            }
        }

        $response = [
            'status' => 200,
            'message' => 'success',
            'assigned_orders' => $all_orders,
            'total_orders' => count($all_orders),
            'orders_total' => number_format(array_sum($orders_total), 2),
            'net_profit' => number_format(array_sum($net_profit), 2),
            'notificaions' => $notificaions
        ];

        return response()->json($response, 200);
    }

    public function getDriverStatistics(Request $request)
    {
        $driver = Driver::with('user')->where('user_id', auth()->id())->first();

        if ($request->filter == 'from-to') {
            $assigned_orders = Order::whereHas('assigned_order', function ($query) use ($request, $driver) {
                return $query
                    ->where('assign_orders.Driver_id', $driver->id)
                    ->whereBetween('assign_orders.delivery_date', [$request->from, $request->to]);
            })->with('assigned_order')->orderBy('id', 'desc')->get();

            $response = [
                'status' => 200,
                'message' => 'success',
                'orders' => $assigned_orders,
                'total_orders' => count($assigned_orders)
            ];
            return response()->json($response, 200);
        } else {
            $assigned_orders = Order::whereHas('assigned_order', function ($query) use ($driver) {
                return $query->where('assign_orders.Driver_id', $driver->id);
            })->with('assigned_order')->orderBy('id', 'desc')->get();
        }

        $all_orders = [];
        foreach ($assigned_orders as $key => $value) {
            switch ($request->filter) {
                case 'previous':
                    if ($request->has('filterByDate') && isset($request->filterByDate)) {
                        if (strtotime($value->assigned_order->delivery_date) == strtotime($request->filterByDate)) {
                            array_push($all_orders, $value);
                        }
                        break;
                    }
                    if (strtotime($value->assigned_order->delivery_date) < strtotime(Carbon::now()->format('Y-m-d'))) {
                        array_push($all_orders, $value);
                    }
                    break;
                case 'upcoming':
                    if ($request->has('filterByDate') && isset($request->filterByDate)) {
                        if (strtotime($value->assigned_order->delivery_date) == strtotime($request->filterByDate)) {
                            array_push($all_orders, $value);
                        }
                        break;
                    }
                    if (strtotime($value->assigned_order->delivery_date) > strtotime(Carbon::now()->format('Y-m-d'))) {
                        array_push($all_orders, $value);
                    }
                    break;
                case 'today':
                    if (strtotime($value->assigned_order->delivery_date) == strtotime(Carbon::now()->format('Y-m-d'))) {
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
            'total_orders' => count($all_orders)
        ];

        return response()->json($response, 200);
    }

    public function getDriverUpcoming(Request $request)
    {
        $driver = Driver::with('user')->where('user_id', auth()->id())->first();

        $assigned_orders = Order::whereHas('assigned_order', function ($query) use ($driver) {
            return $query->where('assign_orders.Driver_id', $driver->id);
        })->with('assigned_order')->get();

        $all_orders = [];
        foreach ($assigned_orders as $key => $value) {
            if ($request->has('filterByDate') && isset($request->filterByDate)) {
                if (strtotime($value->assigned_order->delivery_date) == strtotime($request->filterByDate)) {
                    array_push($all_orders, $value);
                }
                continue;
            }
            if (strtotime($value->assigned_order->delivery_date) > strtotime(Carbon::now()->format('Y-m-d'))) {
                array_push($all_orders, $value);
            }
        }

        $response = [
            'status' => 200,
            'message' => 'success',
            'orders' => $all_orders,
            'total_orders' => count($all_orders)
        ];

        return response()->json($response, 200);
    }

    public function getAllDrivers(Request $request)
    {
        $drivers = Driver::with('user')->where('status', 'approved')->get();

        $response = [
            'status' => 200,
            'message' => 'success',
            'drivers' => $drivers
        ];

        return response()->json($response, 200);
    }

    public function getDriver(Request $request)
    {
        $driver = Driver::with('user')->where('id', $request->id)->first();

        $response = [
            'status' => 200,
            'message' => 'success',
            'driver' => $driver
        ];

        return response()->json($response, 200);
    }
}
