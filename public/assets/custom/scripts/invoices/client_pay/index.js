var gridPayTable = new Datatable();
var gridPayActTable = new Datatable();

var TableClientPay = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handlePayTable = function () {

        gridPayTable.init({
            src: $("#tbl_client_pays"),
            onSuccess: function (gridPayTable, response) { },
            onError: function (gridPayTable) { },
            onDataLoad: function (gridPayTable) {
                $('.btn-pay-delete').click(function () {
                    var id = $(this).attr('data-id');
                    deletePayment(id);
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
                    "url": BASE_URL + "/invoices/client_pay/get_tbl_list", // ajax source
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
        gridPayTable.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", gridPayTable.getTableWrapper());
            if (action.val() != "" && gridPayTable.getSelectedRowsCount() > 0) {
                gridPayTable.setAjaxParam("customActionType", "group_action");
                gridPayTable.setAjaxParam("customActionName", action.val());
                gridPayTable.setAjaxParam("id", gridPayTable.getSelectedRows());
                gridPayTable.getDataTable().ajax.reload();
                gridPayTable.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: gridPayTable.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (gridPayTable.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: gridPayTable.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // gridPayTable.setAjaxParam("customActionType", "group_action");
        // gridPayTable.getDataTable().ajax.reload();
        // gridPayTable.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_client_pays_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridPayTable.getDataTable().button(action).trigger();
        });
    }

    var handlePayActTable = function () {
        gridPayActTable.init({
            src: $("#tbl_pay_activities"),
            onSuccess: function (gridPayActTable, response) { },
            onError: function (gridPayActTable) { },
            onDataLoad: function (gridPayActTable) {
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
                    "url": BASE_URL + "/invoices/client_pay/get_tbl_act_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0]
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
            handlePayTable();
            handlePayActTable();
        }
    };
}();

$(document).ready(function () {
    TableClientPay.init();

    $('#btn_add_pay_ok').click(function () {
        createPayment();
    });
});

function refreshPayTable() {
    gridPayTable.getDataTable().ajax.reload();
    gridPayTable.clearAjaxParams();
}

function refreshPayActTable() {
    gridPayActTable.getDataTable().ajax.reload();
    gridPayActTable.clearAjaxParams();
}

/**
 * Create Client Payment.
 */
function createPayment() {
    // Check Validation
    var validateFields = [{
        field_id: 'add_client',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Client is required.'
        ]
    }, {
        field_id: 'add_pay_date',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Payment Received Date is required.'
        ],
        level: true
    }, {
        field_id: 'add_amount_received',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Amount Received is required.',
            'numeric' + CONST_VALIDATE_SPLITER + "Amount Received will be number."
        ]
    }, {
        field_id: 'add_pay_method',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Payment Method is required.'
        ]
    }, {
        field_id: 'add_bank',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Bank is required.'
        ]
    }, {
        field_id: 'add_ref_no',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Reference No is required.'
        ]
    }, {
        field_id: 'add_comment',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Comments is required.'
        ]
    }, {
        field_id: 'add_attachment',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Attachment is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        client_id: $('#add_client').val(),
        payment_received_date: $('#add_pay_date').val(),
        // amount_due: $('#add_role_department').val(),
        amount_received: $('#add_amount_received').val(),
        bank_id: $('#add_bank').val(),
        pay_method_id: $('#add_pay_method').val(),
        comments: $('#add_comment').val(),
        attachment: $('#add_attachment').val(),
    };

    callAjax({
        url: BASE_URL + '/invoices/client_pay/create',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Init Form.
                $('#add_client').val("");
                $('#add_pay_date').val("");
                $('#add_amount_received').val("");
                $('#add_pay_method').val("");
                $('#add_bank').val("");
                $('#add_ref_no').val("");
                $('#add_comment').val("");
                $('#add_attachment').val("");

                // Refresh Table.
                refreshPayTable();
                refreshPayActTable();
                toastr.success("New payment is successfully created.", "Success");

                // Cancel Panel
                $('#btn_add_pay_cancel').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'client_id' + CONST_VALIDATE_SPLITER + 'add_client',
                    'payment_received_date' + CONST_VALIDATE_SPLITER + 'add_pay_date',
                    'amount_received' + CONST_VALIDATE_SPLITER + 'add_amount_received',
                    'bank_id' + CONST_VALIDATE_SPLITER + 'add_pay_method',
                    'pay_method_id' + CONST_VALIDATE_SPLITER + 'add_bank',
                    'comments' + CONST_VALIDATE_SPLITER + 'add_comment',
                    'attachment' + CONST_VALIDATE_SPLITER + 'add_attachment',
                ];
                showServerValidationErrors(validationFields, errors);
                toastr.error(err.message, "Error");
            }
        }
    });
}

/**
 * Delete Payment 
 */
function deletePayment(id) {
    displayConfirmModal("Are you sure to delete this payment?", "Delete", function (res) {
        if (res == 'ok') {
            var formData = {
                id: id
            };
            var formData = {
                id: id
            };

            callAjax({
                url: BASE_URL + '/invoices/client_pay/delete',
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data['result'] == 'success') {
                        // Refresh Table.
                        refreshPayTable();
                        refreshPayActTable();
                        toastr.success("Payment is successfully deleted.", "Success");
                    }
                },
                error: function (err) {
                    var errors = err.errors;
                    if (errors) {
                        toastr.error(err.message, "Error");
                    }
                }
            });
        }
    });
}