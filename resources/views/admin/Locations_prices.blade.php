@extends('layouts.dashboardApp')
@section('title', 'Orders')

@section('content')
<style>
    .textInput {
        height: calc(1.5em + .75rem + 2px);padding: .375rem .75rem;font-size: 1rem;font-weight: 400;line-height: 1.5;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: .25rem;transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
</style>
<br>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Locations prices') }}<a style="margin-left: 30rem;" href="{{ url('home') }}" type="submit" class="btn btn-success">Finish</a></div>
            <div class="card-body">
                <div class="row mt-4">
                    <form method="POST" action="{{ route('defaultPrices') }}">
                        @csrf
                        <button class="btn btn-primary" id="defaultPrices" type="submit">
                            Default Pirces
                        </button>
                        <input type="hidden" value="{{ $user_id }}" name="user_id"/>
                    </form>
                </div>
                @foreach($locations as $location)
                    <div class="row mt-4">
                        <span>{{ $location->Region }}</span>
                    </div>
                    <div class="row" id="loc-container{{$location->id}}">
                        <div class="col-md-5">
                            <div class="row">
                                <input class="ml-2 textInput" id="location-{{ $location->id }}" placeholder="{{ $location->Region }} Delivery price.." value="{{ $location->price }}" />  
                                <button type="submit" data-id="{{ $location->id }}" class="btn btn-success ml-2 submitLocation">Submit</button>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <button class="btn btn-primary collapsebtn" type="button" data-id="{{ $location->id }}" data-toggle="collapse" data-target="#loc-{{ $location->id }}" aria-expanded="false" aria-controls="loc-{{ $location->id }}">
                               {{ $location->Region }} Cities
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <form method="POST" action="{{ route('submitCitiesPrice') }}">
                            @csrf
                            <div class="form-group collapse" id="loc-{{ $location->id }}">
                                
                            </div>
                            <input type="hidden" value="{{ $user_id }}" name="user_id"/>
                        </form>
                    </div>
                @endforeach
                <input type="hidden" value="{{ $user_id }}" name="user_id" id="user_id" />
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $(".collapsebtn").click(function(){
        var data = $(this).attr('data-id');
         let user_id = $('#user_id').val();
        $.ajax({
            url:"{{ route('getcity') }}",
            type:'GET',
            data:{_token: data, user_id},
            success:function(res){
                $("#loc-"+data).empty();
                $.each(res, function(index, value) {
                    if (value.price == 'undefined' || value.price == null || value.price == 'null') {
                        $("#loc-"+data).append('<div class="mt-2 ml-3"><div><span>'+ value.name +'</span></div><div><input class="ml-2 textInput cities" value="" name="'+ value.id +'" placeholder="'+ value.name +' Delivery price.." /><button class="btn btn-primary cityCollapsebtn ml-2" type="button" data-id="'+value.id+'" data-toggle="collapse" data-target="#city-'+value.id+'" aria-expanded="false" aria-controls="city-'+value.id+'">'+value.name+' Districts</div></div>');
                    } else {
                        $("#loc-"+data).append('<div class="mt-2 ml-3"><div><span>'+ value.name +'</span></div><div><input class="ml-2 textInput cities" value="'+ value.price +'" name="'+ value.id +'" placeholder="'+ value.name +' Delivery price.." /><button class="btn btn-primary cityCollapsebtn ml-2" type="button" data-id="'+value.id+'" data-toggle="collapse" data-target="#city-'+value.id+'" aria-expanded="false" aria-controls="city-'+value.id+'">'+value.name+' Districts</div></div>');
                    }
                    
                    $('#loc-'+data).append('<div class="collapse" id="city-'+ value.id +'"></div><hr />');
                });
                if(data.length > 0) {
                    $('#loc-'+data).append('<div class="mt-2 ml-5"><button type="submit" class="btn btn-success ml-2 submitCities" data-id='+data+'>Submit Cities Prices</button></div>');
                }  
            }
        });
    });
    
    $(document).on("click",".cityCollapsebtn",function() {
        let id = $(this).attr('data-id');
        let user_id = $('#user_id').val();
        $.ajax({
            url:"{{ route('getUserDistrict') }}",
            type:'GET',
            data:{_token: id,user_id: user_id},
            success:function(data){
                $("#city-"+id).empty();
                $.each(data, function(index, value) {
                    if (value.price == 'undefined' || value.price == null || value.price == 'null') {
                        $("#city-"+id).append('<div class="mt-2 ml-5"><div><span>'+ value.name +'</span></div><div><input class="ml-2 textInput" placeholder="'+ value.name +' Delivery price.." name="districtsPrices[]" data-id="'+ value.id +'" /></div>');
                    } else {
                        $("#city-"+id).append('<div class="mt-2 ml-5"><div><span>'+ value.name +'</span></div><div><input class="ml-2 textInput" placeholder="'+ value.name +' Delivery price.." name="districtsPrices[]" data-id="'+ value.id +'" value="'+ value.price +'" /></div>');
                    }
                });
                if(data.length > 0) {
                    $('#city-'+id).append('<div class="mt-2 ml-5"><a data-id='+id+' class="btn btn-success ml-2 submitDistricts" style="color: white;">Submit Disticts pirces</a></div>');
                }
             }                        
        });
    });
    
    $(document).on("click",".submitLocation",function() {
        let id = $(this).attr('data-id');
        let user_id = $('#user_id').val();
        let price = $('#location-'+id).val();
        if(price ==''){
            $("#alert-error-"+id).remove();
            $('#loc-container'+id).append('<div class="alert alert-danger mt-2" id="alert-error-'+id+'" role="alert">Price Cannot be Empty!</div>');
            setTimeout(() => {
                $("#alert-error-"+id).hide('slow', function(){ $("#alert-"+id).remove(); });
            }, 3000);
        }
        let _token = '{{ csrf_token() }}';
        $.ajax({
            url:"{{ route('submitLocationPrice') }}",
            type:'post',
            data:{
                _token,
                location_id: id,
                user_id,
                price
            },
            success:function(res){
                $('#loc-container'+id).append('<div class="alert alert-success mt-2" id="alert-'+id+'" role="alert">Success Price Changed!</div>');
                setTimeout(() => {
                    $("#alert-"+id).hide('slow', function(){ $("#alert-"+id).remove(); });
                }, 3000);
            }
        });
    })
    
    $(document).on("click",".submitDistricts",function() {
        let id = $(this).attr('data-id');
        let _token = "{{ csrf_token() }}"
        let user_id = $('#user_id').val();
        
        var fd = new FormData();    
        fd.append('_token', _token);
        fd.append('user_id', user_id);
        // making new form data and appending the values so its the same as if it was a form
        var prices = $('input[name^=districtsPrices]').map(function(idx, elem) {
            fd.append($(elem).attr('data-id'), $(elem).val());
        }).get();
        
        $.ajax({
            url: "{{ route('submitDistictsPrice') }}",
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data){
                $('#city-'+id).append('<div class="alert alert-success mt-2" id="districts-alert-'+id+'" role="alert">Success Price Changed!</div>');
                setTimeout(() => {
                    $("#districts-alert-"+id).hide('slow', function(){ $("#districts-alert-"+id).remove(); });
                }, 3000);
            }
        });
    })
    
});





    // <div class="form-group row" >
    //     <div class="col-md-6">
    //         <select name="location" id="location" class="form-control">
    //             <option value=''>-- Choose Location --</option>
    //             @foreach($locations as $location)-->
    //                 <option value="{{ $location->id }}">{{ $location->Region }}</option>-
    //             @endforeach
    //         </select>
    //     </div>
    //     <div class="col-md-6">
    //         <select name="city" id="city" class="form-control">
    //             <option value=''>-- Choose City --</option>
    //         </select>
    //     </div>
    // </div>
    // <form method="POST" action="{{ route('submitDistrictsPrices') }}" id="districts_id">
    //     @csrf
    //     <input type="hidden" value="{{ $user_id }}" name="user_id" id="user_id" />
    // </form>
                
    // $("#location").change(function(){
    //     var data = $(this).children("option:selected").val();
    //         $.ajax({
    //             url:"{{ route('getcity') }}",
    //             type:'GET',
    //             data:{_token: data},
    //         success:function(data){
    //             $('#city')
    //                 .find('option')
    //                 .remove();
    //             $("#city").append("<option value=''>-- Choose City --</option>");
    //             $.each(data, function(index, value) {
    //                 $("#city").append("<option value="+ value.id +" data-id=" + value.id +  ">" + value.name + "</option>");
    //             });
    //           }
    //     });
    // });

    // $("#city").change(function(){
    //     let data = $(this).children("option:selected").val();
    //     let user_id = $('#user_id').val();
    //         $.ajax({
    //             url:"{{ route('getUserDistrict') }}",
    //             type:'GET',
    //             data:{_token: data,user_id: user_id},
    //         success:function(data){
    //             console.log(data);
    //             $('.districts_form').remove();
    //             $.each(data, function(index, value) {
    //                 if (value.price == 'undefined' || value.price == null || value.price == 'null') {
    //                     $("#districts_id").append('<div class="form-group row districts_form"><label for="name" class="col-md-4 col-form-label text-md-right">'+ value.name +'</label><div class="col-md-6"><input type="text" class="form-control" value="" name="'+ value.id +'" ></div></div>');
    //                 } else {
    //                     $("#districts_id").append('<div class="form-group row districts_form"><label for="name" class="col-md-4 col-form-label text-md-right">'+ value.name +'</label><div class="col-md-6"><input type="text" class="form-control" value="'+ value.price +'" name="'+ value.id +'" ></div></div>');
    //                 }
                
    //             });
    //             $("#districts_id").append('<div class="form-group row mb-0 districts_form"><div class="col-md-6 offset-md-4"><button type="submit" class="btn btn-success">Submit</button></div></div>   ');
    //           }                        
    //     });
    // });
    
</script>
@endsection
