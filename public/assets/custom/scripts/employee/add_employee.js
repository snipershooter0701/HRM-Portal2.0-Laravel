$(document).ready(function () {
    // create employee
    $('#signup_employee').click(function () {
        addEmployee();
    });

    // pay classification
    $('#create_pay_scale').change(function () {
        var pay_scale = $(this).val();
        payscale_validate(pay_scale);
    });
});

function payscale_validate(pay_scale) {
    if (pay_scale == '1') {
        $('#pay_classification').html(
            '<div class="form-group col-md-2">' +
            '<label class="control-label">Pay Rate/hr <span class="required" aria-required="true">*</span></label>' +
            '<input type="text" class="form-control" value="75" id="create_pay_rate_val">' +
            '</div>' +
            '<div class="form-group col-md-2">' +
            '<label class="control-label">Change After Hrs <span class="required" aria-required="true">*</span></label>' +
            '<input type="text" class="form-control" value="1920" id="create_pay_rate_hrs">' +
            '</div>' +
            '<div class="form-group col-md-2">' +
            '<label class="control-label">Change Pay Rate to <span class="required" aria-required="true">*</span></label>' +
            '<input type="text" class="form-control" value="80" id="create_pay_rate_to">' +
            '</div>'
        );
    } else {
        $('#pay_classification').html(
            '<div class="form-group col-md-2">' +
            '<label class="control-label">Pay % <span class="required" aria-required="true">*</span></label>' +
            '<input type="text" class="form-control" value="75" id="create_pay_percent_val">' +
            '</div>' +
            '<div class="form-group col-md-2">' +
            '<label class="control-label">Change After Hrs <span class="required" aria-required="true">*</span></label>' +
            '<input type="text" class="form-control" value="1920" id="create_pay_percent_hrs">' +
            '</div>' +
            '<div class="form-group col-md-2">' +
            '<label class="control-label">Change Pay % to <span class="required" aria-required="true">*</span></label>' +
            '<input type="text" class="form-control" value="80" id="create_pay_percent_to">' +
            '</div>'
        );
    }
}

function addEmployee() {

    // validation TODO
    var validateFields = [{
        field_id: 'create_first_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'First Name field is required.'
        ]
    }, {
        field_id: 'create_last_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Last Number field is required.'
        ]
    }, {
        field_id: 'create_title',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Title field is required.'
        ]
    }, {
        field_id: 'create_email_address',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Email Address field is required.',
            'valid_email' + CONST_VALIDATE_SPLITER + 'Email Address field is invalid.'
        ]
    }, {
        field_id: 'create_phone_num',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Phone Number field is required.'
        ]
    }, {
        field_id: 'create_birth',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Date of Birth field is required.'
        ],
        level: 'depth'
    }, {
        field_id: 'create_join',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Date of Joining field is required.'
        ],
        level: 'depth'
    }, {
        field_id: 'create_gender',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Gender field is required.'
        ]
    }, {
        field_id: 'create_employment_type',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Employment Type field is required.'
        ]
    }, {
        field_id: 'create_category',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Category field is required.'
        ]
    }, {
        field_id: 'create_employee_type',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Employee Type field is required.'
        ]
    }, {
        field_id: 'create_employee_id',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Employee ID field is required.'
        ]
    }, {
        field_id: 'create_employee_status',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Employee Status field is required.'
        ]
    }, {
        field_id: 'create_role',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Role field is required.'
        ]
    }, {
        field_id: 'create_poc',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'POC field is required.'
        ]
    }, {
        field_id: 'create_classification',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Classification field is required.'
        ]
    }, {
        field_id: 'create_emp_street',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Street field is required.'
        ]
    }, {
        field_id: 'create_emp_apt',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Suite/Apt No field is required.'
        ]
    }, {
        field_id: 'create_emp_city',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'City/Town field is required.'
        ]
    },
    {
        field_id: 'create_emp_state',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'State field is required.'
        ]
    },
    {
        field_id: 'create_emp_country',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Country field is required.'
        ]
    },
    {
        field_id: 'create_emp_zipcode',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Zipcode field is required.'
        ]
    }];

    var payScaleFlag = $('#create_pay_scale').val();

    if (payScaleFlag == '0') {
        validateFields.push(
            {
                field_id: 'create_pay_percent_val',
                conditions: [
                    'required' + CONST_VALIDATE_SPLITER + 'Pay % field is required.'
                ]
            },
            {
                field_id: 'create_pay_percent_hrs',
                conditions: [
                    'required' + CONST_VALIDATE_SPLITER + 'Change After Hrs field is required.'
                ]
            },
            {
                field_id: 'create_pay_percent_to',
                conditions: [
                    'required' + CONST_VALIDATE_SPLITER + 'Change Pay % field is required.'
                ]
            }
        );
    } else {
        validateFields.push(
            {
                field_id: 'create_pay_rate_val',
                conditions: [
                    'required' + CONST_VALIDATE_SPLITER + 'Pay Rate/hr field is required.'
                ]
            },
            {
                field_id: 'create_pay_rate_hrs',
                conditions: [
                    'required' + CONST_VALIDATE_SPLITER + 'Change After Hrs field is required.'
                ]
            },
            {
                field_id: 'create_pay_rate_to',
                conditions: [
                    'required' + CONST_VALIDATE_SPLITER + 'Change Pay Rate to field is required.'
                ]
            }
        );
    }

    var isValid = doValidationForm(validateFields);
    // if (!isValid)
    //     return;

    // var formData = {
    //     first_name: $('#create_first_name').val(),
    //     last_name: $('#create_last_name').val(),
    //     title: $('#create_title').val(),
    //     email_address: $('#create_email_address').val(),
    //     phone_num: $('#create_phone_num').val(),
    //     birth: $('#create_birth').val(),
    //     join_date: $('#create_join').val(),
    //     gender: $('#create_gender').val(),
    //     employment_type: $('#create_employment_type').val(),
    //     category: $('#create_category').val(),
    //     employee_type: $('#create_employee_type').val(),
    //     employee_status: $('#create_employee_status').val(),
    //     role: $('#create_role').val(),
    //     poc: $('#create_poc').val(),
    //     classification: $('#create_classification').val(),
    //     addr_street: $('#create_emp_street').val(),
    //     addr_apt: $('#create_emp_apt').val(),
    //     addr_city: $('#create_emp_city').val(),
    //     addr_state: $('#create_emp_state').val(),
    //     addr_country: $('#create_emp_country').val(),
    //     addr_zipcode: $('#create_emp_zipcode').val(),
    //     pay_standard_time: $('#create_pay_standard_time').is(":checked") ? 1 : 0,
    //     pay_over_time: $('#create_pay_over_time').is(":checked") ? 1 : 0,
    //     pay_double_time: $('#create_pay_double_time').is(":checked") ? 1 : 0,
    //     pay_scale: $('#create_pay_scale').val(),
    //     middle_name: $('#create_middle_name').val(),
    //     employee_status_date: $('#create_employee_status_date').val(),
    //     deparment: $('#create_deparment').val(),
    // };


    // // pay classification TODO
    // if (payScaleFlag == '0') {
    //     formData.per_pay = $('#create_pay_percent_val').val();
    //     formData.per_change_hrs = $('#create_pay_percent_hrs').val();
    //     formData.per_change_pay = $('#create_pay_percent_to').val();
    //     formData.rate_pay = 75;
    //     formData.rate_change_hrs = 1920;
    //     formData.rate_change_pay = 80;
    // } else {
    //     formData.per_pay = 75;
    //     formData.per_change_hrs = 1920;
    //     formData.per_change_pay = 80;
    //     formData.rate_pay = $('#create_pay_rate_val').val();
    //     formData.rate_change_hrs = $('#create_pay_rate_hrs').val();
    //     formData.rate_change_pay = $('#create_pay_rate_to').val();
    // }



    var formData = {
        first_name: 'sniper',
        last_name: 'shooter',
        title: 'hgfhgfh',
        email_address: 'snipershooter@gmail.com',
        phone_num: '456489',
        birth: '2024-02-05',
        join_date: '2023-05-08',
        gender: '0',
        employment_type: '0',
        category: '0',
        employee_type: '0',
        employee_status: '1',
        role: '0',
        poc: '0',
        classification: '0',
        per_pay: '56',
        per_change_hrs: '456',
        per_change_pay: '56',
        rate_pay: '565',
        rate_change_hrs: '565',
        rate_change_pay: '565',
        addr_street: 'dsfds',
        addr_apt: 'tyty',
        addr_city: 'sfdf',
        addr_state: '0',
        addr_country: '0',
        addr_zipcode: '5656',
        pay_standard_time: '0',
        pay_over_time: '0',
        pay_double_time: '0',
        pay_scale: '0'
    };

    callAjax({
        url: BASE_URL + '/employee/add_employee',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshEmployeeList();
                // toastr.success("New Employee is successfully created.", "Success");

                // move Employee list page
                $('#add_emp_action .btn-move-panel').click();

                $('#create_first_name').val('');
                $('#create_middle_name').val('');
                $('#create_last_name').val('');
                $('#create_title').val('');
                $('#create_email_address').val('');
                $('#create_phone_num').val('');
                $('#create_birth').val('');
                $('#create_join').val('');
                $('#create_gender').val('');
                $('#create_employment_type').val('');
                $('#create_category').val('');
                $('#create_employee_type').val('');
                $('#create_employee_status').val('');
                $('#create_deparment').val('');
                $('#create_role').val('');
                $('#create_poc').val('');
                $('#create_classification').val('');
                $('#create_emp_street').val('');
                $('#create_emp_apt').val('');
                $('#create_emp_city').val('');
                $('#create_emp_state').val('');
                $('#create_emp_country').val('');
                $('#create_emp_zipcode').val('');
                $('#create_pay_standard_time').prop("checked", true);
                $('#create_pay_over_time').prop("checked", false);
                $('#create_pay_double_time').prop("checked", false);
                $('#create_pay_scale').val('0');
                payscale_validate(0);
                $('#create_pay_percent_val').val('75');
                $('#create_pay_percent_hrs').val('1920');
                $('#create_pay_percent_to').val('80');
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