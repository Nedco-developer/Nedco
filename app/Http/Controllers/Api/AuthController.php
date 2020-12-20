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
use App\Models\VerifyPhone;
use DB;
use Reflector;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $login = ['phone' => $request->phone, 'password' => $request->password];
        // auth attemt to login the user with the provided credintials
        if (Auth::attempt($login)) {
            // generating api token to authenticate the user 
            User::where('phone', $request->phone)->update([
                'api_token'     =>      Str::random(60),
                'player_id'      =>      $request->playerID
            ]);

            $user = User::where('phone', $request->phone)->first();

            $user_data = User::with($user->type)->where('id', $user->id)->first();

            // checking the status of the user
            switch ($user->type) {
                case 'client':
                    if ($user_data->client->status == 'pending' || $user_data->client->status == 'rejected') {
                        $response = ['status' => 400, 'message' => 'Your Account need to be Approved !', 'success' => false];
                        return response()->json($response, 200);
                    }
                    $address = $user_data->client->address;
                    break;
                case 'driver':
                    if ($user_data->driver->status == 'pending' || $user_data->driver->status == 'rejected') {
                        $response = ['status' => 400, 'message' => 'Your Account need to be Approved !', 'success' => false];
                        return response()->json($response, 200);
                    }
                    $address = $user_data->driver->address;
                    break;
                case 'dispatcher':
                    if ($user_data->dispatcher->status == 'pending' || $user_data->dispatcher->status == 'rejected') {
                        $response = ['status' => 400, 'message' => 'Your Account need to be Approved !', 'success' => false];
                        return response()->json($response, 200);
                    }
                    $address = $user_data->dispatcher->address;
                    break;
                case 'pickup':
                    if ($user_data->pickedup->status == 'pending' || $user_data->pickedup->status == 'rejected') {
                        $response = ['status' => 400, 'message' => 'Your Account need to be Approved !', 'success' => false];
                        return response()->json($response, 200);
                    }
                    $address = $user_data->pickedup->address;
                    break;
                default:
                    $address = '';
                    $response = ['status' => 400, 'message' => 'Somthing Went Wrong Please Try again later ', 'success' => false];
                    return response()->json($response, 200);
                    break;
            }
            
            $response = ['status' => 400, 'message' => 'login success', 'user' => $user_data, 'address' => $address, 'success' => true];
            return response()->json($response, 200);
        }
        $response = ['status' => 400, 'message' => 'Password Or Phone Number Is Incorrect', 'success' => false];
        return response()->json($response, 200);
    }

    public function register(Request $request)
    {
        $user = User::where('phone', $request->phone)->get();
        if (count($user) > 0) {
            $response = ['status' => 400, 'message' => 'Phone Number Already Exist !', 'success' => false];
            return response()->json($response, 200);
        }
        
        $rules = [
            'email' => 'required|email|max:255',
        ];

        $emailRules = [
            'email' => 'unique:users',
        ];

        $validator = Validator::make($request->all(), $rules);
        $UniqueEmailValidator = Validator::make($request->all(), $emailRules);
        if ($validator->fails()) {
            $response = ['status' => 400, 'message' => 'Email should be in a valid Format Ex: email@something.something', 'success' => false];
            return response()->json($response, 200);
        } elseif ($UniqueEmailValidator->fails()) {
            $response = ['status' => 400, 'message' => 'Email Already Exist', 'success' => false];
            return response()->json($response, 200);
        }


        try {

            $user = new User;
            $user->name   =  $request->name;
            $user->email  =  $request->email;
            $user->phone  =  $request->phone;
            $user->player_id  =  $request->playerID;
            $user->type   =  strtolower($request->type);
            $user->password   =  Hash::make($request->password);
            $user->save();

            if ($request->type == 'Client') {
                $client = new Client;
                $client->user_id  =   $user->id;
                $client->address  =   $request->address;
                $client->status   =  'approved';
                $client->save();

                $user_data = User::with($user->type)->where('id', $user->id)->first();

                $response = ['status' => 200, 'message' => 'Thank You For Registering', 'user' => $user_data, 'success' => true];
                return response()->json($response, 200);
            } elseif ($request->type == 'Driver') {
                $driver = new Driver;
                $driver->user_id =  $user->id;
                $driver->address =  $request->address;
                $driver->status  =  'Pending';
                $driver->save();
            } elseif ($request->type == 'Dispatcher') {
                $dispatcher = new Dispatcher;
                $dispatcher->user_id =  $user->id;
                $dispatcher->address =  $request->address;
                $dispatcher->status  =  'Pending';
                $dispatcher->save();
            } else {
                $response = ['status' => 400, 'message' => 'Internal Error'];
                return response()->json($response, 200);
            }

            $user_data = User::with($user->type)->where('id', $user->id)->first();

            $response = ['status' => 200, 'message' => 'Account Created Wait Until Your account get Approved', 'user' => $user_data, 'success' => true];
            return response()->json($response, 200);
        } catch (\Exception $e) {

            $response = [
                'status' => 400,
                'message' => $e->getMessage(),
            ];

            return response()->json($response, 200);
        }
    }
    
    public function update_profile(Request $request)
    {
        $user = User::find($request->id);
        $user_data = User::with($user->type)->where('id', $user->id)->first();
        
        $rules = [
            'email' => 'required|email|max:255',
        ];

        $emailRules = [
            'email' => 'unique:users',
        ];

        $validator = Validator::make($request->all(), $rules);
        $UniqueEmailValidator = Validator::make($request->all(), $emailRules);
        if ($validator->fails()) {
            $response = ['status' => 400, 'message' => 'Email should be in a valid Format Ex: email@something.something', 'success' => false];
            return response()->json($response, 200);
        } elseif ($UniqueEmailValidator->fails()) {
            $response = ['status' => 400, 'message' => 'Email Already Exist', 'success' => false];
            return response()->json($response, 200);
        }
        
        try {
            if ($request->has('name') && $request->name != '') {
                $user->name   =  $request->name;
                $user->save();
            }
            if ($request->has('phone') && $request->phone != '') {
                $user->phone  =  $request->phone;
                $user->save();
            }
            if ($request->has('email') && $request->email != '') {
                $user->email  =  $request->email;
                $user->save();
            }

            if ($user->type == 'client') {
                if ($request->address != '') {
                    $client = Client::where('user_id', $user->id)->update([
                        'address' => $request->address
                    ]);  
                }
                $address = $user_data->client->address;
            } elseif ($user->type == 'driver') {
                if ($request->address != '') {
                    $driver = Driver::where('user_id', $user->id)->update([
                        'address' => $request->address
                    ]);
                }
                $address = $user_data->driver->address;
            } elseif ($user->type == 'dispatcher') {
                if ($request->address != '') {
                    $dispatcher = Dispatcher::where('user_id', $user->id)->update([
                        'address' => $request->address
                    ]); 
                }
                $address = $user_data->dispatcher->address;
            } else {
                // $response = ['status' => 400, 'message' => 'Internal Error'];
                // return response()->json($response, 200);
            }

            $response = ['status' => 200, 'message' => 'Profile Updated Successfully', 'user' => $user_data, 'address' => $address, 'success' => true];
            return response()->json($response, 200);
        } catch (\Exception $e) {

            $response = [
                'status' => 400,
                'message' => $e->getMessage(),
            ];

            return response()->json($response, 200);
        }
    }

    public function getUser(Request $request)
    {
        $user = auth()->user();
        if (is_null($user)) {
            $response = ['message' => 'User Not Found'];
            return response()->json($response, 400);
        }
        $response = ['user' => $user, 'message' => 'sucess'];
        return response()->json($response, 200);
    }

    
    public function forgotPassword(Request $request)
    {
        $user = User::where('phone', $request->phone_number)->first();

        if ($user) {
            $code = rand(1000, 9999);
            $verifyPhone = new VerifyPhone();
            $verifyPhone->phone    =    $request->phone_number;
            $verifyPhone->code     =    $code;
            $verifyPhone->type     =    2;
            $verifyPhone->save();
            $response = ['code' => $code, 'message' => 'success'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'The given phone number was not found in our records !', 'status' => 400];
            return response()->json($response, 200);
        }
    }

    public function verifyForgetPassword(Request $request)
    {
        $date = date("Y-m-d h:i:s");
        $time = strtotime($date);
        $time = $time - (5 * 60);
        $date = date("Y-m-d h:i:s", $time);

        $verifyPhone = DB::table('verify_phones')->where('phone', $request->phone_number)
            ->where('type', 2)
            ->latest()
            ->first();

        if(strtotime($verifyPhone->created_at) < strtotime($date)){
            $response = ['message' => 'Code Expierd !', 'status' => 400];
            return response()->json($response, 200);
        }

        if (isset($verifyPhone)){
            if ($verifyPhone->code == $request->code) {

                $verifyPhone = VerifyPhone::find($verifyPhone->id);
                $verifyPhone->type     =    -2;
                $verifyPhone->save();

                $user = User::where('phone', $request->phone_number)->first();

                $response = ['user' => $user, 'message' => 'Success', 'status' => 200];
                return response()->json($response, 200);

            } else {
                $response = ['message' => 'Code Dosent Match !', 'status' => 400];
                return response()->json($response, 200);
            }
        } else {
            $response = ['message' => 'Code Expierd', 'status' => 400];
            return response()->json($response, 200);
        }
    }

    public function changePassword(Request $request)
    {
        $user = User::where('phone', $request->phone_number)->first();

        User::where('phone', $request->phone_number)->update([
            'password'     =>       Hash::make($request->new_password)
        ]);

        $response = ['message' => 'Success', 'status' => 200];
        return response()->json($response, 200);
    }
}
