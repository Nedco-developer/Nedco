@extends('layouts.dashboardApp')

@section('title', 'Add Locations')

@section('content')
<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Cities') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('submit_add_coupon') }}" enctype="multipart/form-data">
                        @csrf
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Coupon Code') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="code" id="code" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Discount In JOD') }}</label>
                            <div class="col-md-6">
                                <input type="number" step="0.01" name="discount" id="discount" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Expires at') }}</label>
                            <div class="col-md-6">
                                <input type="date" name="expires_at" id="expires_at" class="form-control" min="{{ date('Y-m-d') }}">
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
