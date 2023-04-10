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
        field_id: 'reg_firstname',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'First Name is required.'
        ]
    }, {
        field_id: 'reg_lastname',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Last Name is required.'
        ]
    }, {
        field_id: 'reg_email',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Email is required.',
            'valid_email' + CONST_VALIDATE_SPLITER + 'Email is invalid.'
        ]
    }, {
        field_id: 'reg_phoneno',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Phone Number is required.'
        ]
    }, {
        field_id: 'reg_poc',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Email is required.',
            // 'valid_email' + CONST_VALIDATE_SPLITER + 'Email is invalid.'
        ]
    }
        // {
        //     field_id: 'reg-password',
        //     conditions: [
        //         'required' + CONST_VALIDATE_SPLITER + 'Password is required.',
        //         'min_length[6]' + CONST_VALIDATE_SPLITER + 'Password enter at least 6 characters.',
        //         'max_length[18]' + CONST_VALIDATE_SPLITER + 'Password enter no more than 18 characters.'
        //     ]
        // }, {
        //     field_id: 'reg-rpassword',
        //     conditions: [
        //         'required' + CONST_VALIDATE_SPLITER + 'Confirm password is required.',
        //         'is_match_field[reg-password]' + CONST_VALIDATE_SPLITER + 'Confirm password is not match'
        //     ]
        // }
    ];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        first_name: $('#reg_firstname').val(),
        last_name: $('#reg_lastname').val(),
        email: $('#reg_email').val(),
        phone_no: $('#reg_phoneno').val(),
        poc: $('#reg_poc').val(),
    };

    callAjax({
        url: BASE_URL + '/user_signup',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                toastr.success("Your signup request is successfully sent. Please wait until you receive our email.", "Success");
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

                toastr.error(err.message, "Error");
            }
        }
    });
}