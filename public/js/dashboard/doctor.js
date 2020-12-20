$(document).ready(function(){
    $("#serviceAR").tagEditor();
    $("#serviceEN").tagEditor();

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
        $("#cities").append("<option selected disabled>Please select city</option>")
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
        $("#areas").append("<option selected disabled>Please select area</option>")
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

    $("#create_doctor_form").submit(function(e){
        e.preventDefault();

        var nameAR = $("#nameAR").val();
        var nameEN = $("#nameEN").val();
        var servicesAR = $("#serviceAR").val();
        var servicesEN = $("#serviceEN").val();
        var titleAR = $("#titleAR").val();
        var titleEN = $("#titleEN").val();
        var phone = $("#phone").val();
        var clinic_id = $("#clinic").val();
        var general_specialization_id = $("#general_specialization").val();
        var direct_specialization_id = $("#direct_specialization").val();
        var insurance_id = $("#insurance").val();
        var email = $("#email").val();
        var website = $("#website").val();
        var fees = $("#fees").val();
        var wait = $("#wait").val();
        var duration_id = $("#duration").val();
        var country_id = $("#countries").val();
        var city_id = $("#cities").val();
        var area_id = $("#areas").val();
        var location = $("#location").val();
        var password = $("#password").val();
        var descriptionAR = $("#descriptionAR").val();
        var descriptionEN = $("#descriptionEN").val();


        reader = new FileReader();

        reader.onloadend = function () {
            // Since it contains the Data URI, we should remove the prefix and keep only Base64 string
            b64 = reader.result;
            var image = b64;
            var data = {
                nameAR: nameAR,
                nameEN: nameEN,
                servicesAR: servicesAR,
                servicesEN: servicesEN,
                titleAR: titleAR,
                titleEN: titleEN,
                phone: phone,
                clinic_id: clinic_id,
                general_specialization_id: general_specialization_id,
                direct_specialization_id: direct_specialization_id,
                email: email,
                website: website,
                fees: fees,
                wait: wait,
                duration_id: duration_id,
                country_id: country_id,
                city_id: city_id,
                area_id: area_id,
                password: password,
                descriptionAR: descriptionAR,
                descriptionEN: descriptionEN,
                location: location,
                insurance_id: insurance_id,
                lat: lat,
                long: long,
                image: image
            }

            $.ajax({
                type: "POST",
                url : 'http://127.0.0.1:8000/api/createdoctor',
                data: data,
                success: function(msg){
                    window.location.replace('/admin/doctors')
                }
            });
        };

        reader.readAsDataURL(imagePath);

    })




    $("#edit_doctor_form").submit(function(e){
        e.preventDefault();

        var doctor_id = $("#doctor_id").val();
        var nameAR = $("#nameAR").val();
        var nameEN = $("#nameEN").val();
        var servicesAR = $("#serviceAR").val();
        var servicesEN = $("#serviceEN").val();
        var titleAR = $("#titleAR").val();
        var titleEN = $("#titleEN").val();
        var phone = $("#phone").val();
        var clinic_id = $("#clinic").val();
        var general_specialization_id = $("#general_specialization").val();
        var direct_specialization_id = $("#direct_specialization").val();
        var insurance_id = $("#insurance").val();
        var email = $("#email").val();
        var website = $("#website").val();
        var fees = $("#fees").val();
        var wait = $("#wait").val();
        var duration_id = $("#duration").val();
        var country_id = $("#countries").val();
        var city_id = $("#cities").val();
        var area_id = $("#areas").val();
        var location = $("#location").val();
        var descriptionAR = $("#descriptionAR").val();
        var descriptionEN = $("#descriptionEN").val();

        if(!imagePath){
            var data = {
                doctor_id: doctor_id,
                nameAR: nameAR,
                nameEN: nameEN,
                servicesAR: servicesAR,
                servicesEN: servicesEN,
                titleAR: titleAR,
                titleEN: titleEN,
                phone: phone,
                clinic_id: clinic_id,
                general_specialization_id: general_specialization_id,
                direct_specialization_id: direct_specialization_id,
                email: email,
                website: website,
                fees: fees,
                wait: wait,
                duration_id: duration_id,
                country_id: country_id,
                city_id: city_id,
                area_id: area_id,
                descriptionAR: descriptionAR,
                descriptionEN: descriptionEN,
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
                url : 'http://127.0.0.1:8000/api/updatedoctor',
                data: data,
                success: function(msg){
                    window.location.replace('/admin/doctors')
                }
            });
        }else{
            reader = new FileReader();

            reader.onloadend = function () {
                // Since it contains the Data URI, we should remove the prefix and keep only Base64 string
                b64 = reader.result;
                var image = b64;

                var data = {
                    doctor_id: doctor_id,
                    nameAR: nameAR,
                    nameEN: nameEN,
                    servicesAR: servicesAR,
                    servicesEN: servicesEN,
                    titleAR: titleAR,
                    titleEN: titleEN,
                    phone: phone,
                    clinic_id: clinic_id,
                    general_specialization_id: general_specialization_id,
                    direct_specialization_id: direct_specialization_id,
                    email: email,
                    website: website,
                    fees: fees,
                    wait: wait,
                    duration_id: duration_id,
                    country_id: country_id,
                    city_id: city_id,
                    area_id: area_id,
                    descriptionAR: descriptionAR,
                    descriptionEN: descriptionEN,
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
                    url : 'http://127.0.0.1:8000/api/updatedoctor',
                    data: data,
                    success: function(msg){
                        window.location.replace('/admin/doctors')
                    }
                });

            };

            reader.readAsDataURL(imagePath);
        }




    })

})


function deleteDoctor(id){

    var data = {
        id: id
    }

    $.ajax({
        type: "POST",
        url : 'http://127.0.0.1:8000/api/deletedoctor',
        data: data,
        success: function(msg){
            location.replace('/admin/doctors')
        }
    });
}