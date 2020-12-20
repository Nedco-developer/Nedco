@extends('layouts.dashboardApp')

@section('title', 'Edit Client')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-11">

        <div class="row">
            <div class="col-xl-4 col-sm-6 py-2">
                <div class="cardh-100">
                    <div class="card-body text-white mx-auto text-center bg-danger">
                        <div class="rotate ">
                            <i class="fa fa-user fa-4x"></i>
                        <h6 class="text-uppercase">New Clients</h6>
                        </div>
                        <h1 class="display-4 text-center">{{$clientsCount}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 py-2">
                <div class="card text-white bg-success h-100">
                    <div class="card-body bg-success mx-auto text-center">
                        <div class="rotate">
                            <i class="fa fa-line-chart fa-4x"></i>
                            <h6 class="text-uppercase">orders</h6>
                        </div>
                        <h1 class="display-4">{{ $ordersCount }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 py-2">
                <div class="card text-white bg-primary h-100">
                    <div class="card-body bg-primary mx-auto text-center">
                        <div class="rotate">
                            <i class="fa fa-car fa-4x"></i>
                            <h6 class="text-uppercase">Deliveries</h6>
                        </div>
                        <h1 class="display-4">{{ $deliveriesCount }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-sm-6 py-2">
                <div class="card bg-info text-white h-100">
                    <div class="card-body bg-info mx-auto text-center">
                        <div class="rotate">
                            <i class="fa fa-money fa-4x"></i>
                        </div>
                        <h6 class="text-uppercase">Total received Of Items Deliverd By Clients</h6>
                        <h1 class="display-6">{{$totalItems}} JOD</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 py-2">
                <div class="card text-white bg-warning h-100">
                    <div class="card-body bg-warning mx-auto text-center">
                        <div class="rotate">
                            <i class="fa fa-money fa-4x"></i>
                        </div>
                        <h6 class="text-uppercase">Total received of deliveries By Clients</h6>
                        <h1 class="display-6">{{ $netProfit }} JOD</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 py-2">
                <div class="card text-white bg-danger h-100">
                    <div class="card-body bg-danger mx-auto text-center">
                        <div class="rotate">
                            <i class="fa fa-money fa-4x"></i>
                        </div>
                        <h6 class="text-uppercase">Total paid for drivers</h6>
                        <h1 class="display-6">{{ $districtsPrices }} JOD</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 py-2">
                <div class="card text-white bg-secondary h-100">
                    <div class="card-body mx-auto text-center">
                        <div class="rotate">
                            <i class="fa fa-money fa-4x"></i>
                        </div>
                        <h6 class="text-uppercase">Net profit</h6>
                        <h1 class="display-6">{{ $netProfit }} JOD </h1>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection