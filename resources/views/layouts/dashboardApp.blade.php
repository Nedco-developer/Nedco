<!doctype html>
<html lang="en">
<?php 
    use App\Models\Notifications;
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/nedco/css/dashboard_style.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="/nedco/css/pages-style.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    {{-- jq --}}
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    {{-- jq --}}

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js" integrity="sha512-i8ERcP8p05PTFQr/s0AZJEtUwLBl18SKlTOZTH0yK5jVU0qL8AIQYbbG5LU+68bdmEqJ6ltBRtCxnmybTbIYpw==" crossorigin="anonymous"></script>

    <script src="/nedco/js/sidebar.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <title>Nedco</title>
    <link rel="icon" href="{!! asset('images/cropped-nedco_icon-32x32.jpg') !!}" />
</head>
<style>
.dropbtn {
  background-color: #ee293a;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {
  background-color: #ddd;
}

.show {
  display: block;
}

.show2 {
  display: block;
  width: 20rem;
  max-height: 25rem;
}

.nedco {
  margin-left: 1rem !important;
  font-size: 2.8rem !important;
}

.badge {
  position: relative;
  top: 12px;
  left: -30px;
  border: 1px solid white;
  border-radius: 50%;
  height: 19px;
}

.noti {
  justify-content: center;
  background: darkgrey;
  border-bottom: solid #000000;
  border-bottom-width: 1px;
}

.noti2 {
  text-align-last: center;
}

@media only screen and (max-width: 767px) {
  .sidebar-nav {
    width: 10.5rem !important;
    height: 120vh !important;
  }
  #wrapper.toggled #sidebar-wrapper {
    width: 11rem !important;
  }
  .navbar-nav {
    display: flex !important;
    flex-direction: initial !important;
  }
  .nedco {
    margin-left: 1rem !important;
    font-size: 1.6rem !important;
  }
  .badge {
    position: relative;
    top: -49px;
    left: 31px;
    border: 1px solid white;
    border-radius: 50%;
    height: 19px;
  }
  .show2 {
    display: block;
    width: 20rem;
    max-height: 25rem;
    top: 45px;
    left: -155px;
  }
}

@media only screen and (min-width: 320px) and (max-width: 568px) {
  .sidebar-nav {
    width: 10.5rem !important;
    height: 120vh !important;
  }
  #wrapper.toggled #sidebar-wrapper {
    width: 11rem !important;
  }
  .navbar-nav {
    display: flex !important;
    flex-direction: initial !important;
  }
  .nedco {
    margin-left: 1rem !important;
    font-size: 1.6rem !important;
  }
  .badge {
    position: relative;
    top: -50px;
    left: 33px;
    border: 1px solid white;
    border-radius: 50%;
    height: 19px;
  }
  .dropdown {
    width: 0rem;
  }
  .show2 {
    display: block;
    width: 20rem;
    max-height: 25rem;
    top: 45px;
    left: -155px;
  }
}
    
</style>
<body>
    <?php 
        if(Auth::user()->type == 'dispatcher' )
        {
            $notifications = Notifications::where('type', Auth::user()->type)->orderBy('id', 'DESC')->get();
            $count_notifications = Notifications::where('type', Auth::user()->type)->where('is_seen', 0)->count();
        }else if(Auth::user()->type == 'monitor')
        {
            $notifications = Notifications::where('user_id', null)->orderBy('id', 'DESC')->get();
            $count_notifications = Notifications::where('user_id', null)->where('is_seen', 0)->count();
        }
        else if(Auth::user()->type == 'pickedup' )
        {
            $notifications = Notifications::where('type', Auth::user()->type)->orderBy('id', 'DESC')->get();
            $count_notifications = Notifications::where('type', Auth::user()->type)->where('is_seen', 0)->count();
        }
        else if(Auth::user()->type == 'driver' )
        {
            $notifications = Notifications::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
            $count_notifications = Notifications::where('user_id', Auth::user()->id)->where('is_seen', 0)->count();
        }
        else if(Auth::user()->type == 'client')
        {
            $notifications = Notifications::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
            $count_notifications = Notifications::where('user_id', Auth::user()->id)->where('is_seen', 0)->count();
        }
        else if(Auth::user()->type == 'super_admin')
        {
            $notifications = Notifications::where('type', "!=", 'dispatcher')->where('type', "!=", 'pickup')->orderBy('id', 'DESC')->get();
            $count_notifications = Notifications::where('type', "!=", 'dispatcher')->where('type', "!=", 'pickup')->where('is_seen', 0)->count();
        }else if(Auth::user()->type == 'admin')
        {
            $notifications = Notifications::where('user_id', null)->orderBy('id', 'DESC')->get();
            $count_notifications = Notifications::where('user_id', null)->where('is_seen', 0)->count();
        }
        else if(Auth::user()->type == 'pickup')
        {
            // $notifications = Notifications::where('type', 'pickup')->orderBy('id', 'DESC')->get();
            $notifications = [];
            $count_notifications = Notifications::where('user_id', null)->where('is_seen', 0)->count();
        }
        
    ?>
    <header>
        <nav class="navbar navbar-expand-lg navbar-style">
            <div id="navbarSupportedContent">
                <div class="row navbar-nav mr-auto">
                    <a href="#menu-toggle" class="float-right" id="menu-toggle"><img src="{{ asset('images/open-menu.png') }}"
                            class="menu-toggle" /></a>

                    <a class=" nedco navbar-brand" href="{{ url('home') }}">
                        NEDCO
                    </a>
                </div>
                @if(Auth::user()->type != 'finance')
                    <div class="dropdown">
                        <div class="row">
                            <img class="dropbtn" onclick="myFunction()" src="{{ asset('images/icons8-notification-30.png') }}" />
                            <span onclick="myFunction()" class="badge badge-light">{{ $count_notifications }}</span>
                        </div>
                        <div id="myDropdown" class="dropdown-menu-right dropdown-content">
                            <div class="noti row m-0">Notification</div>
                            @foreach($notifications as $notify)
                                <form action="{{ route('notificationOrder') }}" method="get"
                                    class="{{ $notify->id }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id=$notify->id }}" />
                                    <a href="#" @if($notify->is_seen) style="background-color: white;" @endif
                                        data-id="{{ $notify->id }}" class="drop_item" >
                                        <div class="row">
                                            <input type="hidden" name="id" value="{{ $id=$notify->id }}" />
                                            <div class="col-md-9 b-0 p-0 m-0">{{ $notify->message }}</div>
                                            <div class="col-md-3 b-0 p-0 m-0">
                                                {{ date("g:i a", strtotime($notify->created_at)) }}
                                            </div>
                                        </div>
                                    </a>
                                </form>
                            @endforeach
                        </div>
                    </div>
                @endif
                <a id="navbarDropdown" class="nav-link dropdown-toggle mt-3" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    @if(Auth::user())
                        {{ Auth::user()->name }}
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/nedco/EditMyProfile?id={{ Auth::user()->id }}">Edit My
                        Profile</a>
                    <a class="dropdown-item" href="/nedco">Home</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                        class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                @if(Auth::user())
                    @if(Auth::user()->type == 'super_admin')
                        <li>
                            <div class="wrapper wrapper1 
                            @if(\Request::is('location') ||  \Request::is('addlocation') || \Request::is('addCities') || \Request::is('addDistricts')) active @endif"
                                id="wrapper_1">
                                <p class="click-text">
                                    Locations <span class="arrow"></span>
                                </p>
                                <ul>
                                    <li><a href="/nedco/location">Locations</a></li>
                                    <li><a href="/nedco/addlocation">Add Region</a></li>
                                    <li><a href="/nedco/addCities">Add Cities</a></li>
                                    <li><a href="/nedco/addDistricts">Add Districts</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="wrapper wrapper1 @if(\Request::is('admin') || \Request::is('register-admin')) active @endif"
                                id="wrapper_2">
                                <p class="click-text">
                                    Admins <span class="arrow"></span>
                                </p>
                                <ul>
                                    <li><a href="/nedco/admin">View Admins</a></li>
                                    <li><a href="/nedco/register-admin">Add Admin</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="wrapper wrapper1 @if(\Request::is('viewAllOrders') || \Request::is('addOrder')) active @endif"
                                id="wrapper_3">
                                <p class="click-text">
                                    Orders <span class="arrow"></span>
                                </p>
                                <ul>
                                    <li><a href="/nedco/viewAllOrders">All Orders</a></li>
                                    <li><a href="/nedco/addMultipleOrder">Add Multiple Orders</a></li>
                                    <li><a href="/nedco/addOrder">Add New Order</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="wrapper wrapper1 @if(\Request::is('coupon_codes') || \Request::is('add_coupon')) active @endif"
                                id="wrapper_4">
                                <p class="click-text">
                                    Coupon Codes <span class="arrow"></span>
                                </p>
                                <ul>
                                    <li><a href="/nedco/coupon_codes">Coupon Codes</a></li>
                                    <li><a href="/nedco/add_coupon">Add Coupon</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="/nedco/dispatch">Dispatch</a></li>
                        <li><a href="/nedco/Report">Orders Reports</a></li>
                        <li><a href="/nedco/FinancialAccounts">Financial Reports</a></li>
                        <li><a href="/nedco/view_requests">New Users Requests</a></li>
                        <li><a href="/nedco/viewAllUsers">All Users</a></li>
                        <li>
                            <div class="wrapper wrapper1 @if(\Request::is('defaultDeliveryPrices') || \Request::is('client') || \Request::is('clientsDeliverPrices')) active @endif"
                                id="wrapper_7">
                                <p class="click-text">
                                    Clients <span class="arrow"></span>
                                </p>
                                <ul>
                                    <li><a href="/nedco/client">View Clients</a></li>
                                    <li><a href="/nedco/clientsDeliverPrices">Clients Delivery Prices</a></li>
                                    <li><a href="/nedco/defaultDeliveryPrices">Clients Default Prices</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="wrapper wrapper1 @if(\Request::is('driver') || \Request::is('driversDeliverPrices') || \Request::is('driverDefaultDeliveryPrices')) active @endif"
                                id="wrapper_8">
                                <p class="click-text">
                                    Drivers <span class="arrow"></span>
                                </p>
                                <ul>
                                    <li><a href="/nedco/driver">View Drivers</a></li>
                                    <li><a href="/nedco/driversDeliverPrices">Drivers Delivery Prices</a></li>
                                    <li><a href="/nedco/driverDefaultDeliveryPrices">Drivers Default Prices</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="/nedco/view_pickups">View Pick Ups</a></li>
                        <li><a href="/nedco/finance">View Finance</a></li>
                        <li><a href="/nedco/dispatcher">View Dispatchers</a></li>
                        <li><a href="/nedco/monitor">View Monitors</a></li>
                    @elseif((Auth::user()->type == 'admin'))
                        <li>
                            <div class="wrapper wrapper1 @if(\Request::is('location') || \Request::is('addlocation')) active @endif"
                                id="wrapper_1">
                                <p class="click-text">
                                    Locations <span class="arrow"></span>
                                </p>
                                <ul>
                                    <li><a href="/nedco/location">Locations</a></li>
                                    <li><a href="/nedco/addlocation">Add Region</a></li>
                                    <li><a href="/nedco/addCities">Add Cities</a></li>
                                    <li><a href="/nedco/addDistricts">Add Districts</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="wrapper wrapper1 @if(\Request::is('viewAllOrders') || \Request::is('addOrder')) active @endif"
                                id="wrapper_3">
                                <p class="click-text">
                                    Orders <span class="arrow"></span>
                                </p>
                                <ul>
                                    <li><a href="/nedco/viewAllOrders">All Orders</a></li>
                                    <li><a href="/nedco/addMultipleOrder">Add Multiple Orders</a></li>
                                    <li><a href="/nedco/addOrder">Add New Order</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="wrapper wrapper1 @if(\Request::is('coupon_codes') || \Request::is('add_coupon')) active @endif"
                                id="wrapper_4">
                                <p class="click-text">
                                    Coupon Codes <span class="arrow"></span>
                                </p>
                                <ul>
                                    <li><a href="/nedco/coupon_codes">Coupon Codes</a></li>
                                    <li><a href="/nedco/add_coupon">Add Coupon</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="/nedco/dispatch">Dispatch</a></li>
                        <li><a href="/nedco/Report">Orders Reports</a></li>
                        <li><a href="/nedco/FinancialAccounts">Financial Reports</a></li>
                        <li><a href="/nedco/view_requests">New Users Requests</a></li>
                        <li><a href="/nedco/viewAllUsers">All Users</a></li>
                        <li>
                            <div class="wrapper wrapper1 @if(\Request::is('location') || \Request::is('addlocation') || \Request::is('clientsDeliverPrices')) active @endif"
                                id="wrapper_7">
                                <p class="click-text">
                                    Clients <span class="arrow"></span>
                                </p>
                                <ul>
                                    <li><a href="/nedco/client">View Clients</a></li>
                                    <li><a href="/nedco/clientsDeliverPrices">Clients Delivery Prices</a></li>
                                    <li><a href="/nedco/defaultDeliveryPrices">Clients Default Delivery Prices</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="wrapper wrapper1 @if(\Request::is('driver') || \Request::is('driversDeliverPrices') || \Request::is('driverDefaultDeliveryPrices')) active @endif"
                                id="wrapper_7">
                                <p class="click-text">
                                    Drivers <span class="arrow"></span>
                                </p>
                                <ul>
                                    <li><a href="/nedco/driver">View Drivers</a></li>
                                    <li><a href="/nedco/driversDeliverPrices">Drivers Delivery Prices</a></li>
                                    <li><a href="/nedco/driverDefaultDeliveryPrices">Drivers Default Delivery Prices</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="/nedco/dispatcher">View Dispatchers</a></li>
                        <li><a href="/nedco/view_pickups">View Pick Ups</a></li>
                        <li><a href="/nedco/finance">View Finance</a></li>
                        <li><a href="/nedco/monitor">View Monitors</a></li>
                    @elseif((Auth::user()->type == 'dispatcher'))
                        <li><a href="/nedco/DispatcherOrder">Orders</a></li>
                        <li><a href="/nedco/dispatch">Dispatch</a></li>
                        <li><a href="/nedco/ViewAllDrivers">Drivers</a></li>
                        <li><a href="/nedco/monitor-clients">Clients</a></li>
                    @elseif((Auth::user()->type == 'driver'))
                        <li><a href="/nedco/driverOrder">My Orders</a></li>
                    @elseif((Auth::user()->type == 'monitor'))
                        <li><a href="/nedco/monitor-clients">View Clients</a></li>
                        <li><a href="/nedco/monitor-drivers">View Drivers</a></li>
                        <li><a href="/nedco/monitor-orders">View Orders</a></li>
                        <li><a href="/nedco/monitor-assigned-orders">Assigned Orders</a></li>
                    @elseif((Auth::user()->type == 'finance'))
                        <li><a href="/nedco/monitor-clients">View Clients</a></li>
                        <li><a href="/nedco/monitor-drivers">View Drivers</a></li>
                        <li><a href="/nedco/monitor-orders">View Orders</a></li>
                        <li><a href="/nedco/Report">Orders Reports</a></li>
                        <li><a href="/nedco/FinancialAccounts">Financial Reports</a></li>
                    @elseif((Auth::user()->type == 'client'))
                        <li>
                            <div class="wrapper wrapper1 @if(\Request::is('viewOrder') || \Request::is('Order')) active @endif"
                                id="wrapper_6">
                                <p class="click-text">
                                    Orders <span class="arrow"></span>
                                </p>
                                <ul>
                                    <li><a href="/nedco/viewOrder">My Orders</a></li>
                                    <li><a href="/nedco/Order">Add Order</a></li>
                                </ul>
                            </div>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div class="body-footer-scroll">
            <div id="page-content-wrapper mb-3">
                <div class="container-fluid mb-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <br />
</body>
<script>
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show2");
    }

    window.onclick = function (event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show2')) {
                    openDropdown.classList.remove('show2');
                }
            }
        }
    }

    $(".drop_item").click(function () {
        var data = $(this).attr('data-id');
        $("." + data).submit();
    });

</script>

</html>
