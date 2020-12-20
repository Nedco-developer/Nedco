<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;
use App\Models\City;
use App\Models\Districts;
use App\Models\LocationsPrices;
use App\Models\CitiesPrices;
use App\Models\DistrictsPrices;
use App\Models\Client;
use App\Models\Driver;

class LocationsPricesController extends Controller
{
    public function submitLocationPrice(Request $request){
        $locationsPrices = LocationsPrices::updateOrCreate(
            ['user_id' =>  $request->user_id, 'location_id' => $request->location_id],
            ['price' => $request->price]
        );
        
        return ['success' => true];
    }    
    
    public function submitCitiesPrice(Request $request){
        foreach($request->all() as $key => $value) {
            if ($key == 0) {
                continue;
            }

            $citiesPrices = CitiesPrices::updateOrCreate(
                ['user_id' =>  $request->user_id, 'city_id' => $key],
                ['price' => $value]
            );
        }
        return back()->with('success', 'added');
    }
    
    public function submitDistictsPrice(Request $request){
        foreach($request->all() as $key => $value) {
            if ($key == 0) {
                continue;
            }
            $districtsPrciese = DistrictsPrices::updateOrCreate(
                ['user_id' =>  $request->user_id, 'district_id' => $key],
                ['price' => $value]
            );
        }
        return ['success' => true];
    }    
    
    public function updateDistictsPrice(Request $request){
        $districtsPrciese = DistrictsPrices::updateOrCreate(
            ['user_id' =>  $request->user_id, 'district_id' => $request->district_id],
            ['price' => $request->price]
        );
        
        if ($districtsPrciese) {
            return ['success' => true];
        } 
        return ['success' => false];
    }    
    
    public function clientsDeliverPrices(Request $request)
    {
        if (Auth::user()->type != 'super_admin' && Auth::user()->type != 'admin') {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
        $districtsPrices = DistrictsPrices::with('user')->with('Districts')->get();
        $districts = Districts::all();
        $clients = Client::all();
        return view('admin.ClientsDeliveryPrices', compact('districtsPrices', 'districts', 'clients'));
    }
    
    public function defaultDeliveryPrices(Request $request)
    {
        if (Auth::user()->type != 'super_admin' && Auth::user()->type != 'admin') {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
        $districts = Districts::all();
        $locations = Location::all();
        $cities = City::all();
        return view('admin.DefaultDeliveryPrices', compact('locations', 'cities', 'districts'));
    }
    
    public function updatedefaultDeliveryPrices(Request $request){
        $districts = Districts::updateOrCreate(
            ['id' => $request->id],
            ['price' => $request->price]
        );
        
        if ($districts) {
            return ['success' => true];
        } 
        return ['success' => false];
    }   
    
    public function updateRegionPrice(Request $request){
        $location = Location::updateOrCreate(
            ['id' => $request->id],
            ['price' => $request->price]
        );
        
        if ($location) {
            return ['success' => true];
        } 
        return ['success' => false];
    } 
    
    public function updateCityPrices(Request $request){
        $city = City::updateOrCreate(
            ['id' => $request->id],
            ['price' => $request->price]
        );
        
        if ($city) {
            return ['success' => true];
        } 
        return ['success' => false];
    }   
    
    public function defaultPrices(Request $request){
        $locations = Location::all();
        $cities = City::all();
        $districts = Districts::all();
        $user = User::find($request->user_id);
        
        // if the user is a driver take the default driver price
        if ($user->type == 'driver') {
            foreach($locations as $location){
                $locationsPrices = LocationsPrices::updateOrCreate(
                    ['user_id' =>  $request->user_id, 'location_id' => $location->id],
                    ['price' => $location->driver_price]
                );
            }
            
            foreach($cities as $city){
                $citiesPrices = CitiesPrices::updateOrCreate(
                    ['user_id' =>  $request->user_id, 'city_id' => $city->id],
                    ['price' => $city->driver_price]
                );
            }
            
            foreach($districts as $district){
                $districtsPrciese = DistrictsPrices::updateOrCreate(
                    ['user_id' =>  $request->user_id, 'district_id' => $district->id],
                    ['price' => $district->driver_price]
                );
            }
        } else {
            foreach($locations as $location){
                $locationsPrices = LocationsPrices::updateOrCreate(
                    ['user_id' =>  $request->user_id, 'location_id' => $location->id],
                    ['price' => $location->price]
                );
            }
            
            foreach($cities as $city){
                $citiesPrices = CitiesPrices::updateOrCreate(
                    ['user_id' =>  $request->user_id, 'city_id' => $city->id],
                    ['price' => $city->price]
                );
            }
            
            foreach($districts as $district){
                $districtsPrciese = DistrictsPrices::updateOrCreate(
                    ['user_id' =>  $request->user_id, 'district_id' => $district->id],
                    ['price' => $district->price]
                );
            }
        }
        
        
        
        return back()->with('success', 'Delivry Prices was Updated');
    }
    
    // driver default delivery price
    public function driversDeliverPrices(Request $request)
    {
        if (Auth::user()->type != 'super_admin' && Auth::user()->type != 'admin') {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
        $districtsPrices = DistrictsPrices::with('user')->with('Districts')->get();
        $districts = Districts::all();
        $drivers = Driver::all();
        return view('admin.driversDeliverPrices', compact('districtsPrices', 'districts', 'drivers'));
    }
    public function driverDefaultDeliveryPrices(Request $request)
    {
        if (Auth::user()->type != 'super_admin' && Auth::user()->type != 'admin') {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
        $districts = Districts::all();
        $locations = Location::all();
        $cities = City::all();
        return view('admin.DriverDefaultDeliveryPrices', compact('locations', 'cities', 'districts'));
    }
    public function updateDriverDefaultDeliveryPrices(Request $request){
        $districts = Districts::where('id', $request->id)->update(['driver_price' => $request->driver_price]);
        
        if ($districts) {
            return ['success' => true];
        } 
        return ['success' => false];
    }   
    
    public function updateDriverRegionPrice(Request $request){
        $location = Location::where('id', $request->id)->update(['driver_price' => $request->driver_price]);
        
        if ($location) {
            return ['success' => true];
        } 
        return ['success' => false];
    } 
    
    public function updateDriverCityPrices(Request $request){
        $city = City::where('id', $request->id)->update(['driver_price' => $request->driver_price]);
        
        if ($city) {
            return ['success' => true];
        } 
        return ['success' => false];
    }  
    
}