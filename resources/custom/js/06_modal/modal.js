$('a.modal-body-content').click(function () {
    $('a.modal-body-content').removeClass('activ');
    $(this).addClass('activ');
    let id = parseInt($(this).attr('id'));
    $('div.verstecken').hide();
    $('div#modal-content-body-' + id).show();
});

