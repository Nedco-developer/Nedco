@extends('layouts.app')

@section('content')
         <div class="container-fliud">
             <div class="row">
                 <div class="index col-md-3 mb-3">
                     <div class="side-container color">
                        <div>
                            <div class="row">
                                <img src="images/Group 12.png" class="img" alt="Track Shipments">
                            </div>
                            <br>
                            <div class="row text">
                                <p>Track Shipments</p>
                            </div>
                        </div>
                     </div>
                 </div>
                 <div class="col-md-6 mx-auto">
                     <div class="track-form" style="margin-bottom: 1rem;">
                        <div>
                            <div class="card-header color"><h6>By Order ID</h6> </div>
                            <div class="card-body">
                                <form method="get" action="trackresult?id="+document.getElementById("shipment-number").value"">
                                     <br>
                                     <label for="">Enter shipment number</label>
                                     <input type='text' id="shipment-number" name="shipment-number" required class="form-control"/>
                                     <br>
                                     <button class="btn color float-right round-input"> Track</button>
                                 </form>
                            </div>
                        </div>
                     </div>
                     <br>
                     <br>
                     <div class="track-form">
                        <div>
                            <div class="card-header color"><h6>By Client ID</h6> </div>
                            <div>
                                 <form method="get" action="trackresult?id="+document.getElementById("shipment-number").value",Between="document.getElementById("Between").value",And="document.getElementById("Between").value "">
                                    <br>
                                        <label for="">Refrence number</label>
                                        <input type='text' name="shipment-number" id="shipment-number" required class="form-control"/>
                                    <br>
                                        <label for="">Between<spam style="color:red;"> *</spam></label>
                                        <input type='date' name="Between" id="Between" required class="form-control"/>
                                    <br>
                                         <label for="">And<spam style="color:red;"> *</spam></label>
                                         <input type='date' name="And" id="And" required class="form-control"/>
                                    <br>
                                        <button class="btn color float-right round-input"> Track</button>
                                 </form>
                            </div>
                        </div>
                     </div>
                </div>
             </div>
         </div>
@endsection