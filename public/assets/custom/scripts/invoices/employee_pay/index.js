var gridEmpPayTable = new Datatable();
var gridEmpPayActTable = new Datatable();

var TableEmployeePay = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleEmpPay = function () {

        gridEmpPayTable.init({
            src: $("#tbl_employee_pays"),
            onSuccess: function (gridEmpPayTable, response) { },
            onError: function (gridEmpPayTable) { },
            onDataLoad: function (gridEmpPayTable) {
                $('.btn-show-emp-pay').click(function () {
                    $('#btn_show_emp_payment').trigger('click');
                });

                $('.btn-pay-emp-pay').click(function () {
                    $('#btn_pay_emp_payment').trigger('click');
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
                    "url": BASE_URL + "/invoices/employee_pay/get_tbl_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 1, 12]
                    }
                ],
                "order": [
                    [4, "desc"]
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
        gridEmpPayTable.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", gridEmpPayTable.getTableWrapper());
            if (action.val() != "" && gridEmpPayTable.getSelectedRowsCount() > 0) {
                gridEmpPayTable.setAjaxParam("customActionType", "group_action");
                gridEmpPayTable.setAjaxParam("customActionName", action.val());
                gridEmpPayTable.setAjaxParam("id", gridEmpPayTable.getSelectedRows());
                gridEmpPayTable.getDataTable().ajax.reload();
                gridEmpPayTable.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: gridEmpPayTable.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (gridEmpPayTable.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: gridEmpPayTable.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // handle datatable custom tools
        $('#tbl_employee_pays_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridEmpPayTable.getDataTable().button(action).trigger();
        });
    }

    var handleEmpPayActivity = function () {

        gridEmpPayActTable.init({
            src: $("#tbl_pay_activities"),
            onSuccess: function (gridEmpPayActTable, response) { },
            onError: function (gridEmpPayActTable) { },
            onDataLoad: function (gridEmpPayActTable) {
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
                    "url": BASE_URL + "/invoices/employee_pay/get_tbl_act_list", // ajax source
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
            handleEmpPay();
            handleEmpPayActivity();
        }
    };
}();

$(document).ready(function () {
    TableEmployeePay.init();
});

/**
 * Refresh employee payment table.
 */
function refreshEmpPayTable() {
    gridEmpPayTable.getDataTable().ajax.reload();
    gridEmpPayTable.clearAjaxParams();
}

/**
 * Refresh employee payment activity table.
 */
function refreshEmpPayActTable() {
    gridEmpPayActTable.getDataTable().ajax.reload();
    gridEmpPayActTable.clearAjaxParams();
}