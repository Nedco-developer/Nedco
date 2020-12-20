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
</style>

<div style="margin-top: 10px;" class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __('All Orders') }}</div>
        <div class="card-body">
            <table id="Admintable1" class="display nowrap table-res table table-condensed " style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>RecipientName</th>
                        <th>RecipientNumber</th>
                        <th>City</th>
                        <th>TotalPrice</th>
                        <th>Status</th>
                        <th>Request Location</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->RecipientName }}</td>
                            <td>{{ $order->RecipientNumber }}</td>
                            <td>{{ $order->city }}</td>
                            <td>{{ $order->totalPrice }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <button class="btn btn-primary request" data-id="{{ $order->id }}" data-link="https://api.whatsapp.com/send?phone={{ $order->RecipientNumber }}&text=Hey%20%0A%0A%0Aplease%20confirm%20your%20location%20for%20order%20number%20%23{{ $order->id }}%20via%20link%20down%20below%0A%0Ahttps%3A%2F%2Fominus.marketing%2Fnedco%2FconfirmLocation%3Foid%3D{{$order->id}}%26lat%3D{{ $order->lat }}%26lon%3D{{ $order->lon }}%0A%0A">Request</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.request').click(function() {
            let url = $(this).attr('data-link');
            let id = $(this).attr('data-id');
            let _token = "{{ csrf_token() }}";
            $.ajax({
                type: "post",
                url: "{{ route('setLocationConfirmSent') }}",
                data: {
                    _token,
                    id,
                },
                success: function (response) {
                    console.log(response);
                }
            });
                
            var win = window.open(url, "_blank");
        })
        
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
