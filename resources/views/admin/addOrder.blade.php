@extends('layouts.dashboardApp')

@section('title', 'New Order Form')

@section('content')

<br>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('New Order Form') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('submitAddOrder') }}">
                        @csrf
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif
                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Client') }}</label>
                            <div class="col-md-6">
                                <select required name="client_id" id="client_id" class="form-control">
                                    @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->user->name }}</option>z
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Recipient number') }}</label>

                            <div class="col-md-6">
                                <input id="Recipientnumber" type="text" class="form-control" name="Recipientnumber" value="{{ old('Recipientnumber') }}" required autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Recipient name') }}</label>

                            <div class="col-md-6">
                                <input id="Recipientname" type="text" class="form-control" name="Recipientname" value="{{ old('Recipientname') }}" required autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Recipient Region') }}</label>
                            <div class="col-md-6">
                                <select required name="location" id="location" class="form-control">
                                    <option value=''>-- Choose Region --</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->Region }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Recipient City') }}</label>
                            <div class="col-md-6">
                                <select required name="city" id="city" class="form-control">
                                        <option value="">-- Choose City --<option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Recipient District') }}</label>
                            <div class="col-md-6">
                                <select required name="district" id="district" class="form-control">
                                           <option value=''>-- Choose District --</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Recipient Address') }}</label>

                            <div class="col-md-6">
                                <textarea id="Recipientaddress" type="text" class="form-control" name="Recipientaddress" required autofocus>{{ old('Recipientaddress') }}</textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Item Price') }}</label>

                            <div class="col-md-6">
                                <input id="itemprice" type="text" class="form-control price" name="itemprice" value="" required autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Delivery Price') }}</label>

                            <div class="col-md-6">
                                <input id="deliveryprice" type="text" required disabled class="form-control price" value="" autofocus>
                                <input id="deliveryprice2" type="hidden" required class="form-control" name="deliveryprice" value="" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Total Price') }}</label>

                            <div class="col-md-6">
                                <input id="totalprice" disabled type="text" class="form-control" value="" required>
                                <input id="totalprice2"  type="hidden" class="form-control" name="totalprice" value="" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Notes') }}</label>

                            <div class="col-md-6">
                                <textarea id="notes" type="text" class="form-control" name="notes" autofocus>{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Coupon Code') }}</label>
                            <div class="col-md-6">
                                <input id="coupon_code" type="text" class="form-control" name="coupon_code" value="{{ old('coupon_code') }}" autofocus />
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
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
                    $("#city").append("<option value="+ value.id +" data-id=" + value.id +  ">" + value.name + "</option>");
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
    
    $('.price').keyup(function () {
        var sum = 0;
        $('.price').each(function() {
            sum += Number($(this).val());
        });
        $('#totalprice').attr('value', sum);
        $('#totalprice2').attr('value', sum);
    });
    
    $('#district').on('change', function(event){
        event.preventDefault();
        let _token = '{{ csrf_token() }}';
        let client = $("#client_id option:selected").val();
        let district = $(this).children("option:selected").attr('data-id');
        $.ajax({
            url: "{{ route('getDeliveryPrice') }}",
            type:"POST",
            data:{
                district: district, 
                client: client,
                _token: _token
            },
            success:function(response){
                console.log(response.price);
                $("#deliveryprice").val(response.price);
                $("#deliveryprice2").val(response.price);
            },
       });
    });

    </script>
@endsection
