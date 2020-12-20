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
            <a class="nav-link active" data-toggle="tab" href="#Today" style="color: #FFF;">Today Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#past" style="color: #FFF;">Past Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Next" style="color: #FFF;">Next Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#all" style="color: #FFF;">All Orders</a>
        </li>

    </ul>
    <div style="margin-left: 1%;margin-right: 1%;" class="tab-content">
        <div id="Today" class="row justify-content-center tab-pane active">
            <div style="margin-top: 10px;" class="col-md-12">
                <div class="card">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif
                    <div class="card-body">
                        <div id="alert" style="display: none" class="alert alert-success"></div>
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
                                        Recipient Address
                                    </th>
                                    <th>
                                        City
                                    </th>
                                    <th>
                                        Item Price
                                    </th>
                                    <th>
                                        Delivery Price
                                    </th>
                                    <th>
                                        Total Price
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
                                    <th>
                                        Change Status
                                    </th>
                                    <th>
                                        Delivery Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($AssignOrdersToday as $i => $assinedOrder)
                                    <tr>
                                        <td>{{ $assinedOrder->order->id }}</td>
                                        <td>{{ $assinedOrder->order->SenderName }}</td>
                                        <td>{{ $assinedOrder->order->SenderNumber }}</td>
                                        <td>{{ $assinedOrder->order->RecipientName }}</td>
                                        <td>{{ $assinedOrder->order->RecipientNumber }}</td>
                                        <td>{{ $assinedOrder->order->RecipientAddress }}</td>
                                        <td>{{ $assinedOrder->order->city }}</td>
                                        @if($assinedOrder->order->status == 'Cancelled') 
                                        <td>
                                            {{ $assinedOrder->order->itemPrice }}
                                            <input type="checkbox" class="checkbox" name="{{ $assinedOrder->order->id }}" id="itemPrice" id="itemPrice">
                                            <input type="hidden" name="id" value="{{ $assinedOrder->order->id }}" class="order_id">    
                                        </td>
                                        <td>
                                            {{ $assinedOrder->order->deliveryPrice }}
                                            <input type="checkbox" class="checkbox" name="{{ $assinedOrder->order->id }}" id="deliveryPrice">
                                            <input type="hidden" name="id" value="{{ $assinedOrder->order->id }}" class="order_id">    
                                        </td>
                                        <td>
                                            {{ $assinedOrder->order->totalPrice }}
                                            <input type="checkbox" class="checkbox" name="{{ $assinedOrder->order->id }}" id="totalPrice">
                                            <input type="hidden" name="id" value="{{ $assinedOrder->order->id }}" class="order_id">    
                                        </td>
                                        @else 
                                        <td>
                                            {{ $assinedOrder->order->itemPrice }}
                                        </td>
                                        <td>
                                            {{ $assinedOrder->order->deliveryPrice }}
                                        </td>
                                        <td>
                                            {{ $assinedOrder->order->totalPrice }}
                                        </td>
                                        @endif
                                        <td>{{ $assinedOrder->order->notes }}</td>
                                        <td>{{ $assinedOrder->order->payment_status }}</td>
                                        <td id="status_{{ $assinedOrder->order->id }}">{{ $assinedOrder->order->status }}</td>
                                        @if($assinedOrder->order->status != 'Cancelled')
                                        <td>
                                            <input type="hidden" name="id" id="order_id" value="{{ $assinedOrder->order->id  }}"> 
                                            <select name="status" class="form-control" id="status" data-id="{{ $assinedOrder->order->id }}">
                                                <option  @if($assinedOrder->order->status == 'Assigned')         selected @endif value="Assigned">Assigned</option>
                                                <option  @if($assinedOrder->order->status == 'Delivered')        selected @endif value="Delivered">Delivered</option>
                                                <option  @if($assinedOrder->order->status == 'Out For Delivery') selected @endif value="Out For Delivery">Out For Delivery</option>
                                                <option  @if($assinedOrder->order->status == 'Pending')          selected @endif value="Pending">Received</option>
                                                <option  @if($assinedOrder->order->status == 'Cancelled')        selected @endif value="Cancelled">Cancelled</option>
                                                <option  @if($assinedOrder->order->status == 'No Answer')        selected @endif value="No Answer">No Answer</option>
                                                <option  @if($assinedOrder->order->status == 'Turned Off')       selected @endif value="Turned Off">Turned Off</option>
                                                <option  @if($assinedOrder->order->status == 'Disconnected')     selected @endif value="Disconnected">Disconnected</option>
                                                <option  @if($assinedOrder->order->status == 'Out Of Reach')     selected @endif value="Out Of Reach">Out Of Reach</option>
                                                <option  @if($assinedOrder->order->status == 'Rejected')         selected @endif value="Rejected">Rejected</option>
                                                <option  @if($assinedOrder->order->status == 'Rejected With Charges') selected @endif value="Rejected With Charges">Rejected With Charges</option>
                                            </select>
                                        </td>
                                        @else 
                                        <td>
                                            Order Is Cancelled
                                        </td>
                                        @endif
                                        <td>{{ $assinedOrder->delivery_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="past" class="row justify-content-center tab-pane fade">
            <div style="margin-top: 10px;" class="col-md-12">
                <div class="card">
                    <div id="alert" style="display: none" class="alert alert-success"></div>
                    <div class="card-body">
                        <table id="Admintable2" class="display nowrap table-res table table-condensed ">
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
                                        Recipient Address
                                    </th>
                                    <th>
                                        City
                                    </th>
                                    <th>
                                        Item Price
                                    </th>
                                    <th>
                                        Delivery Price
                                    </th>
                                    <th>
                                        Total Price
                                    </th>
                                    <th>
                                        Notes
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Delivery Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($AssignOrdersLessToday as $i => $assignorders)
                                    <tr>
                                        <td>{{ $assignorders->order->id }}</td>
                                        <td>{{ $assignorders->order->SenderName }}</td>
                                        <td>{{ $assignorders->order->SenderNumber }}</td>
                                        <td>{{ $assignorders->order->RecipientName }}</td>
                                        <td>{{ $assignorders->order->RecipientNumber }}</td>
                                        <td>{{ $assignorders->order->RecipientAddress }}</td>
                                        <td>{{ $assignorders->order->city }}</td>
                                        @if($assignorders->order->status == 'Cancelled') 
                                        <td>
                                            {{ $assignorders->order->itemPrice }}
                                            <input type="checkbox" class="checkbox" name="{{ $assignorders->order->id }}" id="itemPrice">
                                            <input type="hidden" name="id" value="{{ $assignorders->order->id }}" class="order_id">    
                                        </td>
                                        <td>
                                            {{ $assignorders->order->deliveryPrice }}
                                            <input type="checkbox" class="checkbox" name="{{ $assignorders->order->id }}" id="deliveryPrice">
                                            <input type="hidden" name="id" value="{{ $assignorders->order->id }}" class="order_id">    
                                        </td>
                                        <td>
                                            {{ $assignorders->order->totalPrice }}
                                            <input type="checkbox" class="checkbox" name="{{ $assignorders->order->id }}" id="totalPrice">
                                            <input type="hidden" name="id" value="{{ $assignorders->order->id }}" class="order_id">    
                                        </td>
                                        @else 
                                        <td>
                                            {{ $assignorders->order->itemPrice }}
                                        </td>
                                        <td>
                                            {{ $assignorders->order->deliveryPrice }}
                                        </td>
                                        <td>
                                            {{ $assignorders->order->totalPrice }}
                                        </td>
                                        @endif
                                        <td>{{ $assignorders->order->notes }}</td>
                                        <td>{{ $assignorders->order->status }}</td>
                                        <td>{{ $assignorders->delivery_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="Next" class="row justify-content-center tab-pane fade">
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
                                        Recipient Address
                                    </th>
                                    <th>
                                        City
                                    </th>
                                    <th>
                                        Item Price
                                    </th>
                                    <th>
                                        Delivery Price
                                    </th>
                                    <th>
                                        Total Price
                                    </th>
                                    <th>
                                        Notes
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Delivery Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($AssignOrdersLargerToday as $i => $assignorders)
                                    <tr>
                                        <td>{{ $assignorders->order->id }}</td>
                                        <td>{{ $assignorders->order->SenderName }}</td>
                                        <td>{{ $assignorders->order->SenderNumber }}</td>
                                        <td>{{ $assignorders->order->RecipientName }}</td>
                                        <td>{{ $assignorders->order->RecipientNumber }}</td>
                                        <td>{{ $assignorders->order->RecipientAddress }}</td>
                                        <td>{{ $assignorders->order->city }}</td>
                                        <td>{{ $assignorders->order->itemPrice }}</td>
                                        <td>{{ $assignorders->order->deliveryPrice }}</td>
                                        <td>{{ $assignorders->order->totalPrice }}</td>
                                        <td>{{ $assignorders->order->notes }}</td>
                                        <td>{{ $assignorders->order->status }}</td>
                                        <td>{{ $assignorders->delivery_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="all" class="row justify-content-center tab-pane fade">
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
                                        Recipient Address
                                    </th>
                                    <th>
                                        City
                                    </th>
                                    <th>
                                        Item Price
                                    </th>
                                    <th>
                                        Delivery Price
                                    </th>
                                    <th>
                                        Total Price
                                    </th>
                                    <th>
                                        Notes
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Delivery Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($AssignOrders as $i => $assignorders)
                                    <tr>
                                        <td>{{ $assignorders->order->id }}</td>
                                        <td>{{ $assignorders->order->SenderName }}</td>
                                        <td>{{ $assignorders->order->SenderNumber }}</td>
                                        <td>{{ $assignorders->order->RecipientName }}</td>
                                        <td>{{ $assignorders->order->RecipientNumber }}</td>
                                        <td>{{ $assignorders->order->RecipientAddress }}</td>
                                        <td>{{ $assignorders->order->city }}</td>
                                        @if($assignorders->order->status == 'Cancelled') 
                                        <td>
                                            {{ $assignorders->order->itemPrice }}
                                            <input type="checkbox" class="checkbox" name="{{ $assignorders->order->id }}" id="itemPrice" id="itemPrice">
                                            <input type="hidden" name="id" value="{{ $assignorders->order->id }}" class="order_id">    
                                        </td>
                                        <td>
                                            {{ $assignorders->order->deliveryPrice }}
                                            <input type="checkbox" class="checkbox" name="{{ $assignorders->order->id }}" id="deliveryPrice">
                                            <input type="hidden" name="id" value="{{ $assignorders->order->id }}" class="order_id">    
                                        </td>
                                        <td>
                                            {{ $assignorders->order->totalPrice }}
                                            <input type="checkbox" class="checkbox" name="{{ $assignorders->order->id }}" id="totalPrice">
                                            <input type="hidden" name="id" value="{{ $assignorders->order->id }}" class="order_id">    
                                        </td>
                                        @else 
                                        <td>
                                            {{ $assignorders->order->itemPrice }}
                                        </td>
                                        <td>
                                            {{ $assignorders->order->deliveryPrice }}
                                        </td>
                                        <td>
                                            {{ $assignorders->order->totalPrice }}
                                        </td>
                                        @endif
                                        <td>{{ $assignorders->order->notes }}</td>
                                        <td>{{ $assignorders->order->status }}</td>
                                        <td>{{ $assignorders->delivery_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cnacell Order</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h4>Please enter why the order is cancelled</h4>
                <input type="hidden" name="id" id="cancellOrderId" value="">
                <input type="text" name="cancellText" id="cancellOrderText" class="form-control" placeholder="Text goes here ...">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="cancellOrderBtn" class="btn btn-primary">Save</button>
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
                order: [ 0, 'desc' ],
                buttons: [                
                    {
                        extend: 'copy',
                        className: 'btn btn-secondary',
                    }, {
                        extend: 'csv',
                        className: 'btn btn-warning',
                        title: 'my orders',
                        extension: '.csv',
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'my orders',
                        extension: '.xls',
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'my orders',
                        extension: '.pdf',
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'my orders',
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
                    }, {
                        extend: 'csv',
                        className: 'btn btn-warning',
                        title: 'my orders',
                        extension: '.csv',
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'my orders',
                        extension: '.xls',
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'my orders',
                        extension: '.pdf',
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'my orders',
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
                    }, {
                        extend: 'csv',
                        className: 'btn btn-warning',
                        title: 'my orders',
                        extension: '.csv',
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'my orders',
                        extension: '.xls',
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'my orders',
                        extension: '.pdf'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'my orders',
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
                    }, {
                        extend: 'csv',
                        className: 'btn btn-warning',
                        title: 'my orders',
                        extension: '.csv',
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'my orders',
                        extension: '.xls',
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'my orders',
                        extension: '.pdf',
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'my orders',
                    }
                ],

            });

            $('#status').on('change', function(event){
                event.preventDefault();
                let _token = '{{ csrf_token() }}';
                let id = $(this).attr('data-id');
                if (this.value == 'Cancelled') {
                    console.log('Cancelled');
                    console.log(id);
                    $('#cancellOrderId').val(id);
                    $('#exampleModal').modal('toggle');
                    return;
                }
                $('#status_'+id).html(this.value);
                $.ajax({
                    url: "{{ route('cheangeStatus') }}",
                    type:"POST",
                    data:{
                        status: this.value, 
                        id: id,
                        _token: _token
                    },
                    success:function(response){
                        $('#alert').css('display', 'block');
                        $('#alert').text(response)
                    },
                });
            });
            
        });

        $('#cancellOrderBtn').click(function (e) { 
            e.preventDefault();
            let id = $('#cancellOrderId').val();
            let text = $('#cancellOrderText').val();
            let _token = "{{ csrf_token() }}"
            console.log(id, text);
            $.ajax({
                type: "post",
                url: "{{ route('cancellOrder') }}",
                data: {
                    _token,
                    id,
                    text
                },
                success: function (response) {
                    console.log(response);
                }
            });
            $('#exampleModal').modal('hide');
        });

    $(".checkbox").change(function() {
        if(this.checked) {
            console.log($(this).prop('name'));
            console.log($(this).prop('id'));
        }
    });

    </script>
@endsection
