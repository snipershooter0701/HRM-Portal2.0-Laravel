var gridContactInfoTable = new Datatable();

var TableContactInfo = function () {
    var initPickers = function () {
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }
    var handleContactInfoTable = function () {
        gridContactInfoTable.init({
            src: $("#tbl_contact_infos"),
            onSuccess: function (gridContactInfoTable, response) { },
            onError: function (gridContactInfoTable) { },
            onDataLoad: function (gridContactInfoTable) {
                $('.btn-contactinfo-edit').click(function () {
                    var id = $(this).attr('data-id');
                    showContactToEditModal(id);
                });

                $('.btn-contactinfo-delete').click(function () {
                    var id = $(this).attr('data-id');
                    var email = $(this).attr('data-email');
                    deleteContact(id, email);
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
                    "url": BASE_URL + "/client/contact_info/get_tbl_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 1, 6, 7]
                    }
                ],
                "order": [
                    [2, "asc"]
                ],// set first column as a default sort by asc
            }
        });

        gridContactInfoTable.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", gridContactInfoTable.getTableWrapper());
            if (action.val() != "" && gridContactInfoTable.getSelectedRowsCount() > 0) {
                gridContactInfoTable.setAjaxParam("customActionType", "group_action");
                gridContactInfoTable.setAjaxParam("customActionName", action.val());
                gridContactInfoTable.setAjaxParam("id", gridContactInfoTable.getSelectedRows());
                gridContactInfoTable.getDataTable().ajax.reload();
                gridContactInfoTable.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: gridContactInfoTable.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (gridContactInfoTable.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: gridContactInfoTable.getTableWrapper(),
                    place: 'prepend'
                });
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
    TableContactInfo.init();

    $('#btn_modal_add_contact_create').click(function () {
        createContact();
    });

    $('#btn_modal_edit_contact_update').click(function () {
        updateContact();
    });
});

/**
 * Refresh client's contact info table.
 */
function refreshContactInfoTable() {
    // gridContactInfoTable.setAjaxParam("customActionType", "group_action");
    gridContactInfoTable.getDataTable().ajax.reload();
    gridContactInfoTable.clearAjaxParams();
}

/**
 * Show contact information to edit modal.
 */
function showContactToEditModal(id) {
    var formData = {
        id: id,
    };

    callAjax({
        url: BASE_URL + '/client/contact_info/get_by_id',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var contact = data['contact'];

                // Display values in edit modal
                $('#edit_contact_id').val(contact['id']);
                $('#edit_contact_firstname').val(contact['first_name']);
                $('#edit_contact_lastname').val(contact['last_name']);
                $('#edit_contact_email').val(contact['email']);
                $('#edit_contact_phone').val(contact['phone']);

                // Show edit modal
                $('#btn_show_edit_contactinfo_modal').trigger('click');
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
 * Create Contact
 */
function createContact() {
    // Check Validation
    var validateFields = [{
        field_id: 'add_contact_firstname',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'First Name is required.'
        ]
    }, {
        field_id: 'add_contact_lastname',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Last Name is required.'
        ]
    }, {
        field_id: 'add_contact_email',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Email is required.'
        ]
    }, {
        field_id: 'add_contact_phone',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Phone is required.',
            'numeric' + CONST_VALIDATE_SPLITER + "Phone must be a number."
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        client_id: $('#filt_tbl_contact_info_client_id').val(),
        first_name: $('#add_contact_firstname').val(),
        last_name: $('#add_contact_lastname').val(),
        email: $('#add_contact_email').val(),
        phone: $('#add_contact_phone').val(),
    };

    callAjax({
        url: BASE_URL + '/client/contact_info/create',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                $('#btn_modal_add_contact_close').trigger('click');

                // Init Table.
                $('#add_contact_firstname').val("");
                $('#add_contact_lastname').val("");
                $('#add_contact_email').val("");
                $('#add_contact_phone').val("");

                // Refresh Table.
                refreshContactInfoTable();
                toastr.success("Client's contact information is created.", "Success")
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
 * Update Contact
 */
function updateContact() {
    // Check Validation
    var validateFields = [{
        field_id: 'edit_contact_firstname',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'First Name is required.'
        ]
    }, {
        field_id: 'edit_contact_lastname',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Last Name is required.'
        ]
    }, {
        field_id: 'edit_contact_email',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Email is required.'
        ]
    }, {
        field_id: 'edit_contact_phone',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Phone is required.',
            'numeric' + CONST_VALIDATE_SPLITER + "Phone must be a number."
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        id: $('#edit_contact_id').val(),
        first_name: $('#edit_contact_firstname').val(),
        last_name: $('#edit_contact_lastname').val(),
        email: $('#edit_contact_email').val(),
        phone: $('#edit_contact_phone').val(),
    };

    callAjax({
        url: BASE_URL + '/client/contact_info/update',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                $('#btn_modal_add_contact_close').trigger('click');

                // Init Table.
                $('#add_contact_firstname').val("");
                $('#add_contact_lastname').val("");
                $('#add_contact_email').val("");
                $('#add_contact_phone').val("");

                // Close Modal
                $('#modal_edit_contact').trigger('click');

                // Refresh Table.
                refreshContactInfoTable();
                toastr.success("Client's contact information is updated.", "Success")
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
 * Delete Contract
 */
function deleteContact(id, email) {
    displayConfirmModal("Are you sure to delete contact information (" + email + ")?", "Delete", function (res) {
        if (res == 'ok') {
            var formData = {
                id: id
            };

            callAjax({
                url: BASE_URL + '/client/contact_info/delete',
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data['result'] == 'success') {
                        // Refresh Table.
                        refreshContactInfoTable();
                        toastr.success("Contact information (" + email + ") is successfully deleted.", "Success");
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
