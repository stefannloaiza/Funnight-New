window.addEventListener("load", function () {

    function manageActivity() {

        $("#estSeguidos").click(function () {

            $("#divSeguido").show();

            $("#divAmigos").hide();
            $("#divGustos").hide();


            $("#estSeguidos").addClass("btn-info");

            $("#estAmigos").removeClass("btn-info");
            $("#estAmigos").addClass("btn-primary");
            $("#estGustos").removeClass("btn-info");
            $("#estGustos").addClass("btn-primary");

        })

        $("#estAmigos").click(function () {

            $("#divAmigos").show();

            $("#divSeguido").hide();
            $("#divGustos").hide();


            $("#estAmigos").addClass("btn-info");

            $("#estSeguidos").removeClass("btn-info");
            $("#estSeguidos").addClass("btn-primary");
            $("#estGustos").removeClass("btn-info");
            $("#estGustos").addClass("btn-primary");
        })

        $("#estGustos").click(function () {

            $("#divGustos").show();

            $("#divAmigos").hide();
            $("#divSeguido").hide();


            $("#estGustos").addClass("btn-info");

            $("#estAmigos").removeClass("btn-info");
            $("#estAmigos").addClass("btn-primary");
            $("#estSeguidos").removeClass("btn-info");
            $("#estSeguidos").addClass("btn-primary");
        })
    }
    manageActivity();
});