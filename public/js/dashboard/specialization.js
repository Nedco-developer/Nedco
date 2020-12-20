$(document).ready(function(){
    $("#create_specialization_form").submit(function(e){
        e.preventDefault();
        var type="";
        if($("#direct").prop("checked") === true){
            type = "direct"
        }else if($("#general").prop("checked") === true){
            type = "general"
        }

        var name = $("#name").val();
        var description = $("#specialization_add").val()

        var data = {
            name: name,
            type: type,
            description: description
        }


        $.ajax({
            type: "POST",
            url : 'http://127.0.0.1:8000/api/createspecialization',
            data: data,
            success: function(msg){
                location.replace('/admin/specialization')
            }
        });
    })


    $("#edit_specialization_form").submit(function(e){
        e.preventDefault();

        var type="";
        if($("#direct").prop("checked") === true){
            type = "direct"
        }else if($("#general").prop("checked") === true){
            type = "general"
        }

        var specialization_id = $("#specialization_id").val();
        var name = $("#name").val();
        var description = $("#specialization_add").val()

        var data = {
            specialization_id: specialization_id,
            name: name,
            type: type,
            description: description
        }


        $.ajax({
            type: "POST",
            url : 'http://127.0.0.1:8000/api/updatespecialization',
            data: data,
            success: function(msg){
                location.replace('/admin/specialization')
            }
        });
    })

})

function deleteSpecialization(id){

    var data = {
        id: id
    }

    $.ajax({
        type: "POST",
        url : 'http://127.0.0.1:8000/api/deletespecialization',
        data: data,
        success: function(msg){
            location.replace('/admin/specialization')
        }
    });
}