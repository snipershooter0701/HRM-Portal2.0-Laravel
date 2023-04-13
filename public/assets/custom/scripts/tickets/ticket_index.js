
$(document).ready(function () {
    TableTicket.init();

    $('.page-move-btn').click(function () {
        var panelName = $(this).attr('data-panelname');
        $('#create_emp_id').val('');
        $('#create_department_id').val('');
        $('#create_subject').val('');
        $('#create_attachment').val('');
        $('#create_detail').val('');
        btnStatus('add');
        movePanel(panelName);
    });

    // create ticket
    $('#create_ticket').click(function () {
        createTicket();
    });

    // Update ticket
    $('#update_ticket').click(function () {
        var id = $(this).attr('data-id');
        updateTicketInfo(id);
    });

    // Discussion
    $('#ticket_discuss').click(function () {
        setChatHis();
    });
});


var grid_ticket = new Datatable();

var TableTicket = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleTicketTable = function () {



        grid_ticket.init({
            src: $("#tbl_tickets"),
            onSuccess: function (grid_ticket, response) {
                // set employee 
                var i;
                var employee = response['employees'];
                var emp_name = '<option value="">Select</option>';
                for (i = 0; i < employee.length; i++) {
                    emp_name += '<option value="' + employee[i]['id'] + '">' + employee[i]['first_name'] + employee[i]['last_name'] + '</option>';
                }
                $('#create_emp_id').html(emp_name);

                // set department 
                var i;
                var department = response['departments'];
                var depart = '<option value="">Select</option>';
                for (i = 0; i < department.length; i++) {
                    depart += '<option value="' + department[i]['id'] + '">' + department[i]['name'] + '</option>';
                }
                $('#create_department_id').html(depart);
            },
            onError: function (grid_ticket) { },
            onDataLoad: function (grid_ticket) {
                // view
                $('.btn-ticket-view').click(function () {
                    var id = $(this).attr('data-id');
                    viewTicketInfo(id);
                });

                // edit
                $('.btn-ticket-update').click(function () {
                    var id = $(this).attr('data-id');
                    $('#update_ticket').attr('data-id', id);
                    setTicketUpdateBefore(id)
                });

                // delete
                $('.btn-ticket-del').click(function () {
                    var id = $(this).attr('data-id');
                    displayConfirmModal('Do you want to delete?', 'Delete Ticket', function (req) {
                        if (req == 'ok') {
                            delTicketInfo(id);
                        }
                    })
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
                    "url": BASE_URL + "/tickets/list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 1, 9]
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
        grid_ticket.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid_ticket.getTableWrapper());
            if (action.val() != "" && grid_ticket.getSelectedRowsCount() > 0) {
                grid_ticket.setAjaxParam("customActionType", "group_action");
                grid_ticket.setAjaxParam("customActionName", action.val());
                grid_ticket.setAjaxParam("id", grid_ticket.getSelectedRows());
                grid_ticket.getDataTable().ajax.reload();
                grid_ticket.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid_ticket.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid_ticket.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid_ticket.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid_ticket.setAjaxParam("customActionType", "group_action");
        // grid_ticket.getDataTable().ajax.reload();
        // grid_ticket.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_tickets_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            grid_ticket.getDataTable().button(action).trigger();
        });
    }

    var handleTicketActivityTable = function () {

        let grid = new Datatable();

        grid.init({
            src: $("#tbl_pay_activities"),
            onSuccess: function (grid, response) { },
            onError: function (grid) { },
            onDataLoad: function (grid) {
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
                    "url": BASE_URL + "/invoices/due-inv/get-activities", // ajax source
                },
                "order": [
                    [1, "asc"]
                ],// set first column as a default sort by asc
            }
        });
    }

    var handleUserTicketTable = function () {

        let grid = new Datatable();

        grid.init({
            src: $("#tbl_user_tickets"),
            onSuccess: function (grid, response) { },
            onError: function (grid) { },
            onDataLoad: function (grid) {
                $('.btn-emp-ticket-view').click(function () {
                    $('#btn_show_ticket').trigger('click');
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
                    "url": BASE_URL + "/tickets/get-emp-tickets", // ajax source
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
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid.setAjaxParam("customActionType", "group_action");
        // grid.getDataTable().ajax.reload();
        // grid.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_user_tickets_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            grid.getDataTable().button(action).trigger();
        });
    }

    var handleEmpTicketActivityTable = function () {

        let grid = new Datatable();

        grid.init({
            src: $("#tbl_emp_ticket_activities"),
            onSuccess: function (grid, response) { },
            onError: function (grid) { },
            onDataLoad: function (grid) {
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
                    "url": BASE_URL + "/invoices/due-inv/get-activities", // ajax source
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
            handleTicketTable();
            //     handleTicketActivityTable();
            //     handleUserTicketTable();
            //     handleEmpTicketActivityTable();
        }
    };
}();


function refreshTicketList() {
    grid_ticket.getDataTable().ajax.reload();
    grid_ticket.clearAjaxParams();
}

function createTicket() {
    // validation TODO
    var validateFields = [{
        field_id: 'create_emp_id',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Employee Name field is required.'
        ]
    }, {
        field_id: 'create_department_id',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Department field is required.'
        ]
    }, {
        field_id: 'create_subject',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Subject field is required.'
        ]
    }, {
        field_id: 'create_file',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Attachment field is required.',
        ]
    }, {
        field_id: 'create_detail',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Explain field is required.',
        ]
    }];

    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        emp_id: $('#create_emp_id').val(),
        department_id: $('#create_department_id').val(),
        subject: $('#create_subject').val(),
        attachment: $('#create_file').val(),
        details: $('#create_detail').val(),
    };


    callAjax({
        url: BASE_URL + '/tickets/add',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshTicketList();
                toastr.success("New Ticket is successfully created.", "Success");

                // move Employee list page
                $('#add_ticket_action .page-move-btn').click();

                $('#create_emp_id').val('');
                $('#create_department_id').val('');
                $('#create_subject').val('');
                $('#create_attachment').val('');
                $('#create_detail').val('');
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

// get Ticket By ID
function getTicketByID(id, type) {
    var formData = {
        id: id
    };

    callAjax({
        url: BASE_URL + '/tickets/by_id',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var ticket = data['ticket'][0];

                if (type == 'view') {
                    $('#view_emp_name').html(ticket['employee']['first_name'] + ticket['employee']['last_name']);
                    $('#view_ticket_no').html(ticket['id']);
                    $('#view_subject').html(ticket['subject']);
                    $('#view_details').html(ticket['details']);
                    $('#view_status').html(ticket['status'] == 0 ? 'Request' : ticket['status'] == 1 ? 'Assigned' : 'Completed');
                    $('#view_assigned_to').html(ticket['assigned']['first_name'] + ticket['assigned']['last_name']);
                    $('#view_created_on').html(ticket['created_on'] == null ? '' : ticket['created_on']);
                    $('#view_closed_on').html(ticket['closed_on'] == null ? '' : ticket['closed_on']);
                    $('#view_file').val(ticket['attacment']);
                    $('#modal_view_ticket').modal();

                } else {
                    $('#create_emp_id').val(ticket['employee_id']);
                    $('#create_department_id').val(ticket['department_id']);
                    $('#create_subject').val(ticket['subject']);
                    // $('#create_file').val(ticket['attachment']);
                    $('#create_detail').val(ticket['details']);

                    // move add Employee page
                    $('#create_ticket_btn').click();
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

function btnStatus(param) {
    if (param == 'add') {
        $('#add_ticket_action').removeClass('hide');
        $('#update_ticket_action').addClass('hide');
    } else if (param == 'update') {
        $('#add_ticket_action').addClass('hide');
        $('#update_ticket_action').removeClass('hide');
    }
}

// View Employee Info
function viewTicketInfo(id) {
    // change update btn
    btnStatus('view');
    getTicketByID(id, 'view');
}

function setTicketUpdateBefore(id) {
    // change update btn
    btnStatus('update');
    getTicketByID(id, 'update');
}

// Update Employee Info
function updateTicketInfo(id) {

    // validation TODO
    var validateFields = [{
        field_id: 'create_emp_id',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Employee Name field is required.'
        ]
    }, {
        field_id: 'create_department_id',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Department field is required.'
        ]
    }, {
        field_id: 'create_subject',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Subject field is required.'
        ]
    }, {
        field_id: 'create_file',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Attachment field is required.',
        ]
    }, {
        field_id: 'create_detail',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Explain field is required.',
        ]
    }];

    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        id: id,
        emp_id: $('#create_emp_id').val(),
        department_id: $('#create_department_id').val(),
        subject: $('#create_subject').val(),
        attachment: $('#create_file').val(),
        details: $('#create_detail').val(),
    };

    callAjax({
        url: BASE_URL + '/tickets/update',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshTicketList();
                toastr.success("Ticket is successfully updated.", "Success");

                // move Ticket List Page
                $('#update_ticket_action .page-move-btn').click();

                $('#create_emp_id').val('');
                $('#create_department_id').val('');
                $('#create_subject').val('');
                $('#create_attachment').val('');
                $('#create_details').val('');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}

// Delete Employee
function delTicketInfo(id) {
    var formData = {
        id: id
    };

    callAjax({
        url: BASE_URL + '/tickets/del',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshTicketList();
                toastr.success("Ticket is successfully deleted.", "Success");
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors)
                toastr.error(err.message, "Error");
        }
    });
}
