$(document).ready(function () {
    // Default Disable Client Address fields
    setAddClientAddressFieldsStatus(true);

    // Create Button (Business Info)
    $('#btn_create_businfo').click(function () {
        createBusinessInfo();
    });

    // When Click "Same as invoice address"
    $('#create_bus_cli_sameas').change(function () {
        var sameAs = document.getElementById('create_bus_cli_sameas').checked;
        setAddClientAddressFieldsStatus(sameAs);
    });

    $('#create_bus_inv_apt').keyup(function () {
        // If same as invoice address
        if (document.getElementById('create_bus_cli_sameas').checked) {
            $('#create_bus_cli_apt').val($(this).val());
        }
    });

    $('#create_bus_inv_street').keyup(function () {
        // If same as invoice address
        if (document.getElementById('create_bus_cli_sameas').checked) {
            $('#create_bus_cli_street').val($(this).val());
        }
    });

    $('#create_bus_inv_city').keyup(function () {
        // If same as invoice address
        if (document.getElementById('create_bus_cli_sameas').checked) {
            $('#create_bus_cli_city').val($(this).val());
        }
    });

    $('#create_bus_inv_state').change(function () {
        // If same as invoice address
        if (document.getElementById('create_bus_cli_sameas').checked) {
            $('#create_bus_cli_state').val($(this).val());
        }
    });

    $('#create_bus_inv_country').change(function () {
        var country = $(this).val();
        changeAddBusInvCountry(country);
    });

    $('#create_bus_inv_zipcode').keyup(function () {
        // If same as invoice address
        if (document.getElementById('create_bus_cli_sameas').checked) {
            $('#create_bus_cli_zipcode').val($(this).val());
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
function createBusinessInfo() {
    // Check Validation
    var validateFields = [{
        field_id: 'create_bus_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Business Name is required.'
        ]
    }, {
        field_id: 'create_bus_contact_num',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Contact Number is required.'
        ]
    }, {
        field_id: 'create_bus_client_id',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Contact Number is required.'
        ]
    }, {
        field_id: 'create_bus_federal_id',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Federal ID is required.',
            'numeric' + CONST_VALIDATE_SPLITER + 'Federal ID will be number.'
        ]
    }, {
        field_id: 'create_bus_email',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Email is required.',
            'valid_email' + CONST_VALIDATE_SPLITER + 'Email is invalid.',
        ]
    }, {
        field_id: 'create_bus_website',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Contact Number is required.'
        ]
    }, {
        field_id: 'create_bus_inv_apt',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Suite/Apt No is required.'
        ]
    }, {
        field_id: 'create_bus_inv_street',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Street is required.'
        ]
    }, {
        field_id: 'create_bus_inv_city',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'City/Town is required.'
        ]
    }, {
        field_id: 'create_bus_inv_state',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'State is required.'
        ]
    }, {
        field_id: 'create_bus_inv_country',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Country is required.'
        ]
    }, {
        field_id: 'create_bus_inv_zipcode',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Zip Code is required.'
        ]
    }, {
        field_id: 'create_bus_cli_apt',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Suite/Apt No is required.'
        ]
    }, {
        field_id: 'create_bus_cli_street',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Street is required.'
        ]
    }, {
        field_id: 'create_bus_cli_city',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'City/Town is required.'
        ]
    }, {
        field_id: 'create_bus_cli_state',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Contact Number is required.'
        ]
    }, {
        field_id: 'create_bus_cli_country',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Contact Number is required.'
        ]
    }, {
        field_id: 'create_bus_cli_zipcode',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Contact Number is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        business_name: $('#create_bus_name').val(),
        contact_number: $('#create_bus_contact_num').val(),
        federal_id: $('#create_bus_federal_id').val(),
        email: $('#create_bus_email').val(),
        website: $('#create_bus_website').val(),
        inv_country_id: $('#create_bus_inv_country').val(),
        inv_state_id: $('#create_bus_inv_state').val(),
        inv_city: $('#create_bus_inv_city').val(),
        inv_street: $('#create_bus_inv_street').val(),
        inv_suite_aptno: $('#create_bus_inv_apt').val(),
        inv_zipcode: $('#create_bus_inv_zipcode').val(),
        addr_sameas: document.getElementById('create_bus_cli_sameas').checked ? 1 : 0,
        addr_country_id: $('#create_bus_cli_country').val(),
        addr_state_id: $('#create_bus_cli_state').val(),
        addr_city: $('#create_bus_cli_city').val(),
        addr_street: $('#create_bus_cli_street').val(),
        addr_suite_aptno: $('#create_bus_cli_apt').val(),
        addr_zipcode: $('#create_bus_cli_zipcode').val(),
    };

    callAjax({
        url: BASE_URL + '/client/list/create_business_info',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Init all inputs.
                $('#create_bus_name').val("");
                $('#create_bus_contact_num').val("");
                $('#create_bus_federal_id').val("");
                $('#create_bus_email').val("");
                $('#create_bus_website').val("");
                $('#create_bus_inv_country').val("US");
                $('#create_bus_inv_city').val("");
                $('#create_bus_inv_street').val("");
                $('#create_bus_inv_apt').val("");
                $('#create_bus_inv_zipcode').val("");
                document.getElementById('create_bus_cli_sameas').checked = true;
                $('#create_bus_cli_country').val("");
                $('#create_bus_cli_state').val("");
                $('#create_bus_cli_city').val("");
                $('#create_bus_cli_street').val("");
                $('#create_bus_cli_apt').val("");
                $('#create_bus_cli_zipcode').val("");

                // Refresh Table.
                refreshClientList();
                toastr.success("Client's business information is successfully created.", "Success")

                // Go to List page
                $('#btn_cancel_businfo').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'business_name' + CONST_VALIDATE_SPLITER + 'create_bus_name',
                    'contact_number' + CONST_VALIDATE_SPLITER + 'create_bus_contact_num',
                    'federal_id' + CONST_VALIDATE_SPLITER + 'create_bus_federal_id',
                    'email' + CONST_VALIDATE_SPLITER + 'create_bus_email',
                    'website' + CONST_VALIDATE_SPLITER + 'create_bus_website',
                    'inv_country_id' + CONST_VALIDATE_SPLITER + 'create_bus_inv_country',
                    'inv_state_id' + CONST_VALIDATE_SPLITER + 'create_bus_inv_state',
                    'inv_city' + CONST_VALIDATE_SPLITER + 'create_bus_inv_city',
                    'inv_street' + CONST_VALIDATE_SPLITER + 'create_bus_inv_street',
                    'inv_suite_aptno' + CONST_VALIDATE_SPLITER + 'create_bus_inv_apt',
                    'inv_zipcode' + CONST_VALIDATE_SPLITER + 'create_bus_inv_zipcode',
                    'addr_country_id' + CONST_VALIDATE_SPLITER + 'create_bus_cli_country',
                    'addr_state_id' + CONST_VALIDATE_SPLITER + 'create_bus_cli_state',
                    'addr_city' + CONST_VALIDATE_SPLITER + 'create_bus_cli_city',
                    'addr_street' + CONST_VALIDATE_SPLITER + 'create_bus_cli_street',
                    'addr_suite_aptno' + CONST_VALIDATE_SPLITER + 'create_bus_cli_apt',
                    'addr_zipcode' + CONST_VALIDATE_SPLITER + 'create_bus_cli_zipcode',
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
function setAddClientAddressFieldsStatus(isDisable) {
    if (isDisable) {
        // Set values as same as invoice location.
        $('#create_bus_cli_apt').val($('#create_bus_inv_apt').val());
        $('#create_bus_cli_street').val($('#create_bus_inv_street').val());
        $('#create_bus_cli_city').val($('#create_bus_inv_city').val());
        $('#create_bus_cli_state').val($('#create_bus_inv_state').val());
        $('#create_bus_cli_country').val($('#create_bus_inv_country').val());
        $('#create_bus_cli_zipcode').val($('#create_bus_inv_zipcode').val());

        // Disable all inputs
        $('#create_bus_cli_apt').prop('disabled', true);
        $('#create_bus_cli_street').prop('disabled', true);
        $('#create_bus_cli_city').prop('disabled', true);
        $('#create_bus_cli_state').prop('disabled', true);
        $('#create_bus_cli_country').prop('disabled', true);
        $('#create_bus_cli_zipcode').prop('disabled', true);
    } else {
        $('#create_bus_cli_apt').prop('disabled', false);
        $('#create_bus_cli_street').prop('disabled', false);
        $('#create_bus_cli_city').prop('disabled', false);
        $('#create_bus_cli_state').prop('disabled', false);
        $('#create_bus_cli_country').prop('disabled', false);
        $('#create_bus_cli_zipcode').prop('disabled', false);
    }
}

/**
 * Change Business Invoice location's country -> change state
 */
function changeAddBusInvCountry(country) {
    // If same as invoice address
    if (document.getElementById('create_bus_cli_sameas').checked) {
        $('#create_bus_cli_country').val(country);
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

                $('#create_bus_inv_state').html("");
                for (var i in states) {
                    $('#create_bus_inv_state').append('<option value="' + states[i]['id'] + '">' + states[i]['state_name'] + '</option>')
                }

                // If same as invoice address
                if (document.getElementById('create_bus_cli_sameas').checked) {
                    $('#create_bus_cli_state').html("");
                    for (var i in states) {
                        $('#create_bus_cli_state').append('<option value="' + states[i]['id'] + '">' + states[i]['state_name'] + '</option>')
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
                $('#create_bus_cli_state').html("");
                for (var i in states) {
                    $('#create_bus_cli_state').append('<option value="' + states[i]['id'] + '">' + states[i]['state_name'] + '</option>')
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