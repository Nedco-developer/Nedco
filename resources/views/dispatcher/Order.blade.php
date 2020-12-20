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
            <a class="nav-link " data-toggle="tab" href="#AllOrders" style="color: #FFF;">All Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#Pinding" style="color: #FFF;">Pending</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#delivered" style="color: #FFF;">delivered</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#cancelled" style="color: #FFF;">cancelled</a>
        </li>
    </ul>
    <div style="margin-left: 1%;margin-right: 1%;" class="tab-content">
        <div id="AllOrders" class="row justify-content-center tab-pane fade">
            <div style="margin-top: 10px;" class="col-md-12">
                <div class="card">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif
                    <div class="card-body">
                                    <a class="btn btn-success float-right" style="margin-bottom: 1rem;" href="/nedco/add-orders-from-excel">Import From Excel</a>
                        <table id="Admintable1" class="display nowrap table-res table table-condensed ">
                            <thead>
                                <tr>
                                     <th>
                                        id
                                    </th>
                                    <th>
                                        Sender Name
                                    </th>
                                    <th>
                                        Sender Number
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
                                        <td>{{ $Order->SenderName }}</td>
                                        <td>{{ $Order->SenderNumber }}</td>
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
            </div>
        </div>
        <div id="Pinding" class="row justify-content-center tab-pane active ">
            <div style="margin-top: 10px;" class="col-md-12">
                <div class="card">
                    <div id="alert" style="display: none" class="alert alert-success"></div>
                    <div id="errorAlert" style="display: none" class="alert alert-danger"></div>
                    <div class="card-body">
                        
                        <div class="row mb-2">
                                <div class="col-md-2">
                                    <select style="width: 10rem;" required name="drivers" id="drivers" class="form-control">
                                        @foreach ($Driver as $i => $Driver2)
                                          <option value="{{ $Driver2->id }}">{{ $Driver2->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 ml-3">
                                    <input type="date" name="delivery_date" min="{{date('Y-m-d')}}" id="delivery_date">
                                </div>
                                <div class="col-md-2 ml-3">
                                    <button id="MultiAssign" class="btn btn-danger ">Assign</button>
                                </div>   
                        </div>
                        
                        <table id="Admintable2" class="display nowrap table-res table table-condensed ">
                            <thead>
                                <tr>
                                    <th>
                                        Check
                                    </th>
                                    <th>
                                        id
                                    </th>
                                    <th>
                                        Sender Name
                                    </th>
                                    <th>
                                        Sender Number
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
                                        Drivers
                                    </th>
                                    <th>
                                        Delivery Date
                                    </th>
                                    <th>
                                        Assign Order
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Orderpinnding as $i => $Order)
                                    <tr>
                                        <td><input class="m-1" type="checkbox" name="checkbox[]" id="checkbox" value="{{ $Order->id }}"></td>
                                        <td>{{ $Order->id }}</td>
                                        <td>{{ $Order->SenderName }}</td>
                                        <td>{{ $Order->SenderNumber }}</td>
                                        <td>{{ $Order->RecipientName }}</td>
                                        <td>{{ $Order->RecipientNumber }}</td>
                                        <td>{{ $Order->city }}</td>
                                        <td>{{ $Order->RecipientAddress }}</td>
                                        <td>{{ $Order->itemPrice }}</td>
                                        <td>{{ $Order->deliveryPrice }}</td>
                                        <td>{{ $Order->totalPrice }}</td>
                                        <td>{{ $Order->notes }}</td>
                                        <td>{{ $Order->status }}</td>
                                        {{--  If order is assigned get assigned data --}}
                                        @if ($Order->status == 'Assigned')
                                        <td>
                                            <select style="width: 10rem;" name="city" id="city_{{ $Order->id }}" class="form-control">
                                                @foreach ($Driver as $i => $Driver2)
                                                    <option value="{{ $Driver2->id }}" @if($Order->assigned_order->Driver_id == $Driver2->id) selected @endif>{{ $Driver2->user->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                        <input type="date" name="delivery_date" min="{{date('Y-m-d')}}" id="delivery_date_{{ $Order->id }}" value="{{ $Order->assigned_order->delivery_date }}">
                                        </td>
                                        <td>
                                            <button id="{{ $Order->id }}"
                                                class="submitAssgin btn btn-danger">Assign</button>
                                        </td>
                                        @else
                                        {{--  --}}
                                        <td>
                                            <select style="width: 10rem;" required name="city" id="city_{{ $Order->id }}" class="form-control">
                                                @foreach ($Driver as $i => $Driver2)
                                                    <option value="{{ $Driver2->id }}">{{ $Driver2->user->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                        <input type="date" name="delivery_date" min="{{date('Y-m-d')}}" id="delivery_date_{{ $Order->id }}">
                                        </td>
                                        <td>
                                            <button id="{{ $Order->id }}"
                                                class="submitAssgin btn btn-danger">Assign</button>
                                        </td>
                                        @endif
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
                                        Sender Name
                                    </th>
                                    <th>
                                        Sender Number
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
                                        <td>{{ $Order->SenderName }}</td>
                                        <td>{{ $Order->SenderNumber }}</td>
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
                                        Sender Name
                                    </th>
                                    <th>
                                        Sender Number
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
                                        <td>{{ $Order->SenderName }}</td>
                                        <td>{{ $Order->SenderNumber }}</td>
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
            function onClick(event) {
                $('#errorAlert').css('display', 'none');
                $('#errorAlert').text();
                var order_ids = $('input[name^=checkbox]:checked').map(function(idx, elem) {
                    return $(elem).val();
                }).get();
                console.log(order_ids);
                var driver_id = $('#drivers option:selected').val();
                var delivery_date = $('#delivery_date').val();
                let _token = '{{ csrf_token() }}';
                if (delivery_date == '') {
                    $('#errorAlert').css('display', 'block');
                    $('#errorAlert').text('Please select a valid date');
                    return;
                }
                if (order_ids.length == 0) {
                    $('#errorAlert').css('display', 'block');
                    $('#errorAlert').text('Please Select at least 1 Order');
                    return;
                }
                $.ajax({
                    type: "post",
                    url: '{{ route("assignMultiOrder") }}',
                    data: {
                        _token: _token,
                        order_ids: order_ids,
                        driver_id: driver_id,
                        delivery_date: delivery_date
                    },
                    success: function(data) {
                        console.log(data);
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                        $('#alert').css('display', 'block');
                        $('#alert').text(data)
                    }
                })
            event.preventDefault();
        }

        // attach button click listener on dom ready
        $(function() {
          $('#MultiAssign').click(onClick);
        });

            $('.submitAssgin').on('click', function() {
                var order_id = $(this).attr('id');
                var driver_id = $('#city_' + order_id).val();
                var delivery_date = $('#delivery_date_' + order_id).val();
                let _token = '{{ csrf_token() }}';
                $.ajax({
                    type: "post",
                    url: '{{ route("assign") }}',
                    data: {
                        _token: _token,
                        order_id: order_id,
                        driver_id: driver_id,
                        delivery_date: delivery_date
                    },
                    success: function(data) {
                        console.log(data);
                        location.reload();
                        $('#alert').css('display', 'block');
                        $('#alert').text(data)
                    }
                })
            });
            $('#Admintable1').DataTable({
                dom: 'lBfrtip',
                bInfo: false,
                order: [ 0, 'desc' ],
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
                            title: 'nedco_dispatchers',
                            extension: '.csv',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            }
                        }, {
                            extend: 'excel',
                            className: 'btn btn-success',
                            title: 'nedco_dispatchers',
                            extension: '.xls',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            }
                        }, {
                            extend: 'pdf',
                            className: 'btn btn-danger',
                            title: 'nedco_dispatchers',
                            extension: '.pdf',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-info',
                            title: 'nedco_dispatchers',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
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
                                columns: [0, 1, 2, 3]
                            }
                        }, {
                            extend: 'csv',
                            className: 'btn btn-warning',
                            title: 'nedco_dispatchers',
                            extension: '.csv',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            }
                        }, {
                            extend: 'excel',
                            className: 'btn btn-success',
                            title: 'nedco_dispatchers',
                            extension: '.xls',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            }
                        }, {
                            extend: 'pdf',
                            className: 'btn btn-danger',
                            title: 'nedco_dispatchers',
                            extension: '.pdf',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-info',
                            title: 'nedco_dispatchers',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
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
                                columns: [0, 1, 2, 3]
                            }
                        }, {
                            extend: 'csv',
                            className: 'btn btn-warning',
                            title: 'nedco_dispatchers',
                            extension: '.csv',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            }
                        }, {
                            extend: 'excel',
                            className: 'btn btn-success',
                            title: 'nedco_dispatchers',
                            extension: '.xls',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            }
                        }, {
                            extend: 'pdf',
                            className: 'btn btn-danger',
                            title: 'nedco_dispatchers',
                            extension: '.pdf',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-info',
                            title: 'nedco_dispatchers',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
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
                                columns: [0, 1, 2, 3]
                            }
                        }, {
                            extend: 'csv',
                            className: 'btn btn-warning',
                            title: 'nedco_dispatchers',
                            extension: '.csv',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            }
                        }, {
                            extend: 'excel',
                            className: 'btn btn-success',
                            title: 'nedco_dispatchers',
                            extension: '.xls',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            }
                        }, {
                            extend: 'pdf',
                            className: 'btn btn-danger',
                            title: 'nedco_dispatchers',
                            extension: '.pdf',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-info',
                            title: 'nedco_dispatchers',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            }
                        }
                    ],

            });
        });

    </script>
@endsection
