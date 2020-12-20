@extends('layouts.dashboardApp')

@section('title', 'Drivers')

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
    <br>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Orders</div>
            <div class="card-body">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        {!! \Session::get('success') !!}
                    </div>
                @endif
                
                <table id="Admintable" class="display nowrap table-res table table-condensed ">
                    <thead>
                        <tr>
                            <th><button id="MultiAssign" class="btn btn-warning ">Arrived</button></th>
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
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            @if ($order->status == 'Picked up')
                                <td><input class="m-1" type="checkbox" name="checkbox[]" id="checkbox" value="{{ $order->id }}"></td>
                            @else
                                <td><input class="m-1" type="checkbox" name="checkbox[]" id="checkbox" disabled value=""></td>
                            @endif
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->SenderName }}</td>
                            <td>{{ $order->SenderNumber }}</td>
                            @if ($order->status == 'Ready')
                            <td>
                                <form action="{{ route('changePickupStatus') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="hidden" name="status" value="Picked up">
                                    <button type="submit" class="btn btn-info">Picked Up</button>
                                </form>
                            </td>
                            @else
                            <td>
                                <form action="{{ route('changePickupStatus') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="hidden" name="status" value="Pending">
                                    <button class="btn btn-warning">Arrived</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#Admintable').DataTable({
                "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [ 0] }, 
                    { "bSearchable": false, "aTargets": [ 0 ] }
                ]
                });

                $('#MultiAssign').click(function (e) { 
                    e.preventDefault();
                    var order_ids = $('input[name^=checkbox]:checked').map(function(idx, elem) {
                        return $(elem).val();
                    }).get();

                    console.log(order_ids);
                    if (order_ids.length == 0) {
                        return;
                    }
                    let _token = '{{ csrf_token() }}';
                    $.ajax({
                        type: "post",
                        url: "{{ route('MultiStatusChange') }}",
                        data: {
                            _token,
                            order_ids,
                            status: 'Pending'
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                });

            });

        </script>

    @endsection
