@extends('layouts.dashboardApp')

@section('title', 'Add Locations')

@section('content')
<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Districts') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('SubmitDistricts') }}" enctype="multipart/form-data">
                        @csrf
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('District') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="Districts" id="Districts" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                            <div class="col-md-6">
                                <select required name="City_id" id="City_id" class="form-control">
                                    @foreach($City as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>z
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Client Default Delivery Price') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="Price" id="Price" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Driver Default Delivery Price') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="driver_price" id="driver_price" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
