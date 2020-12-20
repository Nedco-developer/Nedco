@extends('layouts.dashboardApp')

@section('title', 'Orders')

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
        .entity-menu>.nav-item>a.active {
            background-color: #000;
            border-bottom: 0px solid black !important;
        }

    </style>
    <ul class="entity-menu d-flex flex-row align-items-start entity-menu-small nav" role="tablist"
        style="margin-top: 1%;margin-left: 1%;margin-right: 1%;font-size: 21px;background-color: #ee293a;">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#Clients" style="color: #FFF;">Clients</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Drivers" style="color: #FFF;">Drivers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Company" style="color: #FFF;">Company</a>
        </li>
    </ul>
    <div style="margin-left: 1%;margin-right: 1%;" class="tab-content">
        <div id="Clients" class="row justify-content-center tab-pane active">
             <div style="margin-top: 10px;" class="col-md-12">
                <div class="card">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif
                    <div class="card-body">
                        <table id="clients" class="display nowrap table-res table">
                            <thead>
                                <tr>
                                    <th>Client Id</th>
                                    <th style="width: 20%;">Client Name</th>
                                    <th style="width: 15%;">Client Email</th>
                                    <th>Client Phone</th>
                                    <th>Client Finance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                <tr>
                                    <td>{{ $client->user->id }}</td>
                                    <td>{{ $client->user->name }}</td>
                                    <td>{{ $client->user->email }}</td>
                                    <td>{{ $client->user->phone }}</td>
                                    <td><a href="ClientFinance?client_id={{ $client->id }}" class="btn btn-warning">Finances</a></td>
                                </tr>
                               @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="Drivers" class="row justify-content-center tab-pane fade">
            <div style="margin-top: 10px;" class="col-md-12">
                <div class="card">
                    @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif
                    <div class="card-body">
                        <table id="drivers" class="display nowrap table-res table">
                            <thead>
                                <tr>
                                    <th>Driver Id</th>
                                    <th>Driver Name</th>
                                    <th>Driver Email</th>
                                    <th>Driver Phone</th>
                                    <th>Driver Finance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($drivers as $driver)
                                <tr>
                                    <td>{{ $driver->id }}</td>
                                    <td>{{ $driver->user->name }}</td>
                                    <td>{{ $driver->user->email }}</td>
                                    <td>{{ $driver->user->phone }}</td>
                                    <td>
                                        <a href="DriverFinance?driver_id={{ $driver->id }}" class="btn btn-warning">Finances</a>
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script>
            $(document).ready(function() {
                $('#drivers').DataTable({
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
                        title: 'nedco_admins',
                        extension: '.csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'nedco_admins',
                        extension: '.xls',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'nedco_admins',
                        extension: '.pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'nedco_admins',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }
                ],
            });
                $('#clients').DataTable({
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
                        title: 'nedco_admins',
                        extension: '.csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'nedco_admins',
                        extension: '.xls',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'nedco_admins',
                        extension: '.pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'nedco_admins',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }
                ],
            });
            });
        </script>
@endsection