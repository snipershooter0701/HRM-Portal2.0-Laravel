var gridLevelTable = new Datatable();
var gridLevelActTable = new Datatable();

var TableRole = function () {
    var initPickers = function () {
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleLevelTable = function () {

        gridLevelTable.init({
            src: $("#tbl_level"),
            onSuccess: function (gridLevelTable, response) { },
            onError: function (gridLevelTable) { },
            onDataLoad: function (gridLevelTable) {
                $('.btn-level-edit').click(function () {
                    var id = $(this).attr('data-id');
                    showLevelInfoToEditModal(id);
                });

                $('.btn-level-delete').click(function () {
                    var id = $(this).attr('data-id');
                    var name = $(this).attr('data-name');
                    deleteLevel(id, name);
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
                    "url": BASE_URL + "/settings/org_hierarchy/get_tbl_list", // ajax source
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

        // gridLevelTable.setAjaxParam("customActionType", "group_action");

        // handle datatable custom tools
        $('#tbl_level_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridLevelTable.getDataTable().button(action).trigger();
        });
    }

    var handleLevelActTable = function () {

        gridLevelActTable.init({
            src: $("#tbl_level_activities"),
            onSuccess: function (gridLevelActTable, response) { },
            onError: function (gridLevelActTable) { },
            onDataLoad: function (gridLevelActTable) { },
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
                    "url": BASE_URL + "/settings/org_hierarchy/get_tbl_act_list", // ajax source
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
            handleLevelTable();
            handleLevelActTable();
        }
    };
}();

$(document).ready(function () {
    TableRole.init();

    $('#btn_modal_add_level_ok').click(function () {
        createLevel();
    });

    $('#btn_modal_edit_level_ok').click(function () {
        updateLevel();
    });
});

function refreshLevelTable() {
    gridLevelTable.getDataTable().ajax.reload();
    gridLevelTable.clearAjaxParams();
}

function refreshLevelActTable() {
    gridLevelActTable.getDataTable().ajax.reload();
    gridLevelActTable.clearAjaxParams();
}

/**
 * Show level information to edit modal.
 */
function showLevelInfoToEditModal(id)
{
    var formData = {
        id: id
    };

    callAjax({
        url: BASE_URL + '/settings/org_hierarchy/get_level',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var level = data['level'];
                if (level != null) {
                    $('#edit_level_id').val(level['id']);

                    var roleTags = document.getElementsByClassName('edit-role');
                    for (var i in roleTags)
                        roleTags[i].checked = false;

                    var roles = level['roles'];
                    for (var i in roles)
                        document.getElementById('edit_role' + roles[i]['role_id']).checked = true;
                }
                $('#btn_show_level_edit_modal').trigger('click');
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
 * Create Level
 */
function createLevel() {
    // Check Validation
    var validateFields = [{
        field_id: 'add_level_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Level Name is required.',
            'numeric' + CONST_VALIDATE_SPLITER + "Level Name must be a number."
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        name: $('#add_level_name').val()
    };

    callAjax({
        url: BASE_URL + '/settings/org_hierarchy/create',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Init Form.
                $('#add_level_name').val("");

                // Refresh Table.
                refreshLevelTable();
                refreshLevelActTable();
                toastr.success("New level is created.", "Success");

                // Cancel Panel
                $('#btn_modal_add_level_close').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'name' + CONST_VALIDATE_SPLITER + 'add_level_name',
                    'role_id' + CONST_VALIDATE_SPLITER + 'add_level_role',
                ];
                showServerValidationErrors(validationFields, errors);
                toastr.error(err.message, "Error");
            }
        }
    });
}

/**
 * Update Level
 */
function updateLevel() {
    var roleTags = document.getElementsByClassName('edit-role');
    var roles = [];
    for (var i in roleTags) {
        var roleTag = roleTags[i];
        if (roleTag.checked == true) {
            roles.push(roleTag.getAttribute('data-id'));
        }
    }

    var formData = {
        level_id: $('#edit_level_id').val(),
        roles: roles
    };

    callAjax({
        url: BASE_URL + '/settings/org_hierarchy/update',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Refresh Table.
                refreshLevelTable();
                refreshLevelActTable();
                toastr.success("Role is updated.", "Success");

                // Cancel Panel
                $('#btn_modal_edit_level_close').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'name' + CONST_VALIDATE_SPLITER + 'edit_level_name',
                    'role_id' + CONST_VALIDATE_SPLITER + 'edit_level_role'
                ];
                showServerValidationErrors(validationFields, errors);

                toastr.error(err.message, "Error");
            }
        }
    });
}

/**
 * Delete Level
 */
function deleteLevel(id, name) {
    displayConfirmModal("Are you sure to delete this level (" + name + ")?", "Delete", function (res) {
        if (res == 'ok') {
            var formData = {
                id: id
            };

            callAjax({
                url: BASE_URL + '/settings/org_hierarchy/delete',
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data['result'] == 'success') {
                        // Refresh Table.
                        refreshLevelTable();
                        refreshLevelActTable();
                        toastr.success("Level is successfully deleted.", "Success");
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