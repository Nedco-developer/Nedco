@extends('layouts.dashboardApp')
@section('title', 'Orders')

@section('content')
<br>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Locations prices') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif
                <div class="form-group row md-2">
                    @foreach($cities as $city)
                        <div class="form-group col md-2">
                        <button class="btn btn-primary"><a href="districts-prices?id={{$city->id}}&user_id={{$user_id}}">{{$city->name}}</a></button>
                        </div>
                    @endforeach
                </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Continue') }}
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
