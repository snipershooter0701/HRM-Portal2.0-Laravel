var Register = function () {
    return {
        //main function to initiate the module
        init: function () {
            // init background slide images
            $.backstretch([
                "../assets/custom/img/bg/1.jpg",
                "../assets/custom/img/bg/2.jpg",
                "../assets/custom/img/bg/3.jpg",
                "../assets/custom/img/bg/4.jpg"
            ], {
                fade: 1000,
                duration: 8000
            }
            );
        }
    };
}();

$(document).ready(function () {
    Register.init();

    $('#btn-register').click(function () {
        doRegister();
    });
});

/**
 * @description
 *  Do register with Username, Email and Password
 */
function doRegister() {
    // Check validation
    var validateFields = [{
        field_id: 'reg-username',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Name is required.'
        ]
    }, {
        field_id: 'reg-email',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Email is required.',
            'valid_email' + CONST_VALIDATE_SPLITER + 'Email is invalid.'
        ]
    }, {
        field_id: 'reg-password',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Password is required.',
            'min_length[6]' + CONST_VALIDATE_SPLITER + 'Password enter at least 6 characters.',
            'max_length[18]' + CONST_VALIDATE_SPLITER + 'Password enter no more than 18 characters.'
        ]
    }, {
        field_id: 'reg-rpassword',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Confirm password is required.',
            'is_match_field[reg-password]' + CONST_VALIDATE_SPLITER + 'Confirm password is not match'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        name: $('#reg-username').val(),
        email: $('#reg-email').val(),
        password: $('#reg-password').val(),
        password_confirmation: $('#reg-rpassword').val()
    };

    callAjax({
        url: BASE_URL + '/register',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                if (data['is_registered'] == true) {
                    document.location = BASE_URL + '/home';
                }
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                if (errors.name) showValidError("reg-username", errors.name[0]);
                else hideValidError("reg-username");

                if (errors.email) showValidError("reg-email", errors.email[0]);
                else hideValidError("reg-email");

                if (errors.password) showValidError("reg-password", errors.password[0]);
                else hideValidError("reg-password");

                if (errors.rpassword) showValidError("reg-rpassword", errors.rpassword[0]);
                else hideValidError("reg-rpassword");
            }
        }
    });
}