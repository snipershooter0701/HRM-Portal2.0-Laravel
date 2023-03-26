var TableExpense = function () {
    var gridExpenseTbl = new Datatable();
    var gridExpensesActTbl = new Datatable();
    var gridAddExpenseTbl = new Datatable();

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    // Expense List Table
    var handleExpenseListTable = function () {

        gridExpenseTbl.init({
            src: $("#tbl_expenses"),
            onSuccess: function (gridExpenseTbl, response) { },
            onError: function (gridExpenseTbl) { },
            onDataLoad: function (gridExpenseTbl) {
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
                    "url": BASE_URL + "/expenses/get-expenses", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 1, 6]
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
        gridExpenseTbl.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", gridExpenseTbl.getTableWrapper());
            if (action.val() != "" && gridExpenseTbl.getSelectedRowsCount() > 0) {
                gridExpenseTbl.setAjaxParam("customActionType", "group_action");
                gridExpenseTbl.setAjaxParam("customActionName", action.val());
                gridExpenseTbl.setAjaxParam("id", gridExpenseTbl.getSelectedRows());
                gridExpenseTbl.getDataTable().ajax.reload();
                gridExpenseTbl.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: gridExpenseTbl.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (gridExpenseTbl.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: gridExpenseTbl.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // gridExpenseTbl.setAjaxParam("customActionType", "group_action");
        // gridExpenseTbl.getDataTable().ajax.reload();
        // gridExpenseTbl.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_expenses_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridExpenseTbl.getDataTable().button(action).trigger();
        });
    }

    // Expense Activity List Table
    var handleExpenseActListTable = function () {
        gridExpensesActTbl.init({
            src: $("#tbl_expense_activities"),
            onSuccess: function (gridExpensesActTbl, response) { },
            onError: function (gridExpensesActTbl) { },
            onDataLoad: function (gridExpensesActTbl) {
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
                    "url": BASE_URL + "/expenses/get-expenses-activities", // ajax source
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

        // gridExpensesActTbl.setAjaxParam("customActionType", "group_action");
        // gridExpensesActTbl.getDataTable().ajax.reload();
        // gridExpensesActTbl.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_expenses_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridExpensesActTbl.getDataTable().button(action).trigger();
        });
    }

    // Expense Add Table
    var handleExpenseAddListTable = function () {
        gridAddExpenseTbl.init({
            src: $("#tbl_add_expenses"),
            onSuccess: function (gridAddExpenseTbl, response) { },
            onError: function (gridAddExpenseTbl) { },
            onDataLoad: function (gridAddExpenseTbl) {
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
                    "url": BASE_URL + "/expenses/get-add-expenses", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 2, 4, 5]
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
            handleExpenseListTable();
            handleExpenseActListTable();
            handleExpenseAddListTable();
        }
    };
}();

$(document).ready(function () {
    TableExpense.init();
});