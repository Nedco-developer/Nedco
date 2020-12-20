$(document).ready(function(){
    var lat = 32.004233;
    var long = 35.9351532;
    var imagePath;
    var b64;
    $("#lat").change(function(){
        lat = $(this).val();
        $("#div-map").empty();
        $("#div-map").append("<iframe src='https://maps.google.com/maps?q="+lat+","+long+"&hl=es&z=14&amp&output=embed' width='100%' height='450' frameborder='0' style='border:0;' ></iframe>")
    })
    $("#long").change(function(){
        long = $(this).val();
        $("#div-map").empty();
        $("#div-map").append("<iframe src='https://maps.google.com/maps?q="+lat+","+long+"&hl=es&z=14&amp&output=embed' width='100%' height='450' frameborder='0' style='border:0;' ></iframe>")
    })

    $("#pharmacy_countries").change(function(){
        $("#pharmacy_cities").find('option').remove();
        $("#pharmacy_cities").append("<option disabled selected>Please select city</option>")
        $("#pharmacy_areas").attr("disabled", "true")
        var country_id = $(this).val();
        var data = {
            country_id: country_id
        }

        $.ajax({
            type: "get",
            url : 'http://127.0.0.1:8000/api/getClinicCities',
            data: data,
            success: function(res){
                $.each(res.cities, function(key,city){
                    $("#pharmacy_cities").append("<option value='"+city.id+"'>"+city.nameAR+"</option>")
                })
                $("#pharmacy_cities").removeAttr("disabled")
            }
        });
    })


    $("#pharmacy_cities").change(function(){
        $("#pharmacy_areas").find('option').remove();
        $("#pharmacy_areas").append("<option disabled selected>Please select area</option>")
        var city_id = $(this).val();
        var data = {
            city_id: city_id
        }

        $.ajax({
            type: "get",
            url : 'http://127.0.0.1:8000/api/getClinicAreas',
            data: data,
            success: function(res){
                $.each(res.areas, function(key,area){
                    $("#pharmacy_areas").append("<option value='"+area.id+"'>"+area.nameAR+"</option>")
                })
                $("#pharmacy_areas").removeAttr("disabled")
            }
        });
    })

    $('#commercial_register').change(function (e) {
        imagePath = e.target.files[0];
    });


    $("#create_pharmacy_form").submit(function(e){
        e.preventDefault();
        if($("#active:checked").length > 0){
            var active = 1;
        }else{
            var active = 0;
        }

        var nameAR = $("#nameAR").val();
        var nameEN = $("#nameEN").val();
        var ownerAR = $("#ownerAR").val();
        var ownerEN = $("#ownerEN").val();
        var phone = $("#phone").val();
        var mobile = $("#mobile").val();
        var email = $("#email").val();
        var country_id = $("#pharmacy_countries").val();
        var city_id = $("#pharmacy_cities").val();
        var area_id = $("#pharmacy_areas").val();
        var location = $("#location").val();
        var insurance_id = $("#pharmacy_insurance").val();

            reader = new FileReader();

            reader.onloadend = function () {
                // Since it contains the Data URI, we should remove the prefix and keep only Base64 string
                b64 = reader.result;
                var image = b64;
                var data = {
                    nameAR: nameAR,
                    nameEN: nameEN,
                    ownerAR: ownerAR,
                    ownerEN: ownerEN,
                    phone: phone,
                    mobile: mobile,
                    email: email,
                    active: active,
                    country_id: country_id,
                    city_id: city_id,
                    area_id: area_id,
                    location: location,
                    insurance_id: insurance_id,
                    lat: lat,
                    long: long,
                    image: image
                }

                $.ajax({
                    type: "POST",
                    url : 'http://127.0.0.1:8000/api/createpharmacy',
                    data: data,
                    success: function(msg){
                        window.location.replace('/admin/pharmacy')
                    }
                });
            };

            reader.readAsDataURL(imagePath);



    })

    $("#edit_pharmacy_form").submit(function(e){
        e.preventDefault();
        if($("#active:checked").length > 0){
            var active = 1;
        }else{
            var active = 0;
        }

        var pharmacy_id = $("#pharmacy_id").val();
        var nameAR = $("#nameAR").val();
        var nameEN = $("#nameEN").val();
        var ownerAR = $("#ownerAR").val();
        var ownerEN = $("#ownerEN").val();
        var phone = $("#phone").val();
        var mobile = $("#mobile").val();
        var email = $("#email").val();
        var country_id = $("#pharmacy_countries").val();
        var city_id = $("#pharmacy_cities").val();
        var area_id = $("#pharmacy_areas").val();
        var location = $("#location").val();
        var insurance_id = $("#pharmacy_insurance").val();

        if(!imagePath){
            var data = {
                pharmacy_id: pharmacy_id,
                nameAR: nameAR,
                nameEN: nameEN,
                ownerAR: ownerAR,
                ownerEN: ownerEN,
                phone: phone,
                mobile: mobile,
                email: email,
                active: active,
                country_id: country_id,
                city_id: city_id,
                area_id: area_id,
                location: location,
                insurance_id: insurance_id,
                lat: lat,
                long: long
            }


            $.ajax({
                type: "POST",
                url : 'http://127.0.0.1:8000/api/updatepharmacy',
                data: data,
                success: function(msg){
                    window.location.replace('/admin/pharmacy')
                }
            });
        }else{
            reader = new FileReader();

            reader.onloadend = function () {
                // Since it contains the Data URI, we should remove the prefix and keep only Base64 string
                b64 = reader.result;
                var image = b64;

                var data = {
                    pharmacy_id: pharmacy_id,
                    nameAR: nameAR,
                    nameEN: nameEN,
                    ownerAR: ownerAR,
                    ownerEN: ownerEN,
                    phone: phone,
                    mobile: mobile,
                    email: email,
                    active: active,
                    country_id: country_id,
                    city_id: city_id,
                    area_id: area_id,
                    location: location,
                    insurance_id: insurance_id,
                    lat: lat,
                    long: long,
                    image: image
                }


                $.ajax({
                    type: "POST",
                    url : 'http://127.0.0.1:8000/api/updatepharmacy',
                    data: data,
                    success: function(msg){
                        window.location.replace('/admin/pharmacy')
                    }
                });

            };

            reader.readAsDataURL(imagePath);
        }




    })



})


function deletePharmacy(id){

    var data = {
        id: id
    }

    $.ajax({
        type: "POST",
        url : 'http://127.0.0.1:8000/api/deletepharmacy',
        data: data,
        success: function(msg){
            location.replace('/admin/pharmacy')
        }
    });
}