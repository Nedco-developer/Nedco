@extends('layouts.dashboardApp')

@section('title', 'Orders')

@section('content')
<style>
 .table-res {
  display: block !important;
  overflow-x: auto !important;
}
.entity-menu > .nav-item > a.active {
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
  .table-res {
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

  .text {
    font-size: 1rem !important;
  }
  .home-form {
    width: 100% !important;
  }
  .nav-item {
    height: 5rem !important;
    margin-left: 1rem !important;
  }
  .table-res {
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

  .text {
    font-size: 1rem !important;
  }
  .home-form {
    width: 100% !important;
  }
  .nav-item {
    height: 5rem !important;
    margin-left: 1rem !important;
  }
  .table-res {
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
  .table-res {
    display: block !important;
    overflow-x: auto !important;
  }
}
@media only screen and (max-width: 1024px) {
  .nav-link {
    margin-left: 1rem !important;
  }
  .text {
    font-size: 0rem !important;
  }
  .home {
    padding: 94px 0px !important;
  }
  .nav-item {
    height: 5rem !important;
    margin-left: 0rem !important;
  }
  .table-res {
    display: block !important;
    overflow-x: auto !important;
  }
}

</style>
<ul class="entity-menu d-flex flex-row align-items-start entity-menu-small nav" role="tablist" style="margin-top: 1%;margin-left: 1%;margin-right: 1%;font-size: 21px;background-color: #ee293a;">
    <li class="nav-item">
        <a class="nav-link @if(request('type') == 'all' || request('type') == '') active @endif" href="Report" style="color: #FFF;">All</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(request('type') == 'today') active @endif" href="Report?type=today" style="color: #FFF;">Today</a>
    </li>
</ul>
<div style="margin-left: 1%;margin-right: 1%;" class="tab-content">
    <div style="margin-top: 10px;" class="col-md-12">
        <div class="card">
            <!--<div class="card-header">-->

            <!--</div>-->
            <div class="card-body">
                @if(request('type') == 'all' || request('type') == '')
                <div id="filter_inputs">
                    <form method="get" action="">
                         <div class="form-group">
                             <div class="row">
                                 <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="col-form-label">From</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="date" name="from" class="form-control" value="{{ request('from') }}" />
                                        </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="col-form-label">To</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="date" name="to" class="form-control" value="{{ request('to') }}" />
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                     <button type="submit" class="btn btn-success">Submit</button>
                                     <a href="/nedco/Report" class="btn btn-danger">Reset</a>
                                 </div>
                             </div>
                         </div>       
                    </form>
                </div>
                @endif
                
                <table id="orders_reports" class="display table table-condensed table-res">
                    <thead>
                        <tr>
                            <th style="width: 9.0%;">Order Id</th>
                            <th style="width: 9.0%;">Client</th>
                            <th style="width: 9.0%;">Driver</th>
                            <th style="width: 9.0%;">Driver Delivery Price</th>
                            <th style="width: 9.0%;">Status</th>
                            <th style="width: 9.0%;">Payment status</th>
                            <th style="width: 9.0%;">City</th>
                            <th style="width: 9.0%;">Item Price</th>
                            <th style="width: 9.0%;">Delivery Price</th>
                            <th style="width: 9.0%;">Total Price</th>
                            <th style="width: 9.0%;">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->client->name }}</td>
                                <td>@if(isset($order->driver->name)) {{ $order->driver->name }} @endif</td>
                                <td>{{ $order->driver_delivery_price }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->city }}</td>
                                <td>{{ $order->itemPrice }}</td>
                                <td>{{ $order->deliveryPrice }}</td>
                                <td>{{ $order->totalPrice }}</td>
                                <td>{{ $order->notes }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-xl-3 col-sm-6 py-2">
                        <div class="card text-white bg-danger">
                            <div class="card-body mx-auto text-center">
                                <p class="text-uppercase">Total received Of Items Deliverd By Clients</p>
                                <h6>{{ array_sum($totalItemsPrices) }} JOD </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 py-2">
                        <div class="card text-white bg-danger">
                            <div class="card-body mx-auto text-center">
                                <p class="text-uppercase">Total received of deliveries</p>
                                <h6>{{ array_sum($totalDeliveryPrices) }} JOD </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 py-2">
                        <div class="card text-white bg-danger">
                            <div class="card-body mx-auto text-center">
                                <p class="text-uppercase">Total Drivers Deliveries</p>
                                <br/>
                                <h6>{{ array_sum($totalDeliveryPrices) }} JOD </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 py-2">
                        <div class="card text-white bg-danger h-100">
                            <div class="card-body mx-auto text-center">
                                <p class="text-uppercase">Net profit</p>
                                <br/>
                                <h6>{{ array_sum($totalNet) }} JOD </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {

        $('#orders_reports').DataTable({
            initComplete: function () {
                count = 0;
                this.api().columns().every(function () {
                    var title = this.header();
                    //replace spaces with dashes
                    title = $(title).html().replace(/[\W]/g, '-');
                    var column = this;
                    var select = $('<select style="width: 100% !important" id="' + title +
                            '" class="select2" ></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            //Get the "text" property from each selected data 
                            //regex escape the value and store in array
                            var data = $.map($(this).select2('data'), function (value,
                                key) {
                                return value.text ? '^' + $.fn.dataTable.util
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
            buttons: [            
                    {
                        extend: 'copy',
                        className: 'btn btn-secondary'
                    }, {
                        extend: 'csv',
                        className: 'btn btn-warning',
                        title: 'nedco_orders_reports',
                        extension: '.csv',
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'nedco_orders_reports',
                        extension: '.xls',
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'nedco_orders_reports',
                        extension: '.pdf',
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'nedco_orders_reports',
                    }
                ],

        });
    });

</script>
@endsection
