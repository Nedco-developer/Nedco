@extends('layouts.app')

@section('content')
<div class="container-fliud">
    <div class="row">
        <div class="index col-md-3">
            <div class="side-container3 color">
                <div>
                    <div class="row">
                        <img src="images/Group 30.png" class="img" alt="Rate Calculator">
                    </div>
                    <br>
                    <div class="row text">
                        <p>Rate Calculator</p>
                    </div>
                </div>
             </div>
         </div>
         <div class="col-md-6 mx-auto">
             <div class="track-form" style="margin-bottom: 1rem;">
                 <div class="card">
                    <div class="card-body"/>
                         <br>
                         <h5 class="ml-4">Rate Calculator</h5>
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
        </div>
    </div>
</div>
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