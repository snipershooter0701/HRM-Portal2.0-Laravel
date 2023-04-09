var gridConfidentialTable = new Datatable();

var TableConfidential = function () {
    var initPickers = function () {
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }
    var handleContactInfoTable = function () {
        gridConfidentialTable.init({
            src: $("#tbl_confidential_old_records"),
            onSuccess: function (gridConfidentialTable, response) { },
            onError: function (gridConfidentialTable) { },
            onDataLoad: function (gridConfidentialTable) {
                $('.btn-confidential-delete').click(function () {
                    var id = $(this).attr('data-id');
                    var bankName = $(this).attr('data-bankName');
                    deleteConfidential(id, bankName);
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
                    "url": BASE_URL + "/client/confidential/get_tbl_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 6]
                    }
                ],
                "order": [
                    [1, "asc"]
                ],// set first column as a default sort by asc
            }
        });
    }

    return {
        init: function () {
            initPickers();
            handleContactInfoTable();
        }
    };
}();

$(document).ready(function () {
    TableConfidential.init();

    $('#btn_create_confidential').click(function () {
        createConfidential();
    });
});

/**
 * Refresh client's confidential table.
 */
function refreshConfidentialTable() {
    // gridConfidentialTable.setAjaxParam("customActionType", "group_action");
    gridConfidentialTable.getDataTable().ajax.reload();
    gridConfidentialTable.clearAjaxParams();
}

/**
 * Create confidential
 */
function createConfidential() {
    // Check Validation
    var validateFields = [{
        field_id: 'add_conf_bankname',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Bank Name is required.'
        ]
    }, {
        field_id: 'add_conf_accounttype',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Account Type is required.'
        ]
    }, {
        field_id: 'add_conf_accountnumber',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Account Number is required.',
            'numeric' + CONST_VALIDATE_SPLITER + "Account Number must be a number."
        ]
    }, {
        field_id: 'add_conf_routingnumber',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Routing Number is required.',
            'numeric' + CONST_VALIDATE_SPLITER + "Routing Number must be a number."
        ]
    }, {
        field_id: 'add_conf_aptno',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Suite/AptNo is required.'
        ]
    }, {
        field_id: 'add_conf_street',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Street is required.'
        ]
    }, {
        field_id: 'add_conf_city',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'City is required.'
        ]
    }, {
        field_id: 'add_conf_state',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'State is required.'
        ]
    }, {
        field_id: 'add_conf_country',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Country is required.'
        ]
    }, {
        field_id: 'add_conf_zipcode',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Zip Code is required.',
            'numeric' + CONST_VALIDATE_SPLITER + "Zip Code must be a number."
        ]
    }, {
        field_id: 'add_conf_cancelledcheck',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Cancelled Check file is required.'
        ]
    }, {
        field_id: 'add_conf_status',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Record Status is required.'
        ]
    }, {
        field_id: 'add_conf_otherattachment',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Other attachment file is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        client_id: $('#filt_tbl_confidential_client_id').val(),
        bankname: $('#add_conf_bankname').val(),
        accounttype: $('#add_conf_accounttype').val(),
        accountnumber: $('#add_conf_accountnumber').val(),
        routingnumber: $('#add_conf_routingnumber').val(),
        country_id: $('#add_conf_country').val(),
        state_id: $('#add_conf_state').val(),
        city: $('#add_conf_city').val(),
        suite_aptno: $('#add_conf_aptno').val(),
        street: $('#add_conf_street').val(),
        zipcode: $('#add_conf_zipcode').val(),
        status: $('#add_conf_status').val(),
    };

    callAjax({
        url: BASE_URL + '/client/confidential/create',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Init Table.
                $('#add_contact_firstname').val("");
                $('#add_contact_lastname').val("");
                $('#add_contact_email').val("");
                $('#add_contact_phone').val("");

                // Refresh Table.
                refreshConfidentialTable();
                toastr.success("Client's confidential information is created.", "Success")
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'first_name' + CONST_VALIDATE_SPLITER + 'add_contact_firstname',
                    'last_name' + CONST_VALIDATE_SPLITER + 'add_contact_lastname',
                    'email' + CONST_VALIDATE_SPLITER + 'add_contact_email',
                    'phone' + CONST_VALIDATE_SPLITER + 'add_contact_phone',
                ];
                showServerValidationErrors(validationFields, errors);

                toastr.error(err.message, "Error");
            }
        }
    });
}

/**
 * Delet eConfidential
 */
function deleteConfidential(id, bankName) {
    displayConfirmModal("Are you sure to delete confidential (" + bankName + ")?", "Delete", function (res) {
        if (res == 'ok') {
            var formData = {
                id: id
            };

            callAjax({
                url: BASE_URL + '/client/confidential/delete',
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data['result'] == 'success') {
                        // Refresh Table.
                        refreshConfidentialTable();
                        toastr.success("Confidential (" + bankName + ") is successfully deleted.", "Success");
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