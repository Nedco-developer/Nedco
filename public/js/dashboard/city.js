$(document).ready(function(){
    $("#create_city_form").submit(function(e){
        e.preventDefault();

        var nameAR = $("#city_nameAR").val();
        var nameEN = $("#city_nameEN").val();
        var country_id = $("#country_id").val();

        var data = {
            nameAR: nameAR,
            nameEN: nameEN,
            country_id: country_id
        }

        $.ajax({
            type: "POST",
            url : 'http://127.0.0.1:8000/api/createcity',
            data: data,
            success: function(msg){
                location.replace('/admin/city')
            }
        });
    })


    $("#edit_city_form").submit(function(e){
        e.preventDefault();

        var id = $("#edit_city_id").val();
        var nameAR = $("#edit_city_nameAR").val();
        var nameEN = $("#edit_city_nameEN").val();
        var country_id = $("#edit_country_id").val();

        var data = {
            id: id,
            nameAR: nameAR,
            nameEN: nameEN,
            country_id: country_id
        }

        $.ajax({
            type: "POST",
            url : 'http://127.0.0.1:8000/api/updatecity',
            data: data,
            success: function(msg){
                location.replace('/admin/city')
            }
        });
    })

})

function deleteCity(id){

    var data = {
        id: id
    }

    $.ajax({
        type: "POST",
        url : 'http://127.0.0.1:8000/api/deletecity',
        data: data,
        success: function(msg){
            location.replace('/admin/city')
        }
    });
}