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
use App\Models\Order;
use App\Models\City;
use App\Models\Districts;

class CityController extends Controller
{
    public function addCities(Request $request){
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $locations = Location::all();
            return view('admin.addCities',compact(['locations']));
        } 
        else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }
    
    public function SubmitCities(Request $request){
        $city = new City();
        $city->name = $request->City;
        $city->locations = $request->Region_id;
        $city->price = $request->price;
        $city->driver_price = $request->driver_price;
        $city->city_code = $request->city_code;
        $city->save();
        return redirect()->back()->with('success', 'City Added successfully');
    }
    
    public function editCities(Request $request){
        $city = City::where('id', $request->get('id'))->first();
        $locations = Location::all();
        return view('admin.editCities', compact('locations','city'));
    }
    
    public function deleteCities(Request $request){
        City::find($request->get('id'))->delete();
        return redirect()->back()->with('error', 'City deleted successfully');
    }
    
    public function SubmitEditCities(Request $request){
        $City = City::where('id' , $request->get('id'))->first();
        $City->name = $request->input('City');
        $City->locations = $request->input('Region_id');
        $City->price = $request->price;
        $City->driver_price = $request->driver_price;
        $City->city_code = $request->city_code;
        $City->save();
        return redirect()->back()->with('success', 'City Edit successfully');
    }
    
    public function addDistricts(Request $request){
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $City = City::all();
            return view('admin.AddDistricts',compact(['City']));
        } 
        else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }
    
    public function SubmitDistricts(Request $request){
        $Districts = new Districts();
        $Districts->city_id = $request->input('City_id');
        $Districts->name = $request->input('Districts');
        $Districts->price = $request->input('Price');
        $Districts->driver_price = $request->driver_price;
        $Districts->save();
        return redirect()->back()->with('success', 'Districts Added successfully');
    }
    
    public function editDistricts(Request $request)
    {
        $Districts = Districts::where('id', $request->get('id'))->first();
        $city = City::all();
        return view('admin.editDistricts', compact('city','Districts'));
    }
    
    public function deleteDistricts(Request $request)
    {
        Districts::find($request->get('id'))->delete();
        return redirect()->back()->with('error', 'Districts deleted successfully');
    }
    
    public function SubmitEditDistricts(Request $request){
        $Districts = Districts::find($request->id);
        $Districts->city_id = $request->input('City_id');
        $Districts->name = $request->input('Districts');
        $Districts->price = $request->input('Price');
        $Districts->driver_price = $request->driver_price;
        $Districts->save();
        return redirect()->back()->with('success', 'Districts Edit successfully');
    }

}
