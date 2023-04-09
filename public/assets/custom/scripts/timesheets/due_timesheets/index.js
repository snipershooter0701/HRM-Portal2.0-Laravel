var gridDueTimesheet = new Datatable();

var TableDueTimesheet = function () {
    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleAllTimesheetsTable = function () {

        gridDueTimesheet.init({
            src: $("#tbl_due_timesheet"),
            onSuccess: function (gridDueTimesheet, response) { },
            onError: function (gridDueTimesheet) { },
            onDataLoad: function (gridDueTimesheet) {
                $('.btn-timesheet-delete').click(function () {
                    var id = $(this).attr('data-id');
                    deleteTimesheet(id);
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
                    "url": BASE_URL + "/timesheets/due/get_tbl_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 6]
                    }
                ],

                "order": [
                    [2, "desc"]
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
        gridDueTimesheet.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", gridDueTimesheet.getTableWrapper());
            if (action.val() != "" && gridDueTimesheet.getSelectedRowsCount() > 0) {
                gridDueTimesheet.setAjaxParam("customActionType", "group_action");
                gridDueTimesheet.setAjaxParam("customActionName", action.val());
                gridDueTimesheet.setAjaxParam("id", gridDueTimesheet.getSelectedRows());
                gridDueTimesheet.getDataTable().ajax.reload();
                gridDueTimesheet.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: gridDueTimesheet.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (gridDueTimesheet.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: gridDueTimesheet.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // handle datatable custom tools
        $('#tbl_due_timesheet_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridDueTimesheet.getDataTable().button(action).trigger();
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            initPickers();
            handleAllTimesheetsTable();
        }
    };
}();

$(document).ready(function () {
    TableDueTimesheet.init();
});