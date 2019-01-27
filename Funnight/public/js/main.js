
// var url = 'http://127.0.0.1:8000';
var url = location.protocol + '//' + location.host;
window.addEventListener("load", function () {

    console.log('la url es:' + url);

    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');



    // boton de like
    function countLikes() {
        $.ajax({
            url: url + '/countLikes/' + $('.btn-like').data('id'),
            type: 'GET',
            success: function (response) {
                // numberLike
                console.log(response.numberLike);
                $(".number_likes").text(response.numberLike);
            }
        });
    }

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
                        setTimeout(function () {
                            countLikes();
                        }, 9000);
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
                        countLikes();
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
        console.log('rating...');
        $.ajax({
            url: url + '/rating/' + $('.btn-stars').data('id') + "/" + $('.btn-stars').val(),
            method: "get",
            type: 'get',
            crossDomain: true,
            contentType: 'application/json',
            // dataType: 'jsonp',
            timeout: 8000, // sets timeout to 3 seconds
            success: function (response) {

                if (response.finish) {
                    console.log('has calificado la publicacion');
                } else {
                    console.log('Error al dar la calificacion');
                }
            }
        });
    }
    $('.btn-stars').unbind('click').click(function () {
        console.log('call rating');

        setTimeout(function () {
            rateImage();
        }, 1000);
    });
});