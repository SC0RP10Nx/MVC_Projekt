$(function () {
    if (typeof setUri !== "undefined") {
        let dir = '/ImgUpload/' + setUri + '/';
        $.ajax({
            type: 'POST',
            url: '/Verzeichniserstellung/imgladen/',
            success: function (data) {
                let imgAusDir = JSON.parse(data)
                galerie(imgAusDir);
            }
        });

        let galerie = function (imgAusDir) {

            $('.img_gr').html('<img src="' + dir + imgAusDir[0] + '" alt="img" ' +
                'class="img-thumbnail rounded responsive mx-auto d-block" id="bild_gr">');
            $('.img_gr1').html('<img src="' + dir + imgAusDir[0] + '" alt="img" ' +
                'class="img-thumbnail rounded responsive mx-auto d-block" id="bild_gr1">');


            let ausgabe_img_kl = '';
            $.each(imgAusDir, function (key, value) {
                (key === 0) ? ausgabe_img_kl += '<img src="' + dir + value + '"  ' +
                        'alt="img" class="rounded img-thumbnail responsive img_kl" style="opacity: 1;">' :
                    ausgabe_img_kl += '<img src="' + dir + value + '" ' +
                        'alt="img" class="rounded img-thumbnail responsive img_kl">';
            });
            $('#img_kl').html(ausgabe_img_kl);

            //Aufruf Click auf kleine IMG
            (function () {
                let imgkl = $('.img_kl');
                imgkl.on('click', function () {
                    fadeToImg($(this).attr('src'));
                    animateImgKl(imgkl, $(this));
                });
                imgkl.on('mouseover', function () {
                    $(this).animate(
                        {opacity: "1"});
                });
                imgkl.on('mouseout', function () {
                    if ($(this).attr('src') !== $('#bild_gr1').attr('src')) {
                        $(this).animate(
                            {opacity: "0.3"});
                    }
                });

                $('.right').on('click', function () {
                    let activImg = $('.img_kl[style="opacity: 1;"]')
                    let endImg = dir + imgAusDir[imgAusDir.length - 1];
                    if (endImg !== activImg.attr('src')) {
                        let next = activImg.next().attr('src');
                        fadeToImg(next);
                        animateImgKl(imgkl, imgkl.filter("[src='" + next + "']"));
                    }
                });
                $('.left').on('click', function () {
                    let activImg = $('.img_kl[style="opacity: 1;"]')
                    let anfangImg = dir + imgAusDir[0];
                    if (anfangImg !== activImg.attr('src')) {
                        let prev = activImg.prev().attr('src');
                        fadeToImg(prev);
                        animateImgKl(imgkl, imgkl.filter("[src='" + prev + "']"));
                    }
                });

            })();
        };

        let fadeToImg = function (picturesGr) {
            let imgGr = $('#bild_gr');
            let imgGr1 = $('#bild_gr1');
            $(imgGr).removeAttr("style");
            imgGr1.attr('src', picturesGr);
            imgGr.stop().fadeTo(2000, 0.0, 'swing',function () {
                imgGr.attr('src', picturesGr);
            });
        }
        let animateImgKl = function (imgkl, imgActiv) {
            imgkl.removeAttr("style");
            imgActiv.animate(
                {opacity: "1"},
                {duration: 300})
        }
    }
});