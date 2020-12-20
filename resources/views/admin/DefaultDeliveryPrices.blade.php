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

<ul class="entity-menu d-flex flex-row align-items-start entity-menu-small nav" role="tablist" style="margin-top: 1%;margin-left: 1%;margin-right: 1%;font-size: 21px;background-color: #ee293a;">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#Regions" style="color: #FFF;">Regions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Cities" style="color: #FFF;">Cities</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Disricts" style="color: #FFF;">Disricts</a>
        </li>
    </ul>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            @if(\Session::has('error'))
                <div class="alert alert-danger">
                    {!! \Session::get('error') !!}
                </div>
            @endif
            <div class="alert alert-danger" id="alert" style="display: none">
            </div>
            <div>
                <p>Click on the row cell to edit the default delivery price</p>
            </div>
            <!-- Regions -->
            <div style="margin-left: 1%;margin-right: 1%;" class="tab-content">
                <div id="Regions" class="row justify-content-center tab-pane active">
                    <table id="regionstable" class="display nowrap table-res table table-condensed ">
                      <thead>
                            <tr>
                                @foreach($locations as $location)
                                <th>
                                    {{$location->Region}}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($locations as $location)
                                <td data-id="{{$location->id}}">{{$location->price}}</td>
                                @endforeach
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                @foreach($locations as $location)
                                <th style="width: 10%;">
                                    {{$location->name}}
                                </th>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <!-- Cities -->
                <div id="Cities" class="row justify-content-center tab-pane">
                    <table id="citiestable" class="display nowrap table-res table table-condensed ">
                      <thead>
                            <tr>
                                @foreach($cities as $city)
                                <th>
                                    {{$city->name}}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($cities as $city)
                                <td data-id="{{$city->id}}">{{$city->price}}</td>
                                @endforeach
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                @foreach($cities as $city)
                                <th style="width: 10%;">
                                    {{$city->name}}
                                </th>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <!-- Districts -->
                <div id="Disricts" class="row justify-content-center tab-pane">
                    <table id="districtstable" class="display nowrap table-res table table-condensed ">
                        <thead>
                            <tr>
                                @foreach($districts as $district)
                                <th>
                                    {{$district->name}}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($districts as $district)
                                <td data-id="{{$district->id}}">{{$district->price}}</td>
                                @endforeach
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                @foreach($districts as $district)
                                <th style="width: 10%;">
                                    {{$district->name}}
                                </th>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>
                </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            // make cell editable function
            const regionCell = function(cell) {
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
                    const row = regionstable.row(e.target.parentElement)
                    let id = e.target.getAttribute("data-id");
                    let _token = "{{ csrf_token() }}";
                    row.invalidate();
                    $.ajax({
                        type: "post",
                        url: "{{ route('updateRegionPrice') }}",
                        data: {
                            _token,
                            id,
                            price: e.target.textContent
                        },
                        success: function (response) {
                        }
                    });
                }
              })
            };
            
            const cityCell = function(cell) {
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
                    const row = citiestable.row(e.target.parentElement)
                    let id = e.target.getAttribute("data-id");
                    let _token = "{{ csrf_token() }}";
                    row.invalidate();
                    $.ajax({
                        type: "post",
                        url: "{{ route('updateCityPrices') }}",
                        data: {
                            _token,
                            id,
                            price: e.target.textContent
                        },
                        success: function (response) {
                        }
                    });
                }
              })
            };
            
            const districtCell = function(cell) {
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
                    const row = districtstable.row(e.target.parentElement)
                    let id = e.target.getAttribute("data-id");
                    let _token = "{{ csrf_token() }}";
                    row.invalidate();
                    $.ajax({
                        type: "post",
                        url: "{{ route('updatedefaultDeliveryPrices') }}",
                        data: {
                            _token,
                            id,
                            price: e.target.textContent
                        },
                        success: function (response) {
                        }
                    });
                }
              })
            };
            
            var regionstable = $('#regionstable').DataTable({
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
                columnDefs: [{ 
                        targets: '_all', 
                        createdCell: regionCell
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
            
            var citiestable = $('#citiestable').DataTable({
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
                columnDefs: [{ 
                        targets: '_all', 
                        createdCell: cityCell
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
            
            var districtstable = $('#districtstable').DataTable({
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
                columnDefs: [{ 
                        targets: '_all', 
                        createdCell: districtCell
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
                    }, {
                        extend: 'excel',
                        className: 'btn btn-success',
                        title: 'nedco_users',
                        extension: '.xls',
                    }, {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        title: 'nedco_users',
                        extension: '.pdf',
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        title: 'nedco_users',
                    }
                ],
            });
        });

    </script>


    @endsection
