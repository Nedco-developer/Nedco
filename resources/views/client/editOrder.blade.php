@extends('layouts.dashboardApp')

@section('title', 'Edit Order Form')

@section('content')

<br>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Edit Order Form') }}</div>
      
                <div class="card-body">
                    <form method="POST" action="{{ route('updateOrder') }}">
                        @csrf
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif
                        <input type="hidden" name="id" value="{{ $order->id }}">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Recipient number') }}</label>

                            <div class="col-md-6">
                            <input id="Recipientnumber" type="text" class="form-control" name="Recipientnumber" value="{{ $order->RecipientNumber }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Recipient name') }}</label>

                            <div class="col-md-6">
                                <input id="Recipientname" type="text" class="form-control" name="Recipientname" value="{{ $order->RecipientName }}" required autofocus>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Recipient Region') }}</label>
                            <div class="col-md-6">
                                <select name="location" id="location" class="form-control" disabled>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" @if($location->id == $order->locations) selected @endif>{{ $location->Region }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <input type="hidden" value="{{$order->city}}" id="cityName" />
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Recipient City') }}</label>
                            <div class="col-md-6">
                                <select name="city" id="city" class="form-control" disabled>
                                    @foreach($cities as $city)
                                        <option @if($city->name == $order->city) selected @endif value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <input type="hidden" value="{{$order->districts}}" id="districtId" />
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Recipient District') }}</label>
                            <div class="col-md-6">
                                <select name="district" id="district" class="form-control" disabled>
                                    @foreach($districts as $district)
                                        <option @if($district->id == $order->districts) selected @endif>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Recipient Address') }}</label>

                            <div class="col-md-6">
                                <textarea id="Recipientaddress" type="text" class="form-control" name="Recipientaddress" required autofocus>{{ $order->RecipientAddress }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Item Price') }}</label>

                            <div class="col-md-6">
                                <input id="itemprice" type="text" class="form-control price" name="itemprice" value="{{ $order->itemPrice }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Delivery Price') }}</label>

                            <div class="col-md-6">
                                <input id="deliveryprice" type="text" disabled class="form-control price" value="{{ $order->deliveryPrice }}" autofocus>
                                <input id="deliveryprice2" type="hidden" class="form-control" name="deliveryprice" value="{{ $order->deliveryPrice }}" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Total Price') }}</label>

                            <div class="col-md-6">
                                <input id="totalprice" disabled type="text" class="form-control" value="{{ $order->totalPrice }}" required>
                                <input id="totalprice2"  type="hidden" class="form-control" name="totalprice" value="{{ $order->totalPrice }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Notes') }}</label>

                            <div class="col-md-6">
                                <textarea id="notes" type="text" class="form-control" name="notes" autofocus>{{ $order->notes }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                            <div class="col-md-6">
                                <select name="status" class="form-control" id="status" disabled>
                                    <option  @if($order->status == 'Assigned')         selected @endif value="Assigned">Assigned</option>
                                    <option  @if($order->status == 'Ready')            selected @endif value="Ready">Ready</option>
                                    <option  @if($order->status == 'Delivered')        selected @endif value="Delivered">Delivered</option>
                                    <option  @if($order->status == 'Out For Delivery') selected @endif value="Out For Delivery">Out For Delivery</option>
                                    <option  @if($order->status == 'Pending')          selected @endif value="Pending">Received</option>
                                    <option  @if($order->status == 'Cancelled')        selected @endif value="Cancelled">Cancelled</option>
                                    <option  @if($order->status == 'No Answer')        selected @endif value="No Answer">No Answer</option>
                                    <option  @if($order->status == 'Turned Off')       selected @endif value="Turned Off">Turned Off</option>
                                    <option  @if($order->status == 'Disconnected')     selected @endif value="Disconnected">Disconnected</option>
                                    <option  @if($order->status == 'Out Of Reach')     selected @endif value="Out Of Reach">Out Of Reach</option>
                                    <option  @if($order->status == 'Rejected')         selected @endif value="Rejected">Rejected</option>
                                    <option  @if($order->status == 'Rejected With Charges') selected @endif value="Rejected With Charges">Rejected With Charges</option>
                                </select>
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
            let cityName = $('#cityName').val();
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
                    if (cityName == value.name) {
                        $("#city").append("<option value="+ value.name +" data-id=" + value.id +  " selected>" + value.name + "</option>");
                    } else {
                        $("#city").append("<option value="+ value.name +" data-id=" + value.id +  ">" + value.name + "</option>");
                    }
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
                    $("#district").append("<option value="+ value.name +" data-id=" + value.id +  ">" + value.name + "</option>");
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
