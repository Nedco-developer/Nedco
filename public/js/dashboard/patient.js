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

    $("#countries").change(function(){
        $("#cities").find('option').remove();
        $("#cities").append("<option disabled selected>Please select city</option>")
        $("#areas").attr("disabled", "true")
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
                    $("#cities").append("<option value='"+city.id+"'>"+city.nameAR+"</option>")
                })
                $("#cities").removeAttr("disabled")
            }
        });
    })


    $("#cities").change(function(){
        $("#areas").find('option').remove();
        $("#areas").append("<option disabled selected>Please select area</option>")
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
                    $("#areas").append("<option value='"+area.id+"'>"+area.nameAR+"</option>")
                })
                $("#areas").removeAttr("disabled")
            }
        });
    })

    $('#image').change(function (e) {
        imagePath = e.target.files[0];
    });


    $("#create_patient_form").submit(function(e){
        e.preventDefault();
        if($("#made_surgery:checked").length > 0){
            var made_surgery = 1;
        }else{
            var made_surgery = 0;
        }

        if($("#diabetes:checked").length > 0){
            var diabetes = 1;
        }else{
            var diabetes = 0;
        }

        if($("#hypertension:checked").length > 0){
            var hypertension = 1;
        }else{
            var hypertension = 0;
        }

        if($("#disability:checked").length > 0){
            var disability = 1;
        }else{
            var disability = 0;
        }

        if($("#health_problem:checked").length > 0){
            var health_problem = 1;
        }else{
            var health_problem = 0;
        }

        if($("#allergy_for_drug:checked").length > 0){
            var allergy_for_drug = 1;
        }else{
            var allergy_for_drug = 0;
        }

        var nameAR = $("#nameAR").val();
        var nameEN = $("#nameEN").val();
        var date = $("#date").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var insurance_id = $("#insurance").val();
        var status = $("#status").val();
        var gender = $("#gender").val();
        var blood = $("#blood").val();
        var country_id = $("#countries").val();
        var city_id = $("#cities").val();
        var area_id = $("#areas").val();
        var location = $("#location").val();




        reader = new FileReader();

        reader.onloadend = function () {
            // Since it contains the Data URI, we should remove the prefix and keep only Base64 string
            b64 = reader.result;
            var image = b64;
            var data = {
                nameAR: nameAR,
                nameEN: nameEN,
                date: date,
                email: email,
                password: password,
                status: status,
                gender: gender,
                blood: blood,
                made_surgery: made_surgery,
                diabetes: diabetes,
                hypertension: hypertension,
                disability: disability,
                health_problem: health_problem,
                allergy_for_drug: allergy_for_drug,
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
                url : 'http://127.0.0.1:8000/api/createpatient',
                data: data,
                success: function(msg){
                    window.location.replace('/admin/patients')
                }
            });
        };

        reader.readAsDataURL(imagePath);



    })

    $("#edit_patient_form").submit(function(e){
        e.preventDefault();
        if($("#made_surgery:checked").length > 0){
            var made_surgery = 1;
        }else{
            var made_surgery = 0;
        }

        if($("#diabetes:checked").length > 0){
            var diabetes = 1;
        }else{
            var diabetes = 0;
        }

        if($("#hypertension:checked").length > 0){
            var hypertension = 1;
        }else{
            var hypertension = 0;
        }

        if($("#disability:checked").length > 0){
            var disability = 1;
        }else{
            var disability = 0;
        }

        if($("#health_problem:checked").length > 0){
            var health_problem = 1;
        }else{
            var health_problem = 0;
        }

        if($("#allergy_for_drug:checked").length > 0){
            var allergy_for_drug = 1;
        }else{
            var allergy_for_drug = 0;
        }

        var patient_id = $("#patient_id").val();
        var nameAR = $("#nameAR").val();
        var nameEN = $("#nameEN").val();
        var date = $("#date").val();
        var email = $("#email").val();
        var insurance_id = $("#insurance").val();
        var status = $("#status").val();
        var gender = $("#gender").val();
        var blood = $("#blood").val();
        var country_id = $("#countries").val();
        var city_id = $("#cities").val();
        var area_id = $("#areas").val();
        var location = $("#location").val();

        if(!imagePath){
            var data = {
                patient_id: patient_id,
                nameAR: nameAR,
                nameEN: nameEN,
                date: date,
                email: email,
                status: status,
                gender: gender,
                blood: blood,
                made_surgery: made_surgery,
                diabetes: diabetes,
                hypertension: hypertension,
                disability: disability,
                health_problem: health_problem,
                allergy_for_drug: allergy_for_drug,
                country_id: country_id,
                city_id: city_id,
                area_id: area_id,
                location: location,
                insurance_id: insurance_id,
                lat: lat,
                long: long
            }

            if($("#password").val()){
                data.password = $("#password").val();
            }

            $.ajax({
                type: "POST",
                url : 'http://127.0.0.1:8000/api/updatepatient',
                data: data,
                success: function(msg){
                    window.location.replace('/admin/patients')
                }
            });
        }else{
            reader = new FileReader();

            reader.onloadend = function () {
                // Since it contains the Data URI, we should remove the prefix and keep only Base64 string
                b64 = reader.result;
                var image = b64;

                var data = {
                    patient_id: patient_id,
                    nameAR: nameAR,
                    nameEN: nameEN,
                    date: date,
                    email: email,
                    status: status,
                    gender: gender,
                    blood: blood,
                    made_surgery: made_surgery,
                    diabetes: diabetes,
                    hypertension: hypertension,
                    disability: disability,
                    health_problem: health_problem,
                    allergy_for_drug: allergy_for_drug,
                    country_id: country_id,
                    city_id: city_id,
                    area_id: area_id,
                    location: location,
                    insurance_id: insurance_id,
                    lat: lat,
                    long: long,
                    image: image
                }

                if($("#password").val()){
                    data.password = $("#password").val();
                }

                $.ajax({
                    type: "POST",
                    url : 'http://127.0.0.1:8000/api/updatepatient',
                    data: data,
                    success: function(msg){
                        window.location.replace('/admin/patients')
                    }
                });

            };

            reader.readAsDataURL(imagePath);
        }




    })



})


function deletePatient(id){

    var data = {
        id: id
    }

    $.ajax({
        type: "POST",
        url : 'http://127.0.0.1:8000/api/deletepatient',
        data: data,
        success: function(msg){
            location.replace('/admin/pharmacy')
        }
    });
}