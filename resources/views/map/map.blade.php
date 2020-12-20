<!DOCTYPE html>
<html>
  <head>
    <title>Nedco</title>
    <link
      rel="icon"
      href="{!! asset('images/cropped-nedco_icon-32x32.jpg') !!}"
    />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      #confirm {
        position: absolute;
        left: 50%;
        bottom: 10px;
      }

      #confirmBtn {
        position: relative;
        left: -50%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <div id="confirm">
        <div id="confirmBtn">
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Confirm</button>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Confirm Location</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body"> 
             By Clicking on save you confirm on delivering the order with the number #{{request('oid')}} to the given location.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <form action="{{ route('changeOrderLocation') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $lat }}" id="lat" name="lat" />
                <input type="hidden" value="{{ $lon }}" id="lon" name="lon" />
                <input type="hidden" value="{{ request('oid') }}" id="oid" name="oid" />
                <button type="submit" class="btn btn-primary" id="confirmLoc">Save changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </body>
<script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous"
></script>
<script
      src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-NF4wMIb4TcsnH1Y9tBklUK-BRX5Pk8U&callback=initMap&libraries=&v=weekly"
    defer
></script>

  <script>
    lat = document.getElementById("lat").value;
    lon = document.getElementById("lon").value;

    // In the following example, markers appear when the user clicks on the map.
    // The markers are stored in an array.
    // The user can then click an option to hide, show or delete the markers.
    let map;
    let markers = [];

    function initMap() {
      const haightAshbury = { lat: parseFloat(lat), lng: parseFloat(lon) };
      map = new google.maps.Map(document.getElementById("map"), {
        zoom: 6,
        center: haightAshbury,
        mapTypeId: "terrain"
      });
      // This event listener will call addMarker() when the map is clicked.
      map.addListener("click", event => {
        clearMarkers();
        addMarker(event.latLng);
        document.getElementById("lat").value = event.latLng.lat();
        document.getElementById("lon").value = event.latLng.lng();
      });
      // Adds a marker at the center of the map.
      addMarker(haightAshbury);
    }

    function toggleBounce() {
      if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
      } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
      }
    }

    // Adds a marker to the map and push to the array.
    function addMarker(location) {
      const marker = new google.maps.Marker({
        draggable: true,
        position: location,
        map: map
      });
      markers.push(marker);
      marker.addListener("click", toggleBounce);
      marker.addListener("dragend", function(evt) {
        document.getElementById("lat").value = evt.latLng.lat();
        document.getElementById("lon").value = evt.latLng.lng();
      });
    }

    // Sets the map on all markers in the array.
    function setMapOnAll(map) {
      for (let i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
      }
    }

    // Removes the markers from the map, but keeps them in the array.
    function clearMarkers() {
      setMapOnAll(null);
    }

    // Shows any markers currently in the array.
    function showMarkers() {
      setMapOnAll(map);
    }

    // Deletes all markers in the array by removing references to them.
    function deleteMarkers() {
      clearMarkers();
      markers = [];
    }
    
        // $('#confirmLoc').click(function (e) { 
        //     e.preventDefault();
        //     let lat = document.getElementById("lat").value;
        //     let lon = document.getElementById("lon").value;
        //     let oid = "{{ request('oid') }}";
        //     let _token = "{{ csrf_token() }}"
        //     $.ajax({
        //     type: "post",
        //     url: "{{ route('changeOrderLocation') }}",
        //     data: {
        //         _token,
        //         lat,
        //         lon,
        //         oid
        //     },
        //     success: function (response) {
        //         console.log(response);
        //     }
            // });    
        // });

  </script>
</html>
