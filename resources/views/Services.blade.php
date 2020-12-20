@extends('layouts.app')

@section('content')
<style>
    .text{
        position: relative;
        bottom: 0;
        font-size:1rem;
    }
    .pText{
        width: 100%;
        text-align: center;
        color: #797979;
        font-weight: 600;
    }
    .img{
        height: 7rem;
        display:block;
        margin:auto;
    }
    .imgCenter{
        height: 4rem;
        margin-top: 3rem;
    }
    h4{
        color: #797979;
        font-weight: 600;
    }
</style>
<body>
   <section id="shipping">
        <div class="row container-fluid">
            <h4>OUR SERVICES</h4>
            </div>
        <div class="row container-fluid">
            <div class="col-md-1"></div>
            <div class="col-md-2 col-sm-12">
                <div>
                    <div class="row">
                        <img src="images/SAME DAY DELIVERY.png" class="img" alt="SAME DAY DELIVERY">
                    </div>
                    <br>
                    <div class="row text">
                        <p class="pText">SAME DAY DELIVERY</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <div>
                    <div class="row text">
                        <img src="images/NEXT DAY DELIVERY.png" class="img imgCenter" alt="NEXT-DAY DELIVERY">
                    </div>
                    <br>
                    <div class="row text">
                        <p class="pText">NEXT-DAY DELIVERY</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="row">
                    <img src="images/BULK DISTRIBUTION.png" class="img" alt="BULK DISTRIBUTION">
                </div>
                <br>
                <div class="row text">
                    <p class="pText">BULK DISTRIBUTION</p>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                 <div class="row">
                    <img src="images/Group 47.png" class="img" alt="Group 47">
                </div>
                <br>
                <div class="row text">
                    <p class="pText">COLLECTION</p>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                 <div class="row">
                    <img src="images/Group 52.png" class="img" alt="Group 52">
                </div>
                <br>
                <div class="row text">
                    <p class="pText">ADDITIONAL SERVICES</p>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <br>
        <div class="row container-fluid">
            <div class="col-md-1"></div>
            <div class="col-md-2 col-sm-12">
                <div>
                    <div class="row">
                        <img src="images/Group 59.png" class="img" alt="CASH ON DELIVERY">
                    </div>
                    <br>
                    <div class="row text">
                        <p class="pText">CASH ON DELIVERY</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <div>
                    <div class="row text">
                        <img src="images/Group 61.png" class="img" alt="CALL CENTER ASSISTANCE">
                    </div>
                    <br>
                    <div class="row text">
                        <p class="pText">CALL CENTER ASSISTANCE</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                 <div class="row">
                    <img src="images/Group 63.png" class="img imgCenter" alt="RSVP">
                </div>
                <br>
                <div class="row text">
                    <p class="pText">RSVP</p>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                 <div class="row">
                    <img src="images/Group 65.png" class="img imgCenter" alt="SIGN BACK">
                </div>
                <br>
                <div class="row text">
                    <p class="pText">SIGN BACK</p>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
            </div>
            <div class="col-md-1"></div>
        </div>
   </section>
</body>

@endsection