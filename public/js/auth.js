$(document).ready(function(){
    $("#logoutButton").click(function() {
        $.ajax({
            type: "GET",
            url: 'http://127.0.0.1:8000/api/logout',
            success: function(msg){
                location.replace('/login')
            }
        });
    })
    $(".toggle-password").click(function() {
        var input = $("#login_password");
        if (input.attr("type") == "password") {
            input.attr("type", "text");
            $(this).removeClass("fa fa-eye")
            $(this).addClass("fa fa-eye-slash")
        } else {
            input.attr("type", "password");
            $(this).removeClass("fa fa-eye-slash")
            $(this).addClass("fa fa-eye")
        }
    });

    $("#login_form").submit(function(e){
        e.preventDefault();

        $(".login-overflow").css("display", "block");

        var email = $("#login_email").val();
        var password = $("#login_password").val();

        var data = {
            email: email,
            password: password
        }


        $.ajax({
            type: "POST",
            url : 'http://127.0.0.1:8000/api/login',
            data: data,
            success: function(msg){
                localStorage.setItem('auth', msg.auth);
                localStorage.setItem('id', msg.id);
                if(msg.role == 0){
                    window.location.href = '/admin/dashboard';
                }else if(msg.role == 1){
                    window.location.href = '/doctors/dashboard';
                }else if(msg.role == 2) {
                    window.location.href = '/patients/dashboard';
                }
                $(".login-overflow").css("display", "none");
            },
            error: function(err){
                $(".login-overflow").css("display", "none");
                $("#login_error_div").css("display", "block");
                $("#login_error").text(JSON.parse(err.responseText).failed);
            }
        });
    })
})