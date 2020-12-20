<!--<!doctype html>-->
<!--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">-->
<!--    <head>-->
<!--        <meta charset="UTF-8">-->
<!--        <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
<!--        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->
<!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
<!--        <link rel="stylesheet" href="{{ asset('css/stylee.css') }}">-->
<!--        <script src="https://code.jquery.com/jquery-2.2.4.min.js" type="text/javascript"></script>-->
<!--    </head>-->
<!--    <body>-->
<!--      <div class="container">-->
<!--        <div class=" justify-content-center">-->
<!--            <div class="row">-->
<!--              <div class="col-md-10"></div>-->
<!--                <img src="{{ asset('images/logo.png') }}" alt="nedco logo" style="width: 12rem;">-->
<!--            </div>-->
<!--            <br>-->
<!--            <div class="row">-->
<!--                <div class="col-md-8">-->
<!--                    <p type="text" name="name" id="name" placeholder="Name" class="form-control round-input" >{{ $name }}</p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <br>-->
<!--            <div class="row">-->
<!--              <div class="col-md-8">-->
<!--                <p type="text" name="Email" id="Email" placeholder="Email" class="form-control round-input" >{{ $email }}</p>-->
<!--              </div>-->
<!--            </div>-->
<!--            <br>-->
<!--            <div class="row">-->
<!--                <div class="col-md-8">-->
<!--                    <p type="text" name="phone" id="phone" placeholder="phone" class="form-control round-input" ><a>{{ $phone }}</a></p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <br>-->
<!--            <div class="row">-->
<!--                <div class="col-md-8">-->
<!--                    <p type="text" name="Message" id="Message" placeholder="Message" class="form-control round-input" style="height: 10rem;">{{ $emailContent }}</p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </body>-->
<!--</html>-->
<div style="display: flex;width: 100%;">  
    <span style="margin: 1%;">    
        <img src="{{ asset('images/logo.png') }}" alt="nedco logo" style="width: 12rem;">         
    </span>   
</div>

 <div style="text-align: -webkit-center;margin-top: 2%;">
     
    <div style="display: inline-grid;width: 70%;">
        <input class="form-control form-input" type="text" value="Name: {{ $name }}" style="border: 1px solid #ced4da; height: 40px; border-radius: 5%; width: 100%; text-align: center; margin: 2%;" disabled>
        <input class="form-control form-input" type="text" value="Email: {{ $email }}" style="border: 1px solid #ced4da; height: 40px; border-radius: 5%; width: 100%; text-align: center; margin: 2%;" disabled>
        <input class="form-control form-input" type="text" value="Phone: {{ $phone }}" style="border: 1px solid #ced4da; height: 40px; border-radius: 5%; width: 100%; text-align: center; margin: 2%;" disabled>
        <textarea name="info" class="form-control form-input"  style="border: 1px solid #ced4da; border-radius: 5%; width: 100%; text-align: center; margin: 2%;" col="30" rows="10" placeholder="information" disabled>{{ $emailContent }}</textarea>
    </div>
    <br><br>
</div>
