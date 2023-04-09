$(document).ready(function () {
    $('#btn_add_placement_create').click(function () {
        createPlacement();
    });
});

/**
 * Create client's placement.
 */
function createPlacement() {
    // Check Validation
    var validateFields = [{
        field_id: 'add_placement_client',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Client Name is required.'
        ]
    }, {
        field_id: 'add_placement_employee',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Employee Name is required.'
        ]
    }, {
        field_id: 'add_placement_id',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Placement ID is required.',
            // 'numeric' + CONST_VALIDATE_SPLITER + "Placement ID must be a number."
        ]
    }, {
        field_id: 'add_placement_category',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Category is required.'
        ]
    }, {
        field_id: 'add_placement_jobtire',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Job Tire is required.'
        ]
    }, {
        field_id: 'add_placement_netterms',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Client Net Terms is required.',
            'numeric' + CONST_VALIDATE_SPLITER + "Client Net Terms must be a number."
        ]
    }, {
        field_id: 'add_placement_po_attachment',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Client PO Attachment is required.'
        ]
    }, {
        field_id: 'add_placement_po_id',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Client PO ID is required.'
        ]
    }, {
        field_id: 'add_placement_jobtitle',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Job Title is required.'
        ]
    }, {
        field_id: 'add_placement_jobstatus',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Job Status is required.'
        ]
    }, {
        field_id: 'add_placement_startdate',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Job Start Date is required.'
        ],
        level: true
    }, {
        field_id: 'add_placement_enddate',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Job End Date is required.'
        ],
        level: true
    }, {
        field_id: 'add_placement_inv_frequency',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Invoice Frequency is required.'
        ]
    }, {
        field_id: 'add_placement_pay_effect_date',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Payments Effective Date is required.'
        ],
        level: true
    }, {
        field_id: 'add_placement_billrate',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Bill Rate/hr is required.'
        ]
    }, {
        field_id: 'add_placement_ot_billrate',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Record Status is required.'
        ]
    }, {
        field_id: 'add_placement_dt_billrate',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Record Status is required.'
        ]
    }, {
        field_id: 'add_placement_vendor',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Record Status is required.'
        ]
    }, {
        field_id: 'add_placement_vendor_netterms',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Record Status is required.'
        ]
    }, {
        field_id: 'add_placement_vendor_po_attachment',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Record Status is required.'
        ]
    }, {
        field_id: 'add_placement_vendor_po_id',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Record Status is required.'
        ]
    }, {
        field_id: 'add_placement_vendor_billrate',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Record Status is required.'
        ]
    }, {
        field_id: 'add_placement_vendor_ot_billrate',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Record Status is required.'
        ]
    }, {
        field_id: 'add_placement_vendor_dt_billrate',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Record Status is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        client_id: $('#add_placement_client').val(),
        employee_id: $('#add_placement_employee').val(),
        job_tire_id: $('#add_placement_jobtire').val(),
        net_terms: $('#add_placement_netterms').val(),
        po_attachment: $('#add_placement_po_attachment').val(),
        po_id: $('#add_placement_po_id').val(),
        client_bill_rate: $('#add_placement_billrate').val(),
        client_ot_bill_rate: $('#add_placement_ot_billrate').val(),
        client_dt_bill_rate: $('#add_placement_dt_billrate').val(),
        client_vendor_id: $('#add_placement_vendor').val(),
        vendor_contractor_id: $('#add_placement_vendor').val(),
        vendor_contractor_netterms: $('#add_placement_vendor_netterms').val(),
        vendor_contractor_po_attachment: $('#add_placement_vendor_po_attachment').val(),
        vendor_contractor_po_id: $('#add_placement_vendor_po_id').val(),
        vendor_contractor_bill_rate: $('#add_placement_vendor_billrate').val(),
        vendor_contractor_at_bill_rate: $('#add_placement_vendor_ot_billrate').val(),
        vendor_contractor_dt_bill_rate: $('#add_placement_vendor_dt_billrate').val(),
        job_title: $('#add_placement_jobtitle').val(),
        job_status: $('#add_placement_jobstatus').val(),
        job_start_date: $('#add_placement_startdate').val(),
        job_end_date: $('#add_placement_enddate').val(),
        invoice_frequency: $('#add_placement_inv_frequency').val(),
        pay_effect_date: $('#add_placement_pay_effect_date').val()
    };

    callAjax({
        url: BASE_URL + '/client/placement/create',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Init Table.
                $('#add_placement_client').val("");
                $('#add_placement_employee').val("");
                $('#add_placement_jobtire').val("");
                $('#add_placement_netterms').val("");
                $('#add_placement_po_attachment').val("");
                $('#add_placement_po_id').val("");
                $('#add_placement_billrate').val("");
                $('#add_placement_ot_billrate').val("");
                $('#add_placement_dt_billrate').val("");
                $('#add_placement_vendor').val("");
                $('#add_placement_vendor_netterms').val("");
                $('#add_placement_vendor_po_attachment').val("");
                $('#add_placement_vendor_po_id').val("");
                $('#add_placement_vendor_billrate').val("");
                $('#add_placement_vendor_ot_billrate').val("");
                $('#add_placement_vendor_dt_billrate').val("");
                $('#add_placement_jobtitle').val("");
                $('#add_placement_jobstatus').val("");
                $('#add_placement_startdate').val("");
                $('#add_placement_enddate').val("");
                $('#add_placement_inv_frequency').val("");
                $('#add_placement_pay_effect_date').val("");

                // Refresh Table.
                refreshPlacementTable();
                refreshClientList();
                refreshPlacementActTable();
                toastr.success("New placement is created.", "Success");

                // Cancel Panel
                $('#btn_add_placement_cancel').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'client_id' + CONST_VALIDATE_SPLITER + 'add_placement_client',
                    'employee_id' + CONST_VALIDATE_SPLITER + 'add_placement_employee',
                    'job_tire_id' + CONST_VALIDATE_SPLITER + 'add_placement_jobtire',
                    'net_terms' + CONST_VALIDATE_SPLITER + 'add_placement_netterms',
                    'po_attachment' + CONST_VALIDATE_SPLITER + 'add_placement_po_attachment',
                    'po_id' + CONST_VALIDATE_SPLITER + 'add_placement_po_id',
                    'client_bill_rate' + CONST_VALIDATE_SPLITER + 'add_placement_billrate',
                    'client_ot_bill_rate' + CONST_VALIDATE_SPLITER + 'add_placement_ot_billrate',
                    'client_dt_bill_rate' + CONST_VALIDATE_SPLITER + 'add_placement_dt_billrate',
                    'client_vendor_id' + CONST_VALIDATE_SPLITER + 'add_placement_vendor',
                    'vendor_contractor_netterms' + CONST_VALIDATE_SPLITER + 'add_placement_vendor_netterms',
                    'vendor_contractor_po_attachment' + CONST_VALIDATE_SPLITER + 'add_placement_vendor_po_attachment',
                    'vendor_contractor_po_id' + CONST_VALIDATE_SPLITER + 'add_placement_vendor_po_id',
                    'vendor_contractor_bill_rate' + CONST_VALIDATE_SPLITER + 'add_placement_vendor_billrate',
                    'vendor_contractor_at_bill_rate' + CONST_VALIDATE_SPLITER + 'add_placement_vendor_ot_billrate',
                    'vendor_contractor_dt_bill_rate' + CONST_VALIDATE_SPLITER + 'add_placement_vendor_dt_billrate',
                    'job_title' + CONST_VALIDATE_SPLITER + 'add_placement_jobtitle',
                    'job_status' + CONST_VALIDATE_SPLITER + 'add_placement_jobstatus',
                    'job_start_date' + CONST_VALIDATE_SPLITER + 'add_placement_startdate',
                    'job_end_date' + CONST_VALIDATE_SPLITER + 'add_placement_enddate',
                    'invoice_frequency' + CONST_VALIDATE_SPLITER + 'add_placement_inv_frequency',
                    'pay_effect_date' + CONST_VALIDATE_SPLITER + 'add_placement_pay_effect_date',
                ];
                showServerValidationErrors(validationFields, errors);

                toastr.error(err.message, "Error");
            }
        }
    });


}