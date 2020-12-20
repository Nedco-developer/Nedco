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
  .table-res {
    display: block !important;
    overflow-x: auto !important;
  }
</style>

<div style="margin-top: 10px;" class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __('All Orders') }}</div>
        <div class="card-body">
            <a class="btn btn-secondary" style="margin-bottom: 1rem;" href="/nedco/addOrder">Add New Order</a>
            <a class="btn btn-warning" style="margin-bottom: 1rem;" href="/nedco/requestAllLocations">Request All</a>
            <a class="btn btn-success" style="margin-bottom: 1rem;" href="/nedco/add-orders-from-excel">Import From Excel</a>
            <table id="Admintable1" class="display nowrap table-res table table-condensed " style="width:100%">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Recipient Name</th>
                        <th>Recipient Number</th>
                        <th>City</th>
                        <th>Recipient Address</th>
                        <th>Item Price</th>
                        <th>Delivery Price</th>
                        <th>Total Price</th>
                        <th>Coupon</th>
                        <th>Notes</th>
                        <th>Status</th>
                        <th>Assign Order</th>
                        <th>View Details</th>
                        <th>Edit</th>
                        <th>Print</th>
                        <th>Request Recipient Location</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Order as $i => $Order)
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
                            <td>{{ $Order->status }} 
                            @if ($Order->status == 'Cancelled') 
                                @if(isset($Order->coupon_code))
                                    / {{ $Order->cancelledOrder->reason }} 
                                @endif
                            @endif</td>
                            @if($Order->status != 'Delivered')
                                <td>
                                    <input type="date" name="delivery_date" min="{{ date('Y-m-d') }}"
                                        id="delivery_date_{{ $Order->id }}" @if(isset($Order->assigned_order->delivery_date))value="{{ $Order->assigned_order->delivery_date }}" @endif>
                                    <button id="{{ $Order->id }}" class="submitAssgin btn btn-danger">Assign</button>
                                    <select style="width: 10rem;" required name="driver" id="driver_{{ $Order->id }}"
                                        class="form-control">
                                        @foreach($Driver as $i => $Driver2)
                                            <option value="{{ $Driver2->id }}" @if(isset($Order->
                                                assigned_order->Driver_id)) @if($Order->assigned_order->Driver_id ==
                                                $Driver2->id) selected @endif @endif>{{ $Driver2->user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            @else
                                <td>Order has been deliverd</td>
                            @endif
                            <td>
                                <a href="ViewDetailsOrder?id={{ $Order->id }}" class="btn btn-warning">View Details</a>
                            </td>
                            <td>
                                <a href="editOrder?id={{ $Order->id }}" class="btn btn-primary">Edit</a>
                            </td>
                            <td><button class="btn btn-info print" data-id="{{ $Order->id }}"> Print </button></td>
                            <td>
                            <a href="https://api.whatsapp.com/send?phone={{ $Order->RecipientNumber }}&text=Hey%20%0A%0A%0Aplease%20confirm%20your%20location%20for%20order%20number%20%23010%20via%20link%20down%20below%0A%0Ahttps%3A%2F%2Fominus.marketing%2Fnedco%2FconfirmLocation%3Foid%3D{{$Order->id}}%26lat%3D{{ $Order->lat }}%26lon%3D{{ $Order->lon }}%0A%0A" target="_blank" class="btn btn-success">Request</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Order Id</th>
                        <th>Recipient Name</th>
                        <th>Recipient Number</th>
                        <th>City</th>
                        <th>Recipient Address</th>
                        <th>Item Price</th>
                        <th>Delivery Price</th>
                        <th>Total Price</th>
                        <th>Coupon</th>
                        <th>Notes</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <th>itemPrice :{{ $itemPrice }} </th>
                        <th></th>
                        <th>deliveryPrice :{{ $deliveryPrice }}</th>
                        <th></th>
                        <th>totalPrice :{{ $totalPrice }}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        
        
        $('.print').on('click', function() {
            let CSRF_TOKEN = '{{ csrf_token() }}';
            let id = $(this).attr('data-id');

            $.ajaxSetup({
              url: "{{ route('print') }}",
              type: 'POST',
              data: {
                _token: CSRF_TOKEN,
                id
              },
              beforeSend: function() {
                console.log('printing ...');
              },
              complete: function() {
                console.log('printed!');
              }
            });

            $.ajax({
              success: function(viewContent) {
                $.print(viewContent); // This is where the script calls the printer to print the viwe's content.
              }
            });
        });
        
        
        $('.submitAssgin').on('click', function () {
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
                success: function (data) {
                    console.log(data);
                    location.reload();
                    $('#alert').css('display', 'block');
                    $('#alert').text(data)
                }
            })
        });

        $('#Admintable1').DataTable({
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
            order: [0, 'desc'],
            responsive: true,
            buttons: [                
                {
                    extend: 'copy',
                    className: 'btn btn-secondary'
                }, {
                    extend: 'csv',
                    className: 'btn btn-warning',
                    title: 'nedco_orders',
                    extension: '.csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                }, {
                    extend: 'excel',
                    className: 'btn btn-success',
                    title: 'nedco_orders',
                    extension: '.xls',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                }, {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    title: 'nedco_orders',
                    extension: '.pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-info',
                    title: 'nedco_orders',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                }
            ],
        });

    });

</script>
@endsection
