$(document).ready(function () {
    // Update Button (Business Info)
    $('#btn_edit_businfo').click(function () {
        updateBusinessInfo();
    });

    // When Click "Same as invoice address"
    $('#edit_bus_cli_sameas').change(function () {
        var sameAs = document.getElementById('edit_bus_cli_sameas').checked;
        setEditClientAddressFieldsStatus(sameAs);
    });

    $('#edit_bus_inv_apt').keyup(function () {
        // If same as invoice address
        if (document.getElementById('edit_bus_cli_sameas').checked) {
            $('#edit_bus_cli_apt').val($(this).val());
        }
    });

    $('#edit_bus_inv_street').keyup(function () {
        // If same as invoice address
        if (document.getElementById('edit_bus_cli_sameas').checked) {
            $('#edit_bus_cli_street').val($(this).val());
        }
    });

    $('#edit_bus_inv_city').keyup(function () {
        // If same as invoice address
        if (document.getElementById('edit_bus_cli_sameas').checked) {
            $('#edit_bus_cli_city').val($(this).val());
        }
    });

    $('#edit_bus_inv_state').change(function () {
        // If same as invoice address
        if (document.getElementById('edit_bus_cli_sameas').checked) {
            $('#edit_bus_cli_state').val($(this).val());
        }
    });

    $('#edit_bus_inv_country').change(function () {
        var country = $(this).val();
        changeEditBusInvCountry(country);
    });

    $('#edit_bus_inv_zipcode').keyup(function () {
        // If same as invoice address
        if (document.getElementById('edit_bus_cli_sameas').checked) {
            $('#edit_bus_cli_zipcode').val($(this).val());
        }
    });

    $('#create_bus_cli_country').change(function () {
        var country = $(this).val();
        changeAddBusCliCountry(country);
    });
});

/**
 * Create Business Info
 */
function updateBusinessInfo() {
    // Check Validation
    var validateFields = [{
        field_id: 'edit_bus_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Business Name is required.'
        ]
    }, {
        field_id: 'edit_bus_contact_num',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Contact Number is required.'
        ]
    }, {
        field_id: 'edit_bus_client_id',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Contact Number is required.'
        ]
    }, {
        field_id: 'edit_bus_federal_id',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Federal ID is required.',
            'numeric' + CONST_VALIDATE_SPLITER + 'Federal ID will be number.'
        ]
    }, {
        field_id: 'edit_bus_email',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Email is required.',
            'valid_email' + CONST_VALIDATE_SPLITER + 'Email is invalid.',
        ]
    }, {
        field_id: 'edit_bus_website',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Contact Number is required.'
        ]
    }, {
        field_id: 'edit_bus_inv_apt',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Suite/Apt No is required.'
        ]
    }, {
        field_id: 'edit_bus_inv_street',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Street is required.'
        ]
    }, {
        field_id: 'edit_bus_inv_city',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'City/Town is required.'
        ]
    }, {
        field_id: 'edit_bus_inv_state',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'State is required.'
        ]
    }, {
        field_id: 'edit_bus_inv_country',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Country is required.'
        ]
    }, {
        field_id: 'edit_bus_inv_zipcode',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Zip Code is required.'
        ]
    }, {
        field_id: 'edit_bus_cli_apt',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Suite/Apt No is required.'
        ]
    }, {
        field_id: 'edit_bus_cli_street',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Street is required.'
        ]
    }, {
        field_id: 'edit_bus_cli_city',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'City/Town is required.'
        ]
    }, {
        field_id: 'edit_bus_cli_state',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Contact Number is required.'
        ]
    }, {
        field_id: 'edit_bus_cli_country',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Contact Number is required.'
        ]
    }, {
        field_id: 'edit_bus_cli_zipcode',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Contact Number is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        id: $('#edit_client_id').val(),
        business_name: $('#edit_bus_name').val(),
        contact_number: $('#edit_bus_contact_num').val(),
        federal_id: $('#edit_bus_federal_id').val(),
        email: $('#edit_bus_email').val(),
        website: $('#edit_bus_website').val(),
        inv_country_id: $('#edit_bus_inv_country').val(),
        inv_state_id: $('#edit_bus_inv_state').val(),
        inv_city: $('#edit_bus_inv_city').val(),
        inv_street: $('#edit_bus_inv_street').val(),
        inv_suite_aptno: $('#edit_bus_inv_apt').val(),
        inv_zipcode: $('#edit_bus_inv_zipcode').val(),
        addr_country_id: $('#edit_bus_cli_country').val(),
        addr_state_id: $('#edit_bus_cli_state').val(),
        addr_city: $('#edit_bus_cli_city').val(),
        addr_street: $('#edit_bus_cli_street').val(),
        addr_suite_aptno: $('#edit_bus_cli_apt').val(),
        addr_zipcode: $('#edit_bus_cli_zipcode').val(),
    };

    callAjax({
        url: BASE_URL + '/client/list/update_business_info',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                $('#btn_cancel_edit_businfo').trigger('click');

                // Refresh Table.
                refreshClientList();
                toastr.success("Client's business information is successfully updated.", "Success")
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'business_name' + CONST_VALIDATE_SPLITER + 'edit_bus_name',
                    'contact_number' + CONST_VALIDATE_SPLITER + 'edit_bus_contact_num',
                    'federal_id' + CONST_VALIDATE_SPLITER + 'edit_bus_federal_id',
                    'email' + CONST_VALIDATE_SPLITER + 'edit_bus_email',
                    'website' + CONST_VALIDATE_SPLITER + 'edit_bus_website',
                    'inv_country_id' + CONST_VALIDATE_SPLITER + 'edit_bus_inv_country',
                    'inv_state_id' + CONST_VALIDATE_SPLITER + 'edit_bus_inv_state',
                    'inv_city' + CONST_VALIDATE_SPLITER + 'edit_bus_inv_city',
                    'inv_street' + CONST_VALIDATE_SPLITER + 'edit_bus_inv_street',
                    'inv_suite_aptno' + CONST_VALIDATE_SPLITER + 'edit_bus_inv_apt',
                    'inv_zipcode' + CONST_VALIDATE_SPLITER + 'edit_bus_inv_zipcode',
                    'addr_country_id' + CONST_VALIDATE_SPLITER + 'edit_bus_cli_country',
                    'addr_state_id' + CONST_VALIDATE_SPLITER + 'edit_bus_cli_state',
                    'addr_city' + CONST_VALIDATE_SPLITER + 'edit_bus_cli_city',
                    'addr_street' + CONST_VALIDATE_SPLITER + 'edit_bus_cli_street',
                    'addr_suite_aptno' + CONST_VALIDATE_SPLITER + 'edit_bus_cli_apt',
                    'addr_zipcode' + CONST_VALIDATE_SPLITER + 'edit_bus_cli_zipcode',
                ];
                showServerValidationErrors(validationFields, errors);

                toastr.error(err.message, "Error");
            }
        }
    });
}

/**
 * Enable or Disable client address fields by same as invoice address
 */
function setEditClientAddressFieldsStatus(isDisable) {
    if (isDisable) {
        // Set values as same as invoice location.
        $('#edit_bus_cli_apt').val($('#edit_bus_inv_apt').val());
        $('#edit_bus_cli_street').val($('#edit_bus_inv_street').val());
        $('#edit_bus_cli_city').val($('#edit_bus_inv_city').val());
        $('#edit_bus_cli_state').val($('#edit_bus_inv_state').val());
        $('#edit_bus_cli_country').val($('#edit_bus_inv_country').val());
        $('#edit_bus_cli_zipcode').val($('#edit_bus_inv_zipcode').val());

        // Disable all inputs
        $('#edit_bus_cli_apt').prop('disabled', true);
        $('#edit_bus_cli_street').prop('disabled', true);
        $('#edit_bus_cli_city').prop('disabled', true);
        $('#edit_bus_cli_state').prop('disabled', true);
        $('#edit_bus_cli_country').prop('disabled', true);
        $('#edit_bus_cli_zipcode').prop('disabled', true);
    } else {
        $('#edit_bus_cli_apt').prop('disabled', false);
        $('#edit_bus_cli_street').prop('disabled', false);
        $('#edit_bus_cli_city').prop('disabled', false);
        $('#edit_bus_cli_state').prop('disabled', false);
        $('#edit_bus_cli_country').prop('disabled', false);
        $('#edit_bus_cli_zipcode').prop('disabled', false);
    }
}

/**
 * Change Business Invoice location's country -> change state
 */
function changeEditBusInvCountry(country) {
    // If same as invoice address
    if (document.getElementById('edit_bus_cli_sameas').checked) {
        $('#edit_bus_cli_country').val(country);
    }

    var formData = {
        id: country
    };

    callAjax({
        url: BASE_URL + '/client/list/get_states',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var states = data['states'];

                $('#edit_bus_inv_state').html("");
                for (var i in states) {
                    $('#edit_bus_inv_state').append('<option value="' + states[i]['id'] + '">' + states[i]['state_name'] + '</option>')
                }

                // If same as invoice address
                if (document.getElementById('edit_bus_cli_sameas').checked) {
                    $('#edit_bus_cli_state').html("");
                    for (var i in states) {
                        $('#edit_bus_cli_state').append('<option value="' + states[i]['id'] + '">' + states[i]['state_name'] + '</option>')
                    }
                }
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                toastr.error(err.message, "Error");
            }
        }
    });
}

/**
 * Change Business client address's country -> change state
 */
function changeAddBusCliCountry(country) {
    var formData = {
        id: country
    };

    callAjax({
        url: BASE_URL + '/client/list/get_states',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var states = data['states'];
                $('#edit_bus_cli_state').html("");
                for (var i in states) {
                    $('#edit_bus_cli_state').append('<option value="' + states[i]['id'] + '">' + states[i]['state_name'] + '</option>')
                }
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                toastr.error(err.message, "Error");
            }
        }
    });
}