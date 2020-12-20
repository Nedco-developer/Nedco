@extends('layouts.dashboardApp')

@section('title', 'Dispatch')

@section('content')
<style>
.entity-menu>.nav-item>a.active {
    background-color: #000;
    border-bottom: 0px solid black !important;
}

@media only screen and (min-width: 320px) and (max-width: 568px) {
    .nav-link {
        margin-left: 1rem !important;
    }

    .side-container {
        height: 100% !important;
    }

    .side-container3 {
        height: 100% !important;
    }

    .nav-item {
        height: 5rem !important;
        margin-left: 0rem !important;
    }

    .table-res {
        display: block !important;
        overflow-x: auto !important;
    }
}

@media only screen and (max-width: 768px) and (max-width: 1024px) {
    .side-container {
        height: 100% !important;
    }

    .side-container3 {
        height: 100% !important;
    }

    .row {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: 0px !important;
        margin-left: 0px !important;
    }

    .text {
        font-size: 1rem !important;
    }

    .home-form {
        width: 100% !important;
    }

    .nav-item {
        height: 5rem !important;
        margin-left: 1rem !important;
    }

    .table-res {
        display: block !important;
        overflow-x: auto !important;
    }
}

@media only screen and (max-width: 600px) {
    .nav-link {
        margin-left: 1rem !important;
    }

    .side-container {
        height: 100% !important;
    }

    .side-container3 {
        height: 100% !important;
    }

    .row {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: 0px !important;
        margin-left: 0px !important;
    }

    .text {
        font-size: 1rem !important;
    }

    .home-form {
        width: 100% !important;
    }

    .nav-item {
        height: 5rem !important;
        margin-left: 1rem !important;
    }

    .table-res {
        display: block !important;
        overflow-x: auto !important;
    }
}

@media only screen and (min-width: 601px) and (max-width: 768px) {
    .nav-link {
        margin-left: 1rem !important;
    }

    .side-container {
        height: 100% !important;
    }

    .side-container3 {
        height: 100% !important;
    }

    .nav-item {
        height: 5rem !important;
        margin-left: 0rem !important;
    }

    .table-res {
        display: block !important;
        overflow-x: auto !important;
    }
}

@media only screen and (max-width: 1024px) {
    .nav-link {
        margin-left: 1rem !important;
    }

    .text {
        font-size: 0rem !important;
    }

    .home {
        padding: 94px 0px !important;
    }

    .nav-item {
        height: 5rem !important;
        margin-left: 0rem !important;
    }

    .table-res {
        display: block !important;
        overflow-x: auto !important;
    }
}
</style>

<div style="margin-top: 10px;" class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __('All Orders') }}</div>
        <div class="card-body">
            <div class="alert alert-danger mt-3" id="order_not_found" style="display: none;">
                No Order was found with the given barcode
            </div>
            <div class="row mb-2">
                <div class="col-md-2 mt-3 mb-3">
                    <select style="width: 10rem;" name="users" id="users" class="form-control">
                        @foreach ($users as $i => $user)
                          <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="col-md-2 mt-3 mb-3">
                        <select style="width: 10rem;" name="status" id="status" class="form-control">
                            <option value="Assign">Assign</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Out For Delivery">Out For Delivery</option>
                            <option value="Pending">Received</option>
                            <option value="Cancelled">Cancelled</option>
                            
                            <option value="No Answer">No Answer</option>
                            <option value="Turned Off">Turned Off</option>
                            <option value="Disconnected">Disconnected</option>
                            <option value="Out Of Reach">Out Of Reach</option>
                            <option value="Rejected">Rejected</option>
                            <option value="Rejected With Charges">Rejected With Charges</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 ml-2 mt-3 mb-3">
                    <input type="date" name="delivery_date" min="{{date('Y-m-d')}}" id="delivery_date" class="form-control">
                </div>
                <div class="col-md-2 ml-2 mt-3 mb-3">
                    <input id="barcodeNumber" onmouseover="this.focus();" type="text" placeholder="Barcode Number" class="form-control" autofouces />
                </div>
                <div class="col-md-2 ml-2 mt-3 mb-3">
                    <a class="btn btn-danger" style="margin-bottom: 1rem;" href="#" id="reset_fields">Reset Fields</a>
                </div>
            </div>
        
            <table id="Admintable1" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Recipient Name</th>
                        <th>Recipient Number</th>
                        <th>City</th>
                        <th>Recipient Address</th>
                        <th>Item Price</th>
                        <th>Delivery Price</th>
                        <th>Total Price</th>
                        <th>Notes</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        
        $('#reset_fields').click(function (e) { 
            e.preventDefault();
            $('#barcodeNumber').val('');
            $('#delivery_date').val('');
            $('#users').prop('selectedIndex',0);
            $('#status').prop('selectedIndex',0);
            $("#order_not_found").css("display", "none");
        });
        
        $('#delivery_date').on('input',function(e){
            $('#barcodeNumber').focus();
        });
        
        $('#barcodeNumber').on('input',function(e){
            let barcode = e.target.value;
            let user_id = $('#users option:selected').val();
            let status = $('#status option:selected').val();
            let delivery_date = $('#delivery_date').val();
            let _token = '{{ csrf_token() }}';
                
            $.ajax({
                type: "post",
                url: "{{ route('dispatchOrder') }}",
                data: {
                    _token,
                    barcode,
                    user_id,
                    status,
                    delivery_date
                },
                success: function (response) {
                    console.log(response);
                    if(response == 'not_found') {
                        $("#order_not_found").css("display", "block");
                    } else {
                        if($("#" + response.id).length == 0) {
                            $('#tableBody').append('<tr id="'+response.id+'"><td> ' + response.id + '             </td><td> ' + response.RecipientName + '    </td><td> ' + response.RecipientNumber + '  </td><td> ' + response.city + '             </td><td> ' + response.RecipientAddress + ' </td><td> ' + response.itemPrice + '        </td><td> ' + response.deliveryPrice + '    </td><td> ' + response.totalPrice + '       </td><td> ' + response.notes + '            </td><td><button class="btn btn-danger remove_btn" data-id="'+response.id+'" id="'+response.assigned_order.Driver_id+','+response.assigned_order.delivery_date+','+response.status+'">Remove</button></td></tr>');
                        }
                        $('#barcodeNumber').val('');
                        $("#order_not_found").css("display", "none");
                    }
                }
            });
        });
        
        $(document).keypress(function(e){
            var keycode = (e.keyCode ? e.keyCode : e.which);
            if(keycode == '13'){
                $('#barcodeNumber').val('');
                let barcode = e.target.value;
                let user_id = $('#users option:selected').val();
                let status = $('#status option:selected').val();
                let delivery_date = $('#delivery_date').val();
                let _token = '{{ csrf_token() }}';
                    
                $.ajax({
                    type: "post",
                    url: "{{ route('dispatchOrder') }}",
                    data: {
                        _token,
                        barcode,
                        user_id,
                        status,
                        delivery_date
                    },
                    success: function (response) {
                        console.log(response);
                        if(response == 'not_found') {
                            $("#order_not_found").css("display", "block");
                        } else {
                            $('#tableBody').append('<tr id="'+response.id+'"><td> ' + response.id + '             </td><td> ' + response.RecipientName + '    </td><td> ' + response.RecipientNumber + '  </td><td> ' + response.city + '             </td><td> ' + response.RecipientAddress + ' </td><td> ' + response.itemPrice + '        </td><td> ' + response.deliveryPrice + '    </td><td> ' + response.totalPrice + '       </td><td> ' + response.notes + '            </td><td><button class="btn btn-danger remove_btn" data-id="'+response.id+'" id="'+response.assigned_order.Driver_id+','+response.assigned_order.delivery_date+','+response.status+'">Remove</button></td></tr>');
                            $('#barcodeNumber').val('');
                            $("#order_not_found").css("display", "none");
                        }
                    }
                });
            }
        });
        
        $(document).on("click",'.remove_btn',function(e) {
            $('#'+id).hide('slow', function(){ $('#'+id).remove(); });
            
            let data = e.target.id.split(',');
            console.log( data );
            let id = $(this).attr('data-id');
            let driver_id = data[0];
            let delivery_date = data[1];
            let status = data[2];
            let _token = '{{ csrf_token() }}';
            
            $.ajax({
                type: "post",
                url: "{{ route('resetOrderData') }}",
                data: {
                    _token,
                    id,
                    delivery_date,
                    status,
                },
                success: function (response) {

                }
            });
        });

        $('#Admintable1').on("draw.dt", function () {
            $(this).find(".dataTables_empty").parents('tbody').empty();
        }).DataTable({
            dom: 'lBfrtip',
            bInfo: false,
            responsive: true,
            buttons: [],
        });

    });

</script>
@endsection