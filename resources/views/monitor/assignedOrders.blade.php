@extends('layouts.dashboardApp')

@section('title', 'Orders')

@section('content')
<style>
.table-res{
        display: block !important;
        overflow-x: auto !important;
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
    <div style="margin-left: 1%;margin-right: 1%;" class="tab-content">
        <div id="AllOrders" class="row justify-content-center tab-pane active">
            <div style="margin-top: 10px;" class="col-md-12">
                <div class="card">
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                            {!! \Session::get('error') !!}
                        </div>
                    @endif
                    <div class="card-header">Assigned Orders</div>
                    <div class="card-body">
                        <div id="alert" style="display: none" class="alert alert-success"></div>
                        <table id="Admintable1" class="display nowrap table-res table table-condensed ">
                            <thead>
                                <tr>
                                    <th>
                                        id
                                    </th>
                                    <th>
                                        Driver Name
                                    </th>
                                    <th>
                                        Client Name
                                    </th>
                                    <th>
                                        Client Number
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
                                @foreach ($orders as $i => $assinedOrder)
                                    <tr>
                                        <td>{{ $assinedOrder->order->id }}</td>
                                        <td>@if(isset($assinedOrder->driver->name)) {{$assinedOrder->driver->name}} @endif</td>
                                        <td>{{ $assinedOrder->order->SenderName }}</td>
                                        <td>{{ $assinedOrder->order->SenderNumber }}</td>
                                        <td>{{ $assinedOrder->order->RecipientName }}</td>
                                        <td>{{ $assinedOrder->order->RecipientNumber }}</td>
                                        <td>{{ $assinedOrder->order->city }}</td>
                                        <td>{{ $assinedOrder->order->RecipientAddress }}</td>
                                        <td>{{ $assinedOrder->order->itemPrice }}</td>
                                        <td>{{ $assinedOrder->order->deliveryPrice }}</td>
                                        <td>{{ $assinedOrder->order->totalPrice }}</td>
                                        <td>{{ $assinedOrder->order->notes }}</td>
                                        <td>
                                            <input type="hidden" name="id" class="order_id" value="{{ $assinedOrder->order->id  }}"> 
                                            <select name="status" class="form-control status" data-id="{{ $assinedOrder->order->id }}">
                                                <option value="Delivered" @if($assinedOrder->order->status == 'Delivered') selected @endif>Delivered</option>
                                                <option value="Pending" @if($assinedOrder->order->status == 'Pending') selected @endif>Pending</option>
                                                <option value="Out For Delivery" @if($assinedOrder->order->status == 'Out For Delivery') selected @endif>Out For Delivery</option>
                                                <option value="No Answer" @if($assinedOrder->order->status == 'No Answer') selected @endif>No Answer</option>
                                                <option value="Turned  Answer" @if($assinedOrder->order->status == 'Turned Off') selected @endif>Turned Off</option>
                                                <option value="Disconnected" @if($assinedOrder->order->status == 'Disconnected') selected @endif>Disconnected</option>
                                                <option value="Out Of Reach" @if($assinedOrder->order->status == 'Out Of Reach') selected @endif>Out Of Reach</option>
                                                <option value="Cancelled" @if($assinedOrder->order->status == 'Cancelled') selected @endif>Cancelled</option>
                                                <option value="Rejected" @if($assinedOrder->order->status == 'Rejected') selected @endif>Rejected</option>
                                                <option value="Rejected With Charges" @if($assinedOrder->order->status == 'Rejected With Charges') selected @endif>Rejected With Charges</option>
                                                <option value="Returned" @if($assinedOrder->order->status == 'Returned') selected @endif>Returned</option>
                                            </select>
                                        </td>
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
            $('#Admintable1').DataTable();

            $('.status').on('change', function(event){
                event.preventDefault();
                let _token = '{{ csrf_token() }}';
                let id = $(this).attr('data-id');
                console.log(id);
                $.ajax({
                    url: "{{ route('cheangeStatus') }}",
                    type:"POST",
                    data:{
                        status: this.value, 
                        id: id,
                        _token: _token
                    },
                    success:function(response){
                        console.log(response);
                        $('#alert').css('display', 'block');
                        $('#alert').text(response)
                    },
                    error:function(){
                        console.log('error');
                    },
                });
            });
        });
    </script>
@endsection
