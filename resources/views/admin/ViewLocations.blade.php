@extends('layouts.dashboardApp')

@section('title', 'Locations')

@section('content')
<style>
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
    <ul class="entity-menu d-flex flex-row align-items-start entity-menu-small nav" role="tablist"
        style="margin-top: 1%;margin-left: 1%;margin-right: 1%;font-size: 21px;background-color: #ee293a;">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#Region" style="color: #FFF;">Regions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Cities" style="color: #FFF;">Cities</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Disrict" style="color: #FFF;">Disrict</a>
        </li>
    </ul>
    <div style="margin-left: 1%;margin-right: 1%;" class="tab-content">
        <div id="Region" class="row justify-content-center tab-pane active">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                        @if (\Session::has('success'))
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif
                    <a class="btn btn-success" style="margin-bottom: 1rem;" href="/nedco/addlocation">Add</a>
                        <table id="Admintable" class="display nowrap table-res table table-condensed ">
        
                            <thead>
                                    <th>
                                        id
                                    </th>
                                    <th>
                                        Region
                                    </th>
                                    <th>
                                        Clients Default Delivery Price
                                    </th>
                                    <th>
                                        Drivers Default Delivery Price
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
                                @foreach ($Location as $location)
                                    <tr>
                                        <td>{{ $location->id }}</td>
                                        <td>{{ $location->Region }}</td>
                                        <td>{{ $location->price }}</td>
                                        <td>{{ $location->driver_price }}</td>
                                        <td><a href="editLocation?id={{ $location->id }}"
                                            class="btn btn-primary">edit</a>
                                        </td>
                                        <td>
                                            <a href="deleteLocation?id={{ $location->id }}"
                                                class="btn btn-danger">delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="Cities" class="row justify-content-center tab-pane fade">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                        @if (\Session::has('success'))
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif
                    <a class="btn btn-success" style="margin-bottom: 1rem;" href="/nedco/addCities">Add</a>
                        <table id="Admintable1" class="display nowrap table-res table table-condensed ">
        
                            <thead>
                                    <th>
                                        id
                                    </th>
                                    <th>
                                        City
                                    </th>
                                    <th>
                                        Clients Default Delivery Price
                                    </th>
                                    <th>
                                        Drivers Default Delivery Price
                                    </th>
                                    <th>
                                        City Code
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
                                @foreach ($City as $Cit)
                                    <tr>
                                        <td>{{ $Cit->id }}</td>
                                        <td>{{ $Cit->name }}</td>
                                        <td>{{ $Cit->price }}</td>
                                        <td>{{ $Cit->driver_price }}</td>
                                        <td>{{ $Cit->city_code }}</td>
                                        <td><a href="editCities?id={{ $Cit->id }}"
                                            class="btn btn-primary">edit</a>
                                        </td>
                                        <td>
                                            <a href="deleteCities?id={{ $Cit->id }}"
                                                class="btn btn-danger">delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="Disrict" class="row justify-content-center tab-pane fade">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                        @if (\Session::has('success'))
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif
                    <a class="btn btn-success" style="margin-bottom: 1rem;" href="/nedco/addDistricts">Add</a>
                        <table id="Admintable2" class="display nowrap table-res table table-condensed ">
        
                            <thead>
                                    <th>
                                        id
                                    </th>
                                    <th>
                                        Disrict
                                    </th>
                                    <th>
                                        Clients Default Delivery Price
                                    </th>
                                    <th>
                                        Drivers Default Delivery Price
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
                                @foreach ($Districts as $disrict)
                                    <tr>
                                        <td>{{ $disrict->id }}</td>
                                        <td>{{ $disrict->name }}</td>
                                        <td>{{ $disrict->price }}</td>
                                        <td>{{ $disrict->driver_price }}</td>
                                        <td><a href="editDistricts?id={{ $disrict->id }}"
                                            class="btn btn-primary">edit</a>
                                        </td>
                                        <td>
                                            <a href="deleteDistricts?id={{ $disrict->id }}"
                                                class="btn btn-danger">delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
        
        
        <script>
            $(document).ready(function() {
                $('#Admintable').DataTable({
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
                    title: 'nedco locations',
                    extension: '.csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }, {
                    extend: 'excel',
                    className: 'btn btn-success',
                    title: 'nedco locations',
                    extension: '.xls',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }, {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    title: 'nedco locations',
                    extension: '.pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-info',
                    title: 'nedco locations',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }
            ],
                });
                $('#Admintable1').DataTable({
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
                    title: 'nedco locations',
                    extension: '.csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }, {
                    extend: 'excel',
                    className: 'btn btn-success',
                    title: 'nedco locations',
                    extension: '.xls',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }, {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    title: 'nedco locations',
                    extension: '.pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-info',
                    title: 'nedco locations',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }
            ],
                });
                $('#Admintable2').DataTable({
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
                    title: 'nedco locations',
                    extension: '.csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }, {
                    extend: 'excel',
                    className: 'btn btn-success',
                    title: 'nedco locations',
                    extension: '.xls',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }, {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    title: 'nedco locations',
                    extension: '.pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-info',
                    title: 'nedco locations',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }
            ],
                });
            });

        </script>
    @endsection
