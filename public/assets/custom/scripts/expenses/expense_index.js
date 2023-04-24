var gridExpenseTbl = new Datatable();
var gridExpensesActTbl = new Datatable();

$(document).ready(function () {
    TableExpense.init();

    $('.page-move-btn').click(function () {
        var parent_name = $(this).parent().attr('id');
        var panelName = $(this).attr('data-panelname');

        if (parent_name == 'add_expense_action' || parent_name == 'update_expense_action' || parent_name == 'view_expense_action') {
            refreshRecord();
            $('#add_bill').attr('data-idx', '1');
        }

        $('#expense_category').val('');
        $('#expense_type').val('');
        $('#expense_emp').val('');
        btnStatus('add');
        movePanel(panelName);
    });

    $('#add_expense_btn').click(function () {
        var panelName = $(this).attr('data-panelname');
        movePanel(panelName);
    });

    // update expense
    $('#update_expense').click(function () {
        var id = $(this).attr('data-id');
        updateExpense(id);
    });

    // create employee
    $('#save_expense').click(function () {
        saveExpense();
    });

    // add bill
    $('#add_bill').click(function () {
        var i = parseInt($(this).attr('data-idx'));
        appendRecord(i + 1)
    });
});

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
                    $('#update_expense').attr('data-id', id);
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
                    "url": BASE_URL + "/expenses/list", // ajax source
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
                    "url": BASE_URL + "/expenses/act", // ajax source
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

    return {
        //main function to initiate the module
        init: function () {
            initPickers();
            handleExpenseListTable();
            handleExpenseActListTable();
        }
    };
}();



// Refresh Expense List Table
function refreshExpenseTbl() {
    gridExpenseTbl.getDataTable().ajax.reload();
    gridExpenseTbl.clearAjaxParams();
}

// Append Record in Expendse Table
function appendRecord(i) {
    var add_bill = '<tr>' +
        '<td>' + i + '</td>' +
        '<td><div class="input-group date date-picker" data-date-format="yyyy-mm-dd">' +
        '<input type="text" class="form-control input-sm bill-date-' + i + '">' +
        '<span class="input-group-btn"><button class="btn btn-sm default" type="button"> <i class="fa fa-calendar"></i></button></div>' +
        '</td>' +
        '<td> <input type="text" class="form-control input-sm bill-detail-' + i + '"> </td>' +
        '<td> <input type="text" class="form-control input-sm bill-amount-' + i + '">  </td>' +
        '<td> <input type="file" class="form-control bill-attachment input-sm bill-attachment-' + i + '"> </td>' +
        '<td>  <a href="javascript:;" class="btn btn-xs btn-c-grey bill-del-' + i + '"><i class="fa fa-trash"></i></a> </td>' +
        '</tr>';

    $('#tbl_add_expenses tbody').append(add_bill);
    $('#add_bill').attr('data-idx', i);

    $('.date-picker').datepicker({
        rtl: App.isRTL(),
        autoclose: true
    });
}

// Refresh Record in Expendse Table
function refreshRecord() {
    $('#tbl_add_expenses tbody').html(
        '<tr>' +
        '<td>1</td>' +
        '<td><div class="input-group date date-picker" data-date-format="yyyy-mm-dd">' +
        '<input type="text" class="form-control input-sm bill-date-1">' +
        '<span class="input-group-btn"><button class="btn btn-sm default" type="button"> <i class="fa fa-calendar"></i></button></div>' +
        '</td>' +
        '<td> <input type="text" class="form-control input-sm bill-detail-1"> </td>' +
        '<td> <input type="text" class="form-control input-sm bill-amount-1">  </td>' +
        '<td> <input type="file" class="form-control bill-attachment input-sm bill-attachment-1"> </td>' +
        '<td> <a href="javascript:;" class="btn btn-xs btn-c-grey hide bill-del-1"><i class="fa fa-trash"></i></a> </td>' +
        '</tr>'
    );
    $('.date-picker').datepicker({
        rtl: App.isRTL(),
        autoclose: true
    });
}


////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
//////                                                    //////////
//////         Expense Add, View, Update, Delete          //////////
//////                                                    //////////
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////

// Add Expense
function saveExpense() {

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

    var formData = {
        cate: $('#expense_category').val(),
        type: $('#expense_type').val(),
        emp: $('#expense_emp').val(),
        bill_record: recordArray
    };

    callAjax({
        url: BASE_URL + '/expenses/add',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshExpenseTbl();
                toastr.success("New Expense is successfully created.", "Success");

                // Move Expense List Page
                $('#add_expense_action .page-move-btn').click();

                $('#expense_category').val('');
                $('#expense_type').val('');
                $('#expense_emp').val('');
                refreshRecord();
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'business_name' + CONST_VALIDATE_SPLITER + 'create_bus_name',
                    'contact_number' + CONST_VALIDATE_SPLITER + 'create_bus_contact_num',
                    'federal_id' + CONST_VALIDATE_SPLITER + 'create_bus_federal_id',
                    'email' + CONST_VALIDATE_SPLITER + 'create_bus_email',
                    'website' + CONST_VALIDATE_SPLITER + 'create_bus_website',
                    'inv_country_id' + CONST_VALIDATE_SPLITER + 'create_bus_inv_country',
                    'inv_state_id' + CONST_VALIDATE_SPLITER + 'create_bus_inv_state',
                    'inv_city' + CONST_VALIDATE_SPLITER + 'create_bus_inv_city',
                    'inv_street' + CONST_VALIDATE_SPLITER + 'create_bus_inv_street',
                    'inv_suite_aptno' + CONST_VALIDATE_SPLITER + 'create_bus_inv_apt',
                    'inv_zipcode' + CONST_VALIDATE_SPLITER + 'create_bus_inv_zipcode',
                    'addr_country_id' + CONST_VALIDATE_SPLITER + 'create_bus_cli_country',
                    'addr_state_id' + CONST_VALIDATE_SPLITER + 'create_bus_cli_state',
                    'addr_city' + CONST_VALIDATE_SPLITER + 'create_bus_cli_city',
                    'addr_street' + CONST_VALIDATE_SPLITER + 'create_bus_cli_street',
                    'addr_suite_aptno' + CONST_VALIDATE_SPLITER + 'create_bus_cli_apt',
                    'addr_zipcode' + CONST_VALIDATE_SPLITER + 'create_bus_cli_zipcode',
                ];
                showServerValidationErrors(validationFields, errors);

                toastr.error(err.message, "Error");
            }
        }
    });
}

// Get Expense By ID
function getExpenseById(id) {
    var formData = {
        id: id
    };
    callAjax({
        url: BASE_URL + '/expenses/by_id',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var expense = data['expense'];

                var i;
                var bill_record = expense[0]['expensebill'];
                for (i = 0; i < bill_record.length; i++) {
                    var j = parseInt($('#add_bill').attr('data-idx'));
                    $('.bill-date-' + j).val(bill_record[i]['date']);
                    $('.bill-detail-' + j).val(bill_record[i]['details']);
                    $('.bill-amount-' + j).val(bill_record[i]['amount']);
                    $('.bill-del-' + j).attr('data-id', bill_record[i]['id']);
                    // $('.bill-attachment-' + (i + 1)).val(bill_record[i]['attachment']);
                    if (i < bill_record.length - 1) {
                        appendRecord(j + 1);
                    }
                }

                $('#expense_category').val(expense[0]['category']);
                $('#expense_type').val(expense[0]['type']);
                $('#expense_emp').val(expense[0]['employee_id']);

                // move create Request page
                $('#add_expense_btn').click();
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}


function btnStatus(param) {
    if (param == 'add') {
        $('#add_expense_action').removeClass('display-none');
        $('#view_expense_action').addClass('display-none');
        $('#update_expense_action').addClass('display-none');
        $('#add_bill').addClass('display-none');
    } else if (param == 'update') {
        $('#add_expense_action').addClass('display-none');
        $('#update_expense_action').removeClass('display-none');
        $('#view_expense_action').addClass('display-none');
        $('#add_bill').removeClass('display-none');
    } else if (param == 'view') {
        $('#view_expense_action').removeClass('display-none');
        $('#add_expense_action').addClass('display-none');
        $('#update_expense_action').addClass('display-none');
        $('#add_bill').addClass('display-none');
    }
}

// View Expense
function viewExpense(id) {
    // change update btn
    btnStatus('view');
    getExpenseById(id);
}

// Update Before
function setInfoUpdateBefore(id) {
    // change update btn
    btnStatus('update');
    getExpenseById(id);
}

// Update Expense
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

    var i;
    var recordArray = [];
    var records = $('#add_bill').attr('data-idx');
    for (i = 0; i < records; i++) {
        var data = {
            id: $('.bill-del-' + (i + 1)).attr('data-id'),
            date: $('.bill-date-' + (i + 1)).val(),
            details: $('.bill-detail-' + (i + 1)).val(),
            amount: $('.bill-amount-' + (i + 1)).val(),
            attachment: $('.bill-attachment-' + (i + 1)).val()
        };
        recordArray[i] = data;
    }

    var formData = {
        id: id,
        cate: $('#expense_category').val(),
        type: $('#expense_type').val(),
        emp: $('#expense_emp').val(),
        bill_record: recordArray
    };

    callAjax({
        url: BASE_URL + '/expenses/update',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshExpenseTbl();
                toastr.success("Expense is successfully updated.", "Success");

                // Move Expense List Page
                $('#update_expense_action .page-move-btn').click();

                $('#expense_category').val('');
                $('#expense_type').val('');
                $('#expense_emp').val('');
                refreshRecord();

            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}

// Delete Expense
function deleteExpense(id) {
    var formData = {
        id: id
    };

    callAjax({
        url: BASE_URL + '/expenses/del',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshExpenseTbl();
                toastr.success("Expense is successfully deleted.", "Success");
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}
