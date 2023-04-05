$(document).ready(function () {

    $('#btn_generate').click(function () {
        callAjax({
            url: BASE_URL + '/home/gen',
            type: "POST",
            data: {
                encKey: $('#enc_key').val(),
            },
            success: function (data) {
                if (data['result'] == 'success') {
                    $('#email').val(data['decryption']);
                }
            },
            error: function (err) {
                var errors = err.errors;
            }
        });
    });
});