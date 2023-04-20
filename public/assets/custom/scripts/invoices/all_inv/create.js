var gridInvSvcSmry = new Datatable();
var gridInvNoteTotal = new Datatable();

var TableDueInvoice = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleInvAddSvcSmryTable = function () {

        gridInvSvcSmry.init({
            src: $("#tbl_inv_add_svc_smry"),
            onSuccess: function (gridInvSvcSmry, response) { },
            onError: function (gridInvSvcSmry) { },
            onDataLoad: function (gridInvSvcSmry) {
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
                    "url": BASE_URL + "/invoices/all_inv/get_tbl_svc_smrys", // ajax source
                },
                "order": [
                    [1, "asc"]
                ],// set first column as a default sort by asc
            }
        });
    }

    var handleInvAddNoteTotalTable = function () {

        gridInvNoteTotal.init({
            src: $("#tbl_inv_add_note_total"),
            onSuccess: function (gridInvNoteTotal, response) { },
            onError: function (gridInvNoteTotal) { },
            onDataLoad: function (gridInvNoteTotal) {
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
                    "url": BASE_URL + "/invoices/all_inv/get_tbl_note_totals", // ajax source
                },
                "order": [
                    [1, "asc"]
                ],// set first column as a default sort by asc
            }
        });
    }

    var handleSummernote = function () {
        $('#summernote_addinfo').summernote({ height: 300 });
        //API:
        //var sHTML = $('#summernote_addinfo').code(); // get code
        //$('#summernote_addinfo').destroy(); // destroy
    }

    return {
        //main function to initiate the module
        init: function () {
            initPickers();
            handleInvAddSvcSmryTable();
            // handleInvAddNoteTotalTable();
            handleSummernote();
        }
    };
}();

$(document).ready(function () {
    TableDueInvoice.init();

    $('#btn_create_invoice_ok').click(function () {
        createInvoice();
    });
});

/**
 * Create Invoice
 */
function createInvoice() {
    // Check Validation
    var validateFields = [{
        field_id: 'add_invoice_client',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Client is required.'
        ]
    }, {
        field_id: 'add_invoice_employee',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Employee is required.'
        ]
    }, {
        field_id: 'add_invoice_invfrequency',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Invoice Frequency is required.'
        ]
    }, {
        field_id: 'add_invoice_netterms',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Net Terms is required.',
            'numeric' + CONST_VALIDATE_SPLITER + 'Net Terms will be number.'
        ]
    }, {
        field_id: 'add_invoice_client_address',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Client Billing Address is required.'
        ]
    }, {
        field_id: 'add_invoice_from_address',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'From Address is required.'
        ]
    }, {
        field_id: 'add_invoice_cc_emails',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'CC Emails are required.'
        ]
    }, {
        field_id: 'add_invoice_bcc_emails',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'BCC Emails are required.'
        ]
    }, {
        field_id: 'add_invoice_created',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Invoice created is required.'
        ],
        level: true
    }, {
        field_id: 'add_invoice_dueddate',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Invoice due date is required.'
        ],
        level: true
    }, {
        field_id: 'add_invoice_include_po_attachment',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Include PO Attachment in Email is required.'
        ]
    }, {
        field_id: 'add_invoice_invoice_recipient',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Invoice Recipient is required.'
        ]
    }, {
        field_id: 'add_invoice_notes',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Invoice note is required.'
        ]
    }, {
        field_id: 'add_invoice_statement_memo',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Statement Memo is required.'
        ]
    }, {
        field_id: 'add_invoice_attachment',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Attachment is required.'
        ]
    }, {
        field_id: 'add_invoice_payable_to',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Payable to is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        employee_id: $('#add_invoice_employee').val(),
        client_id: $('#add_invoice_client').val(),
        invoice_date: $('#add_invoice_created').val(),
        invoice_due_date: $('#add_invoice_dueddate').val(),
        // invoiced_amount: $('#create_bus_website').val(),
        // received_amount: $('#create_bus_inv_country').val(),
        invoice_frequency: $('#add_invoice_invfrequency').val(),
        net_terms: $('#add_invoice_netterms').val(),
        include_po_attach: $('#add_invoice_include_po_attachment').val(),
        invoice_recipient: $('#add_invoice_invoice_recipient').val(),
        invoice_cc_emails: $('#add_invoice_cc_emails').val(),
        invoice_bcc_emails: $('#add_invoice_bcc_emails').val(),
        notes: $('#add_invoice_notes').val(),
        statement_memo: $('#add_invoice_statement_memo').val(),
        attachment: $('#add_invoice_attachment').val(),
        payable_to: $('#add_invoice_payable_to').val(),
        additional_info: $('#summernote_addinfo').code(),
    };

    callAjax({
        url: BASE_URL + '/invoices/all_inv/create',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Clear Form
                $('#add_invoice_client').val("");
                $('#add_invoice_employee').val("");
                $('#add_invoice_invfrequency').val("");
                $('#add_invoice_netterms').val("");
                $('#add_invoice_client_address').val("");
                $('#add_invoice_from_address').val("");
                $('#add_invoice_cc_emails').val("");
                $('#add_invoice_bcc_emails').val("");
                $('#add_invoice_created').val("");
                $('#add_invoice_dueddate').val("");
                $('#add_invoice_include_po_attachment').val("");
                $('#add_invoice_invoice_recipient').val("");
                $('#add_invoice_notes').val("");
                $('#add_invoice_statement_memo').val("");
                $('#add_invoice_attachment').val("");
                $('#add_invoice_payable_to').val("");
                // $('#summernote_addinfo').destroy();

                $('.note-editor .note-editing-area .panel-body').html("");
                
                // Refresh Table.
                refreshInvoiceTable();
                refreshInvoiceActTable();
                toastr.success("Invoice is successfully created.", "Success")

                $('#btn_create_invoice_cancel').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'employee_id' + CONST_VALIDATE_SPLITER + 'create_bus_name',
                    'client_id' + CONST_VALIDATE_SPLITER + 'create_bus_contact_num',
                    'invoice_date' + CONST_VALIDATE_SPLITER + 'create_bus_federal_id',
                    'invoice_due_date' + CONST_VALIDATE_SPLITER + 'create_bus_email',
                    'invoice_frequency' + CONST_VALIDATE_SPLITER + 'create_bus_website',
                    'net_terms' + CONST_VALIDATE_SPLITER + 'create_bus_inv_country',
                    'include_po_attach' + CONST_VALIDATE_SPLITER + 'create_bus_inv_state',
                    'invoice_recipient' + CONST_VALIDATE_SPLITER + 'create_bus_inv_city',
                    'invoice_cc_emails' + CONST_VALIDATE_SPLITER + 'create_bus_inv_street',
                    'invoice_bcc_emails' + CONST_VALIDATE_SPLITER + 'create_bus_inv_apt',
                    'notes' + CONST_VALIDATE_SPLITER + 'create_bus_inv_zipcode',
                    'statement_memo' + CONST_VALIDATE_SPLITER + 'create_bus_cli_country',
                    'attachment' + CONST_VALIDATE_SPLITER + 'create_bus_cli_state',
                    'payable_to' + CONST_VALIDATE_SPLITER + 'create_bus_cli_city',
                    'additional_info' + CONST_VALIDATE_SPLITER + 'create_bus_cli_street',
                ];
                showServerValidationErrors(validationFields, errors);

                toastr.error(err.message, "Error");
            }
        }
    });
}