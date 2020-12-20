@extends('layouts.dashboardApp')

@section('title', 'Orders')

@section('content')

    <style>
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
    <ul class="entity-menu d-flex flex-row align-items-start entity-menu-small nav" role="tablist"
        style="margin-top: 1%;margin-left: 1%;margin-right: 1%;font-size: 21px;background-color: #ee293a;">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#AllOrders" style="color: #FFF;">All Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Pinding" style="color: #FFF;">Pending</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#delivered" style="color: #FFF;">delivered</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#cancelled" style="color: #FFF;">cancelled</a>
        </li>
    </ul>
    <div style="margin-left: 1%;margin-right: 1%;" class="tab-content">
        <div id="AllOrders" class="row justify-content-center tab-pane active">
            <div style="margin-top: 10px;" class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="Admintable1" class="display nowrap table-res table table-condensed ">
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
                                    <th>Coupon</th>
                                    <th>
                                        Notes
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Edit
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
                                        <td>
                                            @if(isset($Order->coupon_code))
                                                {{ $Order->coupon_code }} @if(isset($Order->coupon->discount)) / discounted: {{ $Order->coupon->discount }} @endif
                                            @else
                                                No Coupon was used
                                            @endif
                                        </td>
                                        <td>{{ $Order->notes }}</td>
                                        <td>{{ $Order->status }}</td>
                                        <td>
                                            <a href="editOrder?id={{ $Order->id }}"
                                            class="btn btn-primary">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="Pinding" class="row justify-content-center tab-pane fade">
            <div style="margin-top: 10px;" class="col-md-12">
                <div class="card">
                    <div class="card-body">
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
                                        Cancel Order
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Orderpinnding as $i => $Order)
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
                                            <a id="approved" href="#" class="btn btn-danger">Cancel</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="delivered" class="row justify-content-center tab-pane fade">
            <div style="margin-top: 10px;" class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="Admintable3" class="display nowrap table-res table table-condensed ">
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Orderdelivered as $i => $Order)
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="cancelled" class="row justify-content-center tab-pane fade">
            <div style="margin-top: 10px;" class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="Admintable4" class="display nowrap table-res table table-condensed ">
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Ordercancelled as $i => $Order)
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    }, {
                        extend: 'csv',
                        className: 'btn btn-warning',
                        title: 'nedco_clients',
                        extension: '.csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'nedco_clients',
                        extension: '.xls',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'nedco_clients',
                        extension: '.pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'nedco_clients',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    }
                ],

            });

            $('#Admintable2').DataTable({
                dom: 'lBfrtip',
                bInfo: false,
                buttons: [                
                    {
                        extend: 'copy',
                        className: 'btn btn-secondary',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    }, {
                        extend: 'csv',
                        className: 'btn btn-warning',
                        title: 'nedco_clients',
                        extension: '.csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'nedco_clients',
                        extension: '.xls',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'nedco_clients',
                        extension: '.pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'nedco_clients',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    }
                ],

            });

            $('#Admintable3').DataTable({
                dom: 'lBfrtip',
                bInfo: false,
                buttons: [                
                    {
                        extend: 'copy',
                        className: 'btn btn-secondary',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    }, {
                        extend: 'csv',
                        className: 'btn btn-warning',
                        title: 'nedco_clients',
                        extension: '.csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'nedco_clients',
                        extension: '.xls',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'nedco_clients',
                        extension: '.pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'nedco_clients',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    }
                ],

            });

            $('#Admintable4').DataTable({
                dom: 'lBfrtip',
                bInfo: false,
                buttons: [                
                    {
                        extend: 'copy',
                        className: 'btn btn-secondary',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    }, {
                        extend: 'csv',
                        className: 'btn btn-warning',
                        title: 'nedco_clients',
                        extension: '.csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'nedco_clients',
                        extension: '.xls',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'nedco_clients',
                        extension: '.pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'nedco_clients',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                        }
                    }
                ],

            });
        });

    </script>
@endsection
