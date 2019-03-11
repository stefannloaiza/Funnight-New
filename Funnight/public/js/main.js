
// var url = 'http://127.0.0.1:8000';
var url = location.protocol + '//' + location.host;
window.addEventListener("load", function () {

    console.log('la url es:' + url);

    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    //
    // Metodo para obtener las fechas dependiendo del tipo de publcacion.
    //

    // function getDatesPubs() {
    //     $.ajax({
    //         url: url + '/image/dates/' + $('.btn-like').data('id'),
    //         type: 'GET',
    //         success: function (response) {
    //             // dates of pubs.
    //             console.log(response.dates);
    //             $(".datesPubs").text(response.dates);
    //         }
    //     });
    // }

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
                        }, 600);
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
        }, 600);
    });


    /**
     *  Metodo para seguir un usuario a un establecimiento.
     */
    function followSite() {

        $('.followSite').click(function () {
            console.log('following...');

            $.ajax({
                url: url + '/seguir/' + $(this).attr('id'),
                type: 'GET',
                success: function (response) {
                    // console.log(response);
                    if (response.finish) {

                        $(".unfollowSite").removeAttr('hidden');
                        $(".unfollowSite").show();
                        $('.followSite').hide();

                    } else {
                        console.log('Error al dar dislike');
                    }
                }
            });

        });
    }
    // Execute
    followSite();

    /**
     *  Metodo para seguir un usuario a un establecimiento.
     */
    function unFollowSite() {

        $('.unfollowSite').click(function () {
            console.log('unfollowing...');

            $.ajax({
                url: url + '/dejarSeguir/' + $(this).attr('id'),
                type: 'GET',
                success: function (response) {
                    if (response.finish) {

                        $(".followSite").removeAttr('hidden');
                        $(".followSite").show();
                        $('.unfollowSite').hide();

                    } else {
                        console.log('Error al borrar');
                    }
                }
            });

        });
    }
    // Execute
    unFollowSite();


    /**
     * Metodo para que un usuario siga otro usuario como amigo.
     */
    function followFriend() {
        $('.followFriend').click(function () {
            console.log('following...');

            $.ajax({
                url: url + '/seguirAmigo/' + $(this).attr('id'),
                type: 'GET',
                success: function (response) {
                    if (response.finish) {

                        $(".unFollowFriend").removeAttr('hidden');
                        $(".unFollowFriend").show();
                        $('.followFriend').hide();

                    } else {
                        console.log('Error al borrar');
                    }
                }
            });

        });
    }
    // Run
    followFriend();


    /**
     * Metodo para dejar de seguir un amigo.
     */
    function unFollowFriend() {
        $('.unFollowFriend').click(function () {
            console.log('unFollowing...');

            $.ajax({
                url: url + '/dejarAmigo/' + $(this).attr('id'),
                type: 'GET',
                success: function (response) {
                    if (response.finish) {

                        $(".followFriend").removeAttr('hidden');
                        $(".followFriend").show();
                        $('.unFollowFriend').hide();

                    } else {
                        console.log('Error al borrar');
                    }
                }
            });

        });
    }
    unFollowFriend();
});