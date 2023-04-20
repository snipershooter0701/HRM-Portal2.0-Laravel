var gridInvoiceTable = new Datatable();
var gridInvoiceActTable = new Datatable();

var TableAllInvoice = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleInvTable = function () {
        gridInvoiceTable.init({
            src: $("#tbl_invoices"),
            onSuccess: function (gridInvoiceTable, response) { },
            onError: function (gridInvoiceTable) { },
            onDataLoad: function (gridInvoiceTable) {
                $('.btn-invoice-delete').click(function() {
                    var id = $(this).attr('data-id');
                    deleteInvoice(id);
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
                    "url": BASE_URL + "/invoices/all_inv/get_tbl_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 9]
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

        // handle group actionsubmit button click
        gridInvoiceTable.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", gridInvoiceTable.getTableWrapper());
            if (action.val() != "" && gridInvoiceTable.getSelectedRowsCount() > 0) {
                gridInvoiceTable.setAjaxParam("customActionType", "group_action");
                gridInvoiceTable.setAjaxParam("customActionName", action.val());
                gridInvoiceTable.setAjaxParam("id", gridInvoiceTable.getSelectedRows());
                gridInvoiceTable.getDataTable().ajax.reload();
                gridInvoiceTable.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: gridInvoiceTable.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (gridInvoiceTable.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: gridInvoiceTable.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // gridInvoiceTable.setAjaxParam("customActionType", "group_action");

        // handle datatable custom tools
        $('#tbl_invoices_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridInvoiceTable.getDataTable().button(action).trigger();
        });
    }

    var handleInvActTable = function () {

        gridInvoiceActTable.init({
            src: $("#tbl_invoice_activities"),
            onSuccess: function (gridInvoiceActTable, response) { },
            onError: function (gridInvoiceActTable) { },
            onDataLoad: function (gridInvoiceActTable) { },
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
                    "url": BASE_URL + "/invoices/all_inv/get_tbl_act_list", // ajax source
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
        //main function to initiate the module
        init: function () {
            initPickers();
            handleInvTable();
            handleInvActTable();
        }
    };
}();

$(document).ready(function () {
    TableAllInvoice.init();
});

/**
 * Refresh Invoice table.
 */
function refreshInvoiceTable() {
    gridInvoiceTable.getDataTable().ajax.reload();
    gridInvoiceTable.clearAjaxParams();
}

/**
 * Refresh Invoice Activity table.
 */
function refreshInvoiceActTable() {
    gridInvoiceActTable.getDataTable().ajax.reload();
    gridInvoiceActTable.clearAjaxParams();
}

/**
 * Delete Invoice
 */
function deleteInvoice(id)
{
    displayConfirmModal("Are you sure to delete this invoice?", "Delete", function (res) {
        if (res == 'ok') {
            var formData = {
                id: id
            };

            callAjax({
                url: BASE_URL + '/invoices/all_inv/delete',
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