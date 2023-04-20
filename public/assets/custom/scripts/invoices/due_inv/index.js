var gridInvTable = new Datatable();
var gridInvActTable = new Datatable();

var TableDueInvoice = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleInvTable = function () {

        gridInvTable.init({
            src: $("#tbl_invoices"),
            onSuccess: function (gridInvTable, response) { },
            onError: function (gridInvTable) { },
            onDataLoad: function (gridInvTable) {
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
                    "url": BASE_URL + "/invoices/due_inv/get_tbl_list", // ajax source
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
        gridInvTable.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", gridInvTable.getTableWrapper());
            if (action.val() != "" && gridInvTable.getSelectedRowsCount() > 0) {
                gridInvTable.setAjaxParam("customActionType", "group_action");
                gridInvTable.setAjaxParam("customActionName", action.val());
                gridInvTable.setAjaxParam("id", gridInvTable.getSelectedRows());
                gridInvTable.getDataTable().ajax.reload();
                gridInvTable.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: gridInvTable.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (gridInvTable.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: gridInvTable.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // gridInvTable.setAjaxParam("customActionType", "group_action");
        // gridInvTable.getDataTable().ajax.reload();
        // gridInvTable.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_invoices_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridInvTable.getDataTable().button(action).trigger();
        });
    }

    var handleInvActivities = function () {

        gridInvActTable.init({
            src: $("#tbl_invoice_activities"),
            onSuccess: function (gridInvActTable, response) { },
            onError: function (gridInvActTable) { },
            onDataLoad: function (gridInvActTable) {
                $('.btn-invoice-delete').click(function() {
                    var id = $(this).attr('data-id');
                    deleteDueInvoice(id);
                });
            },
            loadingMessage: 'Loading...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                "dom": "<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'>>",

                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": BASE_URL + "/invoices/due_inv/get_tbl_act_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0]
                    }
                ],
                "order": [
                    [1, "asc"]
                ],// set first column as a default sort by asc
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            initPickers();
            handleInvTable();
            handleInvActivities();
        }
    };
}();

$(document).ready(function () {
    TableDueInvoice.init();
});

/**
 * Refresh Invoice table.
 */
function refreshInvoiceTable() {
    gridInvTable.getDataTable().ajax.reload();
    gridInvTable.clearAjaxParams();
}

/**
 * Refresh Invoice Activity table.
 */
function refreshInvoiceActTable() {
    gridInvActTable.getDataTable().ajax.reload();
    gridInvActTable.clearAjaxParams();
}

/**
 * Delete Due Invoice
 */
function deleteDueInvoice(id) {
    displayConfirmModal("Are you sure to delete this invoice?", "Delete", function (res) {
        if (res == 'ok') {
            var formData = {
                id: id
            };

            callAjax({
                url: BASE_URL + '/invoices/due_inv/delete',
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data['result'] == 'success') {
                        // Refresh Table.
                        refreshInvoiceTable();
                        refreshInvoiceActTable();
                        toastr.success("Invoice is successfully deleted.", "Success");
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