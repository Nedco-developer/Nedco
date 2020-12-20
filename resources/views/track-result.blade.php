@extends('layouts.app')

@section('content')
<style>
    @media only screen and (min-width: 320px) and (max-width: 568px) {
    .nav-link {
        margin-left: 1rem !important;
    }
    .side-container {
        height: 100% !important;
    }
    .side-container3 {
        height: 100% !important;
    }
    .nav-item {
    height: 5rem !important;
        margin-left: 0rem !important;
    }
    .table-resp{
        display: block !important;
        overflow-x: auto !important;
    }
}
@media only screen and (max-width: 768px) and (max-width: 1024px) {
  .side-container {
         height: 100% !important;
    }
    .side-container3 {
        height: 100% !important;
    }
    .row {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: 0px !important;
    margin-left: 0px !important;
    }
    
    .text{
        font-size:1rem !important;
    }
    .home-form {
    width: 100% !important;
    }
    .nav-item {
    height: 5rem !important;
     margin-left: 1rem !important;
    }
    .table-res{
            display: block !important;
        overflow-x: auto !important;
    }
}
@media only screen and (max-width: 600px) {
    .nav-link {
    margin-left: 1rem !important;
    }
  .side-container {
    height: 100% !important;
    }
    
    .side-container3 {
      height: 100% !important;
    }
    
    .row {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: 0px !important;
    margin-left: 0px !important;
    }
    
    .text{
        font-size:1rem !important;
    }
    .home-form {
    width: 100% !important;
    }
    .nav-item {
    height: 5rem !important;
     margin-left: 1rem !important;
    }
    .table-resp{
            display: block !important;
        overflow-x: auto !important;
        }
}
@media only screen and (min-width: 601px) and (max-width: 768px) {
    .nav-link {
    margin-left: 1rem !important;
    }
    .side-container {
        height: 100% !important;
    }
    .side-container3 {
      height: 100% !important;
    }
    .nav-item {
    height: 5rem !important;
     margin-left: 0rem !important;
    }
    .table-resp{
            display: block !important;
        overflow-x: auto !important;
        }
}
@media only screen and (max-width: 1024px) {
    .nav-link {
    margin-left: 1rem !important;
    }
    .text{
        font-size:0rem !important;
    }
    .home {
      padding: 94px 0px !important;
    }
    .nav-item {
    height: 5rem !important;
     margin-left: 0rem !important;
    }
    .table-resp{
            display: block !important;
        overflow-x: auto !important;
        }
}
</style>
<div class="container-fliud">
    <div class="row">
        <div class="index col-md-3">
            <div class="side-container3 color">
                <div>
                    <div class="row">
                            <img src="images/Group 12.png" class="img" alt="Track Shipments">
                    </div>
                        <br>
                    <div class="row text">
                            <p>Track Shipments</p>
                    </div>
                </div>
            </div>
        </div>
         <div class="col-md-6 mx-auto">
             <div class="track-form" style="margin-bottom: 1rem;">
                 <div class="card">
                    <div class="card-body"/>
                         <br>
                         <h5 class="ml-4">Tracking Result</h5>
                         <br>
                        <table class="display nowrap table-resp table table-condensed">
                         <thead style="background: #f5f6f8;">
                                <tr>
                                    <th>id</th>
                                    <th>status</th>
                                    <th>city</th>
                                    <th>status</th>
                                    <th>payment_status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Order as $order)
                                <tr>
                                    <th>{{$order->id}}</th>
                                    <th>{{$order->status}}</th>
                                    <th>{{$order->city}}</th>
                                    <th>{{$order->status}}</th>
                                    <th>{{$order->payment_status}}</th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection