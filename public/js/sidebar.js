$(document).ready(function(){

    if (window.matchMedia('(min-width: 767px)').matches) {
        $("#wrapper").addClass("toggled");
        $("#navbarSupportedContent").addClass("collapse navbar-collapse");
    }

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });




    $("#wrapper_1").click(function(){
        $(this).toggleClass("active");
    })
    $("#wrapper_2").click(function(){
        $(this).toggleClass("active");
    })
    $("#wrapper_3").click(function(){
        $(this).toggleClass("active");
    })
    $("#wrapper_4").click(function(){
        $(this).toggleClass("active");
    })
    $("#wrapper_5").click(function(){
        $(this).toggleClass("active");
    })
    $("#wrapper_6").click(function(){
        $(this).toggleClass("active");
    })
    $("#wrapper_7").click(function(){
        $(this).toggleClass("active");
    })
    $("#wrapper_8").click(function(){
        $(this).toggleClass("active");
    })
    $("#wrapper_9").click(function(){
        $(this).toggleClass("active");
    })
    $("#wrapper_10").click(function(){
        $(this).toggleClass("active");
    })
    $("#wrapper_11").click(function(){
        $(this).toggleClass("active");
    })
    $("#wrapper_12").click(function(){
        $(this).toggleClass("active");
    })
    $("#wrapper_13").click(function(){
        $(this).toggleClass("active");
    })
})