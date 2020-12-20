$(document).ready(function(){
    $("#create_country_form").submit(function(e){
        e.preventDefault();

        var nameAR = $("#country_nameAR").val();
        var nameEN = $("#country_nameEN").val();
        var iso = $("#country_iso").val();

        var data = {
            nameAR: nameAR,
            nameEN: nameEN,
            iso: iso
        }

        $.ajax({
            type: "POST",
            url : 'http://127.0.0.1:8000/api/createcountry',
            data: data,
            success: function(msg){
                location.replace('/admin/country')
            }
        });
    })


    $("#edit_country_form").submit(function(e){
        e.preventDefault();

        var id = $("#edit_country_id").val();
        var nameAR = $("#edit_country_nameAR").val();
        var nameEN = $("#edit_country_nameEN").val();
        var iso = $("#edit_country_iso").val();

        var data = {
            id: id,
            nameAR: nameAR,
            nameEN: nameEN,
            iso: iso
        }

        $.ajax({
            type: "POST",
            url : 'http://127.0.0.1:8000/api/updatecountry',
            data: data,
            success: function(msg){
                location.replace('/admin/country')
            }
        });
    })
})

function deleteCountry(id){

    var data = {
        id: id
    }

    $.ajax({
        type: "POST",
        url : 'http://127.0.0.1:8000/api/deletecountry',
        data: data,
        success: function(msg){
            location.replace('/admin/country')
        }
    });
}
