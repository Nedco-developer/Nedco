@extends('layouts.dashboardApp')

@section('title', 'Home')

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
        style="margin-top: 0.2%;margin-left: 1%;margin-right: 1%;font-size: 21px;background-color: #ee293a;">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#Drivrs" style="color: #FFF;">Drivers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Pickedup" style="color: #FFF;">Pickeups</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Finance" style="color: #FFF;">Finances</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Dispatcher" style="color: #FFF;">Dispatchers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Monitor" style="color: #FFF;">Monitors</a>
        </li>
    </ul>
    <div style="margin-left: 1%;margin-right: 1%;" class="tab-content">
        <div id="Drivrs" class="row justify-content-center tab-pane active">
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
                        <table id="Admintable1" class="display nowrap table-res table table-condensed ">

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
                                        Approve
                                    </th>
                                    <th>
                                        Deny
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Driver as $i => $Drivers)
                                    <tr>
                                        <td>{{ $Drivers->id }}</td>
                                        <td>{{ $Drivers->user->name }}</td>
                                        <td>{{ $Drivers->user->email }}</td>
                                        <td>{{ $Drivers->user->phone }}</td>
                                        <td>
                                            <form action="{{  route('UserStatus') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <input type="hidden" name="id" value="{{ $Drivers->id }}">
                                                <input type="hidden" name="type" value="driver">
                                                <button id="approved" class="submit btn btn-success">Approve</button>                                             
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{  route('UserStatus') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="deny">
                                                <input type="hidden" name="id" value="{{ $Drivers->id }}">
                                                <input type="hidden" name="type" value="driver">
                                                <button id="approved" class="submit btn btn-danger">deny</button>                                             
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="Pickedup" class="row justify-content-center tab-pane fade">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                        <table id="Admintable5" class="display nowrap table-res table table-condensed ">

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
                                        Approve
                                    </th>
                                    <th>
                                        Deny
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Pickedup as $i => $pickedup)
                                    <tr>
                                        <td>{{ $pickedup->id }}</td>
                                        <td>{{ $pickedup->user->name }}</td>
                                        <td>{{ $pickedup->user->email }}</td>
                                        <td>{{ $pickedup->user->phone }}</td>
                                        <td>
                                            <form action="{{  route('UserStatus') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <input type="hidden" name="id" value="{{ $pickedup->id }}">
                                                <input type="hidden" name="type" value="pickup">
                                                <button id="approved" class="submit btn btn-success">Approve</button>                                             
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{  route('UserStatus') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="deny">
                                                <input type="hidden" name="id" value="{{ $pickedup->id }}">
                                                <input type="hidden" name="type" value="pickedup">
                                                <button id="approved" class="submit btn btn-danger">deny</button>                                             
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div id="Finance" class="row justify-content-center tab-pane fade">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                        <table id="Admintable2" class="display nowrap table-res table table-condensed ">

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
                                        Approve
                                    </th>
                                    <th>
                                        Deny
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Finance as $i => $Finance)
                                    <tr>
                                        <td>{{ $Finance->id }}</td>
                                        <td>{{ $Finance->user->name }}</td>
                                        <td>{{ $Finance->user->email }}</td>
                                        <td>{{ $Finance->user->phone }}</td>
                                        <td>
                                            <form action="{{  route('UserStatus') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <input type="hidden" name="id" value="{{ $Finance->id }}">
                                                <input type="hidden" name="type" value="finance">
                                                <button id="approved" class="submit btn btn-success">Approve</button>                                             
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{  route('UserStatus') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="deny">
                                                <input type="hidden" name="id" value="{{ $Finance->id }}">
                                                <input type="hidden" name="type" value="finance">
                                                <button id="approved" class="submit btn btn-danger">deny</button>                                             
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="Dispatcher" class="row justify-content-center tab-pane fade">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                        <table id="Admintable3" class="display nowrap table-res table table-condensed ">

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
                                        Approve
                                    </th>
                                    <th>
                                        Deny
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Dispatcher as $i => $Dispatcher)
                                    <tr>
                                        <td>{{ $Dispatcher->id }}</td>
                                        <td>{{ $Dispatcher->user->name }}</td>
                                        <td>{{ $Dispatcher->user->email }}</td>
                                        <td>{{ $Dispatcher->user->phone }}</td>
                                        <td>
                                            <form action="{{  route('UserStatus') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <input type="hidden" name="id" value="{{ $Dispatcher->id }}">
                                                <input type="hidden" name="type" value="dispatcher">
                                                <button id="approved" class="submit btn btn-success">Approve</button>                                             
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{  route('UserStatus') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="deny">
                                                <input type="hidden" name="id" value="{{ $Dispatcher->id }}">
                                                <input type="hidden" name="type" value="dispatcher">
                                                <button id="approved" class="submit btn btn-danger">deny</button>                                             
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="Monitor" class="row justify-content-center tab-pane fade">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                        <table id="Admintable4" class="display nowrap table-res table table-condensed ">

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
                                        Approve
                                    </th>
                                    <th>
                                        Deny
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Monitor as $i => $Monitor)
                                    <tr>
                                        <td>{{ $Monitor->id }}</td>
                                        <td>{{ $Monitor->user->name }}</td>
                                        <td>{{ $Monitor->user->email }}</td>
                                        <td>{{ $Monitor->user->phone }}</td>
                                        <td>
                                            <form action="{{  route('UserStatus') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <input type="hidden" name="id" value="{{ $Monitor->id }}">
                                                <input type="hidden" name="type" value="monitor">
                                                <button id="approved" class="submit btn btn-success">Approve</button>                                             
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{  route('UserStatus') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="deny">
                                                <input type="hidden" name="id" value="{{ $Monitor->id }}">
                                                <input type="hidden" name="type" value="monitor">
                                                <button id="approved" class="submit btn btn-danger">deny</button>                                             
                                            </form>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#Admintable1').DataTable();
            $('#Admintable2').DataTable();
            $('#Admintable3').DataTable();
            $('#Admintable4').DataTable();
            $('#Admintable5').DataTable();

        });

    </script>
@endsection