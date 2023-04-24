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

                /**
                 * Approve Timesheet.
                 */
                $('.btn-timesheet-approve').click(function () {
                    var timesheetId = $(this).attr('data-id');
                    approveTimesheet(timesheetId);
                });

                /**
                 * Reject Timesheet
                 */
                $('.btn-timesheet-reject').click(function () {
                    var timesheetId = $(this).attr('data-id');
                    rejectTimesheet(timesheetId);
                });

                /**
                 * Show Edit Page
                 */
                $('.btn-timesheet-edit').click(function () {
                    var timesheetId = $(this).attr('data-id');
                    showTimesheetToEditPage(timesheetId);
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
                doMultiAction(action.val(), gridAllTimeshhets.getSelectedRows());
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

    // Init Timesheet's table.
    changeTimesheetWorkrange();
    refreshTotalHours();

    /**
     * Create Timesheet
     */
    $('#btn_submit_timeheet_ok').click(function () {
        createTimesheet();
    });

    /**
     * Update Timesheet
     */
    $('#btn_edit_timeheet_ok').click(function () {
        updateTimesheet();
    });

    /**
     * Add new timelines (OT Time, DT Time)
     */
    $('#btn_submit_add_item').click(function () {
        var showOrder = $('#show_order').val();
        if (showOrder == '0') {
            $('#show_order').val("1");
            $('#time_over').removeClass('display-none');
        } else if (showOrder == '1') {
            $('#show_order').val("2");
            $('#time_double').removeClass('display-none');
        }
    });

    /**
     * Add new timelines (OT Time, DT Time) (Edit Panel)
     */
    $('#btn_submit_edit_add_item').click(function () {
        var showOrder = $('#edit_show_order').val();
        if (showOrder == '0') {
            $('#edit_show_order').val("1");
            $('#edit_time_over').removeClass('display-none');
        } else if (showOrder == '1') {
            $('#edit_show_order').val("2");
            $('#edit_time_double').removeClass('display-none');
        }
    });

    /**
     * Change Work Range.
     */
    $('#create_timesheet_workrange').change(function () {
        var workRange = $(this).val();
        changeTimesheetWorkrange(workRange);
    });

    /**
     * Change Work Range (Edit Panel).
     */
    $('#edit_timesheet_workrange').change(function () {
        var workRange = $(this).val();
        changeEditTimesheetWorkrange(workRange)
    });

    /**
     * Change timepickers and redisplay total hours.
     */
    $('.create-time-picker').change(function () {
        refreshTotalHours();
    });

    /**
     * Change timepickers and redisplay total hours.
     */
    $('.edit-time-picker').change(function () {
        refreshEditTotalHours();
    });

    /**
     * Change JobTire by employee.
     */
    $('#create_timesheet_employee').change(function () {
        var employeeId = $(this).val();
        setJobTires(employeeId);
    });

    /**
     * Change timesheet.
     */
    $('#edit_timesheet_employee').change(function () {
        var employeeId = $(this).val();
        setEditJobTires(employeeId);
    });
});

/**
 * Refresh all timesheets
 */
function refreshAllTimesheets() {
    gridAllTimeshhets.getDataTable().ajax.reload();
    gridAllTimeshhets.clearAjaxParams();
}

// ======================================= BEGIN CREATE ACTIONS ==========================================
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
        ],
        file: true
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

    var formData = new FormData();
    formData.append('employee_id', $('#create_timesheet_employee').val());
    formData.append('job_tire_id', $('#create_timesheet_jobtire').val());
    formData.append('date_from', monday);
    formData.append('date_to', sunday);
    formData.append('attachment', $('#create_timesheet_attachment')[0].files[0]);
    formData.append('report', $('#create_timesheet_report').val());
    formData.append('standard_mon', getMinutesFromHour($('#create_timesheet_std_mon').val()));
    formData.append('standard_tue', getMinutesFromHour($('#create_timesheet_std_tue').val()));
    formData.append('standard_wed', getMinutesFromHour($('#create_timesheet_std_wed').val()));
    formData.append('standard_thu', getMinutesFromHour($('#create_timesheet_std_thu').val()));
    formData.append('standard_fri', getMinutesFromHour($('#create_timesheet_std_fri').val()));
    formData.append('standard_sat', getMinutesFromHour($('#create_timesheet_std_sat').val()));
    formData.append('standard_sun', getMinutesFromHour($('#create_timesheet_std_sun').val()));
    formData.append('over_time', $('#create_timesheet_overtime').val());
    formData.append('over_mon', getMinutesFromHour($('#create_timesheet_over_mon').val()));
    formData.append('over_tue', getMinutesFromHour($('#create_timesheet_over_tue').val()));
    formData.append('over_wed', getMinutesFromHour($('#create_timesheet_over_wed').val()));
    formData.append('over_thu', getMinutesFromHour($('#create_timesheet_over_thu').val()));
    formData.append('over_fri', getMinutesFromHour($('#create_timesheet_over_fri').val()));
    formData.append('over_sat', getMinutesFromHour($('#create_timesheet_over_sat').val()));
    formData.append('over_sun', getMinutesFromHour($('#create_timesheet_over_sun').val()));
    formData.append('double_time', $('#create_timesheet_doubletime').val());
    formData.append('double_mon', getMinutesFromHour($('#create_timesheet_double_mon').val()));
    formData.append('double_tue', getMinutesFromHour($('#create_timesheet_double_tue').val()));
    formData.append('double_wed', getMinutesFromHour($('#create_timesheet_double_wed').val()));
    formData.append('double_thu', getMinutesFromHour($('#create_timesheet_double_thu').val()));
    formData.append('double_fri', getMinutesFromHour($('#create_timesheet_double_fri').val()));
    formData.append('double_sat', getMinutesFromHour($('#create_timesheet_double_sat').val()));
    formData.append('double_sun', getMinutesFromHour($('#create_timesheet_double_sun').val()));

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
    }, true, true);
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

/**
 * Redisplay pay classification dates.
 */
function changeTimesheetWorkrange(workRange) {
    var { monday, tuesday, wednesday, thursday, friday, saturday, sunday } = getMondayToSundaySM(workRange);
    $('#pay_clf_mon').html(monday);
    $('#pay_clf_tue').html(tuesday);
    $('#pay_clf_wed').html(wednesday);
    $('#pay_clf_thu').html(thursday);
    $('#pay_clf_fri').html(friday);
    $('#pay_clf_sat').html(saturday);
    $('#pay_clf_sun').html(sunday);
}

/**
 * Refresh timesheet table, especially total billable hours and totla hours.
 */
function refreshTotalHours() {
    var stdMonTime = getMinutesFromHour($('#create_timesheet_std_mon').val());
    var stdTueTime = getMinutesFromHour($('#create_timesheet_std_tue').val());
    var stdWedTime = getMinutesFromHour($('#create_timesheet_std_wed').val());
    var stdThuTime = getMinutesFromHour($('#create_timesheet_std_thu').val());
    var stdFriTime = getMinutesFromHour($('#create_timesheet_std_fri').val());
    var stdSatTime = getMinutesFromHour($('#create_timesheet_std_sat').val());
    var stdSunTime = getMinutesFromHour($('#create_timesheet_std_sun').val());

    var overMonTime = getMinutesFromHour($('#create_timesheet_over_mon').val());
    var overTueTime = getMinutesFromHour($('#create_timesheet_over_tue').val());
    var overWedTime = getMinutesFromHour($('#create_timesheet_over_wed').val());
    var overThuTime = getMinutesFromHour($('#create_timesheet_over_thu').val());
    var overFriTime = getMinutesFromHour($('#create_timesheet_over_fri').val());
    var overSatTime = getMinutesFromHour($('#create_timesheet_over_sat').val());
    var overSunTime = getMinutesFromHour($('#create_timesheet_over_sun').val());

    var dobMonTime = getMinutesFromHour($('#create_timesheet_double_mon').val());
    var dobTueTime = getMinutesFromHour($('#create_timesheet_double_tue').val());
    var dobWedTime = getMinutesFromHour($('#create_timesheet_double_wed').val());
    var dobThuTime = getMinutesFromHour($('#create_timesheet_double_thu').val());
    var dobFriTime = getMinutesFromHour($('#create_timesheet_double_fri').val());
    var dobSatTime = getMinutesFromHour($('#create_timesheet_double_sat').val());
    var dobSunTime = getMinutesFromHour($('#create_timesheet_double_sun').val());

    $('#tot_bill_mon').html(getHoursFromMinute(stdMonTime + overMonTime + dobMonTime));
    $('#tot_bill_tue').html(getHoursFromMinute(stdTueTime + overTueTime + dobTueTime));
    $('#tot_bill_wed').html(getHoursFromMinute(stdWedTime + overWedTime + dobWedTime));
    $('#tot_bill_thu').html(getHoursFromMinute(stdThuTime + overThuTime + dobThuTime));
    $('#tot_bill_fri').html(getHoursFromMinute(stdFriTime + overFriTime + dobFriTime));
    $('#tot_bill_sat').html(getHoursFromMinute(stdSatTime + overSatTime + dobSatTime));
    $('#tot_bill_sun').html(getHoursFromMinute(stdSunTime + overSunTime + dobSunTime));
    $('#tot_bill_sum').html(getHoursFromMinute(stdMonTime + overMonTime + dobMonTime + stdTueTime + overTueTime + dobTueTime + stdWedTime + overWedTime + dobWedTime + stdThuTime + overThuTime + dobThuTime + stdFriTime + overFriTime + dobFriTime + stdSatTime + overSatTime + dobSatTime + stdSunTime + overSunTime + dobSunTime));
    $('#create_timesheet_std_sum').html(getHoursFromMinute(stdMonTime + stdTueTime + stdWedTime + stdThuTime + stdFriTime + stdSatTime + stdSunTime));
    $('#create_timesheet_over_sum').html(getHoursFromMinute(overMonTime + overTueTime + overWedTime + overThuTime + overFriTime + overSatTime + overSunTime));
    $('#create_timesheet_double_sum').html(getHoursFromMinute(dobMonTime + dobTueTime + dobWedTime + dobThuTime + dobFriTime + dobSatTime + dobSunTime));
}

/**
 * Set Job Tires
 */
function setJobTires(employeeId) {
    var formData = {
        employeeId: employeeId
    };

    callAjax({
        url: BASE_URL + '/timesheets/all/get_placements',
        type: "GET",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var placements = data['placements'];

                $('#create_timesheet_jobtire').html("");
                $('#create_timesheet_jobtire').append('<option value="">Select...</option>');
                for (var i in placements) {
                    $('#create_timesheet_jobtire').append('<option value="' + placements[i]['job_tire']['id'] + '">' + placements[i]['job_tire']['name'] + '</option>');
                }
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}
// ======================================= END CREATE ACTIONS ==========================================

/**
 * Approve timesheet
 */
function approveTimesheet(timesheetId) {
    displayConfirmModal("Are you sure to approve this timesheet?", "Approve Timesheet", function (res) {
        if (res == 'ok') {
            var formData = {
                id: timesheetId
            };

            callAjax({
                url: BASE_URL + '/timesheets/all/approve',
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data['result'] == 'success') {
                        // Refresh Table.
                        refreshAllTimesheets();
                        toastr.success("Timesheet is successfully approved.", "Success");
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
 * Reject timesheet
 */
function rejectTimesheet(timesheetId) {
    displayConfirmModal("Are you sure to reject this timesheet?", "Reject Timesheet", function (res) {
        if (res == 'ok') {
            var formData = {
                id: timesheetId
            };

            callAjax({
                url: BASE_URL + '/timesheets/all/reject',
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data['result'] == 'success') {
                        // Refresh Table.
                        refreshAllTimesheets();
                        toastr.success("Timesheet is successfully rejected.", "Success");
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
 * Do Multi action for tmesheet list table.
 */
function doMultiAction(action, ids) {
    var formData = {
        action: action,
        ids: ids
    };

    callAjax({
        url: BASE_URL + '/timesheets/all/do_mult_action',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Refresh Table.
                refreshAllTimesheets();
                if (action == "delete")
                    toastr.success("The columns has successfully deleted.", "Success");
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}

// ======================================= BEGIN EDIT ACTIONS ==========================================

/**
 * Show timesheet to edit page.
 */
function showTimesheetToEditPage(timesheetId) {
    var formData = {
        id: timesheetId
    };

    callAjax({
        url: BASE_URL + '/timesheets/all/get_timesheet',
        type: "GET",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var timesheet = data['timesheet'];

                $('#edit_timesheet_id').val(timesheet['id']);
                $('#edit_timesheet_employee').val(timesheet['employee_id']);
                $('#edit_timesheet_jobtire').val(timesheet['job_tire_id']);
                $('#edit_timesheet_workrange').val(timesheet['date_from']);
                // $('#edit_timesheet_attachment').val(timesheet['attachment']);
                $('#edit_timesheet_overtime').val(timesheet['over_time']);
                $('#edit_timesheet_doubletime').val(timesheet['double_time']);

                var { monday, tuesday, wednesday, thursday, friday, saturday, sunday } = getMondayToSundaySM($('#edit_timesheet_workrange').val());
                $('#edit_pay_clf_mon').html(monday);
                $('#edit_pay_clf_tue').html(tuesday);
                $('#edit_pay_clf_wed').html(wednesday);
                $('#edit_pay_clf_thu').html(thursday);
                $('#edit_pay_clf_fri').html(friday);
                $('#edit_pay_clf_sat').html(saturday);
                $('#edit_pay_clf_sun').html(sunday);

                $('#edit_timesheet_std_mon').val(getHoursFromMinute(timesheet['standard_mon']));
                $('#edit_timesheet_std_tue').val(getHoursFromMinute(timesheet['standard_tue']));
                $('#edit_timesheet_std_wed').val(getHoursFromMinute(timesheet['standard_wed']));
                $('#edit_timesheet_std_thu').val(getHoursFromMinute(timesheet['standard_thu']));
                $('#edit_timesheet_std_fri').val(getHoursFromMinute(timesheet['standard_fri']));
                $('#edit_timesheet_std_sat').val(getHoursFromMinute(timesheet['standard_sat']));
                $('#edit_timesheet_std_sun').val(getHoursFromMinute(timesheet['standard_sun']));
                $('#edit_timesheet_std_sum').html(getHoursFromMinute(timesheet['standard_mon'] +
                    timesheet['standard_tue'] + timesheet['standard_wed'] + timesheet['standard_thu'] +
                    timesheet['standard_fri'] + timesheet['standard_sat'] + timesheet['standard_sun']));

                $('#edit_timesheet_over_mon').val(getHoursFromMinute(timesheet['over_mon']));
                $('#edit_timesheet_over_tue').val(getHoursFromMinute(timesheet['over_tue']));
                $('#edit_timesheet_over_wed').val(getHoursFromMinute(timesheet['over_wed']));
                $('#edit_timesheet_over_thu').val(getHoursFromMinute(timesheet['over_thu']));
                $('#edit_timesheet_over_fri').val(getHoursFromMinute(timesheet['over_fri']));
                $('#edit_timesheet_over_sat').val(getHoursFromMinute(timesheet['over_sat']));
                $('#edit_timesheet_over_sun').val(getHoursFromMinute(timesheet['over_sun']));
                $('#edit_timesheet_over_sum').html(getHoursFromMinute(timesheet['over_mon'] +
                    timesheet['over_tue'] + timesheet['over_wed'] + timesheet['over_thu'] +
                    timesheet['over_fri'] + timesheet['over_sat'] + timesheet['over_sun']));

                $('#edit_timesheet_double_mon').val(getHoursFromMinute(timesheet['double_mon']));
                $('#edit_timesheet_double_tue').val(getHoursFromMinute(timesheet['double_tue']));
                $('#edit_timesheet_double_wed').val(getHoursFromMinute(timesheet['double_wed']));
                $('#edit_timesheet_double_thu').val(getHoursFromMinute(timesheet['double_thu']));
                $('#edit_timesheet_double_fri').val(getHoursFromMinute(timesheet['double_fri']));
                $('#edit_timesheet_double_sat').val(getHoursFromMinute(timesheet['double_sat']));
                $('#edit_timesheet_double_sun').val(getHoursFromMinute(timesheet['double_sun']));
                $('#edit_timesheet_double_sum').html(getHoursFromMinute(timesheet['double_mon'] +
                    timesheet['double_tue'] + timesheet['double_wed'] + timesheet['double_thu'] +
                    timesheet['double_fri'] + timesheet['double_sat'] + timesheet['double_sun']));

                $('#edit_tot_bill_mon').html(getHoursFromMinute(timesheet['standard_mon'] + timesheet['over_mon'] + timesheet['double_mon']));
                $('#edit_tot_bill_tue').html(getHoursFromMinute(timesheet['standard_tue'] + timesheet['over_tue'] + timesheet['double_tue']));
                $('#edit_tot_bill_wed').html(getHoursFromMinute(timesheet['standard_wed'] + timesheet['over_wed'] + timesheet['double_wed']));
                $('#edit_tot_bill_thu').html(getHoursFromMinute(timesheet['standard_thu'] + timesheet['over_thu'] + timesheet['double_thu']));
                $('#edit_tot_bill_fri').html(getHoursFromMinute(timesheet['standard_fri'] + timesheet['over_fri'] + timesheet['double_fri']));
                $('#edit_tot_bill_sat').html(getHoursFromMinute(timesheet['standard_sat'] + timesheet['over_sat'] + timesheet['double_sat']));
                $('#edit_tot_bill_sun').html(getHoursFromMinute(timesheet['standard_sun'] + timesheet['over_sun'] + timesheet['double_sun']));
                $('#edit_tot_bill_sum').html(getHoursFromMinute(timesheet['standard_mon'] + timesheet['over_mon'] + timesheet['double_mon'] +
                    timesheet['standard_tue'] + timesheet['over_tue'] + timesheet['double_tue'] +
                    timesheet['standard_wed'] + timesheet['over_wed'] + timesheet['double_wed'] +
                    timesheet['standard_thu'] + timesheet['over_thu'] + timesheet['double_thu'] +
                    timesheet['standard_fri'] + timesheet['over_fri'] + timesheet['double_fri'] +
                    timesheet['standard_sat'] + timesheet['over_sat'] + timesheet['double_sat'] +
                    timesheet['standard_sun'] + timesheet['over_sun'] + timesheet['double_sun']));

                $('#edit_timesheet_report').val(timesheet['report']);

                // Show Edit Page.
                $('#btn_to_edit_page').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}

/**
 * Redisplay pay classification dates (for edit panel).
 */
function changeEditTimesheetWorkrange(workRange) {
    var { monday, tuesday, wednesday, thursday, friday, saturday, sunday } = getMondayToSundaySM(workRange);
    $('#edit_pay_clf_mon').html(monday);
    $('#edit_pay_clf_tue').html(tuesday);
    $('#edit_pay_clf_wed').html(wednesday);
    $('#edit_pay_clf_thu').html(thursday);
    $('#edit_pay_clf_fri').html(friday);
    $('#edit_pay_clf_sat').html(saturday);
    $('#edit_pay_clf_sun').html(sunday);
}

/**
 * Refresh timesheet table, especially total billable hours and totla hours. (Edit Panel)
 */
function refreshEditTotalHours() {
    var stdMonTime = getMinutesFromHour($('#edit_timesheet_std_mon').val());
    var stdTueTime = getMinutesFromHour($('#edit_timesheet_std_tue').val());
    var stdWedTime = getMinutesFromHour($('#edit_timesheet_std_wed').val());
    var stdThuTime = getMinutesFromHour($('#edit_timesheet_std_thu').val());
    var stdFriTime = getMinutesFromHour($('#edit_timesheet_std_fri').val());
    var stdSatTime = getMinutesFromHour($('#edit_timesheet_std_sat').val());
    var stdSunTime = getMinutesFromHour($('#edit_timesheet_std_sun').val());

    var overMonTime = getMinutesFromHour($('#edit_timesheet_over_mon').val());
    var overTueTime = getMinutesFromHour($('#edit_timesheet_over_tue').val());
    var overWedTime = getMinutesFromHour($('#edit_timesheet_over_wed').val());
    var overThuTime = getMinutesFromHour($('#edit_timesheet_over_thu').val());
    var overFriTime = getMinutesFromHour($('#edit_timesheet_over_fri').val());
    var overSatTime = getMinutesFromHour($('#edit_timesheet_over_sat').val());
    var overSunTime = getMinutesFromHour($('#edit_timesheet_over_sun').val());

    var dobMonTime = getMinutesFromHour($('#edit_timesheet_double_mon').val());
    var dobTueTime = getMinutesFromHour($('#edit_timesheet_double_tue').val());
    var dobWedTime = getMinutesFromHour($('#edit_timesheet_double_wed').val());
    var dobThuTime = getMinutesFromHour($('#edit_timesheet_double_thu').val());
    var dobFriTime = getMinutesFromHour($('#edit_timesheet_double_fri').val());
    var dobSatTime = getMinutesFromHour($('#edit_timesheet_double_sat').val());
    var dobSunTime = getMinutesFromHour($('#edit_timesheet_double_sun').val());

    $('#edit_tot_bill_mon').html(getHoursFromMinute(stdMonTime + overMonTime + dobMonTime));
    $('#edit_tot_bill_tue').html(getHoursFromMinute(stdTueTime + overTueTime + dobTueTime));
    $('#edit_tot_bill_wed').html(getHoursFromMinute(stdWedTime + overWedTime + dobWedTime));
    $('#edit_tot_bill_thu').html(getHoursFromMinute(stdThuTime + overThuTime + dobThuTime));
    $('#edit_tot_bill_fri').html(getHoursFromMinute(stdFriTime + overFriTime + dobFriTime));
    $('#edit_tot_bill_sat').html(getHoursFromMinute(stdSatTime + overSatTime + dobSatTime));
    $('#edit_tot_bill_sun').html(getHoursFromMinute(stdSunTime + overSunTime + dobSunTime));
    $('#edit_tot_bill_sum').html(getHoursFromMinute(stdMonTime + overMonTime + dobMonTime + stdTueTime + overTueTime + dobTueTime + stdWedTime + overWedTime + dobWedTime + stdThuTime + overThuTime + dobThuTime + stdFriTime + overFriTime + dobFriTime + stdSatTime + overSatTime + dobSatTime + stdSunTime + overSunTime + dobSunTime));
    $('#edit_timesheet_std_sum').html(getHoursFromMinute(stdMonTime + stdTueTime + stdWedTime + stdThuTime + stdFriTime + stdSatTime + stdSunTime));
    $('#edit_timesheet_over_sum').html(getHoursFromMinute(overMonTime + overTueTime + overWedTime + overThuTime + overFriTime + overSatTime + overSunTime));
    $('#edit_timesheet_double_sum').html(getHoursFromMinute(dobMonTime + dobTueTime + dobWedTime + dobThuTime + dobFriTime + dobSatTime + dobSunTime));
}

/**
 * Set Job Tires (Edit Panel)
 */
function setEditJobTires(employeeId) {
    var formData = {
        employeeId: employeeId
    };

    callAjax({
        url: BASE_URL + '/timesheets/all/get_placements',
        type: "GET",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var placements = data['placements'];

                $('#edit_timesheet_jobtire').html("");
                $('#edit_timesheet_jobtire').append('<option value="">Select...</option>');
                for (var i in placements) {
                    $('#edit_timesheet_jobtire').append('<option value="' + placements[i]['job_tire']['id'] + '">' + placements[i]['job_tire']['name'] + '</option>');
                }
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}

/**
 * Update timesheet
 */
function updateTimesheet() {
    // Check Validation
    var validateFields = [{
        field_id: 'edit_timesheet_employee',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Client Name is required.'
        ]
    }, {
        field_id: 'edit_timesheet_jobtire',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Job Tire is required.'
        ]
    }, {
        field_id: 'edit_timesheet_workrange',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Work Range is required.',
        ],
        level: true
    }, {
        field_id: 'edit_timesheet_attachment',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Attachment is required.'
        ],
        file: true
    }, {
        field_id: 'edit_timesheet_report',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Report is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var { monday, tuesday, wednesday, thursday, friday, saturday, sunday } = getMondayToSundayHMS($('#edit_timesheet_workrange').val());

    var formData = new FormData();
    formData.append('id', $('#edit_timesheet_id').val());
    formData.append('employee_id', $('#edit_timesheet_employee').val());
    formData.append('job_tire_id', $('#edit_timesheet_jobtire').val());
    formData.append('date_from', monday);
    formData.append('date_to', sunday);
    formData.append('attachment', $('#edit_timesheet_attachment')[0].files[0]);
    formData.append('is_attachment', $('#edit_timesheet_attachment')[0].files.length);
    formData.append('report', $('#edit_timesheet_report').val());
    formData.append('standard_mon', getMinutesFromHour($('#edit_timesheet_std_mon').val()));
    formData.append('standard_tue', getMinutesFromHour($('#edit_timesheet_std_tue').val()));
    formData.append('standard_wed', getMinutesFromHour($('#edit_timesheet_std_wed').val()));
    formData.append('standard_thu', getMinutesFromHour($('#edit_timesheet_std_thu').val()));
    formData.append('standard_fri', getMinutesFromHour($('#edit_timesheet_std_fri').val()));
    formData.append('standard_sat', getMinutesFromHour($('#edit_timesheet_std_sat').val()));
    formData.append('standard_sun', getMinutesFromHour($('#edit_timesheet_std_sun').val()));
    formData.append('over_time', $('#edit_timesheet_overtime').val());
    formData.append('over_mon', getMinutesFromHour($('#edit_timesheet_over_mon').val()));
    formData.append('over_tue', getMinutesFromHour($('#edit_timesheet_over_tue').val()));
    formData.append('over_wed', getMinutesFromHour($('#edit_timesheet_over_wed').val()));
    formData.append('over_thu', getMinutesFromHour($('#edit_timesheet_over_thu').val()));
    formData.append('over_fri', getMinutesFromHour($('#edit_timesheet_over_fri').val()));
    formData.append('over_sat', getMinutesFromHour($('#edit_timesheet_over_sat').val()));
    formData.append('over_sun', getMinutesFromHour($('#edit_timesheet_over_sun').val()));
    formData.append('double_time', $('#edit_timesheet_doubletime').val());
    formData.append('double_mon', getMinutesFromHour($('#edit_timesheet_double_mon').val()));
    formData.append('double_tue', getMinutesFromHour($('#edit_timesheet_double_tue').val()));
    formData.append('double_wed', getMinutesFromHour($('#edit_timesheet_double_wed').val()));
    formData.append('double_thu', getMinutesFromHour($('#edit_timesheet_double_thu').val()));
    formData.append('double_fri', getMinutesFromHour($('#edit_timesheet_double_fri').val()));
    formData.append('double_sat', getMinutesFromHour($('#edit_timesheet_double_sat').val()));
    formData.append('double_sun', getMinutesFromHour($('#edit_timesheet_double_sun').val()));

    callAjax({
        url: BASE_URL + '/timesheets/all/update',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Refresh Table.
                refreshAllTimesheets();
                toastr.success("Timesheet is successfully updated.", "Success")
                
                // Show List Page
                $('#btn_edit_timeheet_cancel').trigger('click');
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
    }, true, true);
}
// ======================================= EDIT EDIT ACTIONS ==========================================