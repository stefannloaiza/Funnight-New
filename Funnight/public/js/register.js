
window.addEventListener("load", function () {

    $("#role").change(function () {

        // console.log('Si esta entrando en el metodo');

        var selected_option = $('#role').val();
        // console.log(selected_option);

        if (selected_option == 2) {
            // user
            $('#roleUser').show();
            $('#roleSite').hide();
        } else if (selected_option == 3) {
            // site
            $('#roleSite').show();
            $('#roleUser').hide();
        } else {
            $('#roleUser').hide();
            $('#roleSite').hide();
        }
    })

});
