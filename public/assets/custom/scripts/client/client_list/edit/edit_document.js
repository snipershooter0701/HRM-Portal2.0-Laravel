var gridDocumentTable = new Datatable();

var TableDocument = function () {
    var initPickers = function () {
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleDocumentTable = function () {

        gridDocumentTable.init({
            src: $("#tbl_document"),
            onSuccess: function (gridDocumentTable, response) { },
            onError: function (gridDocumentTable) { },
            onDataLoad: function (gridDocumentTable) {
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
                    "url": BASE_URL + "/client/document/get_tbl_list", // ajax source
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
        gridDocumentTable.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", gridDocumentTable.getTableWrapper());
            if (action.val() != "" && gridDocumentTable.getSelectedRowsCount() > 0) {
                gridDocumentTable.setAjaxParam("customActionType", "group_action");
                gridDocumentTable.setAjaxParam("customActionName", action.val());
                gridDocumentTable.setAjaxParam("id", gridDocumentTable.getSelectedRows());
                gridDocumentTable.getDataTable().ajax.reload();
                gridDocumentTable.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: gridDocumentTable.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (gridDocumentTable.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: gridDocumentTable.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // gridDocumentTable.setAjaxParam("customActionType", "group_action");
        // gridDocumentTable.getDataTable().ajax.reload();
        // gridDocumentTable.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_document_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            gridDocumentTable.getDataTable().button(action).trigger();
        });
    }
    return {
        init: function () {
            initPickers();
            handleDocumentTable();
        }
    };
}();

$(document).ready(function () {
    TableDocument.init();

    $('#btn_add_document_create').click(function () {
        createDocument();
    });
});

/**
 * Refresh document table.
 */
function refreshDocumentTable() {
    gridDocumentTable.getDataTable().ajax.reload();
    gridDocumentTable.clearAjaxParams();
}

/**
 * Create Document
 */
function createDocument() {
    var validateFields = [{
        field_id: 'add_document_employee',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Employee Name is required.'
        ]
    }, {
        field_id: 'add_document_client',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Client Name is required.'
        ]
    }, {
        field_id: 'add_document_jobtire',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Job Tire is required.'
        ]
    }, {
        field_id: 'add_document_placement_id',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Placement ID is required.'
        ]
    }, {
        field_id: 'add_document_doctype_id',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Document Type is required.'
        ]
    }, {
        field_id: 'add_document_comment',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Comment is required.'
        ]
    }, {
        field_id: 'add_document_title',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Title is required.'
        ]
    }, {
        field_id: 'add_document_expiredate',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Expiration Date is required.'
        ],
        level: true
    }, {
        field_id: 'add_document_attachment',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Attachment is required.'
        ]
    }];
    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;

    var formData = {
        employee_id: $('#add_document_employee').val(),
        client_id: $('#add_document_client').val(),
        job_tire_id: $('#add_document_jobtire').val(),
        client_placement_id: $('#add_document_placement_id').val(),
        client_placement_doctype_id: $('#add_document_doctype_id').val(),
        title: $('#add_document_title').val(),
        comment: $('#add_document_comment').val(),
        expire_date: $('#add_document_expiredate').val(),
        attachment: $('#add_document_attachment').val()
    };

    callAjax({
        url: BASE_URL + '/client/document/create',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {
                // Init Table.
                $('#add_document_employee').val("");
                $('#add_document_client').val("");
                $('#add_document_jobtire').val("");
                $('#add_document_placement_id').val("");
                $('#add_document_doctype_id').val("");
                $('#add_document_title').val("");
                $('#add_document_comment').val("");
                $('#add_document_expiredate').val("");
                $('#add_document_attachment').val("");

                // Refresh Table.
                refreshClientList();
                refreshDocumentTable();
                toastr.success("New document is created.", "Success");

                // Cancel Panel
                $('#btn_add_document_cancel').trigger('click');
            }
        },
        error: function (err) {
            var errors = err.errors;
            if (errors) {
                // Show server validation error.
                var validationFields = [
                    'employee_id' + CONST_VALIDATE_SPLITER + 'add_document_employee',
                    'client_id' + CONST_VALIDATE_SPLITER + 'add_document_client',
                    'job_tire_id' + CONST_VALIDATE_SPLITER + 'add_document_jobtire',
                    'client_placement_id' + CONST_VALIDATE_SPLITER + 'add_document_placement_id',
                    'client_placement_doctype_id' + CONST_VALIDATE_SPLITER + 'add_document_doctype_id',
                    'title' + CONST_VALIDATE_SPLITER + 'add_document_title',
                    'comment' + CONST_VALIDATE_SPLITER + 'add_document_comment',
                    'expire_date' + CONST_VALIDATE_SPLITER + 'add_document_expiredate',
                    'attachment' + CONST_VALIDATE_SPLITER + 'add_document_attachment',
                ];

                showServerValidationErrors(validationFields, errors);
                toastr.error(err.message, "Error");
            }
        }
    });
}