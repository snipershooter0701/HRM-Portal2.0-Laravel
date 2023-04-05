var grid_employee_list = new Datatable();
var grid_request_details = new Datatable();
var grid_emp_activity = new Datatable();

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
                    var id = $(this).attr('data-id');
                    displayConfirmModal('Do you want to delete?', 'Employee Delete', function (req) {
                        if (req == 'ok') {
                            deleteEmployeeInfo(id);
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
                    "url": BASE_URL + "/employee/get_employee_list", // ajax source
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
            if (action.val() != "" && grid_employee_list.getSelectedRowsCount() > 0) {
                grid_employee_list.setAjaxParam("customActionType", "group_action");
                grid_employee_list.setAjaxParam("customActionName", action.val());
                grid_employee_list.setAjaxParam("id", grid_employee_list.getSelectedRows());
                grid_employee_list.getDataTable().ajax.reload();
                grid_employee_list.clearAjaxParams();
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
                    "url": BASE_URL + "/employee/get_emp_activity", // ajax source
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




    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
    //                                                    All Request Details 
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    var handleRequestDetails = function () {

        grid_request_details.init({
            src: $("#tbl_request_details"),
            onSuccess: function (grid_request_details, response) { },
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
                    "url": BASE_URL + "/employee/get_request_details_list", // ajax source
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
            handleEmployeeList();
            // handleAddPlacementRecords();
            handleRequestDetails();
            // handleEmpActivity();
            // handleViewEmpHistoryRecords();
            // handleMultiSelect();
        }
    };
}();

$(document).ready(function () {
    TableEmployee.init();

    // Update Employee
    $('#update_employee').click(function () {
        var id = $(this).attr('data-id');
        updateEmployeeInfo(id);
    });

    // Update Request Details
    $('#update_req_details').click(function () {
        var id = $(this).attr('data-id');
        var emp_id = $(this).attr('data-emp-id');
        updateRequestDetails(id, emp_id);
    });

    $('#btn-emp-add').click(function () {
        createEmployee();
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


// Refresh Employee List Table
function refreshEmployeeList() {
    // gridClientListTable.setAjaxParam("customActionType", "group_action");
    grid_employee_list.getDataTable().ajax.reload();
    grid_employee_list.clearAjaxParams();
}

// Refresh Request Details List Table
function refreshRequestDetailsList() {
    // gridClientListTable.setAjaxParam("customActionType", "group_action");
    grid_request_details.getDataTable().ajax.reload();
    grid_request_details.clearAjaxParams();
}



///////////////////////////////////////////
///                                     ///
///     Employee View, Update, Delete   ///
///                                     ///
///////////////////////////////////////////

// Get Employee By ID
function getEmployeeByID(id) {
    var formData = {
        id: id
    };

    callAjax({
        url: BASE_URL + '/employee/get_employee',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var employee = data['employee'];
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

// View Employee Info
function viewEmployeeInfo(id) {
    // change update btn
    $('#add_emp_action').addClass('hide');
    $('#update_emp_action').addClass('hide');
    $('#view_emp_action').removeClass('hide');
    getEmployeeByID(id);
}

function setUpdateBeforeInfo(id) {
    // change update btn
    $('#add_emp_action').addClass('hide');
    $('#update_emp_action').removeClass('hide');
    $('#view_emp_action').addClass('hide');
    getEmployeeByID(id);
}

// Update Employee Info
function updateEmployeeInfo(id) {

    var payScaleFlag = $('#create_pay_scale').val();

    var formData = {
        id: id,
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


    // pay classification TODO
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

    callAjax({
        url: BASE_URL + '/employee/update_employee_info',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshEmployeeList();
                refreshRequestDetailsList();
                // toastr.success("New Employee is successfully created.", "Success");

                // move Employee list page
                $('#update_emp_action .btn-move-panel').click();

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
        url: BASE_URL + '/employee/delete_employee_info',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshEmployeeList();
                refreshRequestDetailsList();

            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}






////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
//////                                                    //////////
//////              Request Details Update, Delete        //////////
//////                                                    //////////
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////


// Get Request Details By ID
function getRequestDetailsByID(id, emp_id) {
    var formData = {
        id: id,
        emp_id: emp_id
    };
    callAjax({
        url: BASE_URL + '/employee/get_request_details',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // move create Request page
                $('#add_request_details_btn').click();

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
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}

function setRequestDetailsUpdateBefore(id, emp_id) {
    // change update btn
    $('#add_req_action').addClass('hide');
    $('#update_req_action').removeClass('hide');
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
        url: BASE_URL + '/employee/update_request_details',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshRequestDetailsList();
                // toastr.success("New Employee is successfully created.", "Success");

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
        url: BASE_URL + '/employee/delete_request_details',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshRequestDetailsList();
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}



