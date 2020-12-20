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

            <div style="margin-top: 10px;" class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Order') }}</div>
                    <div class="card-body">
                    <div id="alert" style="display: none" class="alert alert-success"></div>
                    <div class="card-body">
                        <table id="Admintable" class="display nowrap table-res table table-condensed ">
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
                                        Payment Status
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    @if(Auth::user()->type == 'dispatcher' || Auth::user()->type == 'admin' || Auth::user()->type == 'super_admin')
                                    <th>
                                        Drivers
                                    </th>
                                    <th>
                                        Delivery Date
                                    </th>
                                    <th>
                                        Assign Order
                                    </th>
                                    @endif
                                    @if(Auth::user()->type == 'driver')
                                    <th>
                                        Change Status
                                    </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>{{ $notifications->order->id }}</td>
                                        <td>{{ $notifications->order->SenderName }}</td>
                                        <td>{{ $notifications->order->SenderNumber }}</td>
                                        <td>{{ $notifications->order->RecipientName }}</td>
                                        <td>{{ $notifications->order->RecipientNumber }}</td>
                                        <td>{{ $notifications->order->city }}</td>
                                        <td>{{ $notifications->order->RecipientAddress }}</td>
                                        <td>{{ $notifications->order->itemPrice }}</td>
                                        <td>{{ $notifications->order->deliveryPrice }}</td>
                                        <td>{{ $notifications->order->totalPrice }}</td>
                                        <td>{{ $notifications->order->notes }}</td>
                                        <td>{{ $notifications->order->payment_status }}</td>
                                        <td id="status_{{ $notifications->order->id }}">{{ $notifications->order->status }}</td>
                                        @if ($notifications->order->status != 'Delivered')
                                            @if(Auth::user()->type == 'dispatcher' || Auth::user()->type == 'admin' || Auth::user()->type == 'super_admin')
                                            <td>
                                                <select style="width: 10rem;" required name="driver" id="driver_{{ $notifications->order->id }}" class="form-control">
                                                    @foreach ($Driver as $i => $Driver2)
                                                        <option value="{{ $Driver2->id }}">{{ $Driver2->user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                            <input type="date" name="delivery_date" min="{{date('Y-m-d')}}" id="delivery_date_{{ $notifications->order->id }}">
                                            </td>
                                            <td>
                                                <button id="{{ $notifications->order->id }}"
                                                    class="submitAssgin btn btn-danger">Assign</button>
                                            </td>
                                            @endif
                                        @else 
                                        <td>Order has been deliverd</td>
                                        @endif
                                        @if(Auth::user()->type == 'driver')
                                        <td>
                                        <select name="status" class="form-control" id="status" data-id="{{ $notifications->order->id }}">
                                                <option value="Delivered"       @if($notifications->order->status == 'Delivered') selected @endif>Delivered</option>
                                                <option value="No Answer"       @if($notifications->order->status == 'No Answer') selected @endif>No Answer</option>
                                                <option value="Turned  Answer"  @if($notifications->order->status == 'Turned Off') selected @endif>Turned Off</option>
                                                <option value="Disconnected"    @if($notifications->order->status == 'Disconnected') selected @endif>Disconnected</option>
                                                <option value="Out Of Reach"    @if($notifications->order->status == 'Out Of Reach') selected @endif>Out Of Reach</option>
                                                <option value="Out For Delivery" @if($notifications->order->status == 'Out For Delivery') selected @endif>Out For Delivery</option>
                                                <option value="Cancelled"       @if($notifications->order->status == 'Cancelled') selected @endif>Cancelled</option>
                                                <option value="Rejected"        @if($notifications->order->status == 'Rejected') selected @endif>Rejected</option>
                                                <option value="Rejected With Charges" @if($notifications->order->status == 'Rejected With Charges') selected @endif>Rejected With Charges</option>
                                            </select>
                                        </td>
                                        @endif
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
<script type="text/javascript">
    $(document).ready(function() {
        
            $('.submitAssgin').on('click', function() {
                var order_id = $(this).attr('id');
                var driver_id = $('#driver_' + order_id).val();
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

            $('#status').change(function (e) { 
                e.preventDefault();
                let _token = '{{ csrf_token() }}';
                let status = $(this).children("option:selected").val();
                let order_id = $(this).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: "changeStatus",
                    data: {
                        _token: _token,
                        order_id: order_id,
                        status: status
                    },
                    success: function (response) {
                        $('#status_'+order_id).html(status);
                    }
                });
            });
            
        $('#Admintable').DataTable({
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'pdf',
                        title: 'My Orders Report',
                        footer: true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11]
                        }
                    },
                    {
                        extend: 'excel',
                        title: 'My Orders Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11]
                        },
                        footer: false
                    },
                    {
                        extend: 'print',
                        title: 'My Orders Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11]
                        },
                        footer: true
                    }
                ],

            });
        });

    </script>
@endsection
