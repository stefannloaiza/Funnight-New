
var url = 'http://localhost:8000';
window.addEventListener("load", function () {


    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    //boton de like
    function like() {
        $('.btn-like').unbind('click').click(function () {
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url + '/img/heart-red.png');

            $.ajax({
                url: url + '/like/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('has dado like a la publicacion');
                        
                        // $(".number_likes").text("");
                    } else {
                        console.log('Error al dar like');
                    }
                }
            });

            dislike();
        });
    }
    like();



    //boton de dislike
    function dislike() {
        $('.btn-dislike').unbind('click').click(function () {
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url + '/img/heart-black.png');

            $.ajax({
                url: url + '/dislike/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('has dado dislike a la publicacion');
                    } else {
                        console.log('Error al dar dislike');
                    }
                }
            });


            like();
        });
    }
    dislike();


    // BUSCADOR

    $('#buscador').submit(function (e) {

        $(this).attr('action', url + '/gente/' + $('#buscador #search').val());

    });


    // RATING

    //  Metodo RATING
    function rateImage() {
        $('.btn-stars').unbind('click').click(function () {
            console.log('rating this image');

            $.ajax({
                url: url + '/rating/' + $(this).data('id') + "/" + $(this).val(),
                type: 'POST',
                success: function (response) {
                    if (response.like) {
                        console.log('has calificado la publicacion');
                    } else {
                        console.log('Error al dar la calificacion');
                    }
                }
            });
        });
    }
    rateImage();
});