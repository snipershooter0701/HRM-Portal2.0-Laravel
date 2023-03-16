var Login = function () {
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
	Login.init();

	$('#btn-login').click(function () {
		doLogin();
	});
});

/**
 * @description
 * 	Login User with email and pwd.
 */
function doLogin() {
	// Check validation
	var validateFields = [{
		field_id: 'login-email',
		conditions: [
			'required' + CONST_VALIDATE_SPLITER + 'Email is required.',
			'valid_email' + CONST_VALIDATE_SPLITER + 'Email is invalid.'
		]
	}, {
		field_id: 'login-pwd',
		conditions: [
			'required' + CONST_VALIDATE_SPLITER + 'Password is required.',
			'min_length[6]' + CONST_VALIDATE_SPLITER + 'Password enter at least 6 characters.',
			'max_length[18]' + CONST_VALIDATE_SPLITER + 'Password enter no more than 18 characters.'
		]
	}];
	var isValid = doValidationForm(validateFields);
	if (!isValid)
		return;

	var formData = {
		email: $('#login-email').val(),
		password: $('#login-pwd').val()
	};

	callAjax({
		url: BASE_URL + '/login',
		type: "POST",
		data: formData,
		success: function (data) {
			if (data['result'] == 'success') {
				if (data['is_logged_in'] == true) {
					document.location = BASE_URL + '/home';
				}
			}
		},
		error: function (err) {
			var errors = err.errors;
			if (errors) {
				if (errors.email) {
					showValidError("login-email", errors.email[0]);
				}
			}
		}
	});
}