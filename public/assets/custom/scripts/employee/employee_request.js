var grid_request_details = new Datatable();
var grid_emp_activity = new Datatable();

$(document).ready(function () {
    TableEmployee.init();

    $('.page-move-btn').click(function () {
        var panelName = $(this).attr('data-panelname');
        btnStatus('add');
        movePanel(panelName);
    });

    // create employee
    $('#create_req_details').click(function () {
        addRequestDetails();
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

    // select checkbox in create request
    $('.req-checkbox').click(function () {
        var id = $(this).attr('id');
        // if ($('#' + id + '_star').hasClass('star-active')) {
        //    $(this).prop('checked', false);
        // }
        if ($(this).is(":checked")) {
            $('#' + id + '_star').removeClass('star-active');
        }

    });


    // $('#req_emp_name').change(function () {
    //     console.log('=========');
    //     var name = $(this).find(':selected').attr('data-name');
    //     console.log(name);
    //     $('#req_emp_name').attr('data-name', name);
    // });

    // Update Request Details
    $('#update_req_details').click(function () {
        var id = $(this).attr('data-id');
        var emp_id = $(this).attr('data-emp-id');
        updateRequestDetails(id, emp_id);
    });

    $('#uniform-options_overwrite').click(function () {
        displayConfirmModal('Do you want to Overwrite?', "Overwrite Option", function (res) {
            if (res != 'ok') {
                $('#uniform-options_overwrite span').removeClass('checked');
                $('#uniform-options_skip span').addClass('checked');
            }
        });
    });
});

var TableEmployee = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleRequestDetails = function () {

        grid_request_details.init({
            src: $("#tbl_request_details"),
            onSuccess: function (grid_request_details, response) { 
                // set employee in create request
                var employee = response['employees'];
                var i;
                var emp_name = '<option value="">Select</option>';
                for (i = 0; i < employee.length; i++) {
                    emp_name += '<option value="' + employee[0]['id'] + '">' + employee[i]['first_name'] + employee[i]['last_name'] + '</option>'
                }
                $('#req_emp_name').html(emp_name);
            },
            onError: function (grid_request_details) { },
            onDataLoad: function (grid_request_details) {
                // edit
                $('.btn-req-edit').click(function () {
                    var id = $(this).attr('data-id');
                    var emp_id = $(this).attr('data-emp-id');
                    $('#update_req_details').attr('data-id', id);
                    $('#update_req_details').attr('data-emp-id', emp_id);
                    setRequestDetailsUpdateBefore(id, emp_id);
                });

                // delete
                $('.btn-req-delete').click(function () {
                    var id = $(this).attr('data-id');
                    displayConfirmModal('Do you want to delete?', 'Delete Request Details', function (req) {
                        if (req == 'ok') {
                            deleteRequestDetails(id);
                        }
                    })
                });

            },
            loadingMessage: 'Loading...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": BASE_URL + "/employee/all_request_details/list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 1, 9]
                    }
                ],

                "order": [
                    [2, "asc"]
                ],// set first column as a default sort by asc
                buttons: [
                    { extend: 'print', className: 'btn default' },
                    { extend: 'copy', className: 'btn default' },
                    { extend: 'pdf', className: 'btn default' },
                    { extend: 'excel', className: 'btn default' },
                    { extend: 'csv', className: 'btn default' },
                    {
                        text: 'Reload',
                        className: 'btn default',
                        action: function (e, dt, node, config) {
                            dt.ajax.reload();
                            alert('Datatable reloaded!');
                        }
                    }
                ],
            }
        });

        // handle group actionsubmit button click
        grid_request_details.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid_request_details.getTableWrapper());
            if (action.val() != "" && grid_request_details.getSelectedRowsCount() > 0) {
                grid_request_details.setAjaxParam("customActionType", "group_action");
                grid_request_details.setAjaxParam("customActionName", action.val());
                grid_request_details.setAjaxParam("id", grid_request_details.getSelectedRows());
                grid_request_details.getDataTable().ajax.reload();
                grid_request_details.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid_request_details.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid_request_details.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid_request_details.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid_request_details.setAjaxParam("customActionType", "group_action");
        // grid_request_details.getDataTable().ajax.reload();
        // grid_request_details.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_request_details_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            grid_request_details.getDataTable().button(action).trigger();
        });
    }

    var handleMultiSelect = function () {
        $('#my_multi_select1').multiSelect({
            cssClass: 'height:1000px;'
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            initPickers();
            handleRequestDetails();
            // handleMultiSelect();
        }
    };
}();




// Refresh Request Details List Table
function refreshRequestDetailsList() {
    // gridClientListTable.setAjaxParam("customActionType", "group_action");
    grid_request_details.getDataTable().ajax.reload();
    grid_request_details.clearAjaxParams();
}




////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
//////                                                    //////////
//////         Request Details Create, Update, Delete     //////////
//////                                                    //////////
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////

function addRequestDetails() {

    // validation TODO
    var validateFields = [
        {
            field_id: 'req_emp_name',
            conditions: [
                'required' + CONST_VALIDATE_SPLITER + 'Employee Name field is required.'
            ]
        }, {
            field_id: 'req_comment',
            conditions: [
                'required' + CONST_VALIDATE_SPLITER + 'Comment field is required.'
            ]
        }
    ];

    var validateDocFields = [
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

        },
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
        },
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
        },
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
        },
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
    ];

    var isValid = doValidationForm(validateFields);
    // var isValidDoc = doValidationDoc(validateDocFields);

    // if (!isValid || !isValidDoc)
    //     return;
    if (!isValid)
        return;


    var formData = {
        employee_id: $('#req_emp_name').val(),
        requested_by_id: '1',
        comment: $('#req_comment').val(),
        ssn: $("#req_ssn").is(":checked") ? 1 : $('#req_ssn_star').hasClass("star-active") ? 2 : 0,
        auth: $('#req_auth').is(":checked") ? 1 : $('#req_auth_star').hasClass("star-active") ? 2 : 0,
        state: $('#req_state').is(":checked") ? 1 : $('#req_state_star').hasClass("star-active") ? 2 : 0,
        passport: $('#req_passport').is(":checked") ? 1 : $('#req_passport_star').hasClass("star-active") ? 2 : 0,
        i94: $('#req_i94').is(":checked") ? 1 : $('#req_i94_star').hasClass("star-active") ? 2 : 0,
        visa: $('#req_visa').is(":checked") ? 1 : $('#req_visa_star').hasClass("star-active") ? 2 : 0,
        other: $('#req_other').is(":checked") ? 1 : $('#req_other_star').hasClass("star-active") ? 2 : 0,
        // ssn_doc: {
        //     no: $('#ssn_no').val(),
        //     attachment: $('#ssn_file').val()
        // },
        // auth_doc: {
        //     work_auth_id: $('#auth_list').val(),
        //     no: $('#auth_no').val(),
        //     start_date: $('#auth_start_date').val(),
        //     expire_date: $('#auth_end_date').val(),
        //     attachment: $('#auth_file').val()
        // },
        // state_doc: {
        //     no: $('#state_no').val(),
        //     exp_date: $('#state_exp_date').val(),
        //     attachment: $('#state_file').val()
        // },
        // passport_doc: {
        //     no: $('#passport_no').val(),
        //     exp_date: $('#passport_exp_date').val(),
        //     attachment: $('#passport_file').val(),
        // },
        // i94_doc: {
        //     no: $('#i94_no').val(),
        //     exp_date: $('#i94_exp_date').val(),
        //     i94_type: $('#uniform-i94_d_s_radio').prop('checked', true) ? 0 : 1,
        //     attachment: $('#i94_file').val(),
        // },
        // visa_doc: {
        //     no: $('#visa_no').val(),
        //     exp_date: $('#visa_exp_date').val(),
        //     attachment: $('#visa_file').val(),
        // },
        // other_doc: {
        //     comment: $('#other_comment').val(),
        //     no: $('#other_no').val(),
        //     exp_date: $('#other_exp_date').val(),
        //     other_type: $('#uniform-other_n_a_radio').prop('checked', true) ? 0 : 1,
        //     attachment: $('#other_file').val(),
        // }
    };


    callAjax({
        url: BASE_URL + '/employee/all_request_details/add',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshRequestDetailsList();
                toastr.success("New Request is successfully created.", "Success");

                // move Request Details List page
                $('#add_req_action .btn-move-panel').click();

                // Clear History
                $('#req_emp_name').val('');
                $('#req_comment').val('');
                $("#req_ssn").prop("checked", false);
                $('#req_ssn_star').removeClass("star-active");
                $('#req_auth').prop("checked", false);
                $('#req_auth_star').removeClass("star-active");
                $('#req_state').prop("checked", false);
                $('#req_state_star').removeClass("star-active");
                $('#req_passport').prop("checked", false);
                $('#req_passport_star').removeClass("star-active");
                $('#req_i94').prop("checked", false);
                $('#req_i94_star').removeClass("star-active");
                $('#req_visa').prop("checked", false);
                $('#req_visa_star').removeClass("star-active");
                $('#req_other').prop("checked", false);
                $('#req_other_star').removeClass("star-active");
                $('#ssn_no').val('');
                $('#ssn_file').val('')
                $('#auth_list').val('');
                $('#auth_no').val('');
                $('#auth_start_date').val('');
                $('#auth_end_date').val('');
                $('#auth_file').val('')
                $('#state_no').val('');
                $('#state_exp_date').val('');
                $('#state_file').val('')
                $('#passport_no').val('');
                $('#passport_exp_date').val('');
                $('#passport_file').val('');
                $('#i94_no').val('');
                $('#i94_exp_date').val('');
                $('#uniform-i94_d_s_radio').prop('checked', true)
                $('#i94_file').val('');
                $('#visa_no').val('');
                $('#visa_exp_date').val('');
                $('#visa_file').val('');
                $('#other_comment').val('');
                $('#other_no').val('');
                $('#other_exp_date').val('');
                $('#uniform-other_n_a_radio').prop('checked', true)
                $('#other_file').val('');

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


// Get Request Details By ID
function getRequestDetailsByID(id, emp_id) {
    var formData = {
        id: id,
        emp_id: emp_id
    };
    callAjax({
        url: BASE_URL + '/employee/all_request_details/by_id',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                var details = data['details'];
                var doc = data['doc'];
                $('#req_emp_name').val(details['employee_id']);
                details['ssn'] == 1 ? $('#req_ssn').prop('checked', true) : details['ssn'] == 2 ? $('#req_ssn_star').addClass('star-active') : $('#req_ssn').prop('checked', false);
                details['work_auth'] == 1 ? $('#req_auth').prop('checked', true) : details['work_auth'] == 2 ? $('#req_auth_star').addClass('star-active') : $('#req_auth').prop('checked', false);
                details['state'] == 1 ? $('#req_state').prop('checked', true) : details['state'] == 2 ? $('#req_state_star').addClass('star-active') : $('#req_state').prop('checked', false);
                details['passport'] == 1 ? $('#req_passport').prop('checked', true) : details['passport'] == 2 ? $('#req_passport_star').addClass('star-active') : $('#req_passport').prop('checked', false);
                details['i94'] == 1 ? $('#req_i94').prop('checked', true) : details['i94'] == 2 ? $('#req_i94_star').addClass('star-active') : $('#req_i94').prop('checked', false);
                details['visa'] == 1 ? $('#req_visa').prop('checked', true) : details['visa'] == 2 ? $('#req_visa_star').addClass('star-active') : $('#req_visa').prop('checked', false);
                details['other_document'] == 1 ? $('#req_other').prop('checked', true) : details['other_document'] == 2 ? $('#req_other_star').addClass('star-active') : $('#req_other').prop('checked', false);
                $('#req_comment').val(details['comment']);

                for (var i in doc) {
                    if (doc[i]['doc_title_id'] == 0) {
                        $('#ssn_no').val(doc[i]['no']);
                    } else if (doc[i]['doc_title_id'] == 1) {
                        $('#auth_list').val(doc[i]['work_auth_id']);
                        $('#auth_no').val(doc[i]['no']);
                        $('#auth_start_date').val(doc[i]['start_date']);
                        $('#auth_end_date').val(doc[i]['expire_date']);
                    } else if (doc[i]['doc_title_id'] == 2) {
                        $('#state_no').val(doc[i]['no']);
                        $('#state_exp_date').val(doc[i]['exp_date']);
                    } else if (doc[i]['doc_title_id'] == 3) {
                        $('#passport_no').val(doc[i]['no']);
                        $('#passport_exp_date').val(doc[i]['exp_date']);
                    } else if (doc[i]['doc_title_id'] == 4) {
                        $('#i94_no').val(doc[i]['no']);
                        $('#i94_exp_date').val(doc[i]['exp_date']);
                        doc[i]['i94_type'] == 0 ? $('#uniform-i94_d_s_radio').prop('checked', true) : $('#uniform-i94_other_radio').prop('checked', true);
                    } else if (doc[i]['doc_title_id'] == 5) {
                        $('#visa_no').val(doc[i]['no']);
                        $('#visa_exp_date').val(doc[i]['exp_date']);
                    } else if (doc[i]['doc_title_id'] == 6) {
                        $('#other_comment').val(doc[i]['comment']);
                        $('#other_no').val(doc[i]['no']);
                        $('#other_exp_date').val(doc[i]['exp_date']);
                        $('#uniform-other_n_a_radio').prop('checked', true);
                    }
                }

                // move create Request page
                $('#add_request_details_btn').click();
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}

function btnStatus(param) {
    if (param == 'add') {
        $('#add_req_action').removeClass('hide');
        $('#update_req_action').addClass('hide');
    } else if (param == 'update') {
        $('#add_req_action').addClass('hide');
        $('#update_req_action').removeClass('hide');
    }
}

function setRequestDetailsUpdateBefore(id, emp_id) {
    // change update btn
    btnStatus('update');
    getRequestDetailsByID(id, emp_id);
}

// Update Request Details
function updateRequestDetails(id, emp_id) {

    console.log(emp_id);
    // validation TODO
    var validateFields = [
        {
            field_id: 'req_emp_name',
            conditions: [
                'required' + CONST_VALIDATE_SPLITER + 'Employee Name field is required.'
            ]
        }, {
            field_id: 'req_comment',
            conditions: [
                'required' + CONST_VALIDATE_SPLITER + 'Comment field is required.'
            ]
        }
    ];

    var isValid = doValidationForm(validateFields);

    if (!isValid)
        return;

    var formData = {
        id: id,
        emp_id: emp_id,
        employee_id: $('#req_emp_name').val(),
        requested_by_id: '1',
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
            attachment: $('#ssn_file').val()
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

    callAjax({
        url: BASE_URL + '/employee/all_request_details/update',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshRequestDetailsList();
                toastr.success("Request is successfully updated.", "Success");

                // move request details list page
                $('#update_req_action .btn-move-panel').click();

                // Clear History
                $('#req_emp_name').val('');
                $('#req_comment').val('');
                $("#req_ssn").prop("checked", false);
                $('#req_ssn_star').removeClass("star-active");
                $('#req_auth').prop("checked", false);
                $('#req_auth_star').removeClass("star-active");
                $('#req_state').prop("checked", false);
                $('#req_state_star').removeClass("star-active");
                $('#req_passport').prop("checked", false);
                $('#req_passport_star').removeClass("star-active");
                $('#req_i94').prop("checked", false);
                $('#req_i94_star').removeClass("star-active");
                $('#req_visa').prop("checked", false);
                $('#req_visa_star').removeClass("star-active");
                $('#req_other').prop("checked", false);
                $('#req_other_star').removeClass("star-active");
                $('#ssn_no').val('');
                $('#ssn_file').val('')
                $('#auth_list').val('');
                $('#auth_no').val('');
                $('#auth_start_date').val('');
                $('#auth_end_date').val('');
                $('#auth_file').val('')
                $('#state_no').val('');
                $('#state_exp_date').val('');
                $('#state_file').val('')
                $('#passport_no').val('');
                $('#passport_exp_date').val('');
                $('#passport_file').val('');
                $('#i94_no').val('');
                $('#i94_exp_date').val('');
                $('#uniform-i94_d_s_radio').prop('checked', true)
                $('#i94_file').val('');
                $('#visa_no').val('');
                $('#visa_exp_date').val('');
                $('#visa_file').val('');
                $('#other_comment').val('');
                $('#other_no').val('');
                $('#other_exp_date').val('');
                $('#uniform-other_n_a_radio').prop('checked', true)
                $('#other_file').val('');

            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}

// Delete Request Details
function deleteRequestDetails(id) {
    var formData = {
        id: id
    };

    callAjax({
        url: BASE_URL + '/employee/all_request_details/del',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshRequestDetailsList();
                toastr.success("Request is successfully deleted.", "Success");
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}



