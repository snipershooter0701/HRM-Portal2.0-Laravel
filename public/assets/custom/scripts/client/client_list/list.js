var gridClientListTable = new Datatable();
var gridClientListActsTable = new Datatable();

var TableClientList = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleClientListTable = function () {

        gridClientListTable.init({
            src: $("#tbl_client_list"),
            onSuccess: function (gridClientListTable, response) { },
            onError: function (gridClientListTable) { },
            onDataLoad: function (gridClientListTable) {
                $('.btn-client-delete').click(function () {
                    var id = $(this).attr('data-id');
                    var email = $(this).attr('data-email');

                    deleteClient(id, email);
                });

                $('.btn-client-edit').click(function () {
                    var id = $(this).attr('data-id');
                    showEditClientPage(id);
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
                    "url": BASE_URL + "/client/list/get_tbl_client_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 1, 5, 7]
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
        gridClientListTable.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", gridClientListTable.getTableWrapper());
            if (action.val() != "" && gridClientListTable.getSelectedRowsCount() > 0) {
                gridClientListTable.setAjaxParam("customActionType", "group_action");
                gridClientListTable.setAjaxParam("customActionName", action.val());
                gridClientListTable.setAjaxParam("id", gridClientListTable.getSelectedRows());
                gridClientListTable.getDataTable().ajax.reload();
                gridClientListTable.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: gridClientListTable.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (gridClientListTable.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: gridClientListTable.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // gridClientListTable.setAjaxParam("customActionType", "group_action");
        // gridClientListTable.getDataTable().ajax.reload();
        // gridClientListTable.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_client_list_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridClientListTable.getDataTable().button(action).trigger();
        });
    }

    var handleClientListActsTable = function () {

        gridClientListActsTable.init({
            src: $("#tbl_client_list_activities"),
            onSuccess: function (gridClientListActsTable, response) { },
            onError: function (gridClientListActsTable) { },
            onDataLoad: function (gridClientListActsTable) {
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
                    "url": BASE_URL + "/client/list/get_tbl_client_acts_list", // ajax source
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

        // gridClientListActsTable.setAjaxParam("customActionType", "group_action");
        // gridClientListActsTable.getDataTable().ajax.reload();
        // gridClientListActsTable.clearAjaxParams();
    }

    return {
        //main function to initiate the module
        init: function () {
            initPickers();
            handleClientListTable();
            handleClientListActsTable();
        }
    };
}();

$(document).ready(function () {
    TableClientList.init();
});

/**
 * Refresh Client list table.
 */
function refreshClientList() {
    // gridClientListTable.setAjaxParam("customActionType", "group_action");
    gridClientListTable.getDataTable().ajax.reload();
    gridClientListTable.clearAjaxParams();
}

/**
 * Delete Client
 * @param {*} id 
 * @param {*} email 
 */
function deleteClient(id, email) {
    displayConfirmModal("Are you sure to delete client (" + email + ")", "Delete", function (res) {
        if (res == 'ok') {
            var formData = {
                id: id
            };

            callAjax({
                url: BASE_URL + '/client/list/delete',
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data['result'] == 'success') {
                        // Refresh Table.
                        refreshClientList();
                        toastr.success("Client (" + email + ") is successfully deleted.", "Success");
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
 * Show client information to edit page.
 * @param {*} id 
 */
function showEditClientPage(id) {
    var formData = {
        id: id
    };

    callAjax({
        url: BASE_URL + '/client/list/get_client',
        type: "GET",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Set business information to form.
                var client = data['client'];
                $('#edit_client_id').val(client['id']);
                $('#edit_bus_name').val(client['business_name']);
                $('#edit_bus_contact_num').val(client['contact_number']);
                $('#edit_bus_federal_id').val(client['federal_id']);
                $('#edit_bus_email').val(client['email']);
                $('#edit_bus_website').val(client['website']);
                $('#edit_bus_inv_country').val(client['inv_country_id']);
                $('#edit_bus_inv_state').val(client['inv_state_id']);
                $('#edit_bus_inv_city').val(client['inv_city']);
                $('#edit_bus_inv_street').val(client['inv_street']);
                $('#edit_bus_inv_apt').val(client['inv_suite_aptno']);
                $('#edit_bus_inv_zipcode').val(client['inv_zipcode']);
                $('#edit_bus_cli_country').val(client['addr_country_id']);
                $('#edit_bus_cli_state').val(client['addr_state_id']);
                $('#edit_bus_cli_city').val(client['addr_city']);
                $('#edit_bus_cli_street').val(client['addr_street']);
                $('#edit_bus_cli_apt').val(client['addr_suite_aptno']);
                $('#edit_bus_cli_zipcode').val(client['addr_zipcode']);

                // Set Confidential information to form
                var confidential = data['confidential'];
                if (confidential != null) {
                    $('#add_conf_bankname').val(confidential['bankname']);
                    $('#add_conf_accounttype').val(confidential['accounttype']);
                    $('#add_conf_accountnumber').val(confidential['accountnumber']);
                    $('#add_conf_routingnumber').val(confidential['routingnumber']);
                    $('#add_conf_aptno').val(confidential['suite_aptno']);
                    $('#add_conf_street').val(confidential['street']);
                    $('#add_conf_city').val(confidential['city']);
                    $('#add_conf_state').val(confidential['state_id']);
                    $('#add_conf_country').val(confidential['country_id']);
                    $('#add_conf_zipcode').val(confidential['zipcode']);
                    $('#add_conf_status').val(confidential['status']);
                }

                // Show edit page.
                $('#btn_edit_client_page').trigger('click');

                // Filter Contact infos table.
                $('#filt_tbl_contact_info_client_id').val(client['id']);
                $('#btn_tbl_contact_info_search').trigger('click');

                // Filter Confidential table.
                $('#filt_tbl_confidential_client_id').val(client['id']);
                $('#btn_tbl_confidential_search').trigger('click');

                // Filter Placement table
                $('#filt_tbl_placement_client_id').val(client['id']);
                $('#btn_tbl_placement_search').trigger('click');

                // Filter Placement activity table
                $('#filt_tbl_placement_act_client_id').val(client['id']);
                $('#btn_tbl_placement_act_search').trigger('click');

                // Filter Invoice table
                $('#filt_tbl_invoice_client_id').val(client['id']);
                $('#btn_tbl_invoice_search').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}