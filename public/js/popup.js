$(document).ready(function(){
    $("#popup_info").click(function(){
        $(this).addClass("active")
        $("#popup_seller").removeClass("active")
        $("#popup_Doses").removeClass("active")
        $("#popup_concentration").removeClass("active")
        $("#popup_shop").removeClass("active")
        $("#popup_atccode").removeClass("active")
        $("#popup_company").removeClass("active")
        $("#popup_country").removeClass("active")

        $("#info_section").css("display", "block");
        $("#seller_section").css("display", "none");
        $("#doses_section").css("display", "none");
        $("#concentration_section").css("display", "none");
        $("#shop_section").css("display", "none");
        $("#ATCCODE_section").css("display", "none");
        $("#company_section").css("display", "none");
        $("#country_section").css("display", "none");

    });

    $("#popup_seller").click(function(){
        $(this).addClass("active")
        $("#popup_info").removeClass("active")
        $("#popup_Doses").removeClass("active")
        $("#popup_concentration").removeClass("active")
        $("#popup_shop").removeClass("active")
        $("#popup_atccode").removeClass("active")
        $("#popup_company").removeClass("active")
        $("#popup_country").removeClass("active")

        $("#info_section").css("display", "none");
        $("#seller_section").css("display", "block");
        $("#doses_section").css("display", "none");
        $("#concentration_section").css("display", "none");
        $("#shop_section").css("display", "none");
        $("#ATCCODE_section").css("display", "none");
        $("#company_section").css("display", "none");
        $("#country_section").css("display", "none");
    });

    $("#popup_Doses").click(function(){
        $(this).addClass("active")
        $("#popup_info").removeClass("active")
        $("#popup_seller").removeClass("active")
        $("#popup_concentration").removeClass("active")
        $("#popup_shop").removeClass("active")
        $("#popup_atccode").removeClass("active")
        $("#popup_company").removeClass("active")
        $("#popup_country").removeClass("active")

        $("#info_section").css("display", "none");
        $("#seller_section").css("display", "none");
        $("#doses_section").css("display", "block");
        $("#concentration_section").css("display", "none");
        $("#shop_section").css("display", "none");
        $("#ATCCODE_section").css("display", "none");
        $("#company_section").css("display", "none");
        $("#country_section").css("display", "none");
    });

    $("#popup_concentration").click(function(){
        $(this).addClass("active")
        $("#popup_info").removeClass("active")
        $("#popup_Doses").removeClass("active")
        $("#popup_seller").removeClass("active")
        $("#popup_shop").removeClass("active")
        $("#popup_atccode").removeClass("active")
        $("#popup_company").removeClass("active")
        $("#popup_country").removeClass("active")

        $("#info_section").css("display", "none");
        $("#seller_section").css("display", "none");
        $("#doses_section").css("display", "none");
        $("#concentration_section").css("display", "block");
        $("#shop_section").css("display", "none");
        $("#ATCCODE_section").css("display", "none");
        $("#company_section").css("display", "none");
        $("#country_section").css("display", "none");
    });

    $("#popup_shop").click(function(){
        $(this).addClass("active")
        $("#popup_info").removeClass("active")
        $("#popup_Doses").removeClass("active")
        $("#popup_concentration").removeClass("active")
        $("#popup_seller").removeClass("active")
        $("#popup_atccode").removeClass("active")
        $("#popup_company").removeClass("active")
        $("#popup_country").removeClass("active")

        $("#info_section").css("display", "none");
        $("#seller_section").css("display", "none");
        $("#doses_section").css("display", "none");
        $("#concentration_section").css("display", "none");
        $("#shop_section").css("display", "block");
        $("#ATCCODE_section").css("display", "none");
        $("#company_section").css("display", "none");
        $("#country_section").css("display", "none");
    });

    $("#popup_atccode").click(function(){
        $(this).addClass("active")
        $("#popup_info").removeClass("active")
        $("#popup_Doses").removeClass("active")
        $("#popup_concentration").removeClass("active")
        $("#popup_shop").removeClass("active")
        $("#popup_seller").removeClass("active")
        $("#popup_company").removeClass("active")
        $("#popup_country").removeClass("active")

        $("#info_section").css("display", "none");
        $("#seller_section").css("display", "none");
        $("#doses_section").css("display", "none");
        $("#concentration_section").css("display", "none");
        $("#shop_section").css("display", "none");
        $("#ATCCODE_section").css("display", "block");
        $("#company_section").css("display", "none");
        $("#country_section").css("display", "none");
    });

    $("#popup_company").click(function(){
        $(this).addClass("active")
        $("#popup_info").removeClass("active")
        $("#popup_Doses").removeClass("active")
        $("#popup_concentration").removeClass("active")
        $("#popup_shop").removeClass("active")
        $("#popup_atccode").removeClass("active")
        $("#popup_seller").removeClass("active")
        $("#popup_country").removeClass("active")

        $("#info_section").css("display", "none");
        $("#seller_section").css("display", "none");
        $("#doses_section").css("display", "none");
        $("#concentration_section").css("display", "none");
        $("#shop_section").css("display", "none");
        $("#ATCCODE_section").css("display", "none");
        $("#company_section").css("display", "block");
        $("#country_section").css("display", "none");
    });

    $("#popup_country").click(function(){
        $(this).addClass("active")
        $("#popup_info").removeClass("active")
        $("#popup_Doses").removeClass("active")
        $("#popup_concentration").removeClass("active")
        $("#popup_shop").removeClass("active")
        $("#popup_atccode").removeClass("active")
        $("#popup_company").removeClass("active")
        $("#popup_seller").removeClass("active")

        $("#info_section").css("display", "none");
        $("#seller_section").css("display", "none");
        $("#doses_section").css("display", "none");
        $("#concentration_section").css("display", "none");
        $("#shop_section").css("display", "none");
        $("#ATCCODE_section").css("display", "none");
        $("#company_section").css("display", "none");
        $("#country_section").css("display", "block");
    });
})