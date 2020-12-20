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

    $("#clinic_countries").change(function(){
        $("#clinic_cities").find('option').remove();
        $("#clinic_cities").append("<option selected disabled>Please select city</option>")
        $("#clinic_areas").attr("disabled", "true")
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
                    $("#clinic_cities").append("<option value='"+city.id+"'>"+city.nameAR+"</option>")
                })
                $("#clinic_cities").removeAttr("disabled")
            }
        });
    })


    $("#clinic_cities").change(function(){
        $("#clinic_areas").find('option').remove();
        $("#clinic_areas").append("<option selected disabled>Please select area</option>")
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
                    $("#clinic_areas").append("<option value='"+area.id+"'>"+area.nameAR+"</option>")
                })
                $("#clinic_areas").removeAttr("disabled")
            }
        });
    })




    $("#create_clinic_form").submit(function(e){
        e.preventDefault();
        if($("#clinic_active:checked").length > 0){
            var active = 1;
        }else{
            var active = 0;
        }

        var nameAR = $("#clinic_nameAR").val();
        var nameEN = $("#clinic_nameEN").val();
        var phone = $("#clinic_phone").val();
        var email = $("#clinic_email").val();
        var country_id = $("#clinic_countries").val();
        var city_id = $("#clinic_cities").val();
        var area_id = $("#clinic_areas").val();
        var location = $("#clinic_location").val();
        var insurance_id = $("#clinic_insurance").val();

        var data = {
            nameAR: nameAR,
            nameEN: nameEN,
            phone: phone,
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
            url : 'http://127.0.0.1:8000/api/createclinic',
            data: data,
            success: function(msg){
                window.location.replace('/admin/clinic')
            }
        });
    })


    $("#edit_clinic_form").submit(function(e){
        e.preventDefault();
        if($("#clinic_active:checked").length > 0){
            var active = 1;
        }else{
            var active = 0;
        }

        var clinic_id = $("#clinic_id").val();
        var nameAR = $("#clinic_nameAR").val();
        var nameEN = $("#clinic_nameEN").val();
        var phone = $("#clinic_phone").val();
        var email = $("#clinic_email").val();
        var country_id = $("#clinic_countries").val();
        var city_id = $("#clinic_cities").val();
        var area_id = $("#clinic_areas").val();
        var location = $("#clinic_location").val();
        var insurance_id = $("#clinic_insurance").val();

        var data = {
            clinic_id: clinic_id,
            nameAR: nameAR,
            nameEN: nameEN,
            phone: phone,
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
            url : 'http://127.0.0.1:8000/api/updateclinic',
            data: data,
            success: function(msg){
                window.location.replace('/admin/clinic')
            }
        });
    })
})

function deleteClinic(id){

    var data = {
        id: id
    }

    $.ajax({
        type: "POST",
        url : 'http://127.0.0.1:8000/api/deleteclinic',
        data: data,
        success: function(msg){
            location.replace('/admin/clinic')
        }
    });
}