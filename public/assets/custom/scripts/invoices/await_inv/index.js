var gridAwaitInvTable = new Datatable();
var graidAwaitInvActTable = new Datatable();

var TableAllInvoice = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleInvTable = function () {

        gridAwaitInvTable.init({
            src: $("#tbl_await_invoices"),
            onSuccess: function (gridAwaitInvTable, response) { },
            onError: function (gridAwaitInvTable) { },
            onDataLoad: function (gridAwaitInvTable) {
                $('.btn-invoice-delete').click(function() {
                    var id = $(this).attr('data-id');
                    deleteAwaitInvoice(id);
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
                    "url": BASE_URL + "/invoices/await_inv/get_tbl_list", // ajax source
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
        gridAwaitInvTable.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", gridAwaitInvTable.getTableWrapper());
            if (action.val() != "" && gridAwaitInvTable.getSelectedRowsCount() > 0) {
                gridAwaitInvTable.setAjaxParam("customActionType", "group_action");
                gridAwaitInvTable.setAjaxParam("customActionName", action.val());
                gridAwaitInvTable.setAjaxParam("id", gridAwaitInvTable.getSelectedRows());
                gridAwaitInvTable.getDataTable().ajax.reload();
                gridAwaitInvTable.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: gridAwaitInvTable.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (gridAwaitInvTable.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: gridAwaitInvTable.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // handle datatable custom tools
        $('#tbl_await_invoices_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridAwaitInvTable.getDataTable().button(action).trigger();
        });
    }

    var handleInvActivities = function () {

        graidAwaitInvActTable.init({
            src: $("#tbl_ivc_activities"),
            onSuccess: function (graidAwaitInvActTable, response) { },
            onError: function (graidAwaitInvActTable) { },
            onDataLoad: function (graidAwaitInvActTable) {
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
                    "url": BASE_URL + "/invoices/await_inv/get_tbl_act_list", // ajax source
                },
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
    TableAllInvoice.init();
});

/**
 * Refresh Await Invoice table.
 */
function refreshInvoiceTable() {
    gridAwaitInvTable.getDataTable().ajax.reload();
    gridAwaitInvTable.clearAjaxParams();
}

/**
 * Refresh Await Invoice Activity table.
 */
function refreshInvoiceActTable() {
    graidAwaitInvActTable.getDataTable().ajax.reload();
    graidAwaitInvActTable.clearAjaxParams();
}

/**
 * Delete Await Invoice
 */
function deleteAwaitInvoice(id) {
    displayConfirmModal("Are you sure to delete this invoice?", "Delete", function (res) {
        if (res == 'ok') {
            var formData = {
                id: id
            };

            callAjax({
                url: BASE_URL + '/invoices/await_inv/delete',
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data['result'] == 'success') {
                        // Refresh Table.
                        refreshInvoiceTable();
                        refreshInvoiceActTable();
                        toastr.success("Awaiting Invoice is successfully deleted.", "Success");
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