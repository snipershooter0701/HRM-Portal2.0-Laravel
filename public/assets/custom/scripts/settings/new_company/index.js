var gridCompanyListTable = new Datatable();

var TableCompanyList = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleClientListTable = function () {

        gridCompanyListTable.init({
            src: $("#tbl_company"),
            onSuccess: function (gridCompanyListTable, response) { },
            onError: function (gridCompanyListTable) { },
            onDataLoad: function (gridCompanyListTable) {
                $('.btn-company-delete').click(function () {
                    var id = $(this).attr('data-id');
                    var title = $(this).attr('data-title');
                    deleteCompany(id, title);
                });

                $('.btn-company-edit').click(function () {
                    var id = $(this).attr('data-id');
                    showEditCompanyPage(id);
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
                    "url": BASE_URL + "/settings/new_company/get_tbl_list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 1, 7]
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
        gridCompanyListTable.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", gridCompanyListTable.getTableWrapper());
            if (action.val() != "" && gridCompanyListTable.getSelectedRowsCount() > 0) {
                gridCompanyListTable.setAjaxParam("customActionType", "group_action");
                gridCompanyListTable.setAjaxParam("customActionName", action.val());
                gridCompanyListTable.setAjaxParam("id", gridCompanyListTable.getSelectedRows());
                gridCompanyListTable.getDataTable().ajax.reload();
                gridCompanyListTable.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: gridCompanyListTable.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (gridCompanyListTable.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: gridCompanyListTable.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // gridCompanyListTable.setAjaxParam("customActionType", "group_action");

        // handle datatable custom tools
        $('#tbl_company_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridCompanyListTable.getDataTable().button(action).trigger();
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            initPickers();
            handleClientListTable();
        }
    };
}();

$(document).ready(function () {
    TableCompanyList.init();

    $('#btn_modal_add_company_ok').click(function () {
        createCompany();
    });

    $('#btn_modal_edit_company_ok').click(function () {
        updateCompany();
    });
});

/**
 * Refresh company list.
 */
function refreshCompanyList() {
    gridCompanyListTable.getDataTable().ajax.reload();
    gridCompanyListTable.clearAjaxParams();
}

/**
 * Create new company
 */
function createCompany() {
    // Check Validation
    var validateFields = [{
        field_id: 'add_company_title',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Company Title is required.'
        ]
    }, {
        field_id: 'add_company_email',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Company Email is required.'
        ]
    }, {
        field_id: 'add_company_address',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Address is required.'
        ]
    }, {
        field_id: 'add_company_phone',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Phone is required.'
        ]
    }, {
        field_id: 'add_company_favicon',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Favicon is required.'
        ]
    }, {
        field_id: 'add_company_logo',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Logo is required.'
        ]
    }, {
        field_id: 'add_company_currency',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Currency is required.'
        ]
    }, {
        field_id: 'add_company_timezone',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Time Zone is required.'
        ]
    }, {
        field_id: 'add_company_alignment',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Alignment is required.'
        ]
    }, {
        field_id: 'add_company_footer',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Footer Text is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        title: $('#add_company_title').val(),
        email: $('#add_company_email').val(),
        address: $('#add_company_address').val(),
        phone: $('#add_company_phone').val(),
        favicon: $('#add_company_favicon').val(),
        logo: $('#add_company_logo').val(),
        currency_id: $('#add_company_currency').val(),
        timezone_id: $('#add_company_timezone').val(),
        alignment: $('#add_company_alignment').val(),
        footer_text: $('#add_company_footer').val(),
    };

    callAjax({
        url: BASE_URL + '/settings/new_company/create',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Init Form.
                $('#add_company_title').val("");
                $('#add_company_email').val("");
                $('#add_company_address').val("");
                $('#add_company_phone').val("");
                $('#add_company_favicon').val("");
                $('#add_company_logo').val("");
                $('#add_company_currency').val("");
                $('#add_company_timezone').val("");
                $('#add_company_alignment').val("");
                $('#add_company_footer').val("");

                // Refresh Table.
                refreshCompanyList();
                toastr.success("New company is created.", "Success");

                // Cancel Panel
                $('#btn_modal_add_company_close').trigger('click');
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

/**
 * Show company information to edit modal.
 */
function showEditCompanyPage(id) {
    var formData = {
        id: id,
    };

    callAjax({
        url: BASE_URL + '/settings/new_company/get_company',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                var company = data['company'];

                // Init Form.
                $('#edit_company_id').val(company['id']);
                $('#edit_company_title').val(company['title']);
                $('#edit_company_email').val(company['email']);
                $('#edit_company_address').val(company['address']);
                $('#edit_company_phone').val(company['phone']);
                $('#edit_company_favicon').val(company['favicon']);
                $('#edit_company_logo').val(company['logo']);
                $('#edit_company_currency').val(company['currency_id']);
                $('#edit_company_timezone').val(company['timezone_id']);
                $('#edit_company_alignment').val(company['alignment']);
                $('#edit_company_footer').val(company['footer_text']);

                // Show Edit Modal
                $('#btn_show_company_edit_modal').trigger('click');
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

/**
 * Update company
 */
function updateCompany() {
    // Check Validation
    var validateFields = [{
        field_id: 'edit_company_title',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Company Title is required.'
        ]
    }, {
        field_id: 'edit_company_email',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Company Email is required.'
        ]
    }, {
        field_id: 'edit_company_address',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Address is required.'
        ]
    }, {
        field_id: 'edit_company_phone',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Phone is required.'
        ]
    }, {
        field_id: 'edit_company_favicon',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Favicon is required.'
        ]
    }, {
        field_id: 'edit_company_logo',
        conditions: [
            // 'required' + CONST_VALIDATE_SPLITER + 'Logo is required.'
        ]
    }, {
        field_id: 'edit_company_currency',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Currency is required.'
        ]
    }, {
        field_id: 'edit_company_timezone',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Time Zone is required.'
        ]
    }, {
        field_id: 'edit_company_alignment',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Alignment is required.'
        ]
    }, {
        field_id: 'edit_company_footer',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Footer Text is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        id: $('#edit_company_id').val(),
        title: $('#edit_company_title').val(),
        email: $('#edit_company_email').val(),
        address: $('#edit_company_address').val(),
        phone: $('#edit_company_phone').val(),
        favicon: $('#edit_company_favicon').val(),
        logo: $('#edit_company_logo').val(),
        currency_id: $('#edit_company_currency').val(),
        timezone_id: $('#edit_company_timezone').val(),
        alignment: $('#edit_company_alignment').val(),
        footer_text: $('#edit_company_footer').val(),
    };

    callAjax({
        url: BASE_URL + '/settings/new_company/update',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Refresh Table.
                refreshCompanyList();
                toastr.success("Company is updated.", "Success");

                // Cancel Panel
                $('#btn_modal_edit_company_close').trigger('click');
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

/**
 * Delete company.
 */
function deleteCompany(id, title) {
    displayConfirmModal("Are you sure to delete this company (" + title + ")?", "Delete", function (res) {
        if (res == 'ok') {
            var formData = {
                id: id
            };

            callAjax({
                url: BASE_URL + '/settings/new_company/delete',
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data['result'] == 'success') {
                        // Refresh Table.
                        refreshCompanyList();
                        toastr.success("Company is successfully deleted.", "Success");
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