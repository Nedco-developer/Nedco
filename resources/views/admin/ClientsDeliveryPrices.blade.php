@extends('layouts.dashboardApp')

@section('title', 'Clients')

@section('content')
<?php 
use App\Models\DistrictsPrices;
?>
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
<br>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">Clients Delivery Prices</div>
        <div class="card-body">
            @if(\Session::has('error'))
                <div class="alert alert-danger">
                    {!! \Session::get('error') !!}
                </div>
            @endif
            <div class="alert alert-danger" id="alert" style="display: none">
            </div>
            <div>
                <p>Click on the row cell to edit the delivery price</p>
            </div>
            <table id="Admintable" class="display nowrap table-res table table-condensed ">
                <thead>
                    <tr>
                        <th>
                            id
                        </th>
                        <th>
                            Client Name
                        </th>
                        <th>
                            Client Phone
                        </th>
                        @foreach($districts as $district)
                        <th>
                            {{$district->name}}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->user->name }}</td>
                            <td>{{ $client->user->phone }}</td>
                            @foreach($districts as $district)
                            <td data-id="{{$district->id}},{{$client->user->id}}">
                               <?php 
                            //   getting user delivery price per distict
                               $districtsPrices = DistrictsPrices::where('user_id', $client->user_id)->where('district_id', $district->id)->first();
                               if (isset($districtsPrices->price)) {
                                   echo $districtsPrices->price; 
                               }
                               ?>
                            </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>
                            id
                        </th>
                        <th style="width: 10%">
                            Client Name
                        </th>
                        <th style="width: 10%">
                            Client Phone
                        </th>
                        @foreach($districts as $district)
                        <th>
                            {{$district->name}}
                        </th>
                        @endforeach
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            const createdCell = function(cell) {
              let original
            
              cell.setAttribute('contenteditable', true)
              cell.setAttribute('spellcheck', false)
            
              cell.addEventListener('focus', function(e) {
                original = e.target.textContent
              })
              
              cell.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.currentTarget.blur()
                }
              });
            
              cell.addEventListener('blur', function(e) {
                if (original !== e.target.textContent) {
                    const row = table.row(e.target.parentElement)
                    row.invalidate()
                    let data = e.target.getAttribute("data-id").split(',');
                    let _token = "{{ csrf_token() }}";
                    $.ajax({
                        type: "post",
                        url: "{{ route('updateDistictsPrice') }}",
                        data: {
                            _token,
                            district_id: data[0],
                            user_id: data[1],
                            price: e.target.textContent
                        },
                        success: function (response) {
                            
                        }
                    });
                  
                }
              })
            }


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
                // discard columns 0 1 2 from being editable
                columnDefs: [
                    { 
                        targets: [0, 1, 2], createdCell: null
                        
                    },
                    { 
                        targets: '_all', createdCell: createdCell
                    }],
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
