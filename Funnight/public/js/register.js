
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


    $("#paisId").change(function () {

        var pais = $("#paisId").val()

        $.ajax({
            data: { cod_pais: pais },
            url: 'ajaxGetCiudad',
            type: 'get',
            beforeSend: function () {
                select = '<option value="0">Procesando....</option>';
                $("#ciudad").html(select);
            },
            success: function (jsonData) {
                select = '<select name="position" class="form-control input-sm " required id="position" >';
                for(var i in jsonData){
                    select += '<option value="' + jsonData[i].id + '">' + jsonData[i].nombre + '</option>';
                };
                select += '</select>';
                $("#ciudad").html(select);
                
            }
        });
        
    });

});
