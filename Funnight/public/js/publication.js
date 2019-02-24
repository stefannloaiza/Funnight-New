
window.addEventListener("load", function () {

    $("#tipoPub").change(function () {

        var selected_option = $('#tipoPub').val();

        if (selected_option == 1) {
            // promotion
            $('#promotion').show();
            $('#event').hide();
            // $("#roleSite :input").removeAttr('required');
            // $("#roleUser :input").attr("required", "required");
        } else if (selected_option == 2) {
            // event
            $('#event').show();
            $('#promotion').hide();
            // $("#roleUser :input").removeAttr('required');
            // $("#roleSite :input").attr("required", "required");
        } else {
            $('#promotion').hide();
            $('#event').hide();
            // $("#promotion").removeAttr('required');
            // $("#event").removeAttr('required');
        }
    })


    
});