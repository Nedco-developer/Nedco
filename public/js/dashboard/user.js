$(document).ready(function(){
    var imagePath;
    var b64;

    $('#image').change(function (e) {
        imagePath = e.target.files[0];
    });

    $("#create_user_form").submit(function(e) {
        e.preventDefault();
        if ($("#active:checked").length > 0) {
            var active = 1;
        } else {
            var active = 0;
        }

        var name = $("#name").val();
        var phone = $("#phone").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var group = $("#group").val();



        reader = new FileReader();

        reader.onloadend = function () {
            // Since it contains the Data URI, we should remove the prefix and keep only Base64 string
            b64 = reader.result;
            var image = b64;
            var data = {
                name: name,
                phone: phone,
                email: email,
                active: active,
                password: password,
                group: group,
                image: image
            }


            $.ajax({
                type: "POST",
                url : 'http://127.0.0.1:8000/api/createuser',
                data: data,
                success: function(msg){
                    window.location.replace('/admin/users')
                }
            });
        };

        reader.readAsDataURL(imagePath);

    })


    $("#edit_user_form").submit(function(e){
        e.preventDefault();
        if ($("#active:checked").length > 0) {
            var active = 1;
        } else {
            var active = 0;
        }

        var user_id = $("#user_id").val();
        var name = $("#name").val();
        var phone = $("#phone").val();
        var email = $("#email").val();
        var group = $("#group").val();

        if(!imagePath){
            var data = {
                user_id: user_id,
                name: name,
                phone: phone,
                email: email,
                active: active,
                group: group,
            }

            if($("#password").val()){
                data.password = $("#password").val();
            }


            $.ajax({
                type: "POST",
                url : 'http://127.0.0.1:8000/api/updateuser',
                data: data,
                success: function(msg){
                    window.location.replace('/admin/users')
                }
            });
        }else{
            reader = new FileReader();

            reader.onloadend = function () {
                // Since it contains the Data URI, we should remove the prefix and keep only Base64 string
                b64 = reader.result;
                var image = b64;
                var data = {
                    user_id: user_id,
                    name: name,
                    phone: phone,
                    email: email,
                    active: active,
                    group: group,
                    image: image
                }

                if($("#password").val()){
                    data.password = $("#password").val();
                }


                // $.ajax({
                //     type: "POST",
                //     url : 'http://127.0.0.1:8000/api/updateuser',
                //     data: data,
                //     success: function(msg){
                //         // window.location.replace('/admin/users')
                //     }
                // });

            };

            reader.readAsDataURL(imagePath);
        }

    })

})



function deleteUser(id){

    var data = {
        id: id
    }

    $.ajax({
        type: "POST",
        url : 'http://127.0.0.1:8000/api/deleteuser',
        data: data,
        success: function(msg){
            location.replace('/admin/users')
        }
    });
}