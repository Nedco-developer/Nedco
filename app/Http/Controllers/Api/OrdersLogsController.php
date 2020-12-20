<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\OrdersLogs;
use Carbon\Carbon;

class OrdersLogsController extends Controller
{ 
    public function addLog(Request $request)
    {
        $log = new OrdersLogs();
        $log->order_id = $request->order_id;
        $log->log = $request->log;
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imgName = time().$request->ext;
            $image->move('orders_log_images', $imgName);
            $log->log_img = 'orders_log_images/'.$imgName;
        }
        $log->save();
        
        $response = [
            'status' => 200,
            'message' => 'Added Seccussfully',
            'log' => $log,
        ];
        
        return response()->json($response, 200);
    }
}