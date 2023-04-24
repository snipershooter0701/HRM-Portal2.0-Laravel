$(document).ready(function () {

    //init date pickers
    $('.date-picker').datepicker({
        rtl: App.isRTL(),
        autoclose: true
    });

    // click star option
    $('.req-star-opt').click(function () {
        if ($(this).hasClass('star-active')) {
            $(this).removeClass('star-active');
        } else {
            $(this).addClass('star-active');
            var id = $(this).attr('id').split('_star');
            $('#' + id[0]).prop('checked', false);

        }
    });

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

    if (modal_status != 'exist' && (modal_status == 0 || modal_status == 3)) {
        callAjax({
            url: BASE_URL + '/home/by_id',
            type: "POST",
            success: function (data) {
                if (data['result'] == 'success') {
                    var req = data['request'];
                    var doc = data['doc'];


                    if (req.length > 0) {
                        req[0]['ssn'] == 1 ? $('#req_ssn').prop('checked', true) : req[0]['ssn'] == 2 ? $('#req_ssn_star').addClass('star-active') : $('#req_ssn').prop('checked', false);
                        req[0]['work_auth'] == 1 ? $('#req_auth').prop('checked', true) : req[0]['work_auth'] == 2 ? $('#req_auth_star').addClass('star-active') : $('#req_auth').prop('checked', false);
                        req[0]['state'] == 1 ? $('#req_state').prop('checked', true) : req[0]['state'] == 2 ? $('#req_state_star').addClass('star-active') : $('#req_state').prop('checked', false);
                        req[0]['passport'] == 1 ? $('#req_passport').prop('checked', true) : req[0]['passport'] == 2 ? $('#req_passport_star').addClass('star-active') : $('#req_passport').prop('checked', false);
                        req[0]['i94'] == 1 ? $('#req_i94').prop('checked', true) : req[0]['i94'] == 2 ? $('#req_i94_star').addClass('star-active') : $('#req_i94').prop('checked', false);
                        req[0]['visa'] == 1 ? $('#req_visa').prop('checked', true) : req[0]['visa'] == 2 ? $('#req_visa_star').addClass('star-active') : $('#req_visa').prop('checked', false);
                        req[0]['other_document'] == 1 ? $('#req_other').prop('checked', true) : req[0]['other_document'] == 2 ? $('#req_other_star').addClass('star-active') : $('#req_other').prop('checked', false);
                        $('#req_comment').val(req[0]['comment']);

                        if (req[0]['ssn'] == 2 || req[0]['work_auth'] == 2 || req[0]['state'] == 2 || req[0]['passport'] == 2 || req[0]['i94'] == 2 || req[0]['visa'] == 2 || req[0]['other_document'] == 2)
                            $('#req_cancel').hide();
                        else
                            $('#req_cancel').show();

                        $('#request_modal').modal();

                        // create employee
                        $('#create_req_details').click(function () {
                            upsertRequestDetails(req, doc);
                        });
                    }
                }
            },
            error: function (err) {
                var errors = err.errors;
            }
        });
    }

});


function upsertRequestDetails(req, doc) {

    // validation TODO
    var validateFields = [
        {
            field_id: 'req_comment',
            conditions: [
                'required' + CONST_VALIDATE_SPLITER + 'Comment field is required.'
            ]
        }
    ];

    var validateDocFields = [];

    if (req[0]['ssn'] == 1 || req[0]['ssn'] == 2) {
        validateDocFields.push(
            {
                parent_id: 'req_ssn',
                child_id: [{
                    field_id: 'ssn_no',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ],
                    level: 'depth'
                }, {
                    field_id: 'ssn_file',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ]
                }]

            }
        );
    }

    if (req[0]['work_auth'] == 1 || req[0]['work_auth'] == 2) {
        validateDocFields.push(
            {
                parent_id: 'req_auth',
                child_id: [{
                    field_id: 'auth_list',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ]
                }, {
                    field_id: 'auth_no',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ]
                }, {
                    field_id: 'auth_start_date',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ],
                    level: 'depth'
                }, {
                    field_id: 'auth_end_date',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ],
                    level: 'depth'
                }, {
                    field_id: 'auth_file',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ]
                }]
            }
        );
    }

    if (req[0]['state'] == 1 || req[0]['state'] == 2) {
        validateDocFields.push(
            {
                parent_id: 'req_state',
                child_id: [{
                    field_id: 'state_no',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ]
                }, {
                    field_id: 'state_exp_date',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ],
                    level: 'depth'
                }, {
                    field_id: 'state_file',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ]
                }]
            }
        );
    }

    if (req[0]['passport'] == 1 || req[0]['passport'] == 2) {
        validateDocFields.push(
            {
                parent_id: 'req_passport',
                child_id: [{
                    field_id: 'passport_no',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ]
                }, {
                    field_id: 'passport_exp_date',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ],
                    level: 'depth'
                }, {
                    field_id: 'passport_file',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ]
                }]
            },
        );
    }

    if (req[0]['i94'] == 1 || req[0]['i94'] == 2) {
        validateDocFields.push(
            {
                parent_id: 'req_i94',
                child_id: [{
                    field_id: 'i94_no',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ]
                }, {
                    field_id: 'i94_admit_date',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ],
                    level: 'depth'
                }, {
                    field_id: 'i94_file',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ]
                }]
            }
        );
    }
    if (req[0]['visa'] == 1 || req[0]['visa'] == 2) {
        validateDocFields.push(
            {
                parent_id: 'req_visa',
                child_id: [{
                    field_id: 'visa_no',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ]
                }, {
                    field_id: 'visa_exp_date',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ],
                    level: 'depth'
                }, {
                    field_id: 'visa_file',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ]
                }]
            },
        );
    }
    if (req[0]['visa'] == 1 || req[0]['visa'] == 2) {
        validateDocFields.push(
            {
                parent_id: 'req_visa',
                child_id: [{
                    field_id: 'visa_no',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ]
                }, {
                    field_id: 'visa_exp_date',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ],
                    level: 'depth'
                }, {
                    field_id: 'visa_file',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ]
                }]
            },
        );
    }

    if (req[0]['other'] == 1 || req[0]['other'] == 2) {
        validateDocFields.push(
            {
                parent_id: 'req_other',
                child_id: [{
                    field_id: 'other_comment',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ]
                }, {
                    field_id: 'other_no',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ]
                }, {
                    field_id: 'other_exp_date',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ],
                    level: 'depth'
                }, {
                    field_id: 'other_file',
                    conditions: [
                        'required' + CONST_VALIDATE_SPLITER + 'This field is required.'
                    ]
                }]
            }
        );
    }

    var isValid = doValidationForm(validateFields);
    var isValidDoc = doValidationDoc(validateDocFields);

    if (!isValid || !isValidDoc)
        return;

    var formData = {
        employee_id: req[0]['employee_id'],
        comment: $('#req_comment').val(),
        ssn: $("#req_ssn").is(":checked") ? 1 : $('#req_ssn_star').hasClass("star-active") ? 2 : 0,
        auth: $('#req_auth').is(":checked") ? 1 : $('#req_auth_star').hasClass("star-active") ? 2 : 0,
        state: $('#req_state').is(":checked") ? 1 : $('#req_state_star').hasClass("star-active") ? 2 : 0,
        passport: $('#req_passport').is(":checked") ? 1 : $('#req_passport_star').hasClass("star-active") ? 2 : 0,
        i94: $('#req_i94').is(":checked") ? 1 : $('#req_i94_star').hasClass("star-active") ? 2 : 0,
        visa: $('#req_visa').is(":checked") ? 1 : $('#req_visa_star').hasClass("star-active") ? 2 : 0,
        other: $('#req_other').is(":checked") ? 1 : $('#req_other_star').hasClass("star-active") ? 2 : 0,
        ssn_doc: {
            no: $('#ssn_no').val(),
            attachment: $('#ssn_file').val(),
        },
        auth_doc: {
            work_auth_id: $('#auth_list').val(),
            no: $('#auth_no').val(),
            start_date: $('#auth_start_date').val(),
            expire_date: $('#auth_end_date').val(),
            attachment: $('#auth_file').val()
        },
        state_doc: {
            no: $('#state_no').val(),
            exp_date: $('#state_exp_date').val(),
            attachment: $('#state_file').val()
        },
        passport_doc: {
            no: $('#passport_no').val(),
            exp_date: $('#passport_exp_date').val(),
            attachment: $('#passport_file').val(),
        },
        i94_doc: {
            no: $('#i94_no').val(),
            exp_date: $('#i94_exp_date').val(),
            i94_type: $('#uniform-i94_d_s_radio').prop('checked', true) ? 0 : 1,
            attachment: $('#i94_file').val(),
        },
        visa_doc: {
            no: $('#visa_no').val(),
            exp_date: $('#visa_exp_date').val(),
            attachment: $('#visa_file').val(),
        },
        other_doc: {
            comment: $('#other_comment').val(),
            no: $('#other_no').val(),
            exp_date: $('#other_exp_date').val(),
            other_type: $('#uniform-other_n_a_radio').prop('checked', true) ? 0 : 1,
            attachment: $('#other_file').val(),
        }
    };

    var i, udx = 0, odx = 0;
    var update_id = [];
    var update_type = [];
    var other_doc = [];
    for (i = 0; i < doc.length; i++) {
        if (doc[i]['doc_title_id'] == 6) {
            other_doc[odx] = doc[i];
            odx++;
            continue;
        }
        update_id[udx] = doc[i]['id'];
        update_type[udx] = doc[i]['doc_title_id'];
        udx++;
    }

    formData.update_ids = update_id;
    formData.update_types = update_type;
    formData.other_docs = other_doc;


    callAjax({
        url: BASE_URL + '/home/response_doc',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                toastr.success("Response is successfully sent.", "Success");
                $('#request_modal').modal('hide');
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

                // toastr.error(err.message, "Error");
            }
        }
    });
}



// Get Employee By ID
function getDocumentByID(id) {
    var formData = {
        id: id
    };

    callAjax({
        url: BASE_URL + '/employee/all_employees/by_id',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var employee = data['employee'];
                var doc = data['doc'];
                $('#create_first_name').val(employee['first_name']);
                $('#create_middle_name').val(employee['middle_name']);
                $('#create_last_name').val(employee['last_name']);
                $('#create_title').val(employee['title']);
                $('#create_email_address').val(employee['email']);
                $('#create_phone_num').val(employee['phone_num']);
                $('#create_birth').val(employee['dateofbirth']);
                $('#create_join').val(employee['dateofjoining']);
                $('#create_gender').val(employee['gender']);
                $('#create_employment_type').val(employee['employment_type']);
                $('#create_category').val(employee['category']);
                $('#create_employee_type').val(employee['employee_type']);
                $('#create_employee_status').val(employee['status']);
                $('#create_employee_status_date').val(employee['status_end_date']);
                $('#create_role').val(employee['role_id']);
                $('#create_poc').val(employee['poc_id']);
                $('#create_classification').val(employee['classification']);
                $('#create_emp_street').val(employee['street']);
                $('#create_emp_apt').val(employee['suite_aptno']);
                $('#create_emp_city').val(employee['city_town']);
                $('#create_emp_state').val(employee['state_id']);
                $('#create_emp_country').val(employee['country_id']);
                $('#create_emp_zipcode').val(employee['zipcode']);
                employee['pay_standard_time'] == 1 ? $('#create_pay_standard_time').prop('checked', true) : $('#create_pay_standard_time').prop('checked', false);
                employee['pay_over_time'] == 1 ? $('#create_pay_over_time').prop('checked', true) : $('#create_pay_over_time').prop('checked', false);
                employee['pay_double_time'] == 1 ? $('#create_pay_double_time').prop('checked', true) : $('#create_pay_double_time').prop('checked', false);
                $('#create_pay_scale').val(employee['pay_scale']);
                $('#create_middle_name').val(employee['middle_name']);
                $('#create_employee_status_date').val(employee['status_end_date']);
                $('#create_deparment').val(employee['department_id']);

                // Pay Classification
                payscale_validate(employee['pay_scale']);
                $('#create_pay_percent_val').val(employee['pay_percent_value']);
                $('#create_pay_percent_hrs').val(employee['pay_percent_hrs']);
                $('#create_pay_percent_to').val(employee['pay_percent_to']);
                $('#create_pay_rate_val').val(employee['pay_rate_value']);
                $('#create_pay_rate_hrs').val(employee['pay_rate_hrs']);
                $('#create_pay_rate_to').val(employee['pay_rate_to']);

                var idx = 0;
                for (var i = 0; i < doc.length; i++) {
                    if (doc[i]['doc_title_id'] == 0) {
                        $('#ssn_no').val(doc[i]['no']);
                        // $('#ssn_file').val(doc[i]['attachment']);
                    } else if (doc[i]['doc_title_id'] == 1) {
                        $('#auth_list').val(doc[i]['work_auth_id']);
                        $('#auth_no').val(doc[i]['no']);
                        $('#auth_start_date').val(doc[i]['start_date']);
                        $('#auth_end_date').val(doc[i]['expire_date']);
                        // $('#auth_file').val(doc[i]['attachment']);
                    } else if (doc[i]['doc_title_id'] == 2) {
                        $('#state_no').val(doc[i]['no']);
                        $('#state_exp_date').val(doc[i]['exp_date']);
                        // $('#state_file').val(doc[i]['attachment']);
                    } else if (doc[i]['doc_title_id'] == 3) {
                        $('#passport_no').val(doc[i]['no']);
                        $('#passport_exp_date').val(doc[i]['exp_date']);
                        // $('#passport_file').val(doc[i]['attachment']);
                    } else if (doc[i]['doc_title_id'] == 4) {
                        $('#i94_no').val(doc[i]['no']);
                        doc[i]['i94_type'] == '0' ? $('#uniform-i94_ds_radio').prop('checked', true) : $('#i94_other_radio').prop('checked', true);
                        // $('#i94_file').val(doc[i]['attachment']);
                    } else if (doc[i]['doc_title_id'] == 5) {
                        $('#visa_no').val(doc[i]['no']);
                        $('#visa_exp_date').val(doc[i]['exp_date']);
                        // $('#visa_file').val(doc[i]['attachment']);
                    } else if (doc[i]['doc_title_id'] == 6) {
                        if (idx != 0) {
                            $('.other-doc').append(
                                '<div class="row row-' + idx + '" data-id="' + idx + '" data-doc-id="' + doc[i]['id'] + '">' +
                                '<div class="form-group col-md-2">' +
                                '<label class="control-label doc-label"></label>' +
                                '</div>' +
                                '<div class="form-group col-md-2">' +
                                '<label class="control-label">Comment</label>' +
                                '<input type="text" class="form-control other-title-' + idx + '">' +
                                '</div>' +
                                '<div class="form-group col-md-2">' +
                                '<label class="control-label">Document No</label>' +
                                '<input type="text" class="form-control other-no-' + idx + '">' +
                                '</div>' +
                                '<div class="form-group col-md-2">' +
                                '<label class="control-label">Exp Date</label>' +
                                '<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">' +
                                '<input type="text" class="form-control other-exp-date-' + idx + '">' +
                                '<span class="input-group-btn">' +
                                '<button class="btn default" type="button">' +
                                '<i class="fa fa-calendar"></i>' +
                                '</button>' +
                                '</span>' +
                                '</div>' +
                                '</div>' +
                                '<div class="form-group col-md-2">' +
                                '<label class="control-label"></label>' +
                                '<input type="file" class="form-control other-file-' + idx + '">' +
                                '</div>' +
                                '<div class="form-group col-md-2" style="padding-top: 15px;">' +
                                '<a href="javascript:;" class="btn-c-no-border-primary remove-other remove-other-' + idx + '" data-id="' + idx + '"><i class="fa fa-minus-circle icon-16"></i></a>' +
                                '</div>' +
                                '</div>'
                            );
                        }
                        $('.other-title-' + idx).val(doc[i]['comment']);
                        $('.other-no-' + idx).val(doc[i]['no']);
                        $('.other-exp-date-' + idx).val(doc[i]['exp_date']);
                        // $('.other-file-' + idx).val(doc[i]['attachment']);
                        $('.row-' + idx).attr('data-doc-id', doc[i]['id']);

                        idx++;

                        $('.date-picker').datepicker({
                            rtl: App.isRTL(),
                            autoclose: true
                        });
                    }
                }

                $('#btn_add_other_doc').attr('data-id', idx);


                // move add Employee page
                $('#add_employee_btn').click();
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}