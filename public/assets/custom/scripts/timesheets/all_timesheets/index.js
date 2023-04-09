var gridAllTimeshhets = new Datatable();

var TableAllTimesheet = function () {
    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleAllTimesheetsTable = function () {

        gridAllTimeshhets.init({
            src: $("#tbl_all_timesheets"),
            onSuccess: function (gridAllTimeshhets, response) { },
            onError: function (gridAllTimeshhets) { },
            onDataLoad: function (gridAllTimeshhets) {
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
                    "url": BASE_URL + "/timesheets/all/get_tbl_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 1, 8, 9]
                    }
                ],

                "order": [
                    [7, "desc"]
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
        gridAllTimeshhets.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", gridAllTimeshhets.getTableWrapper());
            if (action.val() != "" && gridAllTimeshhets.getSelectedRowsCount() > 0) {
                gridAllTimeshhets.setAjaxParam("customActionType", "group_action");
                gridAllTimeshhets.setAjaxParam("customActionName", action.val());
                gridAllTimeshhets.setAjaxParam("id", gridAllTimeshhets.getSelectedRows());
                gridAllTimeshhets.getDataTable().ajax.reload();
                gridAllTimeshhets.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: gridAllTimeshhets.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (gridAllTimeshhets.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: gridAllTimeshhets.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // handle datatable custom tools
        $('#tbl_all_timesheets_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridAllTimeshhets.getDataTable().button(action).trigger();
        });
    }

    var handleTimePickers = function () {

        if (jQuery().timepicker) {
            $('.timepicker-24').timepicker({
                autoclose: true,
                minuteStep: 5,
                showSeconds: false,
                showMeridian: false
            });
        }
    }

    return {
        //main function to initiate the module
        init: function () {
            initPickers();
            handleAllTimesheetsTable();
            handleTimePickers();
        }
    };
}();

$(document).ready(function () {
    TableAllTimesheet.init();

    $('#btn_submit_timeheet_ok').click(function () {
        createTimesheet();
    });
});

/**
 * Refresh all timesheets
 */
function refreshAllTimesheets() {
    gridAllTimeshhets.getDataTable().ajax.reload();
    gridAllTimeshhets.clearAjaxParams();
}

/**
 * Create timesheet
 */
function createTimesheet() {
    // Check Validation
    var validateFields = [{
        field_id: 'create_timesheet_employee',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Client Name is required.'
        ]
    }, {
        field_id: 'create_timesheet_jobtire',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Job Tire is required.'
        ]
    }, {
        field_id: 'create_timesheet_workrange',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Work Range is required.',
        ],
        level: true
    }, {
        field_id: 'create_timesheet_attachment',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Attachment is required.'
        ]
    }, {
        field_id: 'create_timesheet_report',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Report is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var { monday, tuesday, wednesday, thursday, friday, saturday, sunday } = getMondayToSundayHMS($('#create_timesheet_workrange').val());

    var formData = {
        employee_id: $('#create_timesheet_employee').val(),
        job_tire_id: $('#create_timesheet_jobtire').val(),
        date_from: monday,
        date_to: sunday,
        attachment: $('#create_timesheet_attachment').val(),
        report: $('#create_timesheet_report').val(),
        standard_mon: $('#create_timesheet_std_mon').val(),
        standard_tue: $('#create_timesheet_std_tue').val(),
        standard_wed: $('#create_timesheet_std_wed').val(),
        standard_thu: $('#create_timesheet_std_thu').val(),
        standard_fri: $('#create_timesheet_std_fri').val(),
        standard_sat: $('#create_timesheet_std_sat').val(),
        standard_sun: $('#create_timesheet_std_sun').val(),
        over_time: $('#create_timesheet_overtime').val(),
        over_mon: $('#create_timesheet_over_mon').val(),
        over_tue: $('#create_timesheet_over_tue').val(),
        over_wed: $('#create_timesheet_over_wed').val(),
        over_thu: $('#create_timesheet_over_thu').val(),
        over_fri: $('#create_timesheet_over_fri').val(),
        over_sat: $('#create_timesheet_over_sat').val(),
        over_sun: $('#create_timesheet_over_sun').val(),
        double_time: $('#create_timesheet_doubletime').val(),
        double_mon: $('#create_timesheet_double_mon').val(),
        double_tue: $('#create_timesheet_double_tue').val(),
        double_wed: $('#create_timesheet_double_wed').val(),
        double_thu: $('#create_timesheet_double_thu').val(),
        double_fri: $('#create_timesheet_double_fri').val(),
        double_sat: $('#create_timesheet_double_sat').val(),
        double_sun: $('#create_timesheet_double_su').val(),
    };

    callAjax({
        url: BASE_URL + '/timesheets/all/create',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                $('#btn_submit_timeheet_cancel').trigger('click');

                // Reset Form
                $('#create_timesheet_employee').val("");
                $('#create_timesheet_jobtire').val("");
                $('#create_timesheet_workrange').val("");
                $('#create_timesheet_attachment').val("");
                $('#create_timesheet_report').val("");

                // Refresh Table.
                refreshAllTimesheets();
                toastr.success("Timesheet is successfully created.", "Success")
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'employee_id' + CONST_VALIDATE_SPLITER + 'create_timesheet_employee',
                    'job_tire_id' + CONST_VALIDATE_SPLITER + 'create_timesheet_jobtire',
                    'date_from' + CONST_VALIDATE_SPLITER + 'create_timesheet_workrange',
                    'date_to' + CONST_VALIDATE_SPLITER + 'create_timesheet_workrange',
                    'attachment' + CONST_VALIDATE_SPLITER + 'create_timesheet_attachment',
                    'report' + CONST_VALIDATE_SPLITER + 'create_timesheet_report',
                ];
                showServerValidationErrors(validationFields, errors);

                toastr.error(err.message, "Error");
            }
        }
    });
}

/**
 * Delete timesheet.
 */
function deleteTimesheet(id) {
    displayConfirmModal("Are you sure to delete this timesheet?", "Delete", function (res) {
        if (res == 'ok') {
            var formData = {
                id: id
            };

            callAjax({
                url: BASE_URL + '/timesheets/all/delete',
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data['result'] == 'success') {
                        // Refresh Table.
                        refreshAllTimesheets();
                        toastr.success("Timesheet is successfully deleted.", "Success");
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