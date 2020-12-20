@extends('layouts.app')

@section('content')

<body>
  <!-- home starts here  -->
   <section id='home'>
       <div class="container-fluid p-2">
            <div class="home">
                <div class="home-form">
                    <form method="get" action="trackresult?id="+document.getElementById("shipment-number").value"">
                        <input class="round-input" type="text" name="shipment-number" id="shipment-number" required placeholder="Type your Order number">
                        <button class="btn color round-input"> track</button>
                    </form>
                </div>
            </div>
        </div>
   </section>
   <!-- home ends here  -->

   <section >
    <div class="container-fluid pt-3">
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header color">Get a quick shipping rate</div>
                <div class="card-body">
                    <br>
                    <div class="row container">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-12 pb-3">
                                        <select required name="location" id="location" class="form-control round-input">
                                            <option value=''>-- Choose Region --</option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}">{{ $location->Region }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                    <div class="col-md-6 col-sm-12">
                                        <select required name="city" id="city" class="form-control round-input">
                                                <option value="">-- Choose City --<option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <select required name="district" id="district" class="form-control round-input">
                                                   <option value=''>-- Choose District --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input type="text" disabled name="deliveryprice" id="deliveryprice" placeholder="Calculator Result" class="hi form-control round-input"/>
                                    </div>
                                </div>
                            </div>
                       </div>
                </div>
            </div>
          </div>

          <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header color">Manage Shipments</div>
                <div class="card-body">
                   <div class="row">
                        <div class="col-12">
                             <div class="shipping-card card-one">
                                <a href="{{ route('home') }}" class="mr-2">
                                    <img class="mr-2" src="images/truck.png" alt="truck">
                                    <span>Prepare Shipment</span>
                                </a>
                             </div>
                        </div>
                        <div class="col-12">
                             <div class=" shipping-card ">
                                <a href="{{ route('home') }}" class="mr-4">
                                    <img class="mr-4" src="images/time.png" alt="truck">
                                    <span>Recent Shipment</span>
                                </a>
                             </div>
                        </div>
                   </div>
                    @if (Auth::user())
                        <a href="{{ route('home') }}" class="btn color float-right round-input">My Account</a>
                    @else
                        <a href="{{ route('register') }}" class="btn color float-right round-input">Sign up</a>
                    @endif
                </div>
            </div>
          </div>
        </div>
      </div>
   </section>
</body>
<script>
    $("#location").change(function(){
        var data = $(this).children("option:selected").val();
            $.ajax({
                url:"{{ route('getcity') }}",
                type:'GET',
                data:{_token: data},
            success:function(data){
                $('#city')
                    .find('option')
                    .remove();
                $("#city").append("<option value=''>-- Choose City --</option>");
                $.each(data, function(index, value) {
                    $("#city").append("<option value="+ value.name +" data-id=" + value.id +  ">" + value.name + "</option>");
                });
               }
        });
    });

    $("#city").change(function(){
        var data = $(this).children("option:selected").attr('data-id');
            $.ajax({
                url:"{{ route('getdistricts') }}",
                type:'GET',
                data:{_token: data},
            success:function(data){
                $('#district')
                    .find('option')
                    .remove();
                $("#district").append("<option value=''>-- Choose District --</option>");
                $.each(data, function(index, value) {
                    $("#district").append("<option value="+ value.id +" data-id=" + value.id +  ">" + value.name + "</option>");
                });
               }
        });
    });
    
    $('#district').on('change', function(event){
        event.preventDefault();
        let _token = '{{ csrf_token() }}';
        let district = $(this).children("option:selected").attr('data-id');
        $.ajax({
            url: "{{ route('getDeliveryPrice2') }}",
            type:"POST",
            data:{
                district: district, 
                _token: _token
            },
            success:function(response){
                console.log(response.price);
                $("#deliveryprice").val(response.price + " JD");
            },
       });
    });

</script>
@endsection