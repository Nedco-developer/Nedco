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
                    <div class="col-md-6 haderrow">
                        <h3>Driver Details - تفاصيل السائق</h3>
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
                        <h5>{{ $Driver->user->id }}</h5>
                        <h5>{{ $Driver->user->name }}</h5>
                        <h5>{{ $Driver->user->email }}</h5>
                        <h5>{{ $Driver->user->phone }}</h5>
                        <h5>{{ $Driver->address }}</h5>
                        @if( $Driver->status == 'approved')
                        <h5>Active</h5>
                        @else
                        <h5>Disactive</h5>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 haderrow">
                        <h3>Price Of Delivery - اسعار توصيل السائق</h3>
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
                    <div class="col-md-5 haderrow">
                        <h3>The Cost - تقارير مختصره</h3>
                    </div>
                </div>
                    <br>
                <div class="row">
                    <div class="col-md-4 borderright">
                        <h5>total item Price :</h5>
                        <h5>total delivery Price :</h5>
                        <h5>total Price :</h5>
                        <h5>total driver Price :</h5>
                        <h5>total net :</h5>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1">
                        <h5>{{ $items }} JD</h5>
                        <h5>{{ $delivery }} JD</h5>
                        <h5>{{ $total }} JD</h5>
                        <h5>{{ $totaldriver }} JD</h5>
                        <h5>{{ $totalnet - $items }} JD</h5>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-5 borderrleft">
                        <h5 style="float: right;">:مجموع اسعار البضائع المستلمة بدون اجور التوصيل</h5>
                        <h5 style="float: right;">:مجموع اسعار التوصيل للطلبات المستلمة </h5>
                        <h5 style="float: right;">:المجموع الكلي للاسعار المستلمة </h5>
                        <h5 style="float: right;">:مجموع اجور السائق للطلبيات المستلمة </h5>
                        <h5 style="float: right;">:مجموع الارباح من السائق</h5>
                    </div>
                </div>
                    <hr>
                <div class="row">
                    <div class="col-md-8 haderrow">
                        <h3>Order Deliverd Details - تفاصيل الطلبات المستلمة</h3>
                    </div>
                </div>
                    <br>
                <div class="row">
                    <table id="Admintable1" class="display nowrap table-res table table-condensed " style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        id
                                    </th>
                                    <th>
                                        payment status
                                    </th>
                                    <th>
                                       city
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
                                        notes
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($AssignOrders as $AssignOrder)
                                    <tr>
                                        <td>{{ $AssignOrder->order->id }}</td>
                                        <td>{{ $AssignOrder->order->payment_status }}</td>
                                        <td>{{ $AssignOrder->order->city }}</td>
                                        <td>{{ $AssignOrder->order->itemPrice }}</td>
                                        <td>{{ $AssignOrder->order->deliveryPrice }}</td>
                                        <td>{{ $AssignOrder->order->totalPrice }}</td>
                                        <td>{{ $AssignOrder->order->notes }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
        $(document).ready(function() {
            $('#Admintable1').DataTable({
                dom: 'lBfrtip',
                bInfo: false,
                buttons: [                
                    {
                        extend: 'copy',
                        className: 'btn btn-secondary',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }, {
                        extend: 'csv',
                        className: 'btn btn-warning',
                        title: 'my orders',
                        extension: '.csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'my orders',
                        extension: '.xls',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'my orders',
                        extension: '.pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'my orders',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }
                ],

            });

        });
    </script>
@endsection
