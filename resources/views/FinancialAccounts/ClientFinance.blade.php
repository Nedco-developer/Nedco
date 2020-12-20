@extends('layouts.dashboardApp')

@section('title', 'Edit Driver')

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

.table-res{
    display: block !important;
    overflow-x: auto !important;
}
.row-border {
    border: 3px solid #dee2e6!important;
}
</style>
<br>
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">{{$client->user->name}} Orders</div>
            <div class="card-body">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        {!! \Session::get('success') !!}
                    </div>
                @endif
                <div id="filter_inputs">
                    <form method="get" action="">
                        <input type="hidden" name="client_id" value="{{$client->id}}" />
                         <div class="form-group">
                             <div class="row">
                                 <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="col-form-label">Delivrey Date</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="date" name="delivery_Date" class="form-control" value="{{ request('delivery_Date') }}" />
                                        </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                     <button type="submit" class="btn btn-success">Submit</button>
                                     <a href="/nedco/DriverFinance?client_id={{$client->id}}" class="btn btn-danger">Reset</a>
                                 </div>
                             </div>
                         </div>       
                    </form>
                </div>
                <table id="orders" class="display nowrap table-res table table-condensed ">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Driver</th>
                            <th>Recipient Name</th>
                            <th>Recipient Phone</th>
                            <th>City</th>
                            <th>Delivery Date</th>
                            <th>Status</th>
                            <th>Total Price</th>
                            <th>Driver Delivery Price</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($client_orders as $client_order)
                            <tr>
                                <td>{{ $client_order->id }}</td>
                                @if(isset($client_order->driver->user->name))
                                <td>{{ $client_order->driver->user->name }}</td>
                                @else
                                <td></td>
                                @endif
                                <td>{{ $client_order->RecipientName }}</td>
                                <td>{{ $client_order->RecipientNumber }}</td>
                                <td>{{ $client_order->city }}</td>
                                <td>{{ $client_order->assigned_order->delivery_date }}</td>
                                @if($client_order->status == 'Amount received from driver')
                                <td>Amount received from driver</td>
                                @elseif($client_order->status != 'Delivered')
                                <td>Not Delivered</td>
                                @else
                                <td>Delivered</td>
                                @endif
                                <td>{{ $client_order->totalPrice }}</td>
                                <td>{{ $client_order->driver_delivery_price }}</td>
                                <td>{{ $client_order->notes }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Order Id</th>
                            <th>Client</th>
                            <th>Recipient Name</th>
                            <th>Recipient Phone</th>
                            <th>City</th>
                            <th>Delivery Date</th>
                            <th>Status</th>
                            <th>Total Price</th>
                            <th>Driver Delivery Price</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="row">
                    <div class="col-md-6 p-4">
                        <div class="row row-border">
                            <div class="col-md-10 font-weight-bold">
                                
                            </div>
                            <div class="col-md-2">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-4">
                        <div class="row row-border">
                            <div class="col-md-10 font-weight-bold">
                                
                            </div>
                            <div class="col-md-2">
                               
                            </div>
                        </div>
                    </div>
                </div>
                <!---->
                <div class="row">
                    <div class="col-md-4 p-4">
                        <div class="row row-border">
                            <div class="col-md-10 font-weight-bold">
                                
                            </div>
                            <div class="col-md-2">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 p-4">
                        <div class="row row-border">
                            <div class="col-md-10 font-weight-bold">
                                
                            </div>
                            <div class="col-md-2">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#orders').DataTable({
                initComplete: function () {
                    count = 0;
                    this.api().columns().every(function () {
                        var title = this.header();
                        //replace spaces with dashes
                        title = $(title).text().trim().replace(/[\W]/g, '-');

                        var column = this;
                        var select = $('<select id="' + title +
                                '" class="select2 form-control" ></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                //Get the "text" property from each selected data 
                                //regex escape the value and store in array
                                var data = $.map($(this).select2('data'), function (
                                    value,
                                    key) {
                                    return value.text ? '^' + $.fn.dataTable
                                        .util
                                        .escapeRegex(value.text) + '$' : null;
                                });

                                //if no data selected use ""
                                if (data.length === 0) {
                                    data = [""];
                                }

                                //join array into string with regex or (|)
                                var val = data.join('|');

                                //search for the option(s) selected
                                column
                                    .search(val ? val : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>');
                        });

                        //use column title as selector and placeholder
                        $('#' + title).select2({
                            multiple: true,
                            closeOnSelect: false,
                            placeholder: title
                        });

                        //initially clear select otherwise first option is selected
                        $('.select2').val(null).trigger('change');
                    });
                },
                dom: 'lBfrtip',
                bInfo: false,
                order: [0, 'desc'],
                responsive: true,
                buttons: [                
                    {
                        extend: 'copy',
                        className: 'btn btn-secondary',
                    }, {
                        extend: 'csv',
                        className: 'btn btn-warning',
                        title: 'reports',
                        extension: '.csv',
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'reports',
                        extension: '.xls',
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'reports',
                        extension: '.pdf',
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'reports',
                    }
                ],
            });
    });
</script>
@endsection
