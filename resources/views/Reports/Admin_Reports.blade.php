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

<ul class="entity-menu d-flex flex-row align-items-start entity-menu-small nav" role="tablist" style="margin-top: 1%;margin-left: 1%;margin-right: 1%;font-size: 21px;background-color: #ee293a;">
    <li class="nav-item">
        <a class="nav-link @if(request('filterType') == 'all' || request('filterType') == '') active @endif" href="Report?filterType=all" style="color: #FFF;">All</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(request('filterType') == 'today') active @endif" href="Report?filterType=today" style="color: #FFF;">Today</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(request('filterType') == 'weekly') active @endif" href="Report?filterType=weekly" style="color: #FFF;">Weekly</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(request('filterType') == 'monthly') active @endif" href="Report?filterType=monthly" style="color: #FFF;">Monthly</a>
    </li>
</ul>

<div style="margin-left: 1%;margin-right: 1%;" class="tab-content">

    <div id="Yearly" class="row justify-content-center tab-pane active">
        <div style="margin-top: 10px;" class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="Admintable4" class="display nowrap table-res table table-condensed">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Status</th>
                                <th>Payment status</th>
                                <th>City</th>
                                <th>Item Price</th>
                                <th>Delivery Price</th>
                                <th>Total Price</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody id="yearlyBody">
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
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
                        <tfoot id="yearlyFooter">
                            <tr>
                                <th>Id</th>
                                <th>Status</th>
                                <th>Payment status</th>
                                <th>City</th>
                                <th>Item Price</th>
                                <th>Delivery Price</th>
                                <th>Total Price</th>
                                <th>Notes</th>
                            </tr>
                            <tr class="yearlyFilter">
                                <td>Total Items Prices : {{ $itemPrice }}</td>
                                <td>Total Delivery Cash : {{ $deliveryPrice }}</td>
                                <td>Total : {{ $totalPrice }}</td>
                                <td>Total Paid For Driver : {{ $totalDriver }}</td>
                                <td>Total Net : {{ $totalNet }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @if (request('filterType') == 'all' || request('filterType') == '')
                            <tr class="yearlyFilter">
                                    <th></th>
                                    <th>From : <input type="date" onchange="changeto()" id="From" name="From"></th>
                                    <th></th>
                                    <th>To : <input type="date" id="To" name="To"></th>
                                    <th><a type="submit" id="Search" onclick="searchFromTo()"
                                            class="btn btn-success">Search</a></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            @endif
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="Dailly" class="row justify-content-center tab-pane fade">
        <div style="margin-top: 10px;" class="col-md-12">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

    <div id="Weekly" class="row justify-content-center tab-pane fade">
        <div style="margin-top: 10px;" class="col-md-12">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

    <div id="Monthly" class="row justify-content-center tab-pane fade">
        <div style="margin-top: 10px;" class="col-md-12">
            <div class="card">
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    function changeto() {
        let FromDate = document.getElementById("From").value;
        $('#To').attr("min", FromDate);
    }

    function searchFromTo() {
        let FromDate = document.getElementById("From").value;
        let ToDate = document.getElementById("To").value;
        $.ajax({
            url: "{{ route('Search') }}",
            type: 'GET',
            data: {
                FromDate: FromDate,
                ToDate: ToDate
            },
            success: function (data) {
                $('#yearlyBody').remove();
                $('#Admintable4').append('<tbody id="yearlyBody"></tbody>');
                $.each(data.yearlyOrder, function (index, value) {
                    $('#yearlyBody').append('<tr><td>' + value.id + ' </td><td>' + value
                        .payment_status + ' </td><td>' + value.city + ' </td><td>' + value
                        .itemPrice + ' </td><td>' + value.deliveryPrice + ' </td><td>' + value
                        .totalPrice + ' </td><td>' + value.status + ' </td><td>' + value.notes +
                        ' </td></tr>');
                });
                $('.yearlyFilter').remove();

                $('#yearlyFooter').append('<tr class="yearlyFilter"><td>yearly Item : ' + data.yearlyItem +
                    '</td><td>yearly Delivery : ' + data.yearlyDelivery + '</td><td>yearly Total : ' +
                    data.yearlyTotal + '</td><td>Total yearly Driver : ' + data.TotalyearlyDriver +
                    '</td><td>total yearly Net : ' + data.totalyearlyNet +
                    '</td><td></td><td></td><td></td></tr>');

                $('#yearlyFooter').append(
                    '<tr class="yearlyFilter"><th></th><th>From : <input type="date" onchange="changeto()" id="From" name="From"></th><th></th><th>To : <input type="date" id="To" name="To"></th><th><a type="submit" id="Search" onclick="searchFromTo()" class="btn btn-success">Search</a></th><th></th><td></td></td><td></tr>'
                    );

            }
        });
    }

    $('#today').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "/Report?type=ajax&filterType=today",
            type: 'GET',
            success: function (data) {
                console.log(data);
                $('#yearlyFooter').remove();
                $('#yearlyBody').remove();
                $('#Admintable4').append('<tbody id="yearlyBody"></tbody>');
                if (data.orders.length == 0) {
                    $('#yearlyBody').append(
                        '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty">No data available in table</td></tr>'
                        );
                } else {
                    $.each(data.orders, function (index, value) {
                        $('#yearlyBody').append('<tr><td>' + value.id + ' </td><td>' + value
                            .payment_status + ' </td><td>' + value.city + ' </td><td>' +
                            value.itemPrice + ' </td><td>' + value.deliveryPrice +
                            ' </td><td>' + value.totalPrice + ' </td><td>' + value
                            .status + ' </td><td>' + value.notes + ' </td></tr>');
                    });
                }

                $('.yearlyFilter').remove();

                $('#yearlyFooter').append('<tr class="yearlyFilter"><td>Total Items Prices :' + data
                    .itemPrice + ' }}</td><td>Total Delivery Cash :' + data.deliveryPrice +
                    ' </td><td>Total : ' + data.totalPrice +
                    '</td><td>Total Paid For Driver : ' + data.totalDriver +
                    ' </td><td>Total Net : ' + data.totalNet +
                    ' </td><td></td><td></td><td></td></tr>');
            }
        });
    });

    $('#weekly').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "/Report?type=ajax&filterType=weekly",
            type: 'GET',
            success: function (data) {
                console.log(data);
                $('#yearlyFooter').remove();
                $('#yearlyBody').remove();
                $('#Admintable4').append('<tbody id="yearlyBody"></tbody>');
                if (data.orders.length == 0) {
                    $('#yearlyBody').append(
                        '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty">No data available in table</td></tr>'
                        );
                } else {
                    $.each(data.orders, function (index, value) {
                        $('#yearlyBody').append('<tr><td>' + value.id + ' </td><td>' + value
                            .payment_status + ' </td><td>' + value.city + ' </td><td>' +
                            value.itemPrice + ' </td><td>' + value.deliveryPrice +
                            ' </td><td>' + value.totalPrice + ' </td><td>' + value
                            .status + ' </td><td>' + value.notes + ' </td></tr>');
                    });
                }

                $('.yearlyFilter').remove();

                $('#yearlyFooter').append('<tr class="yearlyFilter"><td>Total Items Prices :' + data
                    .itemPrice + ' }}</td><td>Total Delivery Cash :' + data.deliveryPrice +
                    ' </td><td>Total : ' + data.totalPrice +
                    '</td><td>Total Paid For Driver : ' + data.totalDriver +
                    ' </td><td>Total Net : ' + data.totalNet +
                    ' </td><td></td><td></td><td></td></tr>');
            }
        });
    });

    $('#monthly').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "/Report?type=ajax&filterType=monthly",
            type: 'GET',
            success: function (data) {
                console.log(data);
                $('#yearlyFooter').remove();
                $('#yearlyBody').remove();
                $('#Admintable4').append('<tbody id="yearlyBody"></tbody>');
                if (data.orders.length == 0) {
                    $('#yearlyBody').append(
                        '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty">No data available in table</td></tr>'
                        );
                } else {
                    $.each(data.orders, function (index, value) {
                        $('#yearlyBody').append('<tr><td>' + value.id + ' </td><td>' + value
                            .payment_status + ' </td><td>' + value.city + ' </td><td>' +
                            value.itemPrice + ' </td><td>' + value.deliveryPrice +
                            ' </td><td>' + value.totalPrice + ' </td><td>' + value
                            .status + ' </td><td>' + value.notes + ' </td></tr>');
                    });
                }

                $('.yearlyFilter').remove();

                $('#yearlyFooter').append('<tr class="yearlyFilter"><td>Total Items Prices :' + data
                    .itemPrice + ' }}</td><td>Total Delivery Cash :' + data.deliveryPrice +
                    ' </td><td>Total : ' + data.totalPrice +
                    '</td><td>Total Paid For Driver : ' + data.totalDriver +
                    ' </td><td>Total Net : ' + data.totalNet +
                    ' </td><td></td><td></td><td></td></tr>');
            }
        });
    });

    $('#all').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "/Report?type=ajax&filterType=all",
            type: 'GET',
            success: function (data) {
                console.log(data);
                $('#yearlyFooter').remove();
                $('#yearlyBody').remove();
                $('#Admintable4').append('<tbody id="yearlyBody"></tbody>');
                if (data.orders.length == 0) {
                    $('#yearlyBody').append(
                        '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty">No data available in table</td></tr>'
                        );
                } else {
                    $.each(data.orders, function (index, value) {
                        $('#yearlyBody').append('<tr><td>' + value.id + ' </td><td>' + value
                            .payment_status + ' </td><td>' + value.city + ' </td><td>' +
                            value.itemPrice + ' </td><td>' + value.deliveryPrice +
                            ' </td><td>' + value.totalPrice + ' </td><td>' + value
                            .status + ' </td><td>' + value.notes + ' </td></tr>');
                    });
                }

                $('.yearlyFilter').remove();

                $('#yearlyFooter').append('<tr class="yearlyFilter"><td>Total Items Prices :' + data
                    .itemPrice + ' }}</td><td>Total Delivery Cash :' + data.deliveryPrice +
                    ' </td><td>Total : ' + data.totalPrice +
                    '</td><td>Total Paid For Driver : ' + data.totalDriver +
                    ' </td><td>Total Net : ' + data.totalNet +
                    ' </td><td></td><td></td><td></td></tr>');
            }
        });
    });

    $(document).ready(function () {

        $('#Admintable1').DataTable({
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
            buttons: [{
                    extend: 'pdf',
                    title: 'My Orders Report',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                },
                {
                    extend: 'excel',
                    title: 'My Orders Report',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    },
                    footer: false
                },
                {
                    extend: 'print',
                    title: 'My Orders Report',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    },
                    footer: true
                }
            ],

        });

        $('#Admintable2').DataTable({
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
            buttons: [{
                    extend: 'pdf',
                    title: 'My Orders Report',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                },
                {
                    extend: 'excel',
                    title: 'My Orders Report',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    },
                    footer: false
                },
                {
                    extend: 'print',
                    title: 'My Orders Report',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    },
                    footer: true
                }
            ],

        });

        $('#Admintable3').DataTable({
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
            buttons: [{
                    extend: 'pdf',
                    title: 'My Orders Report',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                },
                {
                    extend: 'excel',
                    title: 'My Orders Report',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    },
                    footer: false
                },
                {
                    extend: 'print',
                    title: 'My Orders Report',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    },
                    footer: true
                }
            ],

        });

        $('#Admintable4').DataTable({
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
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'nedco_orders_reports',
                        extension: '.xls',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'nedco_orders_reports',
                        extension: '.pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'nedco_orders_reports',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                ],

        });
    });

</script>
@endsection
