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
</style>
<br>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                    <div class="card-header">{{$Admin->user->type}}s Orders</div>
                    <div class="card-body">
                    <table id="Admintable1" class="display nowrap table-res table table-condensed ">
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>{{ $order->city }}</td>
                                    <td>{{ $order->itemPrice }}</td>
                                    <td>{{ $order->deliveryPrice }}</td>
                                    <td>{{ $order->totalPrice }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                                <tr>
                                    <td>Item Price :</td>
                                    <td>{{ $item }}</td>
                                    @if($Admin->user->type == "driver")
                                    <td>Driver Price :</td>
                                    @else
                                    <td>Delivery Price :</td>
                                    @endif
                                    <td>{{ $delivery }}</td>
                                    <td>Total Price:</td>
                                    <td>{{ $total }}</td>
                                </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
                <br>
            <div class="card">
                <div class="card-header">{{ __('Financial Accounts') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('SaveAccounts') }}">
                        @csrf
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif

                        <input type="hidden" name="user_id" value="{{$Admin->user->id }}" />

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">name</label>
                            <div class="col-md-5">
                                <input id="name" type="text" disabled class="form-control" name="name" value="{{ $Admin->user->name }}" >
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="TotalPrice" class="col-md-4 col-form-label text-md-right">Total Price</label>
                            <div class="col-md-5">
                                <input id="TotalPrice" type="text" disabled class="form-control" name="TotalPrice" value="{{$TotalPrice}}" >
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="Price" class="col-md-4 col-form-label text-md-right">Price</label>
                            <div class="col-md-5">
                                <input id="Price" type="number" step="0.01" class="form-control" name="Price" value=""  required autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="calPrice" class="col-md-4 col-form-label text-md-right">result</label>
                            <div class="col-md-5">
                                <input id="calPrice" type="text" disabled class="form-control" value="">
                                <input id="result" type="hidden" class="form-control" name="result" value="">
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
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
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }, {
                        extend: 'csv',
                        className: 'btn btn-warning',
                        title: 'reports',
                        extension: '.csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'reports',
                        extension: '.xls',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'reports',
                        extension: '.pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'reports',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    }
                ],
            });
    });
    $('#Price').keyup(function () {
        let total = $('#TotalPrice').val();
        var sum = Number(total) - Number($(this).val());
        $('#calPrice').attr('value', sum.toFixed(2));
        $('#result').attr('value', sum.toFixed(2));
    });
</script>
@endsection
