var gridDepartmentTable = new Datatable();
var gridWorkAuthTable = new Datatable();
var gridPocTable = new Datatable();
var gridJobTireTable = new Datatable();

var TableGeneral = function () {
    var initPickers = function () {
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleDepartmentTable = function () {

        gridDepartmentTable.init({
            src: $("#tbl_department"),
            onSuccess: function (gridDepartmentTable, response) { },
            onError: function (gridDepartmentTable) { },
            onDataLoad: function (gridDepartmentTable) {
                $('.btn-department-edit').click(function () {
                    var id = $(this).attr('data-id');
                    var name = $(this).attr('data-name');
                    $('#edit_department_id').val(id);
                    $('#edit_department_name').val(name);
                    $('#btn_show_department_edit_modal').trigger('click');
                });

                $('.btn-department-delete').click(function () {
                    var id = $(this).attr('data-id');
                    var name = $(this).attr('data-name');
                    deleteDepartment(id, name);
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
                    "url": BASE_URL + "/settings/general/department/get_tbl_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 2]
                    }
                ],
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

        // gridDepartmentTable.setAjaxParam("customActionType", "group_action");

        // handle datatable custom tools
        $('#tbl_department_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridDepartmentTable.getDataTable().button(action).trigger();
        });
    }

    var handleWorkAuthTable = function () {

        gridWorkAuthTable.init({
            src: $("#tbl_work_auths"),
            onSuccess: function (gridWorkAuthTable, response) { },
            onError: function (gridWorkAuthTable) { },
            onDataLoad: function (gridWorkAuthTable) {
                $('.btn-workauth-edit').click(function () {
                    var id = $(this).attr('data-id');
                    var name = $(this).attr('data-name');
                    $('#edit_workauth_id').val(id);
                    $('#edit_workauth_name').val(name);
                    $('#btn_show_workauth_edit_modal').trigger('click');
                });

                $('.btn-workauth-delete').click(function () {
                    var id = $(this).attr('data-id');
                    var name = $(this).attr('data-name');
                    deleteWorkAuth(id, name);
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
                    "url": BASE_URL + "/settings/general/workauth/get_tbl_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 2]
                    }
                ],
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

        // gridWorkAuthTable.setAjaxParam("customActionType", "group_action");
        // gridWorkAuthTable.getDataTable().ajax.reload();
        // gridWorkAuthTable.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_work_auths_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridWorkAuthTable.getDataTable().button(action).trigger();
        });
    }

    var handlePocTable = function () {

        gridPocTable.init({
            src: $("#tbl_pocs"),
            onSuccess: function (gridPocTable, response) { },
            onError: function (gridPocTable) { },
            onDataLoad: function (gridPocTable) {
                $('.btn-poc-edit').click(function () {
                    var id = $(this).attr('data-id');
                    var name = $(this).attr('data-name');
                    $('#edit_poc_id').val(id);
                    $('#edit_poc_name').val(name);
                    $('#btn_show_poc_edit_modal').trigger('click');
                });

                $('.btn-poc-delete').click(function () {
                    var id = $(this).attr('data-id');
                    var name = $(this).attr('data-name');
                    deletePoc(id, name);
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
                    "url": BASE_URL + "/settings/general/poc/get_tbl_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 2]
                    }
                ],
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

        // gridPocTable.setAjaxParam("customActionType", "group_action");
        // gridPocTable.getDataTable().ajax.reload();
        // gridPocTable.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_pocs_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridPocTable.getDataTable().button(action).trigger();
        });
    }

    var handleJobTireTable = function () {

        gridJobTireTable.init({
            src: $("#tbl_job_tires"),
            onSuccess: function (gridJobTireTable, response) { },
            onError: function (gridJobTireTable) { },
            onDataLoad: function (gridJobTireTable) {
                $('.btn-jobtire-edit').click(function () {
                    var id = $(this).attr('data-id');
                    var name = $(this).attr('data-name');
                    $('#edit_jobtire_id').val(id);
                    $('#edit_jobtire_name').val(name);
                    $('#btn_show_jobtire_edit_modal').trigger('click');
                });

                $('.btn-jobtire-delete').click(function () {
                    var id = $(this).attr('data-id');
                    var name = $(this).attr('data-name');
                    deleteJobTire(id, name);
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
                    "url": BASE_URL + "/settings/general/jobtire/get_tbl_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 2]
                    }
                ],
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

        // gridJobTireTable.setAjaxParam("customActionType", "group_action");
        // gridJobTireTable.getDataTable().ajax.reload();
        // gridJobTireTable.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_job_tires_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridJobTireTable.getDataTable().button(action).trigger();
        });
    }

    return {
        init: function () {
            initPickers();
            handleDepartmentTable();
            handleWorkAuthTable();
            handlePocTable();
            handleJobTireTable();
        }
    };
}();

$(document).ready(function () {
    TableGeneral.init();

    $('#btn_modal_add_department_ok').click(function () {
        createDepartment();
    });

    $('#btn_modal_edit_department_ok').click(function () {
        updateDepartment();
    });

    $('#btn_modal_add_workauth_ok').click(function () {
        createWorkAuth();
    });

    $('#btn_modal_edit_workauth_ok').click(function () {
        updateWorkAuth();
    });

    $('#btn_modal_add_poc_ok').click(function () {
        createPoc();
    });

    $('#btn_modal_edit_poc_ok').click(function () {
        updatePoc();
    });

    $('#btn_modal_add_jobtire_ok').click(function () {
        createJobTire();
    });

    $('#btn_modal_edit_jobtire_ok').click(function () {
        updateJobTire();
    });
});

function refreshDepartmentTable() {
    gridDepartmentTable.getDataTable().ajax.reload();
    gridDepartmentTable.clearAjaxParams();
}

function refreshWorkAuthTable() {
    gridWorkAuthTable.getDataTable().ajax.reload();
    gridWorkAuthTable.clearAjaxParams();
}

function refreshPocTable() {
    gridPocTable.getDataTable().ajax.reload();
    gridPocTable.clearAjaxParams();
}

function refreshJobTireTable() {
    gridJobTireTable.getDataTable().ajax.reload();
    gridJobTireTable.clearAjaxParams();
}

/**
 * Create Department
 */
function createDepartment() {
    // Check Validation
    var validateFields = [{
        field_id: 'add_department_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Department Name is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        name: $('#add_department_name').val()
    };

    callAjax({
        url: BASE_URL + '/settings/general/department/create',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Init Form.
                $('#add_department_name').val("");

                // Refresh Table.
                refreshDepartmentTable();
                toastr.success("New department is created.", "Success");

                // Cancel Panel
                $('#btn_modal_add_department_close').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'name' + CONST_VALIDATE_SPLITER + 'add_department_name',
                ];
                showServerValidationErrors(validationFields, errors);

                toastr.error(err.message, "Error");
            }
        }
    });
}

/**
 * Update Department
 */
function updateDepartment() {
    // Check Validation
    var validateFields = [{
        field_id: 'edit_department_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Department Name is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        id: $('#edit_department_id').val(),
        name: $('#edit_department_name').val()
    };

    callAjax({
        url: BASE_URL + '/settings/general/department/update',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Refresh Table.
                refreshDepartmentTable();
                toastr.success("Department is updated.", "Success");

                // Cancel Panel
                $('#btn_modal_edit_department_close').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'name' + CONST_VALIDATE_SPLITER + 'edit_department_name',
                ];
                showServerValidationErrors(validationFields, errors);

                toastr.error(err.message, "Error");
            }
        }
    });
}

/**
 * Delete Department
 */
function deleteDepartment(id, name) {
    displayConfirmModal("Are you sure to delete this department (" + name + ")?", "Delete", function (res) {
        if (res == 'ok') {
            var formData = {
                id: id
            };

            callAjax({
                url: BASE_URL + '/settings/general/department/delete',
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data['result'] == 'success') {
                        // Refresh Table.
                        refreshDepartmentTable();
                        toastr.success("Department is successfully deleted.", "Success");
                    }
                },
                error: function (err) {
                    var errors = err.errors;
                    if (errors)
                        toastr.error(err.message, "Error");
                }
            });
        }
    });
}




/**
 * Create WorkAuth
 */
function createWorkAuth() {
    // Check Validation
    var validateFields = [{
        field_id: 'add_workauth_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'WorkAuth Name is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        name: $('#add_workauth_name').val()
    };

    callAjax({
        url: BASE_URL + '/settings/general/workauth/create',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Init Form.
                $('#add_workauth_name').val("");

                // Refresh Table.
                refreshWorkAuthTable();
                toastr.success("New workauth is created.", "Success");

                // Cancel Panel
                $('#btn_modal_add_workauth_close').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'name' + CONST_VALIDATE_SPLITER + 'add_workauth_name',
                ];
                showServerValidationErrors(validationFields, errors);

                toastr.error(err.message, "Error");
            }
        }
    });
}

/**
 * Update WorkAuth
 */
function updateWorkAuth() {
    // Check Validation
    var validateFields = [{
        field_id: 'edit_workauth_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'WorkAuth Name is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        id: $('#edit_workauth_id').val(),
        name: $('#edit_workauth_name').val()
    };

    callAjax({
        url: BASE_URL + '/settings/general/workauth/update',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Refresh Table.
                refreshWorkAuthTable();
                toastr.success("WorkAuth is updated.", "Success");

                // Cancel Panel
                $('#btn_modal_edit_workauth_close').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'name' + CONST_VALIDATE_SPLITER + 'edit_workauth_name',
                ];
                showServerValidationErrors(validationFields, errors);

                toastr.error(err.message, "Error");
            }
        }
    });
}

/**
 * Delete WorkAuth
 */
function deleteWorkAuth(id, name) {
    displayConfirmModal("Are you sure to delete this workauth (" + name + ")?", "Delete", function (res) {
        if (res == 'ok') {
            var formData = {
                id: id
            };

            callAjax({
                url: BASE_URL + '/settings/general/workauth/delete',
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data['result'] == 'success') {
                        // Refresh Table.
                        refreshWorkAuthTable();
                        toastr.success("WorkAuth is successfully deleted.", "Success");
                    }
                },
                error: function (err) {
                    var errors = err.errors;
                    if (errors)
                        toastr.error(err.message, "Error");
                }
            });
        }
    });
}




/**
 * Create Poc
 */
function createPoc() {
    // Check Validation
    var validateFields = [{
        field_id: 'add_poc_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Poc Name is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        name: $('#add_poc_name').val()
    };

    callAjax({
        url: BASE_URL + '/settings/general/poc/create',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Init Form.
                $('#add_poc_name').val("");

                // Refresh Table.
                refreshPocTable();
                toastr.success("New poc is created.", "Success");

                // Cancel Panel
                $('#btn_modal_add_poc_close').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'name' + CONST_VALIDATE_SPLITER + 'add_poc_name',
                ];
                showServerValidationErrors(validationFields, errors);

                toastr.error(err.message, "Error");
            }
        }
    });
}

/**
 * Update Poc
 */
function updatePoc() {
    // Check Validation
    var validateFields = [{
        field_id: 'edit_poc_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Poc Name is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        id: $('#edit_poc_id').val(),
        name: $('#edit_poc_name').val()
    };

    callAjax({
        url: BASE_URL + '/settings/general/poc/update',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Refresh Table.
                refreshPocTable();
                toastr.success("Poc is updated.", "Success");

                // Cancel Panel
                $('#btn_modal_edit_poc_close').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'name' + CONST_VALIDATE_SPLITER + 'edit_poc_name',
                ];
                showServerValidationErrors(validationFields, errors);

                toastr.error(err.message, "Error");
            }
        }
    });
}

/**
 * Delete Poc
 */
function deletePoc(id, name) {
    displayConfirmModal("Are you sure to delete this poc (" + name + ")?", "Delete", function (res) {
        if (res == 'ok') {
            var formData = {
                id: id
            };

            callAjax({
                url: BASE_URL + '/settings/general/poc/delete',
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data['result'] == 'success') {
                        // Refresh Table.
                        refreshPocTable();
                        toastr.success("Poc is successfully deleted.", "Success");
                    }
                },
                error: function (err) {
                    var errors = err.errors;
                    if (errors)
                        toastr.error(err.message, "Error");
                }
            });
        }
    });
}




/**
 * Create JobTire
 */
function createJobTire() {
    // Check Validation
    var validateFields = [{
        field_id: 'add_jobtire_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'JobTire Name is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        name: $('#add_jobtire_name').val()
    };

    callAjax({
        url: BASE_URL + '/settings/general/jobtire/create',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Init Form.
                $('#add_jobtire_name').val("");

                // Refresh Table.
                refreshJobTireTable();
                toastr.success("New jobtire is created.", "Success");

                // Cancel Panel
                $('#btn_modal_add_jobtire_close').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'name' + CONST_VALIDATE_SPLITER + 'add_jobtire_name',
                ];
                showServerValidationErrors(validationFields, errors);

                toastr.error(err.message, "Error");
            }
        }
    });
}

/**
 * Update JobTire
 */
function updateJobTire() {
    // Check Validation
    var validateFields = [{
        field_id: 'edit_jobtire_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'JobTire Name is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        id: $('#edit_jobtire_id').val(),
        name: $('#edit_jobtire_name').val()
    };

    callAjax({
        url: BASE_URL + '/settings/general/jobtire/update',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Refresh Table.
                refreshJobTireTable();
                toastr.success("JobTire is updated.", "Success");

                // Cancel Panel
                $('#btn_modal_edit_jobtire_close').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'name' + CONST_VALIDATE_SPLITER + 'edit_jobtire_name',
                ];
                showServerValidationErrors(validationFields, errors);

                toastr.error(err.message, "Error");
            }
        }
    });
}

/**
 * Delete JobTire
 */
function deleteJobTire(id, name) {
    displayConfirmModal("Are you sure to delete this jobtire (" + name + ")?", "Delete", function (res) {
        if (res == 'ok') {
            var formData = {
                id: id
            };

            callAjax({
                url: BASE_URL + '/settings/general/jobtire/delete',
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data['result'] == 'success') {
                        // Refresh Table.
                        refreshJobTireTable();
                        toastr.success("JobTire is successfully deleted.", "Success");
                    }
                },
                error: function (err) {
                    var errors = err.errors;
                    if (errors)
                        toastr.error(err.message, "Error");
                }
            });
        }
    });
}