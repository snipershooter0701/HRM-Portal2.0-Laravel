var gridPlacementTable = new Datatable();
var gridPlacementActTable = new Datatable();
var gridInvoiceTable = new Datatable();

var TablePlacement = function () {
    var initPickers = function () {
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handlePlacementTable = function () {

        gridPlacementTable.init({
            src: $("#tbl_placements"),
            onSuccess: function (gridPlacementTable, response) { },
            onError: function (gridPlacementTable) { },
            onDataLoad: function (gridPlacementTable) {
                $('.btn-placement-delete').click(function () {
                    var id = $(this).attr('data-id');
                    deletePlacement(id);
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
                    "url": BASE_URL + "/client/placement/get_ones_placement_tbl_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 1, 8]
                    }
                ],
                "order": [
                    [2, "asc"]
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
        gridPlacementTable.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", gridPlacementTable.getTableWrapper());
            if (action.val() != "" && gridPlacementTable.getSelectedRowsCount() > 0) {
                gridPlacementTable.setAjaxParam("customActionType", "group_action");
                gridPlacementTable.setAjaxParam("customActionName", action.val());
                gridPlacementTable.setAjaxParam("id", gridPlacementTable.getSelectedRows());
                gridPlacementTable.getDataTable().ajax.reload();
                gridPlacementTable.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: gridPlacementTable.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (gridPlacementTable.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: gridPlacementTable.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // gridPlacementTable.setAjaxParam("customActionType", "group_action");
        // gridPlacementTable.getDataTable().ajax.reload();
        // gridPlacementTable.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_placements_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridPlacementTable.getDataTable().button(action).trigger();
        });
    }

    var handlePlacementActTable = function () {

        gridPlacementActTable.init({
            src: $("#tbl_placement_activities"),
            onSuccess: function (gridPlacementActTable, response) { },
            onError: function (gridPlacementActTable) { },
            onDataLoad: function (gridPlacementActTable) {
                $('.btn-placement-delete').click(function () {
                    var id = $(this).attr('data-id');
                    deletePlacement(id);
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
                    "url": BASE_URL + "/client/placement/get_activities_tbl_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0]
                    }
                ],
                "order": [
                    [1, "desc"]
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
    }

    var handleInvoiceTable = function () {

        gridInvoiceTable.init({
            src: $("#tbl_invoices"),
            onSuccess: function (gridInvoiceTable, response) { },
            onError: function (gridInvoiceTable) { },
            onDataLoad: function (gridInvoiceTable) {
                $('.btn-placement-delete').click(function () {
                    var id = $(this).attr('data-id');
                    deletePlacement(id);
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
                    "url": BASE_URL + "/client/placement/get_invoices_tbl_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 1, 6]
                    }
                ],
                "order": [
                    [3, "desc"]
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

        gridInvoiceTable.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", gridInvoiceTable.getTableWrapper());
            if (action.val() != "" && gridInvoiceTable.getSelectedRowsCount() > 0) {
                gridInvoiceTable.setAjaxParam("customActionType", "group_action");
                gridInvoiceTable.setAjaxParam("customActionName", action.val());
                gridInvoiceTable.setAjaxParam("id", gridInvoiceTable.getSelectedRows());
                gridInvoiceTable.getDataTable().ajax.reload();
                gridInvoiceTable.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: gridInvoiceTable.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (gridInvoiceTable.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: gridInvoiceTable.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        $('#tbl_invoices_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridInvoiceTable.getDataTable().button(action).trigger();
        });
    }

    return {
        init: function () {
            initPickers();
            handlePlacementTable();
            handlePlacementActTable();
            handleInvoiceTable();
        }
    };
}();

$(document).ready(function () {
    TablePlacement.init();

    $('#btn_add_placement_create').click(function () {
        createPlacement();
    });

    $('#btn_show_add_placement_page').click(function () {
        showAddPlacementPage();
    });

    $('#add_placement_employee').change(function () {
        var empId = $(this).val();
        changeCategoryByEmp(empId);
    });
});

/**
 * Refresh client's placement table.
 */
function refreshPlacementTable() {
    // gridPlacementTable.getDataTable().ajax.reload();
    // gridPlacementTable.clearAjaxParams();
    $('#btn_tbl_placement_search').trigger('click');
}

/**
 * Refresh client's placement activities table.
 */
function refreshPlacementActTable() {
    // gridPlacementActTable.getDataTable().ajax.reload();
    // gridPlacementActTable.clearAjaxParams();
    $('#btn_tbl_placement_act_search').trigger('click');
}

/**
 * Refresh client's invoice table.
 */
function refreshInvoiceActTable() {
    // gridInvoiceTable.getDataTable().ajax.reload();
    // gridInvoiceTable.clearAjaxParams();
    $('#btn_tbl_invoice_search').trigger('click');
}

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
            'required' + CONST_VALIDATE_SPLITER + 'Placement ID is required.',
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
            'required' + CONST_VALIDATE_SPLITER + 'Client PO Attachment is required.'
        ]
    }, {
        field_id: 'add_placement_po_id',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Client PO ID is required.'
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
            'required' + CONST_VALIDATE_SPLITER + 'Bill Rate/hr is required.',
            'numeric' + CONST_VALIDATE_SPLITER + 'Bill Rate/hr must be a number.'
        ]
    }, {
        field_id: 'add_placement_ot_billrate',
        conditions: [
            'numeric' + CONST_VALIDATE_SPLITER + 'OT Bill Rate/hr must be a number.'
        ]
    }, {
        field_id: 'add_placement_dt_billrate',
        conditions: [
            'numeric' + CONST_VALIDATE_SPLITER + 'DT Bill Rate/hr must be a number.'
        ]
    }];

    if ($('#add_placement_category').val() == EMP_CATEGORY_C2C || $('#add_placement_category').val() == EMP_CATEGORY_1099) {
        validateFields.push({
            field_id: 'add_placement_vendor',
            conditions: [
                'required' + CONST_VALIDATE_SPLITER + 'Vendor/Contractor is required.'
            ]
        }, {
            field_id: 'add_placement_vendor_netterms',
            conditions: [
                'required' + CONST_VALIDATE_SPLITER + 'Vendor/Contractor Net Terms is required.'
            ]
        }, {
            field_id: 'add_placement_vendor_po_attachment',
            conditions: [
                'required' + CONST_VALIDATE_SPLITER + 'Vendor/Contractor PO Attachment is required.'
            ]
        }, {
            field_id: 'add_placement_vendor_po_id',
            conditions: [
                'required' + CONST_VALIDATE_SPLITER + 'Vendor/Contractor PO ID is required.'
            ]
        }, {
            field_id: 'add_placement_vendor_billrate',
            conditions: [
                'required' + CONST_VALIDATE_SPLITER + 'Bill Rate/hr is required.'
            ]
        }, {
            field_id: 'add_placement_vendor_ot_billrate',
            conditions: [
                'required' + CONST_VALIDATE_SPLITER + 'OT Bill Rate/hr is required.'
            ]
        }, {
            field_id: 'add_placement_vendor_dt_billrate',
            conditions: [
                'required' + CONST_VALIDATE_SPLITER + 'DT Bill Rate/hr is required.'
            ]
        });
    }

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
        job_title: $('#add_placement_jobtitle').val(),
        job_status: $('#add_placement_jobstatus').val(),
        job_start_date: $('#add_placement_startdate').val(),
        job_end_date: $('#add_placement_enddate').val(),
        invoice_frequency: $('#add_placement_inv_frequency').val(),
        pay_effect_date: $('#add_placement_pay_effect_date').val(),

        client_bill_rate: $('#add_placement_billrate').val(),
        client_ot_bill_rate: $('#add_placement_ot_billrate').val(),
        client_dt_bill_rate: $('#add_placement_dt_billrate').val(),
        // client_vendor_id: $('#add_placement_vendor').val(),
        
        vendor_contractor_id: $('#add_placement_vendor').val(),
        vendor_contractor_netterms: $('#add_placement_vendor_netterms').val(),
        vendor_contractor_po_attachment: $('#add_placement_vendor_po_attachment').val(),
        vendor_contractor_po_id: $('#add_placement_vendor_po_id').val(),
        vendor_contractor_bill_rate: $('#add_placement_vendor_billrate').val(),
        vendor_contractor_at_bill_rate: $('#add_placement_vendor_ot_billrate').val(),
        vendor_contractor_dt_bill_rate: $('#add_placement_vendor_dt_billrate').val(),
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

/**
 * Delete client's placement.
 */
function deletePlacement(id) {
    displayConfirmModal("Are you sure to delete placement?", "Delete", function (res) {
        if (res == 'ok') {
            var formData = {
                id: id
            };

            callAjax({
                url: BASE_URL + '/client/placement/delete',
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data['result'] == 'success') {
                        // Refresh Table.
                        refreshClientList();
                        refreshPlacementTable();
                        refreshPlacementActTable();
                        toastr.success("Placement is successfully deleted.", "Success");
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
 * Show add placement page.
 */
function showAddPlacementPage() {
    var formData = {
    };

    callAjax({
        url: BASE_URL + '/client/placement/get_new',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var last = data['last'];
                var clientId = $('#edit_client_id').val();

                // Set base values.
                $('#add_placement_client').val(clientId);
                $('#add_placement_id').val(last['id'] != null ? last['id'] + 1 : 1);
                $('#add_placement_po_id').val(last['id'] != null ? last['id'] + 1 : 1);
                $('#add_placement_vendor_po_id').val(last['id'] != null ? last['id'] + 1 : 1);

                $('#go_to_add_placement_page').trigger('click');
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
 * Change Category by Employee Id
 */
function changeCategoryByEmp(empId) {
    var formData = {
        empId: empId
    };

    callAjax({
        url: BASE_URL + '/client/placement/get_employee',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var employee = data['employee'];
                var vendors = data['vendors'];
                var contractors = data['contractors'];

                // Set Category field.
                $('#add_placement_category').val(employee['category']);

                // Init Vendor/Contractor fields.
                $('#add_placement_vendor').html('<option value="">Select...</option>');
                $('#add_placement_vendor_netterms').val('');
                $('#add_placement_vendor_po_attachment').val('');
                $('#add_placement_vendor_billrate').val('');
                $('#add_placement_vendor_ot_billrate').val('');
                $('#add_placement_vendor_dt_billrate').val('');

                if (employee['category'] == EMP_CATEGORY_W2) {
                    $('#add_placement_vendor').prop('disabled', true);
                    $('#add_placement_vendor_netterms').prop('disabled', true);
                    $('#add_placement_vendor_po_attachment').prop('disabled', true);
                    $('#add_placement_vendor_billrate').prop('disabled', true);
                    $('#add_placement_vendor_ot_billrate').prop('disabled', true);
                    $('#add_placement_vendor_dt_billrate').prop('disabled', true);
                } else if (employee['category'] == EMP_CATEGORY_C2C) {
                    $('#add_placement_vendor').removeAttr('disabled');
                    $('#add_placement_vendor_netterms').removeAttr('disabled');
                    $('#add_placement_vendor_po_attachment').removeAttr('disabled');
                    $('#add_placement_vendor_billrate').removeAttr('disabled');
                    $('#add_placement_vendor_ot_billrate').removeAttr('disabled');
                    $('#add_placement_vendor_dt_billrate').removeAttr('disabled');

                    for (var i in vendors)
                        $('#add_placement_vendor').append('<option value="' + vendors[i]['id'] + '">' + vendors[i]['business_name'] + '</option>');
                } else if (employee['category'] == EMP_CATEGORY_1099) {
                    $('#add_placement_vendor').removeAttr('disabled');
                    $('#add_placement_vendor_netterms').removeAttr('disabled');
                    $('#add_placement_vendor_po_attachment').removeAttr('disabled');
                    $('#add_placement_vendor_billrate').removeAttr('disabled');
                    $('#add_placement_vendor_ot_billrate').removeAttr('disabled');
                    $('#add_placement_vendor_dt_billrate').removeAttr('disabled');

                    for (var i in contractors)
                        $('#add_placement_vendor').append('<option value="' + contractors[i]['id'] + '">' + contractors[i]['first_name'] + ' ' + contractors[i]['last_name'] + '</option>');
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