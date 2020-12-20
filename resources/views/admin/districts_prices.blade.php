@extends('layouts.dashboardApp')

@section('title', 'Add Districts Prices Form')

@section('content')

<br>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Add Districts Prices Form') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('submitDistrictsPrices') }}">
                        @csrf
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif
                        <input type="hidden" class="form-control" name="user_id" value="{{$user_id}}" />
                        <!--@foreach($districts as $district)-->
                        <!-- <div class="form-group row">-->
                        <!--    <label for="name" class="col-md-4 col-form-label text-md-right">{{ $district->name }}</label>-->
                        <!--    <div class="col-md-6">-->
                        <!--        <input type="text" class="form-control" name="{{ $district->id }}" value="" autofocus>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--@endforeach-->
                @foreach($districts as $district)   
                    @if(!count($userDistricts) > 0)
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ $district->name }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="{{ $district->id }}" value="" autofocus>
                            </div>
                        </div>
                    @endif
                    @foreach($userDistricts as $Districts)
                        @if($district->id != $Districts->district_id)
                            @if($district->id == $Districts->district_id)
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ $district->name }}</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="{{ $district->id }}" value="" autofocus>
                                    </div>
                                </div>
                            @endif
                        @endif
                        @if($district->id == $Districts->district_id)
                           <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ $district->name }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="{{ $Districts->district_id }}" value="{{$Districts->price}}" autofocus>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Submit') }}
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
