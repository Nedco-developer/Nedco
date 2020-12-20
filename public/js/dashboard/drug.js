$(document).ready(function(){

    $("#create_drug_form").submit(function(e){
        e.preventDefault();

        var name = $("#drug_name").val();
        var code = $("#drug_code").val();
        var unit= $("#drug_unit").val();
        var group = $("#drug_group").val();
        var barcode = $("#drug_barcode").val();
        var sale_tax = $("#drug_sale_tax").val();
        var purchase_tax = $("#drug_purchase_tax").val();
        var sale_tax_free = $("#drug_sale_tax_free").val();
        var purchase_tax_free = $("#drug_purchase_tax_free").val();
        var price_symbol = $("#drug_price_symbol").val();
        var price = $("#drug_price").val();

        var data = {
            name: name,
            code: code,
            unit: unit,
            group: group,
            barcode: barcode,
            sale_tax: sale_tax,
            purchase_tax: purchase_tax,
            sale_tax_free: sale_tax_free,
            purchase_tax_free: purchase_tax_free,
            price_symbol: price_symbol,
            price: price
        }

        $.ajax({
            type: "POST",
            url : 'http://127.0.0.1:8000/api/createdrug',
            data: data,
            success: function(msg){
                window.location.replace('/admin/drug')
            }
        });
    })


    $("#edit_drug_form").submit(function(e){
        e.preventDefault();
        var drug_id = $("#drug_id").val();
        var name = $("#drug_edit_name").val();
        var code = $("#drug_edit_code").val();
        var unit= $("#drug_edit_unit").val();
        var group = $("#drug_edit_group").val();
        var barcode = $("#drug_edit_barcode").val();
        var sale_tax = $("#drug_edit_sale_tax").val();
        var purchase_tax = $("#drug_edit_purchase_tax").val();
        var sale_tax_free = $("#drug_edit_sale_tax_free").val();
        var purchase_tax_free = $("#drug_edit_purchase_tax_free").val();
        var price_symbol = $("#drug_edit_price_symbol").val();
        var price = $("#drug_edit_price").val();

        var data = {
            drug_id: drug_id,
            name: name,
            code: code,
            unit: unit,
            group: group,
            barcode: barcode,
            sale_tax: sale_tax,
            purchase_tax: purchase_tax,
            sale_tax_free: sale_tax_free,
            purchase_tax_free: purchase_tax_free,
            price_symbol: price_symbol,
            price: price
        }

        console.log(data);
        $.ajax({
            type: "POST",
            url : 'http://127.0.0.1:8000/api/updatedrug',
            data: data,
            success: function(msg){
                window.location.replace('/admin/drug')
            }
        });
    })
})

function deleteDrug(id){

    var data = {
        id: id
    }

    $.ajax({
        type: "POST",
        url : 'http://127.0.0.1:8000/api/deletedrug',
        data: data,
        success: function(msg){
            location.replace('/admin/drug')
        }
    });
}