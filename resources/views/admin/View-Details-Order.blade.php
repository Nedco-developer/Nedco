@extends('layouts.dashboardApp')

@section('title', 'Orders')

@section('content')
<style>
    .borderright {
         border-right: solid #ee293a;
        border-right-width: 0.5px;
    }
    .haderrow{
        background: #ee293a;
        text-align-last: center;
        color: white;
    }
    .entity-menu>.nav-item>a.active {
        background-color: #000;
        border-bottom: 0px solid black !important;
    }
    #Admintable3{
    display: block !important;
    overflow-x: auto !important;
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
        .table-res{
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
        
        .text{
            font-size:1rem !important;
        }
        .home-form {
        width: 100% !important;
        }
        .nav-item {
        height: 5rem !important;
         margin-left: 1rem !important;
        }
        .table-res{
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
        
        .text{
            font-size:1rem !important;
        }
        .home-form {
        width: 100% !important;
        }
        .nav-item {
        height: 5rem !important;
         margin-left: 1rem !important;
        }
        .table-res{
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
        .table-res{
                display: block !important;
            overflow-x: auto !important;
            }
    }
    @media only screen and (max-width: 1024px) {
        .nav-link {
        margin-left: 1rem !important;
        }
        .text{
            font-size:0rem !important;
        }
        .home {
          padding: 94px 0px !important;
        }
        .nav-item {
        height: 5rem !important;
         margin-left: 0rem !important;
        }
        .table-res{
                display: block !important;
            overflow-x: auto !important;
            }
    }
</style>
<?php 
    use Milon\Barcode\Facades\DNS1DFacade;
?>
       <div style="margin-top: 10px;" class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 haderrow">
                        <h3>Order</h3>
                    </div>
                </div>
                    <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="Admintable3" class="display nowrap table-res table table-condensed " style="width:100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Recipient Name</th>
                                    <th>Recipient Number</th>
                                    <th>City</th>
                                    <th>Recipient Address</th>
                                    <th>Item Price</th>
                                    <th>Delivery Price</th>
                                    <th>Total Price</th>
                                    @if (isset($Order->partialPayment->paid))
                                    <th>Total Price After Delivery</th>
                                    @endif
                                    <th>Payment Status</th>
                                    <th>Coupon</th>
                                    <th>Notes</th>
                                    <th>Status</th>
                                    @if ($Order->status == 'Cancelled')
                                    <th>Cancelled Reason</th>
                                    @endif
                                    <th>Delivery Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>{{ $Order->id }}</td>
                                        <td>{{ $Order->RecipientName }}</td>
                                        <td>{{ $Order->RecipientNumber }}</td>
                                        <td>{{ $Order->city }}</td>
                                        <td>{{ $Order->RecipientAddress }}</td>
                                        <td>{{ $Order->itemPrice }}</td>
                                        <td>{{ $Order->deliveryPrice }}</td>
                                        <td>{{ $Order->totalPrice }}</td>
                                        @if (isset($Order->partialPayment->paid))
                                        <td>{{ $Order->totalPrice - $Order->partialPayment->paid }}</td>
                                        @endif
                                        <td>{{ $Order->payment_status }}</td>
                                        <td>
                                            @if(isset($Order->coupon_code))
                                                {{ $Order->coupon_code }} @if(isset($Order->coupon->discount)) / discounted: {{ $Order->coupon->discount }} @endif
                                            @else
                                                No Coupon was used
                                            @endif
                                        </td>
                                        <td>{{ $Order->notes }}</td>
                                        <td>{{ $Order->status }}</td>
                                        @if ($Order->status == 'Cancelled')
                                        @isset($Order->cancelledOrder)
                                        <td>{{ $Order->cancelledOrder->reason }}</td>
                                        @endisset
                                        @endif
                                        @if(isset($assignOrders->delivery_date))
                                        <td>{{ $assignOrders->delivery_date }}</td>
                                        @else
                                        <td></td>
                                        @endif
                                    </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>id</th>
                                    <th>Recipient Name</th>
                                    <th>Recipient Number</th>
                                    <th>City</th>
                                    <th>Recipient Address</th>
                                    <th>Item Price</th>
                                    <th>Delivery Price</th>
                                    <th>Total Price</th>
                                    @if (isset($Order->partialPayment->paid))
                                    <th>Total Price After Delivery</th>
                                    @endif
                                    <th>Payment Status</th>
                                    <th>Coupon</th>
                                    <th>Notes</th>
                                    <th>Status</th>
                                    <th>Delivery Date</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <hr>
                <div>
                    <h1>Order Barcode</h1>
                    {!!DNS1DFacade::getBarcodeHTML($Order->barcode, 'C39')!!}
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-2 haderrow">
                        <h3>Finance</h3>
                    </div>
                </div>
                    <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="Admintable4" class="display nowrap table-res table table-condensed ">
                            <thead>
                                <tr>
                                    <th>
                                        Order ID
                                    </th>
                                    <th>
                                        item Price
                                    </th>
                                    <th>
                                        delivery Price
                                    </th>
                                    <th>
                                        total Price
                                    </th>
                                    <th>
                                        driver Price
                                    </th>
                                    <th>
                                        total Net
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>{{ $Order->id }}</td>
                                        <td>{{ $Order->itemPrice }}</td>
                                        <td>{{ $Order->deliveryPrice }}</td>
                                        <td>{{ $Order->totalPrice }}</td>
                                        @if ($districtsPrices != null)
                                        <td>{{ $districtsPrices->price }}</td>
                                        @else
                                        <td></td>
                                        @endif
                                        @if ($Totalnet != null)
                                        <td>{{ $Totalnet - $Order->itemPrice}}</td>
                                        @else
                                        <td></td>
                                        @endif
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <hr>
                <div class="row">
                    <div class="col-md-2 haderrow">
                        <h3>Client</h3>
                    </div>
                </div>
                    <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="Admintable1" class="display nowrap table-res table table-condensed ">
                        <thead>
                        <tr>
                            <th>
                                id
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Phone
                            </th>
                            <th>
                                View
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{ $Admin->user->id }}</td>
                                <td>{{ $Admin->user->name }}</td>
                                <td>{{ $Admin->user->email }}</td>
                                <td>{{ $Admin->user->phone }}</td>
                                <td><a href="Viewclient?id={{ $Admin->user->id }}"
                                    class="btn btn-primary">View</a></td>
                            </tr>
                    </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <hr>
                <div class="row">
                    <div class="col-md-2 haderrow">
                        <h3>Driver</h3>
                    </div>
                </div>
                <hr>
                @if($Driver != null)
                            <div class="row">
                    <div class="col-md-12">
                        <table id="Admintable2" class="display nowrap table-res table table-condensed ">
                            <thead>
                        <tr>
                            <th>
                                id
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Phone
                            </th>
                            <th>
                                View Details
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{ $Driver->user->id }}</td>
                                <td>{{ $Driver->user->name }}</td>
                                <td>{{ $Driver->user->email }}</td>
                                <td>{{ $Driver->user->phone }}</td>
                                <td>
                                    <a href="ViewDetailsDriver?id={{ $Driver->user_id }}" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                    </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#Admintable1').DataTable({
                dom: 'lBfrtip',
                bInfo: false,
                            buttons: [                
                {
                    extend: 'copy',
                    className: 'btn btn-secondary'
                }, {
                    extend: 'csv',
                    className: 'btn btn-warning',
                    title: 'nedco_order',
                    extension: '.csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }, {
                    extend: 'excel',
                    className: 'btn btn-success',
                    title: 'nedco_order',
                    extension: '.xls',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }, {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    title: 'nedco_order',
                    extension: '.pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-info',
                    title: 'nedco_order',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }
            ],

            });
            $('#Admintable2').DataTable({
                dom: 'lBfrtip',
                bInfo: false,
                            buttons: [                
                {
                    extend: 'copy',
                    className: 'btn btn-secondary'
                }, {
                    extend: 'csv',
                    className: 'btn btn-warning',
                    title: 'nedco_order',
                    extension: '.csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }, {
                    extend: 'excel',
                    className: 'btn btn-success',
                    title: 'nedco_order',
                    extension: '.xls',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }, {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    title: 'nedco_order',
                    extension: '.pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-info',
                    title: 'nedco_order',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }
            ],

            });
            $('#Admintable3').DataTable({
                 initComplete: function () {
                    count = 0;
                    this.api().columns().every( function () {
                        var title = this.header();
                        //replace spaces with dashes
                        title = $(title).html().replace(/[\W]/g, '-');
                        var column = this;
                        var select = $('<select id="' + title + '" class="select2" ></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                              //Get the "text" property from each selected data 
                              //regex escape the value and store in array
                              var data = $.map( $(this).select2('data'), function( value, key ) {
                                return value.text ? '^' + $.fn.dataTable.util.escapeRegex(value.text) + '$' : null;
                                         });
                              
                              //if no data selected use ""
                              if (data.length === 0) {
                                data = [""];
                              }
                              
                              //join array into string with regex or (|)
                              var val = data.join('|');
                              
                              //search for the option(s) selected
                              column
                                    .search( val ? val : '', true, false )
                                    .draw();
                            } );
         
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' );
                        } );
                      
                      //use column title as selector and placeholder
                      $('#' + title).select2({
                        multiple: true,
                        closeOnSelect: false,
                        placeholder: title
                      });
                      
                      //initially clear select otherwise first option is selected
                      $('.select2').val(null).trigger('change');
                    } );
                },
                dom: 'lBfrtip',
                bInfo: false,
                            buttons: [                
                {
                    extend: 'copy',
                    className: 'btn btn-secondary'
                }, {
                    extend: 'csv',
                    className: 'btn btn-warning',
                    title: 'nedco_order',
                    extension: '.csv',
                }, {
                    extend: 'excel',
                    className: 'btn btn-success',
                    title: 'nedco_order',
                    extension: '.xls',
                }, {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    title: 'nedco_order',
                    extension: '.pdf',
                },
                {
                    extend: 'print',
                    className: 'btn btn-info',
                    title: 'nedco_order',
                }
            ],

            });
            $('#Admintable4').DataTable({
                dom: 'lBfrtip',
                bInfo: false,
                buttons: [                
                {
                    extend: 'copy',
                    className: 'btn btn-secondary'
                }, {
                    extend: 'csv',
                    className: 'btn btn-warning',
                    title: 'nedco_order',
                    extension: '.csv',
                }, {
                    extend: 'excel',
                    className: 'btn btn-success',
                    title: 'nedco_order',
                    extension: '.xls',
                }, {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    title: 'nedco_order',
                    extension: '.pdf',
                },
                {
                    extend: 'print',
                    className: 'btn btn-info',
                    title: 'nedco_order',
                }
            ],

            });

        });
    </script>
@endsection
