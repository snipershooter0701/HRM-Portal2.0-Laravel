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
                /**
                 * Submit Timesheet
                 */
                $('.btn-timesheet-submit').click(function () {
                    var id = $(this).attr('data-id');
                    showTimesheetPanel(id);
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
    TableDueTimesheet.init();

    /**
     * Create Timesheet
     */
    $('#btn_submit_timeheet_ok').click(function () {
        createTimesheet();
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
     * Change timepickers and redisplay total hours.
     */
    $('.create-time-picker').change(function () {
        refreshTotalHours();
    });
});

/**
 * Refresh due timesheets
 */
function refreshDueTimesheets() {
    gridDueTimesheet.getDataTable().ajax.reload();
    gridDueTimesheet.clearAjaxParams();
}

/**
 * Show create timesheet page.
 */
function showTimesheetPanel(id) {

    var formData = {
        id: id
    };

    callAjax({
        url: BASE_URL + '/timesheets/due/get_due_timesheet',
        type: "GET",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var timesheet = data['timesheet'];

                $('#create_timesheet_due_id').val(timesheet['id']);
                $('#create_timesheet_employee').val(timesheet['employee_id']);
                $('#create_timesheet_jobtire').val(timesheet['job_tire_id']);
                $('#create_timesheet_workrange').val(timesheet['date_to']);
                changeTimesheetWorkrange(timesheet['date_to']);

                $('#btn_to_submit_page').trigger('click');
            }
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
    formData.append('due_id', $('#create_timesheet_due_id').val());
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
                refreshDueTimesheets();
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