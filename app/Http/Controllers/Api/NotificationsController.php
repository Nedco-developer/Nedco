<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Notifications;

class NotificationsController extends Controller
{
    public function getNotifications(){
        
        if (Auth::user()->type == 'dispatcher' || Auth::user()->type == 'pickup') {
            $notifications = Notifications::where('type', Auth::user()->type)->orderBy('id', 'desc')->get();   
        } else {
            $notifications = Notifications::where('user_Id', Auth::id())->orderBy('id', 'desc')->get();
        }
        
        $response = [
            'status' => 200,
            'message' => 'Seccuss',
            'notifications' => $notifications
        ];

        return response()->json($response, 200);
    }
    
    public function markAllAsRead(Request $request){

        foreach($request->ids as $id) {
            $notification = Notifications::find($id);
            $notification->is_seen = 1;
            $notification->save();
        }
        
        $response = [
            'status' => 200,
            'message' => 'Seccuss',
        ];

        return response()->json($response, 200);
    }
    
    public function updateToIsSeen(Request $request){
        $notification = Notifications::find($request->id);
        $notification->is_seen = 1;
        $notification->save();
        
        $response = [
            'status' => 200,
            'message' => 'Seccuss',
        ];

        return response()->json($response, 200);
    }
}