$(document).ready(function(){
    $("#create_duration_form").submit(function(e){
        e.preventDefault();

        var name = $("#duration_name").val();

        var data = {
            name: name,
        }

        $.ajax({
            type: "POST",
            url : 'http://127.0.0.1:8000/api/createduration',
            data: data,
            success: function(msg){
                location.replace('/admin/duration')
            }
        });
    })


    $("#edit_duration_form").submit(function(e){
        e.preventDefault();

        var id = $("#edit_duration_id").val();
        var name = $("#edit_duration_name").val();

        var data = {
            id: id,
            name: name
        }

        $.ajax({
            type: "POST",
            url : 'http://127.0.0.1:8000/api/updateduration',
            data: data,
            success: function(msg){
                location.replace('/admin/duration')
            }
        });
    })

})

function deleteDuration(id){

    var data = {
        id: id
    }

    $.ajax({
        type: "POST",
        url : 'http://127.0.0.1:8000/api/deleteduration',
        data: data,
        success: function(msg){
            location.replace('/admin/duration')
        }
    });
}