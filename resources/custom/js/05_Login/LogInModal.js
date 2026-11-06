$(function () {
    $('#login').click(function () {
        let username = $('#username').val();
        let password = $('#passwd').val();
        let result = $('.result');
        if (username !== '' && password !== '') {
            $.ajax({
                type: 'POST',
                data: {action: 'login', username: username, passwd: password},
                //data: 'action=login&username='+ username+'&passwd='+password,
                url: '/Kontakt/logincontrollModal',
                success: function (ergText) {
                    if (ergText === 'fehler') {
                        result.html('<span class="error-messages">Username und Password inkorrekt!!!</span>');
                    } else if (ergText === 'io') {
                        window.location = '/Kontakt/zumdatensatz';
                    } else {
                        window.location = '/';
                    }
                }
            })
        } else {
            result.html('<span class="error-messages">Bitte tragen Sie Ihre Zugangsdaten ein!!</span>');
        }
        return false;

    });
});