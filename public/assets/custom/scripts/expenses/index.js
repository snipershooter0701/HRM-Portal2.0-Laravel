var gridExpenseTbl = new Datatable();
var gridExpensesActTbl = new Datatable();
var gridAddExpenseTbl = new Datatable();

var TableExpense = function () {

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
            onSuccess: function (gridExpenseTbl, response) {
                console.log(response);
                // set employee
                var i;
                var emp_name = '<option value="">Select</option>';
                for (i = 0; i < response['employees'].length; i++) {
                    emp_name += '<option value="' + response['employees'][i].id + '">' + response['employees'][i].first_name + response['employees'][i].last_name + '</option>'
                }
                $('#expense_emp').html(emp_name);

                $('#expense_total').val(response['total']);
            },
            onError: function (gridExpenseTbl) { },
            onDataLoad: function (gridExpenseTbl) {

                // view
                $('.btn-expense-view').click(function () {
                    var id = $(this).attr('data-id');
                    viewExpense(id);
                });

                // edit
                $('.btn-expense-edit').click(function () {
                    var id = $(this).attr('data-id');
                    $('#update_expenseloyee').attr('data-id', id);
                    setInfoUpdateBefore(id)
                });

                // delete
                $('.btn-expense-del').click(function () {
                    var id = $(this).attr('data-id');
                    displayConfirmModal('Do you want to delete?', 'Delete Expense', function (req) {
                        if (req == 'ok') {
                            deleteExpense(id);
                        }
                    })
                });
            },
            loadingMessage: 'Loading...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                "dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'>>",

                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": BASE_URL + "/expenses/get_expenses_list", // ajax source
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
                // "dom": "<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'>>",

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
            // handleExpenseActListTable();
            // handleExpenseAddListTable();
        }
    };
}();

$(document).ready(function () {
    TableExpense.init();

    $('#update_expense').click(function () {
        var id = $(this).attr('data-id');
        updateExpense(id);
    });
});

// Refresh Expense List Table
function refreshExpenseTbl() {
    gridExpenseTbl.getDataTable().ajax.reload();
    gridExpenseTbl.clearAjaxParams();
}


////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
//////                                                    //////////
//////              Expense View, Update, Delete          //////////
//////                                                    //////////
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////


// Get Request Details By ID
function getExpenseById(id) {
    var formData = {
        id: id
    };
    callAjax({
        url: BASE_URL + '/expenses/get_expense',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // move create Request page
                $('#add_request_details_btn').click();

                var details = data['details'];
                var doc = data['doc'];
                $('#req_emp_name').val(details['employee_id']);
                details['ssn'] == 1 ? $('#req_ssn').prop('checked', true) : details['ssn'] == 2 ? $('#req_ssn_star').addClass('star-active') : $('#req_ssn').prop('checked', false);
                details['work_auth'] == 1 ? $('#req_auth').prop('checked', true) : details['work_auth'] == 2 ? $('#req_auth_star').addClass('star-active') : $('#req_auth').prop('checked', false);
                details['state'] == 1 ? $('#req_state').prop('checked', true) : details['state'] == 2 ? $('#req_state_star').addClass('star-active') : $('#req_state').prop('checked', false);
                details['passport'] == 1 ? $('#req_passport').prop('checked', true) : details['passport'] == 2 ? $('#req_passport_star').addClass('star-active') : $('#req_passport').prop('checked', false);
                details['i94'] == 1 ? $('#req_i94').prop('checked', true) : details['i94'] == 2 ? $('#req_i94_star').addClass('star-active') : $('#req_i94').prop('checked', false);
                details['visa'] == 1 ? $('#req_visa').prop('checked', true) : details['visa'] == 2 ? $('#req_visa_star').addClass('star-active') : $('#req_visa').prop('checked', false);
                details['other_document'] == 1 ? $('#req_other').prop('checked', true) : details['other_document'] == 2 ? $('#req_other_star').addClass('star-active') : $('#req_other').prop('checked', false);
                $('#req_comment').val(details['comment']);

                for (var i in doc) {
                    if (doc[i]['doc_title_id'] == 0) {
                        $('#ssn_no').val(doc[i]['no']);
                    } else if (doc[i]['doc_title_id'] == 1) {
                        $('#auth_list').val(doc[i]['work_auth_id']);
                        $('#auth_no').val(doc[i]['no']);
                        $('#auth_start_date').val(doc[i]['start_date']);
                        $('#auth_end_date').val(doc[i]['expire_date']);
                    } else if (doc[i]['doc_title_id'] == 2) {
                        $('#state_no').val(doc[i]['no']);
                        $('#state_exp_date').val(doc[i]['exp_date']);
                    } else if (doc[i]['doc_title_id'] == 3) {
                        $('#passport_no').val(doc[i]['no']);
                        $('#passport_exp_date').val(doc[i]['exp_date']);
                    } else if (doc[i]['doc_title_id'] == 4) {
                        $('#i94_no').val(doc[i]['no']);
                        $('#i94_exp_date').val(doc[i]['exp_date']);
                        doc[i]['i94_type'] == 0 ? $('#uniform-i94_d_s_radio').prop('checked', true) : $('#uniform-i94_other_radio').prop('checked', true);
                    } else if (doc[i]['doc_title_id'] == 5) {
                        $('#visa_no').val(doc[i]['no']);
                        $('#visa_exp_date').val(doc[i]['exp_date']);
                    } else if (doc[i]['doc_title_id'] == 6) {
                        $('#other_comment').val(doc[i]['comment']);
                        $('#other_no').val(doc[i]['no']);
                        $('#other_exp_date').val(doc[i]['exp_date']);
                        $('#uniform-other_n_a_radio').prop('checked', true);
                    }
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

// View Expenses
function viewExpense(id) {
    // change update btn
    $('#add_expense_action').addClass('hide');
    $('#update_expense_action').addClass('hide');
    $('#view_expense_action').removeClass('hide');
    getExpenseById(id);
}


function setInfoUpdateBefore(id) {
    // change update btn
    $('#add_expense_action').addClass('hide');
    $('#update_expense_action').removeClass('hide');
    $('#view_expense_action').addClass('hide');
    getExpenseById(id);
}

// Update Request Details
function updateExpense(id) {

    // validation TODO
    var validateFields = [{
        field_id: 'expense_category',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Category field is required.'
        ]
    }, {
        field_id: 'expense_type',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Type field is required.'
        ]
    }, {
        field_id: 'expense_emp',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Employee field is required.'
        ]
    }];

    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        cate: $('#expense_category').val(),
        type: $('#expense_type').val(),
        emp: $('#expense_emp').val()
    };

    var i;
    var recordArray = [];
    var records = $('#add_bill').attr('data-idx');
    for (i = 0; i < records; i++) {
        var data = {
            date: $('.bill-date-' + (i + 1)).val(),
            details: $('.bill-detail-' + (i + 1)).val(),
            amount: $('.bill-amount-' + (i + 1)).val(),
            attachment: $('.bill-attachment-' + (i + 1)).val()
        };
        recordArray[i] = data;
    }

    formData['bill_record'] = recordArray;

    callAjax({
        url: BASE_URL + '/expenses/get_update_expenses',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshRequestDetailsList();
                // toastr.success("New Employee is successfully created.", "Success");

                // move request details list page
                $('#update_req_action .btn-move-panel').click();

                // Clear History
                $('#req_emp_name').val('');
                $('#req_comment').val('');
                $("#req_ssn").prop("checked", false);
                $('#req_ssn_star').removeClass("star-active");
                $('#req_auth').prop("checked", false);
                $('#req_auth_star').removeClass("star-active");
                $('#req_state').prop("checked", false);
                $('#req_state_star').removeClass("star-active");
                $('#req_passport').prop("checked", false);
                $('#req_passport_star').removeClass("star-active");
                $('#req_i94').prop("checked", false);
                $('#req_i94_star').removeClass("star-active");
                $('#req_visa').prop("checked", false);
                $('#req_visa_star').removeClass("star-active");
                $('#req_other').prop("checked", false);
                $('#req_other_star').removeClass("star-active");
                $('#ssn_no').val('');
                $('#ssn_file').val('')
                $('#auth_list').val('');
                $('#auth_no').val('');
                $('#auth_start_date').val('');
                $('#auth_end_date').val('');
                $('#auth_file').val('')
                $('#state_no').val('');
                $('#state_exp_date').val('');
                $('#state_file').val('')
                $('#passport_no').val('');
                $('#passport_exp_date').val('');
                $('#passport_file').val('');
                $('#i94_no').val('');
                $('#i94_exp_date').val('');
                $('#uniform-i94_d_s_radio').prop('checked', true)
                $('#i94_file').val('');
                $('#visa_no').val('');
                $('#visa_exp_date').val('');
                $('#visa_file').val('');
                $('#other_comment').val('');
                $('#other_no').val('');
                $('#other_exp_date').val('');
                $('#uniform-other_n_a_radio').prop('checked', true)
                $('#other_file').val('');

            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}

// Delete Request Details
function deleteExpense(id) {
    var formData = {
        id: id
    };

    callAjax({
        url: BASE_URL + '/expenses/get_del_expenses',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshRequestDetailsList();
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}
