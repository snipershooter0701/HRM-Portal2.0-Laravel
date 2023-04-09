var gridModuleSecTable = new Datatable();
var gridModuleSecActTable = new Datatable();

var TableModuleSec = function () {
    var initPickers = function () {
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleModuleSecTable = function () {

        gridModuleSecTable.init({
            src: $("#tbl_module_security"),
            onSuccess: function (gridModuleSecTable, response) { },
            onError: function (gridModuleSecTable) { },
            onDataLoad: function (gridModuleSecTable) {
                $('.btn-role-edit').click(function () {
                    var id = $(this).attr('data-id');

                    showEditModal(id);
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
                    "url": BASE_URL + "/settings/module_sec/get_tbl_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 2, 3, 4, 5, 7]
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

        // handle datatable custom tools
        $('#tbl_module_security_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridModuleSecTable.getDataTable().button(action).trigger();
        });
    }

    var handleModuleSecActTable = function () {

        gridModuleSecActTable.init({
            src: $("#tbl_module_sec_activities"),
            onSuccess: function (gridModuleSecActTable, response) { },
            onError: function (gridModuleSecActTable) { },
            onDataLoad: function (gridModuleSecActTable) { },
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
            handleModuleSecTable();
            handleModuleSecActTable();
        }
    };
}();

$(document).ready(function () {
    TableModuleSec.init();

    $('#btn_modal_edit_role_ok').click(function () {
        updateRoleSecurity();
    });
});

function refreshRoleTable() {
    gridModuleSecTable.getDataTable().ajax.reload();
    gridModuleSecTable.clearAjaxParams();
}

function showEditModal(id) {
    var formData = {
        id: id
    };
    callAjax({
        url: BASE_URL + '/settings/module_sec/get_role',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var role = data['role'];
                var roleModules = data['roleModule'];

                // Set Name
                $('#edit_perm_role').html(role['name']);
                $('#edit_perm_role_id').val(role['id']);

                // Set Role Permission
                document.getElementById('edit_perm_view_' + role['access_view']).checked = true;
                document.getElementById('edit_perm_add_' + role['access_add']).checked = true;
                document.getElementById('edit_perm_edit_' + role['access_edit']).checked = true;
                document.getElementById('edit_perm_delete_' + role['access_delete']).checked = true;

                // Set role modules
                var modules = document.getElementsByClassName('check-module');
                for (var i in modules)
                    modules[i].checked = false;
                for (var i in roleModules)
                    document.getElementById('edit_perm_module_' + roleModules[i]['module_id']).checked = true;

                $('#btn_show_role_edit_modal').trigger('click');
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

function updateRoleSecurity() {
    var viewPerm = $('input[name="view_perm"]:checked').val();
    var addPerm = $('input[name="add_perm"]:checked').val();
    var editPerm = $('input[name="edit_perm"]:checked').val();
    var deletePerm = $('input[name="delete_perm"]:checked').val();

    var modules = new Array();
    var moduleCheckboxes = document.getElementsByClassName('check-module');
    for (var i in moduleCheckboxes) {
        if (moduleCheckboxes[i].checked)
            modules.push(moduleCheckboxes[i].getAttribute('data-id'));
    }

    var formData = {
        id: $('#edit_perm_role_id').val(),
        access_view: viewPerm,
        access_add: addPerm,
        access_edit: editPerm,
        access_delete: deletePerm,
        modules: modules,
    };
    callAjax({
        url: BASE_URL + '/settings/module_sec/update',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Refresh Table.
                refreshRoleTable();
                toastr.success("Module Security is updated.", "Success");

                // Cancel Panel
                $('#btn_modal_edit_role_close').trigger('click');
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