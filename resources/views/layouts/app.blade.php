<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/stylee.min.css') }}">
    
    <title>Nedco</title>
    <link rel="icon" href="{!! asset('images/cropped-nedco_icon-32x32.jpg') !!}"/>
</head>

<body style="overflow-x: hidden;">
    <div id="app" class="app">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <a class="navbar-brand logo ml-5" href="{{ asset('../nedco/') }}" >
                <img src="{{ asset('images/logo.png') }}" alt="nedco logo" style="width: 12rem;">
            </a>
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
  
    <div class="collapse navbar-collapse navbar-links" id="navbarTogglerDemo03">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            @if(explode('=', $_SERVER['REQUEST_URI'])[0] == "/nedco/")
                <li class="nav-item active" id="Home">
                  <a class="nav-link" style="color:#ffffff"  id="Home2" href="{{ asset('../nedco/') }}">Home</a>
                </li>
                <li class="nav-item" id="Track" >
                  <a class="nav-link" id="Track2" href="{{ asset('track') }}">Track</a>
                </li>
                <li class="nav-item " id="ship" >
                  <a class="nav-link" id="ship2" href="{{ asset('CheckShappingRate') }}">Ship</a>
                </li>
                <li class="nav-item " id="Services">
                    <a class="nav-link"  id="Services2" href="{{ asset('Services') }}">Services</a>
                </li>
                <li class="nav-item " id="Clients">
                    <a class="nav-link" id="Clients2" href="{{ asset('Clients') }}">Clients</a>
                 </li>
                <li class="nav-item " id="Contact">
                    <a class="nav-link"  id="Contact2"  href="{{ asset('Contact') }}">Contact Us</a>
                 </li>
            @elseif(explode('=', $_SERVER['REQUEST_URI'])[0] == "/nedco/track")
                <li class="nav-item " id="Home">
                  <a class="nav-link"  id="Home2" href="{{ asset('../nedco/') }}">Home</a>
                </li>
                <li class="nav-item active" id="Track" >
                  <a class="nav-link" style="color:#ffffff"  id="Track2" href="{{ asset('track') }}">Track</a>
                </li>
                <li class="nav-item " id="ship" >
                  <a class="nav-link" id="ship2" href="{{ asset('CheckShappingRate') }}">Ship</a>
                </li>
                <li class="nav-item " id="Services">
                    <a class="nav-link"  id="Services2" href="{{ asset('Services') }}">Services</a>
                </li>
                <li class="nav-item " id="Clients">
                    <a class="nav-link"   id="Clients2" href="{{ asset('Clients') }}">Clients</a>
                 </li>
                <li class="nav-item " id="Contact">
                    <a class="nav-link"  id="Contact2"  href="{{ asset('Contact') }}">Contact Us</a>
                 </li>
            @elseif(explode('=', $_SERVER['REQUEST_URI'])[0] == "/nedco/CheckShappingRate")
                <li class="nav-item " id="Home">
                  <a class="nav-link"  id="Home2" href="{{ asset('../nedco/') }}">Home</a>
                </li>
                <li class="nav-item " id="Track" >
                  <a class="nav-link" id="Track2" href="{{ asset('track') }}">Track</a>
                </li>
                <li class="nav-item active" id="ship" >
                  <a class="nav-link" id="ship2" style="color:#ffffff" href="{{ asset('CheckShappingRate') }}">Ship</a>
                </li>
                <li class="nav-item " id="Services">
                    <a class="nav-link"  id="Services2" href="{{ asset('Services') }}">Services</a>
                </li>
                <li class="nav-item " id="Clients">
                    <a class="nav-link" id="Clients2" href="{{ asset('Clients') }}">Clients</a>
                 </li>
                <li class="nav-item " id="Contact">
                    <a class="nav-link"  id="Contact2"  href="{{ asset('Contact') }}">Contact Us</a>
                 </li>
            @elseif(explode('=', $_SERVER['REQUEST_URI'])[0] == "/nedco/Services")
                <li class="nav-item " id="Home">
                  <a class="nav-link"  id="Home2" href="{{ asset('../nedco/') }}">Home</a>
                </li>
                <li class="nav-item " id="Track" >
                  <a class="nav-link" id="Track2" href="{{ asset('track') }}">Track</a>
                </li>
                <li class="nav-item " id="ship" >
                  <a class="nav-link" id="ship2" href="{{ asset('CheckShappingRate') }}">Ship</a>
                </li>
                <li class="nav-item active" id="Services">
                    <a class="nav-link"  style="color:#ffffff" id="Services2" href="{{ asset('Services') }}">Services</a>
                </li>
                <li class="nav-item " id="Clients">
                    <a class="nav-link"  id="Clients2" href="{{ asset('Clients') }}">Clients</a>
                 </li>
                <li class="nav-item " id="Contact">
                    <a class="nav-link"  id="Contact2"  href="{{ asset('Contact') }}">Contact Us</a>
                 </li>
            @elseif(explode('=', $_SERVER['REQUEST_URI'])[0] == "/nedco/Clients")
                <li class="nav-item " id="Home">
                  <a class="nav-link"  id="Home2" href="{{ asset('../nedco/') }}">Home</a>
                </li>
                <li class="nav-item " id="Track" >
                  <a class="nav-link" id="Track2" href="{{ asset('track') }}">Track</a>
                </li>
                <li class="nav-item " id="ship" >
                  <a class="nav-link" id="ship2" href="{{ asset('CheckShappingRate') }}">Ship</a>
                </li>
                <li class="nav-item " id="Services">
                    <a class="nav-link"  id="Services2" href="{{ asset('Services') }}">Services</a>
                </li>
                <li class="nav-item active" id="Clients">
                    <a class="nav-link " style="color:#ffffff" id="Clients2" href="{{ asset('Clients') }}">Clients</a>
                 </li>
                <li class="nav-item " id="Contact">
                    <a class="nav-link"  id="Contact2"  href="{{ asset('Contact') }}">Contact Us</a>
                 </li>
            @elseif(explode('=', $_SERVER['REQUEST_URI'])[0] == "/nedco/Contact")
                <li class="nav-item " id="Home">
                  <a class="nav-link"  id="Home2" href="{{ asset('../nedco/') }}">Home</a>
                </li>
                <li class="nav-item " id="Track" >
                  <a class="nav-link" id="Track2" href="{{ asset('track') }}">Track</a>
                </li>
                <li class="nav-item " id="ship" >
                  <a class="nav-link" id="ship2" href="{{ asset('CheckShappingRate') }}">Ship</a>
                </li>
                <li class="nav-item " id="Services">
                    <a class="nav-link"  id="Services2" href="{{ asset('Services') }}">Services</a>
                </li>
                <li class="nav-item " id="Clients">
                    <a class="nav-link" id="Clients2" href="{{ asset('Clients') }}">Clients</a>
                 </li>
                <li class="nav-item active" id="Contact">
                    <a class="nav-link"  style="color:#ffffff" id="Contact2"  href="{{ asset('Contact') }}">Contact Us</a>
                 </li>
            @else
                <li class="nav-item " id="Home">
                  <a class="nav-link"  id="Home2" href="{{ asset('../nedco/') }}">Home</a>
                </li>
                <li class="nav-item " id="Track" >
                  <a class="nav-link" id="Track2" href="{{ asset('track') }}">Track</a>
                </li>
                <li class="nav-item " id="ship" >
                  <a class="nav-link" id="ship2" href="{{ asset('CheckShappingRate') }}">Ship</a>
                </li>
                <li class="nav-item " id="Services">
                    <a class="nav-link"  id="Services2" href="{{ asset('Services') }}">Services</a>
                </li>
                <li class="nav-item " id="Clients">
                    <a class="nav-link" id="Clients2" href="{{ asset('Clients') }}">Clients</a>
                 </li>
                <li class="nav-item" id="Contact">
                    <a class="nav-link"  id="Contact2"  href="{{ asset('Contact') }}">Contact Us</a>
                 </li>
            @endif
          </ul>
      <form class="form-inline my-2 mx-2  my-lg-0">
            @if (Auth::user())
                <a href="{{ route('home') }}" class="btn color my-2 my-sm-0 round-input mr-2 px-5"  type="submit">My Account</a>
            @else
                <a href="{{ route('login') }}" class="btn color my-2 my-sm-0 round-input px-5"  type="submit">Login</a>
            @endif
            
      </form>
    </div>
</div>
</nav>
    </div>
</nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <section id='home2'>
        <div style="padding-top: 13rem;">
            <div class="row" style="padding: 5rem 5rem 1rem 5rem;">
                <div class="col-md-4 col-sm-12">
                    <img src="{{ asset('images/logo-background.png') }}" />
                </div>
                <div class="col-md-4 col-sm-12 borderLeft">
                    <div class="ml-2">
                        <a class="footer-nav" href="{{ asset('../nedco/') }}">Home</a>
                    </div>
                    <div class="ml-2">
                       <a class="footer-nav" href="{{ asset('track') }}">Track</a>
                    </div>
                    <div class="ml-2">
                       <a class="footer-nav" href="{{ asset('CheckShappingRate') }}">Ship</a>
                    </div>
                    <div class="ml-2">
                       <a class="footer-nav" href="{{ asset('Services') }}">Services</a>
                    </div>
                    <div class="ml-2">
                       <a class="footer-nav" href="{{ asset('Clients') }}">Clients</a>
                    </div>
                    <div class="ml-2">
                        <a class="footer-nav" href="{{ asset('Contact') }}">Contact Us</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <a href="https://www.linkedin.com/company/nedcojo" target="_blank"><img src="{{ asset('images/in-background.png') }}" class="m-2" alt="linkedin"></a>
                    <a href="https://www.facebook.com/%D8%A7%D9%84%D9%88%D8%B7%D9%86%D9%8A%D8%A9-%D9%84%D9%84%D8%AA%D9%88%D8%B5%D9%8A%D9%84-%D8%A7%D9%84%D8%B3%D8%B1%D9%8A%D8%B9-NEDCO-102658368040135/" target="_blank"><img src="{{ asset('images/f-background.png') }}" class="m-2" alt="facebook"></a>
                    <a href="tel:+962 78 9 75 85 85" class="btn btn-danger" style="border-radius: 50px;">Call Now</a>
                </div>
            </div>
            <hr class="bottomHr" />
        </div>
        <div class="ominus">
            <div class="col-xl-12 text-light">
                <p>Designed &amp; Developed by: <a href="https://ominus.marketing/" target="_blank"><img src="/nedco/images/o-minus.png" class="ominus-image"></a></p>
            </div>
        </div>
    </section>
</body>
</html>
