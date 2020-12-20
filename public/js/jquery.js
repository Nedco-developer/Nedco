$(document).ready(function(){

    $("#patients_profile_table").dataTable({
        "lengthChange": false
    });

    $("#doctors_appointments_table").dataTable({
        "lengthChange": false
    });

    $("#patients_files_table").dataTable({
        "lengthChange": false,
        searching: false
    });

    $("#patients_prescription_table").dataTable({
        "lengthChange": false,
        searching: false
    });

    $("#patients_notice_table").dataTable({
        "lengthChange": false,
        searching: false
    });

    $("#patients_appointments_table").dataTable({
        "lengthChange": false,
    });

    $("#patients_diaries_table_recipes").dataTable({
        "lengthChange": false,
    });

    $("#patients_diaries_table_files").dataTable({
        "lengthChange": false,
    });

    $(".dates").daterangepicker();

    $("#tel_input").intlTelInput({
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js"
    });

    $(".paginate_button").each(function(){
        $(this).attr("style", "color:white!important;background:#4188c6");
    })

    $(".sorting_asc").click(function(){
        $(".paginate_button").each(function(){
            $(this).attr("style", "color:white!important;background:#4188c6");
        })
    })

    $(".sorting_desc").click(function(){
        $(".paginate_button").each(function(){
            $(this).attr("style", "color:white!important;background:#4188c6");
        })
    })

    $(".sorting").click(function(){
        $(".paginate_button").each(function(){
            $(this).attr("style", "color:white!important;background:#4188c6");
        })
    })


    $("#files_send_to").click(function(){
        window.location.href = "/doctors/diaries"
    })

    $("#files_recipes_to").click(function(){
        window.location.href = "/doctors/prescriptions"
    })

    $('#summernote').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['height', ['height']]
        ]
    });
})

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result)
                .width(150)
                .height(100);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

