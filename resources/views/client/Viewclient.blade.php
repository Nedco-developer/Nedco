@extends('layouts.dashboardApp')

@section('title', 'Orders')

@section('content')
<style>
    .borderright {
         border-right: solid #ee293a;
        border-right-width: 0.5px;
    }
    .borderrleft {
         border-left: solid #ee293a;
        border-left-width: 0.5px;
    }
    .haderrow{
        background: #ee293a;
        text-align-last: center;
        color: white;
    }
    .table-res{
        display: block !important;
        overflow-x: auto !important;
    }
    .entity-menu>.nav-item>a.active {
            background-color: #000;
            border-bottom: 0px solid black !important;
        }
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
    .table-res{
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
    .table-res{
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
    .table-res{
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
    .table-res{
            display: block !important;
        overflow-x: auto !important;
        }
}
</style>
<div style="margin-top: 10px;" class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 haderrow">
                        <h3>Client - تفاصيل العميل</h3>
                    </div>
                </div>
                    <br>
                <div class="row">
                    <div class="col-md-2">
                        <h5>     id :</h5>
                        <h5>   Name :</h5>
                        <h5>  Email :</h5>
                        <h5>  Phone :</h5>
                        <h5>Address :</h5>
                        <h5>Status :</h5>
                    </div>
                    <div class="col-md-4">
                        <h5>{{ $user->id }}</h5>
                        <h5>{{ $user->name }}</h5>
                        <h5>{{ $user->email }}</h5>
                        <h5>{{ $user->phone }}</h5>
                        <h5>{{ $user->client->address }}</h5>
                        @if( $user->client->status == 'approved')
                        <h5>Active</h5>
                        @else
                        <h5>Disactive</h5>
                        @endif
                    </div>
                </div>
                    <hr>
                <div class="row">
                    <div class="col-md-5 haderrow">
                        <h3>Short Report - تقارير مختصره</h3>
                    </div>
                </div>
                    <br>
                <div class="row">
                    <div class="col-md-4 borderright">
                        <h5>Order count :</h5>
                        <h5>total item Price :</h5>
                        <h5>total delivery Price :</h5>
                        <h5>total Price :</h5>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1">
                        <h5>{{ $count }} JD</h5>
                        <h5>{{ $itemPrice }} JD</h5>
                        <h5>{{ $deliveryPrice }} JD</h5>
                        <h5>{{ $totalPrice }} JD</h5>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-5 borderrleft">
                        <h5 style="float: right;">:عدد الطلبات</h5>
                        <h5 style="float: right;">:مجموع اسعار البضائع المستلمة بدون اجور التوصيل</h5>
                        <h5 style="float: right;">:مجموع اسعار التوصيل للطلبات المستلمة </h5>
                        <h5 style="float: right;">:المجموع الكلي للاسعار المستلمة </h5>
                    </div>
                </div>
                    <hr>
                <div class="row">
                    <div class="col-md-6 haderrow">
                        <h3>Price Of Delivery - اسعار التوصيل</h3>
                    </div>
                </div>
                    <br>
                <div class="row">
                    <div class="col-md-2">
                        <tr>
                            <th>
                                <h5>Name</h5>
                            </th>
                        </tr>
                        @foreach ($districtsPrices as $districtsPrice)
                            <div class="row ml-1 borderright">
                                <tr>
                                    <td>{{ $districtsPrice->districts->name }}</td>
                                </tr>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        <tr>
                            <th>
                                <h5>Price</h5>
                            </th>
                            @foreach ($districtsPrices as $districtsPrice)
                                <div class="row ml-1">
                                    <tr>
                                      <td>{{ $districtsPrice->price }}  JD</td>
                                    </tr>
                                </div>
                            @endforeach
                        </tr>
                    </div>
                </div>
                    <hr>
                <div class="row">
                    <div class="col-md-4 haderrow">
                        <h3>Orders - الطلبات</h3>
                    </div>
                </div>
                    <br>
                <div class="row">
                    <div class="col-md-12">
                        <table id="Admintable2" class="display nowrap table-res table table-condensed ">
                            <thead>
                                <tr>
                                     <th>
                                        id
                                    </th>
                                    <th>
                                        Recipient Name
                                    </th>
                                    <th>
                                        Recipient Number
                                    </th>
                                    <th>
                                        City
                                    </th>
                                    <th>
                                        Recipient Address
                                    </th>
                                    <th>
                                        item Price
                                    </th>
                                    <th>
                                        delivery Price
                                    </th>
                                    <th>
                                        total Price
                                    </th>
                                    <th>
                                        Notes
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        View
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Order as $i => $Order)
                                    <tr>
                                        <td>{{ $Order->id }}</td>
                                        <td>{{ $Order->RecipientName }}</td>
                                        <td>{{ $Order->RecipientNumber }}</td>
                                        <td>{{ $Order->city }}</td>
                                        <td>{{ $Order->RecipientAddress }}</td>
                                        <td>{{ $Order->itemPrice }}</td>
                                        <td>{{ $Order->deliveryPrice }}</td>
                                        <td>{{ $Order->totalPrice }}</td>
                                        <td>{{ $Order->notes }}</td>
                                        <td>{{ $Order->status }}</td>
                                        <td>
                                            <a href="ViewDetailsOrder?id={{ $Order->id }}"
                                            class="btn btn-primary">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--<hr>-->
                <!--<div class="row">-->
                <!--    <div class="col-md-4 haderrow">-->
                <!--        <h3>Monitoring - المتابعة</h3>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<br>-->
                <!--<div class="row">-->
                <!--    <div class="col-md-12">-->
                <!--        <table id="Admintable3" class="display nowrap table-res table table-condensed ">-->
                <!--            <thead>-->
                <!--                <tr>-->
                <!--                    <th>-->
                <!--                        id-->
                <!--                    </th>-->
                <!--                    <th>-->
                <!--                        payment status-->
                <!--                    </th>-->
                <!--                    <th>-->
                <!--                        Sender Name-->
                <!--                    </th>-->
                <!--                    <th>-->
                <!--                        Sender Number-->
                <!--                    </th>-->
                <!--                    <th>-->
                <!--                        city-->
                <!--                    </th>-->
                <!--                    <th>-->
                <!--                        item Price-->
                <!--                    </th>-->
                <!--                    <th>-->
                <!--                        delivery Price-->
                <!--                    </th>-->
                <!--                    <th>-->
                <!--                        total Price-->
                <!--                    </th>-->
                <!--                    <th>-->
                <!--                        notes-->
                <!--                    </th>-->
                <!--                    <th>-->
                <!--                        Status-->
                <!--                    </th>-->
                <!--                </tr>-->
                <!--            </thead>-->
                <!--            <tbody>-->
                <!--                @foreach($OrderDelivered as $Delivered)-->
                <!--                    <tr>-->
                <!--                        <td>{{ $Delivered->id }}</td>-->
                <!--                        <td>{{ $Delivered->payment_status }}</td>-->
                <!--                        <td>{{ $Delivered->SenderName }}</td>-->
                <!--                        <td>{{ $Delivered->SenderNumber }}</td>-->
                <!--                        <td>{{ $Delivered->city }}</td>-->
                <!--                        <td>{{ $Delivered->itemPrice }}</td>-->
                <!--                        <td>{{ $Delivered->deliveryPrice }}</td>-->
                <!--                        <td>{{ $Delivered->totalPrice }}</td>-->
                <!--                        <td>{{ $Delivered->notes }}</td>-->
                <!--                        <td>{{ $Delivered->status }}</td>-->
                <!--                    </tr>-->
                <!--                @endforeach-->
                <!--            </tbody>-->
                <!--        </table>-->
                <!--    </div>-->
                <!--</div>-->
                
            </div>
        </div>
    </div>
<script type="text/javascript">
        $(document).ready(function() {
            
            $('#Admintable2').DataTable({
                dom: 'lBfrtip',
                bInfo: false,
                buttons: [                
                {
                    extend: 'copy',
                    className: 'btn btn-secondary'
                }, {
                    extend: 'csv',
                    className: 'btn btn-warning',
                    title: 'nedco_orders',
                    extension: '.csv',
                }, {
                    extend: 'excel',
                    className: 'btn btn-success',
                    title: 'nedco_orders',
                    extension: '.xls',

                }, {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    title: 'nedco_orders',
                    extension: '.pdf',
                },
                {
                    extend: 'print',
                    className: 'btn btn-info',
                    title: 'nedco_orders',
                }
            ],
            });
            
            $('#Admintable3').DataTable({
                dom: 'lBfrtip',
                bInfo: false,
                buttons: [                
                {
                    extend: 'copy',
                    className: 'btn btn-secondary'
                }, {
                    extend: 'csv',
                    className: 'btn btn-warning',
                    title: 'nedco_orders',
                    extension: '.csv',
                }, {
                    extend: 'excel',
                    className: 'btn btn-success',
                    title: 'nedco_orders',
                    extension: '.xls',

                }, {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    title: 'nedco_orders',
                    extension: '.pdf',
                },
                {
                    extend: 'print',
                    className: 'btn btn-info',
                    title: 'nedco_orders',
                }
            ],
            });

        });
    </script>
@endsection
