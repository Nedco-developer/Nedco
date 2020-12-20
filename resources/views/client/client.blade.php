@extends('layouts.dashboardApp')

@section('title', 'Clients')

@section('content')
<style>

    .table-res {
        display: block !important;
        overflow-x: auto !important;
    }
    
</style>
<br>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">Clients</div>
        <div class="card-body">
            @if(\Session::has('error'))
                <div class="alert alert-danger">
                    {!! \Session::get('error') !!}
                </div>
            @endif
            <a class="btn btn-success" style="margin-bottom: 1rem;" href="/nedco/register-user?name=client">Add</a>
            <table id="Admintable" class="display nowrap table-res table table-condensed ">

                <thead>
                    <tr>
                        <th>
                            id
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Phone
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            View
                        </th>
                        <th>
                            Edit
                        </th>
                        <th>
                            Delete
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Admin as $admin)
                        <tr>
                            <td>{{ $admin->user->id }}</td>
                            <td>{{ $admin->user->name }}</td>
                            <td>{{ $admin->user->email }}</td>
                            <td>{{ $admin->user->phone }}</td>
                            @if( $admin->status == 'approved')
                                <td>Active</td>
                            @else
                                <td>Disactive</td>
                            @endif
                            <td>
                                <a href="Viewclient?id={{ $admin->user_id }}" class="btn btn-primary">View</a>
                            </td>
                            <td>
                                <a href="editclient?id={{ $admin->user_id }}" class="btn btn-primary">edit</a>
                            </td>
                            <td>
                                <a href="deleteclient?user_id={{ $admin->user_id }}&id={{ $admin->id }}"
                                    class="btn btn-danger">delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>
                            id
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Phone
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#Admintable').DataTable({
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
                        title: 'nedco_clients',
                        extension: '.csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'nedco_clients',
                        extension: '.xls',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'nedco_clients',
                        extension: '.pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'nedco_clients',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }
                ],
            });
        });

    </script>


    @endsection
