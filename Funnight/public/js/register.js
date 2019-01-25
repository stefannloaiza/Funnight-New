
window.addEventListener("load", function () {

    $("#role").change(function () {

        // console.log('Si esta entrando en el metodo');

        var selected_option = $('#role').val();
        // console.log(selected_option);

        if (selected_option == 2) {
            // user
            $('#roleUser').show();
            $('#roleSite').hide();
            $("#roleSite :input").removeAttr('required');
            $("#roleUser :input").attr("required", "required");
        } else if (selected_option == 3) {
            // site
            $('#roleSite').show();
            $('#roleUser').hide();
            $("#roleUser :input").removeAttr('required');
            $("#roleSite :input").attr("required", "required");
        } else {
            $('#roleUser').hide();
            $('#roleSite').hide();
            $("#roleUser :input").removeAttr('required');
            $("#roleSite :input").removeAttr('required');
        }
    })


    $("#paisSite").change(function () {

        var pais = $("#paisSite").val()

        if (pais == "") {
            $("#ciudadSite").attr("disabled", "disables");
        } else {
            $("#ciudadSite").removeAttr("disabled");
        }

        $.ajax({
            data: { cod_pais: pais },
            url: 'ajaxGetCiudad',
            type: 'get',
            beforeSend: function () {
                select = '<option value="0">Procesando....</option>';
                $("#ciudadSite").html(select);
            },
            success: function (jsonData) {
                // select = '<select name="position" class="form-control input-sm " required id="position" >';

                select = '<option value="0">Selecciona la ciudad</option>';
                for (var i in jsonData) {
                    select += '<option value="' + jsonData[i].id + '">' + jsonData[i].nombre + '</option>';
                };
                // select += '</select>';
                $("#ciudadSite").html(select);



            }

        });

    });

    $("#paisUser").change(function () {

        var pais = $("#paisUser").val()

        if (pais == "") {
            $("#ciudadUser").attr("disabled", "disables");
        } else {
            $("#ciudadUser").removeAttr("disabled");
        }

        $.ajax({
            data: { cod_pais: pais },
            url: 'ajaxGetCiudad',
            type: 'get',
            beforeSend: function () {
                select = '<option value="0">Procesando....</option>';
                $("#ciudadUser").html(select);
            },
            success: function (jsonData) {
                // select = '<select name="position" class="form-control input-sm " required id="position" >';
                select = '<option value="0">Selecciona la ciudad</option>';
                for (var i in jsonData) {
                    select += '<option value="' + jsonData[i].id + '">' + jsonData[i].nombre + '</option>';
                };
                // select += '</select>';
                $("#ciudadUser").html(select);

            }
        });

    });


});
