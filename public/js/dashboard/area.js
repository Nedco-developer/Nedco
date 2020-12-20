$(document).ready(function(){
    $("#create_area_form").submit(function(e){
        e.preventDefault();

        var nameAR = $("#area_nameAR").val();
        var nameEN = $("#area_nameEN").val();
        var city_id = $("#city_id").val();

        var data = {
            nameAR: nameAR,
            nameEN: nameEN,
            city_id: city_id
        }

        $.ajax({
            type: "POST",
            url : 'http://127.0.0.1:8000/api/createarea',
            data: data,
            success: function(msg){
                location.replace('/admin/area')
            }
        });
    })


    $("#edit_area_form").submit(function(e){
        e.preventDefault();

        var id = $("#edit_area_id").val();
        var nameAR = $("#edit_area_nameAR").val();
        var nameEN = $("#edit_area_nameEN").val();
        var city_id = $("#edit_city_id").val();

        var data = {
            id: id,
            nameAR: nameAR,
            nameEN: nameEN,
            city_id: city_id
        }

        $.ajax({
            type: "POST",
            url : 'http://127.0.0.1:8000/api/updatearea',
            data: data,
            success: function(msg){
                location.replace('/admin/area')
            }
        });
    })

})

function deleteArea(id){

    var data = {
        id: id
    }

    $.ajax({
        type: "POST",
        url : 'http://127.0.0.1:8000/api/deletearea',
        data: data,
        success: function(msg){
            location.replace('/admin/area')
        }
    });
}