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

class pickedupController extends Controller
{
    public function pickeduphome(Request $request)
    {
        return view("pickedup.pickeduphome");
    }
}