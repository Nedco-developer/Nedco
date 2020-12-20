@extends('layouts.dashboardApp')

@section('title', 'Pickedup')

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
</style>
    <br>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Pickedup</div>
            <div class="card-body">
                @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        {!! \Session::get('error') !!}
                    </div>
                @endif
                <a class="btn btn-success" style="margin-bottom: 1rem;" href="/nedco/register-user?name=pickedup">Add</a>
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
                                View Details
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
                        @foreach ($Admin as $Admin)
                            <tr>
                                <td>{{ $Admin->id }}</td>
                                <td>{{ $Admin->user->name }}</td>
                                <td>{{ $Admin->user->email }}</td>
                                <td>{{ $Admin->user->phone }}</td>
                                @if( $Admin->status == 'approved')
                                <td>Active</td>
                                @else
                                <td>Disactive</td>
                                @endif
                                <td><a href="ViewDetailspickedup?id={{ $Admin->user_id }}" class="btn btn-primary">View</a>
                                </td>
                                <td><a href="editdriver?id={{ $Admin->user_id }}" class="btn btn-primary">edit</a>
                                </td>
                                <td>
                                    <a href="deletedriver?user_id={{ $Admin->user_id }}&id={{ $Admin->id }}"
                                        class="btn btn-danger">delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#Admintable').DataTable();
            });

        </script>

    @endsection
