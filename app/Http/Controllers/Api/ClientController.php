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
use App\Models\DistrictsPrices;
use App\Models\Notifications;
use Carbon\Carbon;
use Reflector;

class ClientController extends Controller
{
    public function getClientStatistics(Request $request)
    {
        $client = Client::with('user')->where('user_id', auth()->id())->first();

        if ($request->filter == 'from-to') {

            $orders = Order::where('client_id', $client->id)->whereHas('assigned_order', function ($query) use ($request) {
                return $query->whereBetween('assign_orders.delivery_date', [$request->from, $request->to]);
            })->with('assigned_order')->orderBy('id', 'desc')->get();

            $orders_total = [];
            foreach ($orders as $key => $value) {
                array_push($orders_total, (float)$value->totalPrice);
            }

            $response = [
                'status' => 200, 'message' => 'success',
                'orders' => $orders,
                'orders_total' => number_format(array_sum($orders_total), 2),
                'total_orders' => count($orders)
            ];

            return response()->json($response, 200);
        }

        $orders = Order::with('assigned_order')->where('client_id', $client->id)->orderBy('id', 'desc')->get();

        $orders_total = [];
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
                    if (isset($value->assigned_order->delivery_date)) {
                        if (strtotime($value->assigned_order->delivery_date) == strtotime(Carbon::now()->format('Y-m-d'))) {
                            array_push($all_orders, $value);
                        }
                    }
                    break;
                default:
                    array_push($all_orders, $value);
                    break;
            }
        }

        $response = [
            'status' => 200, 'message' => 'success',
            'orders' => $all_orders,
            'orders_total' => number_format(array_sum($orders_total), 2),
            'total_orders' => count($all_orders)
        ];

        return response()->json($response, 200);
    }

    public function getClientHomeStatistics(Request $request)
    {
        $client = Client::with('user')->where('user_id', auth()->id())->first();

        $orders = Order::with('assigned_order')->where('client_id', $client->id)->get();
        
        $notificaions = Notifications::where('user_Id', Auth::id())->where('is_seen', 0)->count();
       
        $orders_total = [];
        $all_orders = [];
        foreach ($orders as $key => $value) {
            switch ($request->filter) {
                case 'weekly':
                    if (isset($value->assigned_order->delivery_date)) {
                        if (strtotime($value->assigned_order->delivery_date) >= strtotime(Carbon::now()->subWeek()->format('Y-m-d'))) {
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
            'status' => 200, 'message' => 'success',
            'orders' => $all_orders,
            'orders_total' => number_format(array_sum($orders_total), 2),
            'total_orders' => count($all_orders),
            'notificaions' => $notificaions
        ];

        return response()->json($response, 200);
    }

    public function getDeliveryPrice(Request $request)
    {
        $delivery_price = DistrictsPrices::where('user_id', auth()->id())->where('district_id', $request->district_id)->select('price')->first();
        
        $response = [
            'status' => 200,
            'message' => 'Success',
            'delivery_price' => $delivery_price
        ];

        return response()->json($response, 200);
    }
}
