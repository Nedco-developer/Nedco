@extends('layouts.dashboardApp')

@section('title', 'Clients')

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
<br>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">Coupons</div>
        <div class="card-body">
            @if(\Session::has('error'))
                <div class="alert alert-danger">
                    {!! \Session::get('error') !!}
                </div>
            @endif
            <div class="alert alert-danger" id="alert" style="display: none">
            </div>
            <a class="btn btn-success" style="margin-bottom: 1rem;" href="/nedco/add_coupon">Add</a>
            <table id="Admintable" class="display nowrap table-res table table-condensed ">
                <thead>
                    <tr>
                        <th>
                            id
                        </th>
                        <th>
                            Coupon Code
                        </th>
                        <th>
                            Discount
                        </th>
                        <th>
                            Expires at
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupons as $coupon)
                        <tr id="row_{{ $coupon->id }}">
                            <td>{{ $coupon->id }}</td>
                            <td>{{ $coupon->coupon_code }}</td>
                            <td>{{ $coupon->discount }} JOD</td>
                            <td>{{ $coupon->expires_at }}</td>
                            <td><button id="delete_coupon" class="btn btn-danger" data-id="{{ $coupon->id }}">Delete</button></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th style="width: 5%">
                            id
                        </th>
                        <th style="width: 10%">
                            Coupon Code
                        </th>
                        <th>
                            Discount
                        </th>
                        <th>
                            Expires at
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Coupone Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this coupone ?
                        <input type="hidden" name="coupon_id" id="coupon_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="confirm_delete" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function () {

            $('#delete_coupon').click(function (e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                $('#coupon_id').val(id);

                $('#exampleModal').modal('toggle');
            });

            $('#confirm_delete').click(function (e) { 
                e.preventDefault();
                let id = $('#coupon_id').val();
                let _token = "{{ csrf_token() }}"
                $.ajax({
                    type: "post",
                    url: "{{ route('delete_coupon') }}",
                    data: {
                        _token,
                        coupone_id: id
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.success) {
                            $('#exampleModal').modal('hide');
                            $('#alert').css('display', 'block');
                            $('#alert').text('Coupon was Deleted');
                            setTimeout(() => {
                                $('#alert').css('display', 'none');
                                $('#alert').text('');
                            }, 5000);
                            $('#row_'+response.id+'').remove();
                        }
                    }
                }); 
            });

            var table = $('#Admintable').DataTable({
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
                buttons: [{
                        extend: 'copy',
                        className: 'btn btn-secondary'
                    }, {
                        extend: 'csv',
                        className: 'btn btn-warning',
                        title: 'nedco_users',
                        extension: '.csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'nedco_users',
                        extension: '.xls',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'nedco_users',
                        extension: '.pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'nedco_users',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }
                ],
            });
        });

    </script>


    @endsection
