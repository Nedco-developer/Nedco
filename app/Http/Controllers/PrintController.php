<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Milon\Barcode\Facades\DNS1DFacade;
use App\Models\Order;
use App\Models\City;
use App\Models\Location;
use App\Models\Districts;

class PrintController extends Controller
{
    public function print(Request $request)
    {
        $order = Order::find($request->id);
        $region = Location::find($order->locations);
        $city = City::find($order->city_id);
        $destrict = Districts::find($order->districts);

        return view('print.print', compact('order', 'region', 'city', 'destrict'));
    }
}