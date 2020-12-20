@extends('layouts.dashboardApp')

@section('title', 'New Order Form')

@section('content')

<br>
<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="card">
            <div class="card-header">{{ __('New Order Form') }}</div>

            <div class="card-body">
                @if(\Session::has('success'))
                    <div class="alert alert-success">
                        {!! \Session::get('success') !!}
                    </div>
                @endif
                <table id="addOrders" class="">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Client</th>
                            <th>District</th>
                            <th>Recipient Name</th>
                            <th>Recipient Number</th>
                            <th>Recipient Address</th>
                            <th>Notes</th>
                            <th>Item Price</th>
                            <th>Delivery Price</th>
                            <th>Total Price</th>
                            <th> <a href="#" class="btn btn-success btn-sm" id="addOrder">
                                    <i class="fa fa-plus-square"></i>
                                </a></th>
                        </tr>
                    </thead>
                    <tbody id="addOrdersTbody">
                        <tr id="row_{{ $last_id->id + 1 }}">
                                <td>
                                    {{ $last_id->id + 1 }}
                                </td>
                                <td> {!! $htmlClients !!}</td>
                                <td>{!! $htmlDistricts !!}</td>
                                <td><textarea id="Recipientname_{{ $last_id->id + 1 }}" type="text" class="form-control" name="Recipientname"
                                        value="" placeholder="Recipient Name" required autofocus></textarea></td>
                                <td> <textarea id="Recipientnumber_{{ $last_id->id + 1 }}" type="number" class="form-control"
                                        name="Recipientnumber" value="" placeholder="Recipient Number" required
                                        autofocus></textarea></td>
                                <td> <textarea id="Recipientaddress_{{ $last_id->id + 1 }}" type="text" class="form-control"
                                        name="Recipientaddress" placeholder="Recipient Address" required
                                        autofocus></textarea></td>
                                <td> <textarea class="form-control" name="notes" placeholder="Notes" id="notes_{{ $last_id->id + 1 }}"></textarea></td>
                                <td> <input id="itemprice_{{ $last_id->id + 1 }}" type="text" class="form-control price price_value_{{ $last_id->id + 1 }}" name="itemprice" value="" placeholder="Item Price" data-id="{{ $last_id->id + 1 }}" required autofocus></td>
                                <td> <input id="deliveryprice_{{ $last_id->id + 1 }}" type="text" required disabled class="form-control price price_value_{{ $last_id->id + 1 }}"
                                        value="" autofocus> <input id="deliveryprice2_{{ $last_id->id + 1 }}" type="hidden" required
                                        class="form-control" name="deliveryprice" value="" autofocus></td>
                                <td> <input id="totalprice_{{ $last_id->id + 1 }}" disabled type="text" class="form-control" value="" required>
                                    <input id="totalprice2_{{ $last_id->id + 1 }}" type="hidden" class="form-control" placeholder="Total Price"
                                        name="totalprice" value="" required></td>
                                <td> <button class="btn btn-success btn-sm m-2 submit" id="submitBtn_{{ $last_id->id + 1 }}" data-id="{{ $last_id->id + 1 }}">Submit Order</button>
                                    <button class="btn btn-info btn-xs m-2 remove_row" data-id="{{ $last_id->id + 1 }}">Remove Row</button>
                                    <div id="deleteBtn_{{ $last_id->id + 1 }}"></div>
                                </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $('.clients').select2({
        multiple: false,
        closeOnSelect: false,
        placeholder: 'Clients'
    });

    $('.district').select2({
        multiple: false,
        closeOnSelect: false,
        placeholder: 'Districts'
    });

    let last_id = "{{ $last_id->id }}"

    var table = $('#addOrders').DataTable({
        dom: 'lBfrtip',
        bInfo: false,
        searching: false,
        responsive: true,
        aoColumnDefs: [{
            "bSortable": false,
            "aTargets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }, ],
        buttons: []
    });

    let last_id_num = parseInt(last_id) + 2;

    $('#addOrder').click(function (e) {
        e.preventDefault();
        console.log($( "#addOrdersTbody" ).length);
        $('#addOrdersTbody').append('<tr id="tr_row_'+ last_id_num +'" class="odd"><td valign="top" colspan="11" class="dataTables_empty"><hr /></td></tr>');
        $('#addOrdersTbody').append('<tr id="row_'+ last_id_num +'"><form method="POST" action="{{ route('submitAddOrderFromTable') }}" class="form_'+ last_id_num +'">@csrf<td>' + last_id_num + '</td><td>    <select required name="client_id" id="client_id_'+ last_id_num +'" class="clients form-control"></select></td><td><select required name="district" id="district_'+last_id_num+'" class="district form-control"><option value="">-- Choose District --</option>    </select></td><td><textarea id="Recipientname_'+ last_id_num +'" type="text" class="form-control" name="Recipientname" value="" placeholder="Recipient Name"    required autofocus></textarea></td><td>    <textarea id="Recipientnumber_'+ last_id_num +'" type="number" class="form-control" name="Recipientnumber" value="" placeholder="Recipient Number"    required autofocus></textarea></td><td>    <textarea id="Recipientaddress_'+ last_id_num +'" type="text" class="form-control" name="Recipientaddress" placeholder="Recipient Address"    required autofocus></textarea></td><td>    <textarea class="form-control" name="notes" placeholder="Notes" id="notes_'+ last_id_num +'"></textarea></td><td>    <input id="itemprice_'+ last_id_num +'" type="text" class="form-control price price_value_'+ last_id_num +'" name="itemprice" data-id="'+ last_id_num +'" value="" placeholder="Item Price" required autofocus></td><td>    <input id="deliveryprice_'+ last_id_num +'" type="text" required disabled class="form-control price price_value_'+ last_id_num +'"        value="" autofocus>    <input id="deliveryprice2_'+ last_id_num +'" type="hidden" required class="form-control"        name="deliveryprice" value="" autofocus></td><td>    <input id="totalprice_'+ last_id_num +'" disabled type="text" class="form-control" value="" required>    <input id="totalprice2_'+ last_id_num +'" type="hidden" class="form-control" placeholder="Total Price"        name="totalprice" value="" required></td><td>    <button class="btn btn-success btn-sm m-2 submit" id="submitBtn_{{ $last_id->id + 2 }}" data-id="'+ last_id_num +'">Submit Order</button><button class="btn btn-info btn-sm m-2 remove_row" data-id="'+ last_id_num +'">Remove Row</button><div id="deleteBtn_'+ last_id_num +'"></div></td></form></tr>')
        getDistricts();
        getClients();
        $('.clients').select2({
            multiple: false,
            closeOnSelect: false,
            placeholder: 'Clients'
        });
        $('.district').select2({
            multiple: false,
            closeOnSelect: false,
            placeholder: 'Districts'
        });
        last_id_num = last_id_num + 1 ;
    });

    function getDistricts() {
        $.ajax({
            url: "{{ route('getAllDistricts') }}",
            type: 'GET',
            success: function (data) {
                $('#district_'+last_id_num-1).append("<option value='111'>-- Choose District --</option>");
                $.each(data, function (index, value) {
                    $('#district_'+`${last_id_num-1}`).append("<option value=" + value.id + " data-id=" + parseInt(last_id_num-1) + ">" + value.name + "</option>");
                });
            }
        });
    }

    function getClients() {
        $.ajax({
            url: "{{ route('getAllClients') }}",
            type: 'GET',
            success: function (data) {
                $('.clients').select2({
                    multiple: false,
                    closeOnSelect: false,
                    placeholder: 'Clients'
                });
                $('.district').select2({
                    multiple: false,
                    closeOnSelect: false,
                    placeholder: 'Districts'
                });
                $("#client_id_"+`${last_id_num-1}`).append("<option value=''>-- Choose Client --</option>");
                $.each(data, function (index, value) {
                    $("#client_id_"+`${last_id_num-1}`).append("<option value=" + value.id + " data-id=" + parseInt(last_id_num-1) + ">" + value.user.name +
                        "</option>");
                });
            }
        });
    }

    $('.price').keyup(function () {
        var sum = 0;
        let id = $(this).attr('data-id');
        $('.price_value_'+id).each(function () {
            sum += Number($(this).val());
        });
        $('#totalprice_'+id).attr('value', sum);
        $('#totalprice2_'+id).attr('value', sum);
    });

    $(document).on('keyup', 'input.price', function () {
        var sum = 0;
        let id = $(this).attr('data-id');
        console.log(id);
        $('.price_value_'+id).each(function () {
            sum += Number($(this).val());
        });
        $('#totalprice_'+id).attr('value', sum);
        $('#totalprice2_'+id).attr('value', sum);
    })

    $(document).on('click touchstart', 'button.remove_row', function(e){
        e.preventDefault();
        let id = $(this).attr('data-id');
        $('#row_'+id+'').remove();
        $('#tr_row_'+id+'').remove();
    })

    $(document).on('change', 'select.district', function () {
        event.preventDefault();
        let _token = '{{ csrf_token() }}';
        let data_id = $(this).children("option:selected").attr('data-id');
        let client = $("#client_id_"+data_id).children("option:selected").val();
        let district = $(this).children("option:selected").val();
        $.ajax({
            url: "{{ route('getDeliveryPrice') }}",
            type: "POST",
            data: {
                district: district,
                client: client,
                _token: _token
            },
            success: function (response) {
                $("#deliveryprice_"+data_id).val(response.price);
                $("#deliveryprice2_"+data_id).val(response.price);
            },
        });
    })

    $(document).on('click touchstart', 'button.submit', function(e){
        e.preventDefault();
        let id = $(this).attr('data-id');
        $('.form_'+id).submit(function (e) { 
            e.preventDefault();
        });
        let _token = "{{ csrf_token() }}"
        let client_id         = document.getElementById('client_id_'+id).value;
        let district          = document.getElementById('district_'+id).value;
        let Recipientnumber   = document.getElementById('Recipientnumber_'+id).value;
        let Recipientname     = document.getElementById('Recipientname_'+id).value;
        let Recipientaddress  = document.getElementById('Recipientaddress_'+id).value;
        let itemprice         = document.getElementById('itemprice_'+id).value;
        let deliveryprice     = document.getElementById('deliveryprice_'+id).value;
        let totalprice        = document.getElementById('totalprice_'+id).value;
        let notes             = document.getElementById('notes_'+id).value;

        $('#deleteBtn_'+id+'').empty();

        $.ajax({
            type: "post",
            url: "{{ route('submitAddOrderFromTable') }}",
            data: {
                _token,
                client_id,
                district,
                Recipientnumber,
                Recipientname,
                district,
                Recipientaddress,
                itemprice,
                deliveryprice,
                totalprice,
                notes,
            },
            success: function (response) {
                $('#submitBtn_'+id+'').remove();
            }
        });
    })


</script>
@endsection
