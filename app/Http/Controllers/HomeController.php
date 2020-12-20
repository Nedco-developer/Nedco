<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Dispatcher;
use App\Models\Finance;
use App\Models\Monitor;
use App\Models\Driver;
use App\Models\User;
use App\Models\Location;
use App\Models\AssignOrders;
use App\Models\Districts;
use App\Models\DistrictsPrices;
use App\Models\Order;
use App\Models\Pickedup;
use App\Models\Notifications;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //home page for all users
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect(route('login'));
        }

        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {

            $clientsCount = Client::whereDate('created_at', '>', Carbon::now()->subDays(30)->toDateString())->count();

            $orders = Order::with('assigned_order')->whereDate('created_at', '>', Carbon::now()->subDays(30)->toDateString())->get();

            $ordersCount = count($orders);

            $deliveriesCount = Order::whereHas('assigned_order', function ($query) {
                return $query->whereDate('delivery_date', '>', Carbon::now()->subDays(30)->toDateString());
            })->with('assigned_order')->count();

            $districtsIds = array();
            $driverIds = array();
            foreach($orders as $order)
            {
                if (isset($order->assigned_order->Driver_id)) {
                    $driver = Driver::where('id',$order->assigned_order->Driver_id)->with('user')->first();
                    array_push($driverIds, $driver->user_id);
                    array_push($districtsIds, $order->districts);
                }
            }

            $districtsPrices = DistrictsPrices::whereIn('user_id',$driverIds)->whereIn('district_id', $districtsIds)->pluck('price')->sum();

            $netProfit = Order::whereDate('created_at', '>', Carbon::now()->subDays(30)->toDateString())->sum('deliveryPrice');

            $totalItems = Order::whereDate('created_at', '>', Carbon::now()->subDays(30)->toDateString())->sum('itemPrice');
            
            return view('admin.index', compact('clientsCount', 'ordersCount', 'deliveriesCount', 'netProfit', 'totalItems', 'districtsPrices'));
            
        } elseif (Auth::user()->type == 'client') {
            $status = client::where('user_id', Auth::user()->id)->first();

            if ($status->status == 'rejected') {
                Auth::logout();
                return redirect()->back()->with('success', 'لم يتم قبولك');
            }
            if ($status->status == 'approved') {
                return redirect('/viewOrder');
            }
            if ($status->status == 'pending') {
                Auth::logout();
                return redirect()->back()->with('success', 'يرجى الانتظار حتى يتم قبولك لتتمكن من تسجيل الدخول');
            }
        } elseif (Auth::user()->type == 'driver') {
            $status = Driver::where('user_id', Auth::user()->id)->first();

            if ($status->status == 'rejected') {
                Auth::logout();
                return redirect()->back()->with('success', 'لم يتم قبولك');
            }
            if ($status->status == 'approved') {
                return redirect('/driverOrder');
            }
            if ($status->status == 'pending') {
                Auth::logout();
                return redirect()->back()->with('success', 'يرجى الانتظار حتى يتم قبولك لتتمكن من تسجيل الدخول');
            }
        } elseif (Auth::user()->type == 'finance') {
            $status = Finance::where('user_id', Auth::user()->id)->first();

            if ($status->status == 'rejected') {
                Auth::logout();
                return redirect()->back()->with('success', 'لم يتم قبولك');
            }
            if ($status->status == 'approved') {
                return redirect('/Report');
            }
            if ($status->status == 'pending') {
                Auth::logout();
                return redirect()->back()->with('success', 'يرجى الانتظار حتى يتم قبولك لتتمكن من تسجيل الدخول');
            }
        } elseif (Auth::user()->type == 'dispatcher') {
            $status = Dispatcher::where('user_id', Auth::user()->id)->first();

            if ($status->status == 'rejected') {
                Auth::logout();
                return redirect()->back()->with('success', 'لم يتم قبولك');
            }
            if ($status->status == 'approved') {
                return redirect('/DispatcherOrder');
            }
            if ($status->status == 'pending') {
                Auth::logout();
                return redirect()->back()->with('success', 'يرجى الانتظار حتى يتم قبولك لتتمكن من تسجيل الدخول');
            }
        } elseif (Auth::user()->type == 'monitor') {
            $status = Monitor::where('user_id', Auth::user()->id)->first();

            if ($status->status == 'rejected') {
                Auth::logout();
                return redirect()->back()->with('success', 'لم يتم قبولك');
            }
            if ($status->status == 'approved') {
                return redirect('/monitor-assigned-orders');
            }
            if ($status->status == 'pending') {
                Auth::logout();
                return redirect()->back()->with('success', 'يرجى الانتظار حتى يتم قبولك لتتمكن من تسجيل الدخول');
            }
        } elseif (Auth::user()->type == 'pickup') {
            $status = Pickedup::where('user_id', Auth::user()->id)->first();

            if ($status->status == 'rejected') {
                Auth::logout();
                return redirect()->back()->with('success', 'لم يتم قبولك');
            }
            if ($status->status == 'approved') {
                return redirect('/pickups');
            }
            if ($status->status == 'pending') {
                Auth::logout();
                return redirect()->back()->with('success', 'يرجى الانتظار حتى يتم قبولك لتتمكن من تسجيل الدخول');
            }
        }
    }
    //approve or deny all users
    public function UserStatus(Request $request)
    {
        if ($request->get('type') == 'driver') {
            $driver =  Driver::find($request->get('id'))->update(['status' => $request->get('status')]);
            $driverInfo =  Driver::find($request->get('id'));
            return redirect('location-prices/'. $driverInfo->user_id);
        } elseif ($request->get('type') == 'finance') {
            $Finance =  Finance::find($request->get('id'))->update(['status' => $request->get('status')]);
            return redirect()->back()->with('success', 'updated successfully');
        } elseif ($request->get('type')  == 'dispatcher') {
            $Dispatcher =  Dispatcher::find($request->get('id'))->update(['status' => $request->get('status')]);
            return redirect()->back()->with('success', 'updated successfully');
        } elseif ($request->get('type')  == 'monitor') {
            $Monitor =  Monitor::find($request->get('id'))->update(['status' => $request->get('status')]);
            return redirect()->back()->with('success', 'updated successfully');
        } elseif ($request->get('type')  == 'pickup') {
            $Monitor =  Pickedup::find($request->get('id'))->update(['status' => $request->get('status')]);
            return redirect()->back()->with('success', 'updated successfully');
        }
        return redirect()->back()->with('error', 'update was not successfull');
    }

    public function registerAdmin(Request $request)
    {
        return view('registerAdmin');
    }
    public function RegisterByAdmin(Request $request)
    {
        $status = 'pending';
        if (Auth::user()) {
            if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
                $status = 'approved';
            }
        }
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->type = $request->get('type');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        if ($request->get('type') == 'client') {
            $client = new Client();
            $client->user_id = $user->id;
            $client->phone   = $request->get('phone');
            $client->age     =  $request->get('age');
            $client->address = $request->get('address');
            $client->status  =  'approved';
            $client->save();
        } elseif ($request->get('type') == 'driver') {
            $driver = new Driver();
            $driver->user_id = $user->id;
            $driver->phone = $request->get('phone');
            $driver->age =  $request->get('age');
            $driver->address = $request->get('address');
            $driver->status =  $status;
            $driver->save();
        } elseif ($request->get('type') == 'finance') {
            $finance = new Finance();
            $finance->user_id = $user->id;
            $finance->phone = $request->get('phone');
            $finance->age =  $request->get('age');
            $finance->address = $request->get('address');
            $finance->status =  $status;
            $finance->save();
        } elseif ($request->get('type') == 'dispatcher') {
            $dispatcher = new Dispatcher();
            $dispatcher->user_id = $user->id;
            $dispatcher->phone = $request->get('phone');
            $dispatcher->age =  $request->get('age');
            $dispatcher->address = $request->get('address');
            $dispatcher->status =  $status;
            $dispatcher->save();
        } elseif ($request->get('type') == 'monitor') {
            $monitor = new Monitor();
            $monitor->user_id = $user->id;
            $monitor->phone = $request->get('phone');
            $monitor->age =  $request->get('age');
            $monitor->address = $request->get('address');
            $monitor->status =  $status;
            $monitor->save();
        }
        return redirect()->back()->with('success', 'User Added successfully');
    }
    
    public function sendEmail(Request $request){
        // \Mail::raw($request->$message, function($message) {
        //     $message->from($request->email, $request->subject);
        //     $message->to('ammar.m.alzyoud@gmail.com');
        // });
        
        $data = ['emailContent' => $request->message, 'name' => $request->name, 'phone' => $request->phone, 'email' => $request->email];
        
        \Mail::send('emails.contact',$data, function ($message) use ($request) {
			$message->from($request->email, $request->name);
			$message->to('brobrhooom1@gmail.com');
			$message->subject($request->subject);
 		});
        return redirect()->back()->with('success', 'Thank you for contacting us , we will reach to you soon  ');
    }
    
    public function SeeMore(Request $request){
        
        if(Auth::user()->type == 'dispatcher')
        {
            $notifications = Notifications::where('user_id', null)->where('id','<',$request->id)->orderBy('id', 'DESC')->limit(5)->get();
            $count_notifications = Notifications::where('user_id', null)->where('is_seen', 0)->count();
            return $notifications;
        }
        else if(Auth::user()->type == 'driver' )
        {
            $notifications = Notifications::where('user_id', Auth::user()->id)->where('id','<',$request->id)->orderBy('id', 'DESC')->limit(5)->get();
            $count_notifications = Notifications::where('user_id', Auth::user()->id)->where('is_seen', 0)->count();
            return $notifications;
        }
        else if(Auth::user()->type == 'client')
        {
            $notifications = Notifications::where('user_id', Auth::user()->id)->where('id','<',$request->id)->orderBy('id', 'DESC')->limit(5)->get();
            $count_notifications = Notifications::where('user_id', Auth::user()->id)->where('is_seen', 0)->count();
            return $notifications;
        }
    }
    
}
