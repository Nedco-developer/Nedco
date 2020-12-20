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
use App\Models\City;
use App\Models\Districts;
use Carbon\Carbon;
use Reflector;

class UserController extends Controller
{
    public function getStatistics(Request $request)
    {
        $orders = Order::with('client')->with('assigned_order');

        if ($request->filter == 'from-to') {

            $orders = Order::with('client')->whereHas('assigned_order', function ($query) use ($request) {
                return $query->whereBetween('assign_orders.delivery_date', [$request->from, $request->to]);
            })->get();

            $response = [
                'status' => 200,
                'message' => 'success',
                'orders' => $orders
            ];

            return response()->json($response, 200);
        }

        $orders = $orders->get();

        $orders_total = [];
        $all_orders = [];
        foreach ($orders as $key => $value) {
            switch ($request->filter) {
                case 'weekly':
                    if (isset($value->assigned_order->delivery_date)) {
                        if (strtotime($value->assigned_order->delivery_date) < strtotime(Carbon::now()->subWeek()->format('Y-m-d'))) {
                            array_push($all_orders, $value);
                            array_push($orders_total, (float)$value->totalPrice);
                        };
                    }
                    break;
                case 'monthly':
                    if (isset($value->assigned_order->delivery_date)) {
                        if (strtotime($value->assigned_order->delivery_date) > strtotime(Carbon::now()->subMonth()->format('Y-m-d'))) {
                            array_push($all_orders, $value);
                            array_push($orders_total, (float)$value->totalPrice);
                        };
                    }
                    break;
                case 'today':
                    if (isset($value->assigned_order->delivery_date)) {
                        if (strtotime($value->assigned_order->delivery_date) == strtotime(Carbon::now()->format('Y-m-d'))) {
                            array_push($all_orders, $value);
                            array_push($orders_total, (float)$value->totalPrice);
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
            'total_orders' => count($all_orders)
        ];
        
        return response()->json($response, 200);
    }

    public function getLocations(Request $request)
    {
        $location = Location::all();

        $response = [
            'status' => 200,
            'message' => 'success',
            'locations' => $location,
        ];

        return response()->json($response, 200);
    }

    public function getCities(Request $request)
    {
        $cities = City::where('locations', $request->id)->get();

        $response = [
            'status' => 200,
            'message' => 'success',
            'cities' => $cities,
        ];

        return response()->json($response, 200);
    }

    public function getDistricts(Request $request)
    {
        $districts = Districts::where('city_id', $request->id)->get();

        $response = [
            'status' => 200,
            'message' => 'success',
            'districts' => $districts,
        ];

        return response()->json($response, 200);
    }
}
