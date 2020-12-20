$(document).ready(function(){

    $("#create_drug_ingredient_form").submit(function(e){
        e.preventDefault();

        var ingredient = $("#ingredient").val();
        var name = $("#name").val();
        var supply = $("#supply").val();
        var dosageform = $("#dosageform").val();
        var concentration = $("#concentration").val();
        var drugstore = $("#drugstore").val();
        var atccode = $("#atccode").val();
        var company = $("#company").val();
        var country_id = $("#country_id").val();

        var data = {
            ingredient: ingredient,
            name: name,
            supply: supply,
            dosageform: dosageform,
            concentration: concentration,
            drugstore: drugstore,
            atccode: atccode,
            company: company,
            country_id: country_id,
        }

        $.ajax({
            type: "POST",
            url : 'http://127.0.0.1:8000/api/createdrugIngredient',
            data: data,
            success: function(msg){
                window.location.replace('/admin/drug/ingredient')
            }
        });
    })


    $("#edit_drug_ingredient_form").submit(function(e){
        e.preventDefault();

        var drug_ingredient_id = $("#drug_ingredient_id").val();
        var ingredient = $("#ingredient").val();
        var name = $("#name").val();
        var supply = $("#supply").val();
        var dosageform = $("#dosageform").val();
        var concentration = $("#concentration").val();
        var drugstore = $("#drugstore").val();
        var atccode = $("#atccode").val();
        var company = $("#company").val();
        var country_id = $("#country_id").val();

        var data = {
            drug_ingredient_id: drug_ingredient_id,
            ingredient: ingredient,
            name: name,
            supply: supply,
            dosageform: dosageform,
            concentration: concentration,
            drugstore: drugstore,
            atccode: atccode,
            company: company,
            country_id: country_id,
        }

        $.ajax({
            type: "POST",
            url : 'http://127.0.0.1:8000/api/updatedrugIngredient',
            data: data,
            success: function(msg){
                window.location.replace('/admin/drug/ingredient')
            }
        });
    })
})

function deleteDrugIngredient(id){

    var data = {
        id: id
    }

    $.ajax({
        type: "POST",
        url : 'http://127.0.0.1:8000/api/deletedrugIngredient',
        data: data,
        success: function(msg){
            location.replace('/admin/drug/ingredient')
        }
    });
}