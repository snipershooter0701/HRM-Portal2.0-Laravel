var gridAwaitInvoice = new Datatable();

var TableAwaitInvoices = function () {
    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleAwaitInvoiceTable = function () {

        gridAwaitInvoice.init({
            src: $("#time_await_invoices"),
            onSuccess: function (gridAwaitInvoice, response) { },
            onError: function (gridAwaitInvoice) { },
            onDataLoad: function (gridAwaitInvoice) {
                $('.btn-await-inv-show').click(function() {
                    var id = $(this).attr('data-id');
                    showAwaitInv(id);
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
                    "url": BASE_URL + "/timesheets/awaiting/get_tbl_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 6]
                    }
                ],

                "order": [
                    [5, "desc"]
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
        gridAwaitInvoice.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", gridAwaitInvoice.getTableWrapper());
            if (action.val() != "" && gridAwaitInvoice.getSelectedRowsCount() > 0) {
                gridAwaitInvoice.setAjaxParam("customActionType", "group_action");
                gridAwaitInvoice.setAjaxParam("customActionName", action.val());
                gridAwaitInvoice.setAjaxParam("id", gridAwaitInvoice.getSelectedRows());
                gridAwaitInvoice.getDataTable().ajax.reload();
                gridAwaitInvoice.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: gridAwaitInvoice.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (gridAwaitInvoice.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: gridAwaitInvoice.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // handle datatable custom tools
        $('#time_await_invoices_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridAwaitInvoice.getDataTable().button(action).trigger();
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            initPickers();
            handleAwaitInvoiceTable();
        }
    };
}();

$(document).ready(function () {
    TableAwaitInvoices.init();
});

/**
 * Show awaiting invoice
 */
function showAwaitInv(id)
{

}