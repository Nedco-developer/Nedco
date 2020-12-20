$(document).ready(function(){
    var lat = 32.004233;
    var long = 35.9351532;
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
    $("#insurance_countries").change(function(){
        $("#insurance_cities").find('option').remove();
        $("#insurance_cities").append("<option selected disabled>Please select city</option>")
        $("#insurance_areas").attr("disabled", "true")
        var country_id = $(this).val();
        var data = {
            country_id: country_id
        }

        $.ajax({
            type: "get",
            url : 'http://127.0.0.1:8000/api/getInsuranceCities',
            data: data,
            success: function(res){
                $.each(res.cities, function(key,city){
                    $("#insurance_cities").append("<option value='"+city.id+"'>"+city.nameAR+"</option>")
                })
                $("#insurance_cities").removeAttr("disabled")
            }
        });
    })


    $("#insurance_cities").change(function(){
        $("#insurance_areas").find('option').remove();
        $("#insurance_areas").append("<option selected disabled>Please select area</option>")
        var city_id = $(this).val();
        var data = {
            city_id: city_id
        }

        $.ajax({
            type: "get",
            url : 'http://127.0.0.1:8000/api/getInsuranceAreas',
            data: data,
            success: function(res){
                $.each(res.areas, function(key,area){
                    $("#insurance_areas").append("<option value='"+area.id+"'>"+area.nameAR+"</option>")
                })
                $("#insurance_areas").removeAttr("disabled")
            }
        });
    })




    $("#create_insurance_form").submit(function(e){
        e.preventDefault();
        if($("#insurance_active:checked").length > 0){
            var active = 1;
        }else{
            var active = 0;
        }

        var nameAR = $("#insurance_nameAR").val();
        var nameEN = $("#insurance_nameEN").val();
        var country_id = $("#insurance_countries").val();
        var city_id = $("#insurance_cities").val();
        var area_id = $("#insurance_areas").val();
        var location = $("#insurance_location").val();

        var data = {
            nameAR: nameAR,
            nameEN: nameEN,
            active: active,
            country_id: country_id,
            city_id: city_id,
            area_id: area_id,
            location: location,
            lat: lat,
            long: long
        }

        $.ajax({
            type: "POST",
            url : 'http://127.0.0.1:8000/api/createinsurance',
            data: data,
            success: function(msg){
                window.location.replace('/admin/insurance')
            }
        });
    })


    $("#edit_insurance_form").submit(function(e){
        e.preventDefault();
        if($("#insurance_active:checked").length > 0){
            var active = 1;
        }else{
            var active = 0;
        }

        var insurance_id = $("#insurance_id").val();
        var nameAR = $("#insurance_nameAR").val();
        var nameEN = $("#insurance_nameEN").val();
        var country_id = $("#insurance_countries").val();
        var city_id = $("#insurance_cities").val();
        var area_id = $("#insurance_areas").val();
        var location = $("#insurance_location").val();

        var data = {
            insurance_id: insurance_id,
            nameAR: nameAR,
            nameEN: nameEN,
            active: active,
            country_id: country_id,
            city_id: city_id,
            area_id: area_id,
            location: location,
            lat: lat,
            long: long
        }

        $.ajax({
            type: "POST",
            url : 'http://127.0.0.1:8000/api/updateinsurance',
            data: data,
            success: function(msg){
                window.location.replace('/admin/insurance')
            }
        });
    })
})

function deleteInsurance(id){

    var data = {
        id: id
    }

    $.ajax({
        type: "POST",
        url : 'http://127.0.0.1:8000/api/deleteinsurance',
        data: data,
        success: function(msg){
            location.replace('/admin/insurance')
        }
    });
}