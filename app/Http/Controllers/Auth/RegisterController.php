<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;
use App\Models\Dispatcher;
use App\Models\Finance;
use App\Models\Monitor; 
use App\Models\Driver;
use App\Models\Pickedup;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'unique:users','max:255'],
            'type' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    //register all users
    protected function create(array $data)
    {
        $status = 'pending';
        if(Auth::user()){
            if(Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin' ){
                $status = 'approved';
            }
        }
        $user = new User();
        $user->name = $data['name']; 
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->type = $data['type'];
        $user->password = Hash::make($data['password']);
        $user->save();

        if($data['type'] == 'client')
        {
            $client = new Client();
            $client->user_id = $user->id;
            $client->address = $data['address'];
            $client->status =  'approved';
            $client->save();
        }
        elseif($data['type'] == 'driver')
        {
            $driver = new Driver();
            $driver->user_id = $user->id;
            $driver->address = $data['address'];
            $driver->status =  $status;
            $driver->save();
        }
        elseif($data['type'] == 'finance')
        {
            $finance = new Finance();
            $finance->user_id = $user->id;
            $finance->address = $data['address'];
            $finance->status =  $status;
            $finance->save();
        }
        elseif($data['type'] == 'dispatcher')
        {
            $dispatcher = new Dispatcher();
            $dispatcher->user_id = $user->id;
            $dispatcher->address = $data['address'];
            $dispatcher->status =  $status;
            $dispatcher->save();
        }
        elseif($data['type'] == 'monitor')
        {
            $monitor = new Monitor();
            $monitor->user_id = $user->id;
            $monitor->address = $data['address'];
            $monitor->status =  $status;
            $monitor->save();
        }
        elseif($data['type'] == 'pickup')
        {
            $monitor = new Pickedup();
            $monitor->user_id = $user->id;
            $monitor->address = $data['address'];
            $monitor->status =  $status;
            $monitor->save();
        }
    }
}
