@extends('layouts.app')

@section('content')
<style>
@media only screen and (max-width: 600px) {
    #shipping{
        padding: 0 !important;
        
    }
    .container-fluid {
        width: 100%;
        padding-right: 0 !important;
        padding-left: 0 !important;
    }
    .col-sm-1{
        width: 20% !important;
    }
}

@media only screen and (max-width: 1024px) {

    
}
    .locationText{
        text-align: center;
        color: black;
        font-size: 20px;
        width: auto !important;
    }
    .img{
        height: 7rem;
        display:block;
        margin:auto;
    }
    .icon{
        height: 2rem;
    }
    h4{
        color: #797979;
        font-weight: 600;
    }
    .hi{
        min-height: 10rem;
    }
</style>
<body>
    <section id="shipping">
        <div class="row container-fluid">
            <h4>Contact Us</h4>
        </div>
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <img src="{{ asset('images/location.png') }}" class="icon float-right mr-1" alt="location">
                        <a href="https://g.page/NEDCOJO?share" target="_blank">
                            <p class="locationText">Amman - Jordan , Wasfi Al Tal.st</p>
                            <p class="locationText">P.O.Box 5058 Amman 11953 Jordan</p>
                        </a>
                    </div>
                    <br>
                    <div class="row">
                        <img src="{{ asset('images/mail.png') }}" class="icon float-right mr-1" alt="mail">
                        <a href="mailto:contact@nedcogo.com" target="_blank">contact@nedcogo.com</a>
                    </div>
                    <br>
                    <div class="row">
                        <img src="{{ asset('images/phone.png') }}" class="icon float-right mr-3" alt="phone">
                        <a href="tel:+962 78 9 75 85 85">+962 78 9 75 85 85</a>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-1">
                            <a href="https://www.linkedin.com/company/nedcojo" target="_blank"><img src="{{ asset('images/in.png') }}" class="icon float-right mb-3" alt="linkedin"></a>
                        </div>
                        <div class="col-sm-1">
                            <a target="_blank" href="https://www.facebook.com/%D8%A7%D9%84%D9%88%D8%B7%D9%86%D9%8A%D8%A9-%D9%84%D9%84%D8%AA%D9%88%D8%B5%D9%8A%D9%84-%D8%A7%D9%84%D8%B3%D8%B1%D9%8A%D8%B9-NEDCO-102658368040135/"><img src="{{ asset('images/f.png') }}" class="icon float-right mb-3" alt="facebook"></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                        <form method="post" action="{{ route('contact_us') }}">
                            @csrf
                        @if (\Session::has('success'))
                            <div class="alert alert-success round-input">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif
                        <div class="row p-0">
                            <div class="col-12 p-0">
                                <div class="form-group row p-0">
                                    <div class="col-md-6 p-1 pb-3">
                                        <input type="text" name="name" id="name" placeholder="Name" required  class="form-control round-input" />
                                    </div> 
                                    <div class="col-md-6 p-1">
                                        <input type="text" name="email" id="email" placeholder="Email" required  class="form-control round-input" />
                                    </div>
                                </div>
                                <div class="form-group row p-0">
                                    <div class="col-md-6 p-1 pb-3">
                                        <input type="text" name="subject" id="subject" placeholder="Subject" required  class="form-control round-input" />
                                    </div>
                                    <div class="col-md-6 p-1">
                                        <input type="text" name="phone" id="phone" placeholder="phone number" required  class="form-control round-input" />
                                    </div>
                                </div>
                                <div class="form-group row p-0">
                                    <div class="col-md-12 p-1">
                                        <textarea type="text" name="message" id="message" placeholder="Your Message" required  class="hi form-control round-input"></textarea>
                                    </div>
                                </div>
                            </div>
                       </div>
                        <button type="submit" class="btn color float-right round-input">Send</button>
                    </form>
                </div>
                
      </div>
   </section>

</body>

@endsection