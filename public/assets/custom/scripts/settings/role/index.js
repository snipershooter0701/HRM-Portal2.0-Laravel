var gridRoleTable = new Datatable();
var gridRoleActTable = new Datatable();

var TableRole = function () {
    var initPickers = function () {
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleRoleTable = function () {

        gridRoleTable.init({
            src: $("#tbl_role_permission"),
            onSuccess: function (gridRoleTable, response) { },
            onError: function (gridRoleTable) { },
            onDataLoad: function (gridRoleTable) {
                $('.btn-role-edit').click(function () {
                    var id = $(this).attr('data-id');
                    var name = $(this).attr('data-name');
                    var department = $(this).attr('data-department');

                    $('#edit_role_id').val(id);
                    $('#edit_role_name').val(name);
                    $('#edit_role_department').val(department);
                    $('#btn_show_role_edit_modal').trigger('click');
                });

                $('.btn-role-delete').click(function () {
                    var id = $(this).attr('data-id');
                    var name = $(this).attr('data-name');
                    deleteRole(id, name);
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
                    "url": BASE_URL + "/settings/role_perm/get_tbl_list", // ajax source
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

        // gridRoleTable.setAjaxParam("customActionType", "group_action");

        // handle datatable custom tools
        $('#tbl_role_permission_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridRoleTable.getDataTable().button(action).trigger();
        });
    }

    var handleRoleActTable = function () {

        gridRoleActTable.init({
            src: $("#tbl_role_activities"),
            onSuccess: function (gridRoleActTable, response) { },
            onError: function (gridRoleActTable) { },
            onDataLoad: function (gridRoleActTable) { },
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
                    "url": BASE_URL + "/settings/role_perm/get_tbl_act_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0]
                    }
                ],
                "order": [
                    [1, "desc"]
                ],// set first column as a default sort by asc
            }
        });
    }

    return {
        init: function () {
            initPickers();
            handleRoleTable();
            handleRoleActTable();
        }
    };
}();

$(document).ready(function () {
    TableRole.init();

    $('#btn_modal_add_role_ok').click(function () {
        createRole();
    });

    $('#btn_modal_edit_role_ok').click(function () {
        updateRole();
    });
});

function refreshRoleTable() {
    gridRoleTable.getDataTable().ajax.reload();
    gridRoleTable.clearAjaxParams();
}

function refreshRoleActTable() {
    gridRoleActTable.getDataTable().ajax.reload();
    gridRoleActTable.clearAjaxParams();
}

/**
 * Create Role
 */
function createRole() {
    // Check Validation
    var validateFields = [{
        field_id: 'add_role_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Role Name is required.'
        ]
    }, {
        field_id: 'add_role_department',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Department is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        name: $('#add_role_name').val(),
        department_id: $('#add_role_department').val()
    };

    callAjax({
        url: BASE_URL + '/settings/role_perm/create',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Init Form.
                $('#add_role_name').val("");
                $('#add_role_department').val("");

                // Refresh Table.
                refreshRoleTable();
                refreshRoleActTable();
                toastr.success("New role is created.", "Success");

                // Cancel Panel
                $('#btn_modal_add_role_close').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'name' + CONST_VALIDATE_SPLITER + 'add_role_name',
                    'department_id' + CONST_VALIDATE_SPLITER + 'add_role_department',
                ];
                showServerValidationErrors(validationFields, errors);
                toastr.error(err.message, "Error");
            }
        }
    });
}

/**
 * Update Role
 */
function updateRole() {
    // Check Validation
    var validateFields = [{
        field_id: 'edit_role_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Role Name is required.'
        ]
    }, {
        field_id: 'edit_role_department',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Department is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        id: $('#edit_role_id').val(),
        name: $('#edit_role_name').val(),
        department_id: $('#edit_role_department').val()
    };

    callAjax({
        url: BASE_URL + '/settings/role_perm/update',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Refresh Table.
                refreshRoleTable();
                refreshRoleActTable();
                toastr.success("Role is updated.", "Success");

                // Cancel Panel
                $('#btn_modal_edit_role_close').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'name' + CONST_VALIDATE_SPLITER + 'edit_role_name',
                    'department_id' + CONST_VALIDATE_SPLITER + 'edit_role_department'
                ];
                showServerValidationErrors(validationFields, errors);

                toastr.error(err.message, "Error");
            }
        }
    });
}

/**
 * Delete Role
 */
function deleteRole(id, name) {
    displayConfirmModal("Are you sure to delete this role (" + name + ")?", "Delete", function (res) {
        if (res == 'ok') {
            var formData = {
                id: id
            };

            callAjax({
                url: BASE_URL + '/settings/role_perm/delete',
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data['result'] == 'success') {
                        // Refresh Table.
                        refreshRoleTable();
                        refreshRoleActTable();
                        toastr.success("Role is successfully deleted.", "Success");
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