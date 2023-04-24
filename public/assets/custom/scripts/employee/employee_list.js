var grid_employee_list = new Datatable();
var grid_emp_activity = new Datatable();

$(document).ready(function () {
    TableEmployee.init();

    // move page
    $('.page-move-btn').click(function () {
        var panelName = $(this).attr('data-panelname');
        btnStatus('add');
        initCreatePage();
        movePanel(panelName);
    });

    // create employee
    $('#signup_employee').click(function () {
        addEmployee();
    });

    // pay classification
    $('#create_pay_scale').change(function () {
        var pay_scale = $(this).val();
        payscale_validate(pay_scale);
    });

    // Update Employee
    $('#update_employee').click(function () {
        var id = $(this).attr('data-id');
        updateEmployeeInfo(id);
    });

    // import - overwrite
    $('#uniform-options_overwrite').click(function () {
        displayConfirmModal('Do you want to Overwrite?', "Overwrite Option", function (res) {
            if (res != 'ok') {
                $('#uniform-options_overwrite span').removeClass('checked');
                $('#uniform-options_skip span').addClass('checked');
            }
        });
    });

    // Change Employment type 
    $('#create_category').change(function () {
        if ($('#create_employment_type').val() == 1 && $(this).val() == 0) {
            toastr.error("C2C and 1099 are for Employment Type", "Error");
            $(this).val('');
        } else if ($('#create_employment_type').val() == 0 && ($(this).val() == 1 || $(this).val() == 2)) {
            toastr.error("Please select W2", "Error");
            $(this).val('');
        }
    });

    // change Employee Status
    $('#create_employee_status').change(function () {
        if ($(this).val() == 0) {
            $('#create_employee_status_date').val($('.curr_date').val());
        } else {
            $('#create_employee_status_date').val('');
        }
    });

    // add other doc
    $('#btn_add_other_doc').unbind('click').bind('click', function () {
        var id = $(this).attr('data-id');
        if (!$('#allow_emp_later').is(':Checked')) {
            $('.other-doc').append(
                '<div class="row row-' + id + '" data-id="' + id + '">' +
                '<div class="form-group col-md-2">' +
                '<label class="control-label doc-label"></label>' +
                '</div>' +
                '<div class="form-group col-md-2">' +
                '<label class="control-label">Comment</label>' +
                '<input type="text" class="form-control other-title-' + id + '">' +
                '</div>' +
                '<div class="form-group col-md-2">' +
                '<label class="control-label">Document No</label>' +
                '<input type="text" class="form-control other-no-' + id + '">' +
                '</div>' +
                '<div class="form-group col-md-2">' +
                '<label class="control-label">Exp Date</label>' +
                '<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">' +
                '<input type="text" class="form-control other-exp-date-' + id + '">' +
                '<span class="input-group-btn">' +
                '<button class="btn default" type="button">' +
                '<i class="fa fa-calendar"></i>' +
                '</button>' +
                '</span>' +
                '</div>' +
                '</div>' +
                '<div class="form-group col-md-2">' +
                '<label class="control-label"></label>' +
                '<input type="file" class="form-control other-file-' + id + '">' +
                '</div>' +
                '<div class="form-group col-md-2" style="padding-top: 15px;">' +
                '<a href="javascript:;" class="btn-c-no-border-primary remove-other remove-other-' + id + '" data-id="' + id + '"><i class="fa fa-minus-circle icon-16"></i></a>' +
                '</div>' +
                '</div>'
            );
            id++;
            $('#btn_add_other_doc').attr('data-id', id);

            // remove other doc
            $('.remove-other').unbind('click').bind('click', function () {
                var id = $(this).attr('data-id');
                if (!$('#allow_emp_later').is(':Checked')) {
                    $('.row-' + id).remove();
                    var total = parseInt($('#btn_add_other_doc').attr('data-id'));
                    total--;
                    $('#btn_add_other_doc').attr('data-id', total);
                }
            });

            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                autoclose: true
            });
        }

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

    // All Employee List
    var handleEmployeeList = function () {

        grid_employee_list.init({
            src: $("#tbl_employee_list"),
            onSuccess: function (grid_employee_list, response) {
                // set employee in create request
                var i;
                var emp_name = '<option value="">Select</option>';
                for (i = 0; i < response['data'].length; i++) {
                    emp_name += '<option value="' + response['emp_id'][i] + '">' + response['data'][i][2] + response['data'][i][3] + '</option>'
                }
                $('#req_emp_name').html(emp_name);

                // set role name
                var j;
                var role_name = '<option value="">Select</option>';
                for (j = 0; j < response['role'].length; j++) {
                    role_name += '<option value="' + response['role'][j]['id'] + '">' + response['role'][j]['name'] + '</option>'
                }
                $('#create_role').html(role_name);
                $('#create_employee_id').val(response['max_id'] + 1);

                // currently date
                $('.curr_date').val(response['curr_date']);
            },
            onError: function (grid_employee_list) { },
            onDataLoad: function (grid_employee_list) {

                // view
                $('.btn-emp-view').click(function () {
                    var id = $(this).attr('data-id');
                    viewEmployeeInfo(id);
                });

                // edit
                $('.btn-emp-edit').click(function () {
                    var id = $(this).attr('data-id');
                    $('#update_employee').attr('data-id', id);
                    setUpdateBeforeInfo(id)
                });

                // delete
                $('.btn-emp-delete').click(function () {
                    var ids = [$(this).attr('data-id')];

                    displayConfirmModal('Do you want to delete?', 'Employee Delete', function (req) {
                        if (req == 'ok') {
                            deleteEmployeeInfo(ids);
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
                    "url": BASE_URL + "/employee/all_employees/list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 1, 9]
                    }
                ],
                "order": [
                    [8, "asc"]
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
        grid_employee_list.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid_employee_list.getTableWrapper());
            if (action.val() == "delete" && grid_employee_list.getSelectedRowsCount() > 0) {
                // grid_employee_list.setAjaxParam("customActionType", "group_action");
                // grid_employee_list.setAjaxParam("customActionName", action.val());
                // grid_employee_list.setAjaxParam("id", grid_employee_list.getSelectedRows());
                // // grid_employee_list.getDataTable().ajax.reload();
                // grid_employee_list.clearAjaxParams();

                var val = [];
                $('input[name="id"]:checkbox:checked').each(function (i) {
                    val[i] = $(this).val();
                });
                deleteEmployeeInfo(val);

            } else if (action.val() == "send_email" && grid_employee_list.getSelectedRowsCount() > 0) {
                var ids = grid_employee_list.getSelectedRows();
                sendEmailToEmployees(ids);
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid_employee_list.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid_employee_list.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid_employee_list.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid_employee_list.setAjaxParam("customActionType", "group_action");
        // grid_employee_list.getDataTable().ajax.reload();
        // grid_employee_list.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_employee_list_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            grid_employee_list.getDataTable().button(action).trigger();
        });
    }

    // Employee Activity
    var handleEmpActivity = function () {

        grid_emp_activity.init({
            src: $("#tbl_emp_activity"),
            onSuccess: function (grid_emp_activity, response) { },
            onError: function (grid_emp_activity) { },
            onDataLoad: function (grid_emp_activity) {
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
                    "url": BASE_URL + "/employee/all_employees/act", // ajax source
                },
                "order": [
                    [1, "asc"]
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
        grid_emp_activity.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid_emp_activity.getTableWrapper());
            if (action.val() != "" && grid_emp_activity.getSelectedRowsCount() > 0) {
                grid_emp_activity.setAjaxParam("customActionType", "group_action");
                grid_emp_activity.setAjaxParam("customActionName", action.val());
                grid_emp_activity.setAjaxParam("id", grid_emp_activity.getSelectedRows());
                grid_emp_activity.getDataTable().ajax.reload();
                grid_emp_activity.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid_emp_activity.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid_emp_activity.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid_emp_activity.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid_emp_activity.setAjaxParam("customActionType", "group_action");
        // grid_emp_activity.getDataTable().ajax.reload();
        // grid_emp_activity.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_add_emp_activities_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            grid_emp_activity.getDataTable().button(action).trigger();
        });
    }

    var handleAddPlacementRecords = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#tbl_view_placements"),
            onSuccess: function (grid, response) { },
            onError: function (grid) { },
            onDataLoad: function (grid) {
            },
            loadingMessage: 'Loading...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                // "dom": "<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'>>",

                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": BASE_URL + "/employee/get-add-placements", // ajax source
                },
                "order": [
                    [1, "asc"]
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
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid.setAjaxParam("customActionType", "group_action");
        // grid.getDataTable().ajax.reload();
        // grid.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_add_placements_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            grid.getDataTable().button(action).trigger();
        });
    }

    var handleViewEmpHistoryRecords = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#tbl_view_emp_activities"),
            onSuccess: function (grid, response) { },
            onError: function (grid) { },
            onDataLoad: function (grid) {
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
                    "url": BASE_URL + "/employee/get-add-histories", // ajax source
                },
                "order": [
                    [1, "asc"]
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
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid.setAjaxParam("customActionType", "group_action");
        grid.getDataTable().ajax.reload();
        // grid.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_add_emp_activities_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            grid.getDataTable().button(action).trigger();
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
            handleEmployeeList();
            // handleAddPlacementRecords();
            handleEmpActivity();
            // handleViewEmpHistoryRecords();
            // handleMultiSelect();
        }
    };
}();


// TODO: payscale
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

// Refresh Employee List Table
function refreshEmployeeList() {
    grid_employee_list.getDataTable().ajax.reload();
    grid_employee_list.clearAjaxParams();
}

// Refresh Employee Activity Table
function refreshEmployeeActivity() {
    grid_emp_activity.getDataTable().ajax.reload();
    grid_emp_activity.clearAjaxParams();
}

// init employee fields
function initCreatePage() {
    $('div').removeClass('has-error');
    $('div').find('.help-block').remove();

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
    $('#i94_file').val('');
    $('#visa_no').val('');
    $('#visa_exp_date').val('');
    $('#visa_file').val('');

    $('.other-doc').html(
        '<div class="row row-0" data-id="0">' +
        '<div class="form-group col-md-2">' +
        '<label class="control-label doc-label"></label>' +
        '</div>' +
        '<div class="form-group col-md-2">' +
        '<label class="control-label">Comment</label>' +
        '<input type="text" class="form-control other-title-0">' +
        '</div>' +
        '<div class="form-group col-md-2">' +
        '<label class="control-label">Document No</label>' +
        '<input type="text" class="form-control other-no-0">' +
        '</div>' +
        '<div class="form-group col-md-2">' +
        '<label class="control-label">Exp Date</label>' +
        '<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">' +
        '<input type="text" class="form-control other-exp-date-0">' +
        '<span class="input-group-btn">' +
        '<button class="btn default" type="button">' +
        '<i class="fa fa-calendar"></i>' +
        '</button>' +
        '</span>' +
        '</div>' +
        '</div>' +
        '<div class="form-group col-md-2">' +
        '<label class="control-label"></label>' +
        '<input type="file" class="form-control other-file-0">' +
        '</div>' +
        '</div>'
    );
    $('.date-picker').datepicker({
        rtl: App.isRTL(),
        autoclose: true
    });
}

////////////////////////////////////////////////////////////////////
///                                                          ///////
///           Employee Create, View, Update, Delete             ////
///                                                             ////
////////////////////////////////////////////////////////////////////


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

    if (!$('#allow_pay_later').is(':Checked')) {
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
    }

    var isValid = doValidationForm(validateFields);
    if (!$('#allow_emp_later').is(':Checked')) {
        var { isValidDoc, valid_ssn, valid_auth, valid_state, valid_passport, valid_i94, valid_visa, other_doc } = doValidationDoc();
        if (!isValidDoc) {
            toastr.error("Document is required", "Error");
            return;
        }
    }

    if (!isValid)
        return;

    // var formData = {
    //     first_name: 'sniper',
    //     last_name: 'shooter',
    //     title: 'hgfhgfh',
    //     email_address: 'snipershooteaaaar000@gmail.com',
    //     phone_num: '456489',
    //     birth: '2024-02-05',
    //     join_date: '2023-05-08',
    //     gender: '0',
    //     employment_type: '0',
    //     category: '0',
    //     employee_type: '0',
    //     employee_status: '1',
    //     role: '0',
    //     poc: '0',
    //     classification: '0',
    //     per_pay: '56',
    //     per_change_hrs: '456',
    //     per_change_pay: '56',
    //     rate_pay: '565',
    //     rate_change_hrs: '565',
    //     rate_change_pay: '565',
    //     addr_street: 'dsfds',
    //     addr_apt: 'tyty',
    //     addr_city: 'sfdf',
    //     addr_state: '0',
    //     addr_country: '0',
    //     addr_zipcode: '5656',
    //     pay_standard_time: '0',
    //     pay_over_time: '0',
    //     pay_double_time: '0',
    //     pay_scale: '0',
    //     middle_name: 'aaaaaa',
    //     employee_status_date: '2023-05-08',
    //     deparment: '0',
    //     emp_id: $('#create_employee_id').val(),

    //     ssn: valid_ssn,
    //     auth: valid_auth,
    //     state: valid_state,
    //     passport: valid_passport,
    //     i94: valid_i94,
    //     visa: valid_visa,
    //     other_array: other_doc
    // };

    var formData = {
        first_name: $('#create_first_name').val(),
        last_name: $('#create_last_name').val(),
        title: $('#create_title').val(),
        email_address: $('#create_email_address').val(),
        phone_num: $('#create_phone_num').val(),
        birth: $('#create_birth').val(),
        join_date: $('#create_join').val(),
        gender: $('#create_gender').val(),
        employment_type: $('#create_employment_type').val(),
        category: $('#create_category').val(),
        employee_type: $('#create_employee_type').val(),
        employee_status: $('#create_employee_status').val(),
        role: $('#create_role').val(),
        poc: $('#create_poc').val(),
        classification: $('#create_classification').val(),
        addr_street: $('#create_emp_street').val(),
        addr_apt: $('#create_emp_apt').val(),
        addr_city: $('#create_emp_city').val(),
        addr_state: $('#create_emp_state').val(),
        addr_country: $('#create_emp_country').val(),
        addr_zipcode: $('#create_emp_zipcode').val(),
        pay_standard_time: $('#create_pay_standard_time').is(":checked") ? 1 : 0,
        pay_over_time: $('#create_pay_over_time').is(":checked") ? 1 : 0,
        pay_double_time: $('#create_pay_double_time').is(":checked") ? 1 : 0,
        pay_scale: $('#create_pay_scale').val(),
        middle_name: $('#create_middle_name').val(),
        employee_status_date: $('#create_employee_status_date').val(),
        deparment: $('#create_deparment').val(),
        emp_id: $('#create_employee_id').val(),

        ssn: valid_ssn,
        auth: valid_auth,
        state: valid_state,
        passport: valid_passport,
        i94: valid_i94,
        visa: valid_visa,
        other_array: other_doc
    };

    if (!$('#allow_emp_later').is(':Checked')) {
        formData.ssn_doc = {
            no: $('#ssn_no').val(),
            attachment: $('#ssn_file').val()
        };
        formData.auth_doc = {
            work_auth_id: $('#auth_list').val(),
            no: $('#auth_no').val(),
            start_date: $('#auth_start_date').val(),
            expire_date: $('#auth_end_date').val(),
            attachment: $('#auth_file').val()
        };
        formData.state_doc = {
            no: $('#state_no').val(),
            exp_date: $('#state_exp_date').val(),
            attachment: $('#state_file').val()
        };
        formData.passport_doc = {
            no: $('#passport_no').val(),
            exp_date: $('#passport_exp_date').val(),
            attachment: $('#passport_file').val(),
        };
        formData.i94_doc = {
            no: $('#i94_no').val(),
            i94_type: $('#uniform-i94_ds_radio').prop('checked', true) ? 0 : 1,
            attachment: $('#i94_file').val(),
        };
        formData.visa_doc = {
            no: $('#visa_no').val(),
            exp_date: $('#visa_exp_date').val(),
            attachment: $('#visa_file').val(),
        };
    }

    // pay classification TODO
    if (!$('#allow_pay_later').is(':Checked')) {
        if (payScaleFlag == '0') {
            formData.per_pay = $('#create_pay_percent_val').val();
            formData.per_change_hrs = $('#create_pay_percent_hrs').val();
            formData.per_change_pay = $('#create_pay_percent_to').val();
            formData.rate_pay = 75;
            formData.rate_change_hrs = 1920;
            formData.rate_change_pay = 80;
        } else {
            formData.per_pay = 75;
            formData.per_change_hrs = 1920;
            formData.per_change_pay = 80;
            formData.rate_pay = $('#create_pay_rate_val').val();
            formData.rate_change_hrs = $('#create_pay_rate_hrs').val();
            formData.rate_change_pay = $('#create_pay_rate_to').val();
        }
    }

    callAjax({
        url: BASE_URL + '/employee/all_employees/add',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshEmployeeList();
                refreshEmployeeActivity();
                toastr.success("New Employee is successfully created.", "Success");

                // move Employee list page
                $('#add_emp_action .page-move-btn').click();

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


// Get Employee By ID
function getEmployeeByID(id) {
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

function btnStatus(param) {
    if (param == 'add') {
        $('#add_emp_action').removeClass('hide');
        $('#update_emp_action').addClass('hide');
        $('#view_emp_action').addClass('hide');
    } else if (param == 'update') {
        $('#add_emp_action').addClass('hide');
        $('#update_emp_action').removeClass('hide');
        $('#view_emp_action').addClass('hide');
    } else if (param == 'view') {
        $('#add_emp_action').addClass('hide');
        $('#update_emp_action').addClass('hide');
        $('#view_emp_action').removeClass('hide');
    }
}

// View Employee Info
function viewEmployeeInfo(id) {
    // change update btn
    btnStatus('view');
    getEmployeeByID(id);
}

function setUpdateBeforeInfo(id) {
    // change update btn
    btnStatus('update');
    getEmployeeByID(id);
}

// Update Employee Info
function updateEmployeeInfo(id) {

    if (!$('#allow_emp_later').is(':Checked')) {
        var { isValidDoc, valid_ssn, valid_auth, valid_state, valid_passport, valid_i94, valid_visa, other_doc } = doValidationDoc();
        if (!isValidDoc) {
            toastr.error("Document is required", "Error");
        }
    }

    var other_ids = [];
    for (var i = 0; i < other_doc.length; i++) {
        var other_id = $('.row-' + i).attr('data-doc-id');
        other_ids[i] = other_id;
    }

    var formData = {
        id: id,
        ssn_id: $('#ssn_no').attr('data-id'),
        auth_id: $('#auth_list').attr('data-id'),
        state_id: $('#state_no').attr('data-id'),
        passport_id: $('#passport_no').attr('data-id'),
        i94_id: $('#i94_no').attr('data-id'),
        visa_id: $('#visa_no').attr('data-id'),
        other_ids: other_ids,
        ssn: valid_ssn,
        auth: valid_auth,
        state: valid_state,
        passport: valid_passport,
        i94: valid_i94,
        visa: valid_visa,
        other_array: other_doc,

        first_name: $('#create_first_name').val(),
        last_name: $('#create_last_name').val(),
        title: $('#create_title').val(),
        email_address: $('#create_email_address').val(),
        phone_num: $('#create_phone_num').val(),
        birth: $('#create_birth').val(),
        join_date: $('#create_join').val(),
        gender: $('#create_gender').val(),
        employment_type: $('#create_employment_type').val(),
        category: $('#create_category').val(),
        employee_type: $('#create_employee_type').val(),
        employee_status: $('#create_employee_status').val(),
        role: $('#create_role').val(),
        poc: $('#create_poc').val(),
        classification: $('#create_classification').val(),
        addr_street: $('#create_emp_street').val(),
        addr_apt: $('#create_emp_apt').val(),
        addr_city: $('#create_emp_city').val(),
        addr_state: $('#create_emp_state').val(),
        addr_country: $('#create_emp_country').val(),
        addr_zipcode: $('#create_emp_zipcode').val(),
        pay_standard_time: $('#create_pay_standard_time').is(":checked") ? 1 : 0,
        pay_over_time: $('#create_pay_over_time').is(":checked") ? 1 : 0,
        pay_double_time: $('#create_pay_double_time').is(":checked") ? 1 : 0,
        pay_scale: $('#create_pay_scale').val(),
        middle_name: $('#create_middle_name').val(),
        employee_status_date: $('#create_employee_status_date').val(),
        deparment: $('#create_deparment').val(),
    };

    if (!$('#allow_emp_later').is(':Checked')) {
        formData.ssn_doc = {
            no: $('#ssn_no').val(),
            attachment: $('#ssn_file').val()
        };
        formData.auth_doc = {
            work_auth_id: $('#auth_list').val(),
            no: $('#auth_no').val(),
            start_date: $('#auth_start_date').val(),
            expire_date: $('#auth_end_date').val(),
            attachment: $('#auth_file').val()
        };
        formData.state_doc = {
            no: $('#state_no').val(),
            exp_date: $('#state_exp_date').val(),
            attachment: $('#state_file').val()
        };
        formData.passport_doc = {
            no: $('#passport_no').val(),
            exp_date: $('#passport_exp_date').val(),
            attachment: $('#passport_file').val(),
        };
        formData.i94_doc = {
            no: $('#i94_no').val(),
            i94_type: $('#uniform-i94_ds_radio').prop('checked', true) ? 0 : 1,
            attachment: $('#i94_file').val(),
        };
        formData.visa_doc = {
            no: $('#visa_no').val(),
            exp_date: $('#visa_exp_date').val(),
            attachment: $('#visa_file').val(),
        };
    }

    // pay classification TODO
    var payScaleFlag = $('#create_pay_scale').val();
    if (!$('#allow_pay_later').is(':Checked')) {
        if (payScaleFlag == '0') {
            formData.per_pay = $('#create_pay_percent_val').val();
            formData.per_change_hrs = $('#create_pay_percent_hrs').val();
            formData.per_change_pay = $('#create_pay_percent_to').val();
            formData.rate_pay = 75;
            formData.rate_change_hrs = 1920;
            formData.rate_change_pay = 80;
        } else {
            formData.per_pay = 75;
            formData.per_change_hrs = 1920;
            formData.per_change_pay = 80;
            formData.rate_pay = $('#create_pay_rate_val').val();
            formData.rate_change_hrs = $('#create_pay_rate_hrs').val();
            formData.rate_change_pay = $('#create_pay_rate_to').val();
        }
    }

    console.log(formData);

    callAjax({
        url: BASE_URL + '/employee/all_employees/update',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshEmployeeList();
                refreshEmployeeActivity();
                toastr.success("Employee is successfully updated.", "Success");

                // move Employee list page
                $('#update_emp_action .page-move-btn').click();
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}

// Delete Employee
function deleteEmployeeInfo(id) {
    var formData = {
        id: id
    };

    callAjax({
        url: BASE_URL + '/employee/all_employees/del',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshEmployeeList();
                refreshEmployeeActivity();
                toastr.success("Employee is successfully deleted.", "Success");

            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}


// valid Documentation
function doValidationDoc() {
    var isValidDoc = true;
    var valid_ssn = true;
    var valid_auth = true;
    var valid_state = true;
    var valid_passport = true;
    var valid_i94 = true;
    var valid_visa = true;

    var ssn_no = $('#ssn_no').val() == '' ? false : true;
    var ssn_file = $('#ssn_file').val() == '' ? false : true;
    var auth_id = $('#auth_list').val() == '' ? false : true;
    var auth_no = $('#auth_no').val() == '' ? false : true;
    var auth_start_date = $('#auth_start_date').val() == '' ? false : true;
    var auth_exp_date = $('#auth_end_date').val() == '' ? false : true;
    var auth_file = $('#auth_file').val() == '' ? false : true;
    var state_no = $('#state_no').val() == '' ? false : true;
    var state_exp_date = $('#state_exp_date').val() == '' ? false : true;
    var state_file = $('#state_file').val() == '' ? false : true;
    var passport_no = $('#passport_no').val() == '' ? false : true;
    var passport_exp_date = $('#passport_exp_date').val() == '' ? false : true;
    var passport_file = $('#passport_file').val() == '' ? false : true;
    var i94_no = $('#i94_no').val() == '' ? false : true;
    var i94_file = $('#i94_file').val() == '' ? false : true;
    var visa_no = $('#visa_no').val() == '' ? false : true;
    var visa_exp_date = $('#visa_exp_date').val() == '' ? false : true;
    var visa_file = $('#visa_file').val() == '' ? false : true;

    if (!ssn_no && !ssn_file) valid_ssn = 0;
    else if (ssn_no && ssn_file) valid_ssn = 1;
    else valid_ssn = 2;

    if (!auth_id && !auth_no && !auth_start_date && !auth_exp_date && !auth_file) valid_auth = 0;
    else if (auth_id && auth_no && auth_start_date && auth_exp_date && auth_file) valid_auth = 1;
    else valid_auth = 2;

    if (!state_no && !state_exp_date && !state_file) valid_state = 0;
    else if (state_no && state_exp_date && state_file) valid_state = 1;
    else valid_state = 2;

    if (!passport_no && !passport_exp_date && !passport_file) valid_passport = 0;
    else if (passport_no && passport_exp_date && passport_file) valid_passport = 1;
    else valid_passport = 2;

    if (!i94_no && !i94_file) valid_i94 = 0;
    else if (i94_no && i94_file) valid_i94 = 1;
    else valid_i94 = 2;

    if (!visa_no && !visa_exp_date && !visa_file) valid_visa = 0;
    else if (visa_no && visa_exp_date && visa_file) valid_visa = 1;
    else valid_visa = 2;

    if (!valid_ssn && !valid_auth && !valid_state && !valid_passport && !valid_i94 && !valid_visa) isValidDoc = false;

    var other_doc = [];
    var idx = 0;
    var len = $('#btn_add_other_doc').attr('data-id');
    for (var i = 0; i < len; i++) {
        var class_name = $('.other-doc .row')[i].classList[1];
        var id = $('.' + class_name).attr('data-id');

        var other_title = $('.other-title-' + id).val();
        var other_no = $('.other-no-' + id).val();
        var other_exp_date = $('.other-exp-date-' + id).val();
        var other_file = $('.other-file-' + id).val();

        if (other_title && other_no && other_exp_date && other_file) {

            other_doc[idx++] = {
                title: other_title,
                no: other_no,
                exp_date: other_exp_date,
                attachment: other_file
            };
        }
    };

    return { isValidDoc, valid_ssn, valid_auth, valid_state, valid_passport, valid_i94, valid_visa, other_doc };
}

/**
 * Send email to selected users.
 */
function sendEmailToEmployees(ids) {
    var formData = {
        ids: ids
    };

    callAjax({
        url: BASE_URL + '/employee/all_employees/send_emails',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                toastr.success("Email successfully sent.", "Success");
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}