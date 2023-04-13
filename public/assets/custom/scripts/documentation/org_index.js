$(document).ready(function () {
    TableDocumentation.init();

    $('#select_group').change(function () {
        if ($(this).val() == 'create-group') {
            $('#btn_toogle_create_group_modal').trigger('click');
        }
    });

    // create folder
    $('#create_folder').click(function () {
        displayConfirmModal('<input type="text" class="form-control folder-name" id="folder_name" placeholder="Folder Name">', 'My Folder', function (req) {
            if (req == 'ok') {
                createMyDocument();
            }
        })
    });



    // add document
    $('#create_doc').click(function () {
        displayConfirmModal('<input type="text" placeholder="Folder Name">', 'My Folder', function (req) {
            if (req == 'ok') {
                createMyDocument();
            }
        })
    });
});


var grid_myFolder = new Datatable();
var grid_share_doc = new Datatable();
var grid_all_doc = new Datatable();

var TableDocumentation = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleBootstrapSelect = function () {
        $('.bs-select').selectpicker({
            iconBase: 'fa',
            tickIcon: 'fa-check'
        });
    }

    // My Documents
    var handleMyDocList = function () {

        grid_myFolder.init({
            src: $("#tbl_org_my_docs"),
            onSuccess: function (grid_myFolder, response) { },
            onError: function (grid_myFolder) { },
            onDataLoad: function (grid_myFolder) {

                // share document
                $('.btn-share').click(function () {
                    var id = $(this).attr('data-id');
                    var body = '<form action="javascript:;" class="form-horizontal form-row-seperated">' +
                        '<div class="form-body">' +
                        '<div class="row">' +
                        '<div class="col-sm-3"></div>' +
                        '<div class="col-sm-6">' +
                        '<div class="form-group mr-0 ml-0 ">' +
                        '<label class="control-label">Shared To <span class="required" aria-required="true">*</span></label>' +
                        '<input type="text" class="form-control" id="share_emp">' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-sm-3"></div>' +
                        '</div>' +
                        '</div>' +
                        '</form>';

                    displayConfirmModal(body, 'Share Document', function (req) {
                        if (req == 'ok') {
                            shareMyDocument(id);
                        }
                    })
                });
            },
            loadingMessage: 'Loading...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                "dom": "<'row'<'col-md-8 col-sm-12'pl><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pl><'col-md-4 col-sm-12'>>",

                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": BASE_URL + "/documentation/organization/my_doc/list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 2]
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
        grid_myFolder.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid_myFolder.getTableWrapper());
            if (action.val() != "" && grid_myFolder.getSelectedRowsCount() > 0) {
                grid_myFolder.setAjaxParam("customActionType", "group_action");
                grid_myFolder.setAjaxParam("customActionName", action.val());
                grid_myFolder.setAjaxParam("id", grid_myFolder.getSelectedRows());
                grid_myFolder.getDataTable().ajax.reload();
                grid_myFolder.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid_myFolder.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid_myFolder.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid_myFolder.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid_myFolder.setAjaxParam("customActionType", "group_action");
        // grid_myFolder.getDataTable().ajax.reload();
        // grid_myFolder.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_org_docs_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            grid_myFolder.getDataTable().button(action).trigger();
        });
    }

    // shared Documents
    var handleSharedDocList = function () {

        grid_share_doc.init({
            src: $("#tbl_org_shared_docs"),
            onSuccess: function (grid_share_doc, response) { },
            onError: function (grid_share_doc) { },
            onDataLoad: function (grid_share_doc) {
            },
            loadingMessage: 'Loading...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                "dom": "<'row'<'col-md-8 col-sm-12'pl><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pl><'col-md-4 col-sm-12'>>",

                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": BASE_URL + "/documentation/organization/share_doc/list", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 3]
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
        grid_share_doc.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid_share_doc.getTableWrapper());
            if (action.val() != "" && grid_share_doc.getSelectedRowsCount() > 0) {
                grid_share_doc.setAjaxParam("customActionType", "group_action");
                grid_share_doc.setAjaxParam("customActionName", action.val());
                grid_share_doc.setAjaxParam("id", grid_share_doc.getSelectedRows());
                grid_share_doc.getDataTable().ajax.reload();
                grid_share_doc.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid_share_doc.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid_share_doc.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid_share_doc.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid_share_doc.setAjaxParam("customActionType", "group_action");
        // grid_share_doc.getDataTable().ajax.reload();
        // grid_share_doc.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_emp_docs_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            grid_share_doc.getDataTable().button(action).trigger();
        });
    }

    // All doc list
    var handleAllDocList = function () {

        grid_all_doc.init({
            src: $("#tbl_org_docs"),
            onSuccess: function (grid_all_doc, response) { },
            onError: function (grid_all_doc) { },
            onDataLoad: function (grid_all_doc) {
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
                    "url": BASE_URL + "/documentation/organization/all_list", // ajax source
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
        grid_all_doc.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid_all_doc.getTableWrapper());
            if (action.val() != "" && grid_all_doc.getSelectedRowsCount() > 0) {
                grid_all_doc.setAjaxParam("customActionType", "group_action");
                grid_all_doc.setAjaxParam("customActionName", action.val());
                grid_all_doc.setAjaxParam("id", grid_all_doc.getSelectedRows());
                grid_all_doc.getDataTable().ajax.reload();
                grid_all_doc.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid_all_doc.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid_all_doc.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid_all_doc.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid_all_doc.setAjaxParam("customActionType", "group_action");
        // grid_all_doc.getDataTable().ajax.reload();
        // grid_all_doc.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_exp_docs_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            grid_all_doc.getDataTable().button(action).trigger();
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            initPickers();
            // handleBootstrapSelect();
            handleMyDocList();
            handleSharedDocList();
            handleAllDocList();
        }
    };
}();


function refreshMyDocTbl() {
    grid_myFolder.getDataTable().ajax.reload();
    grid_myFolder.clearAjaxParams();
}

function refreshShareDocTbl() {
    grid_share_doc.getDataTable().ajax.reload();
    grid_share_doc.clearAjaxParams();
}

//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
// My Documents

function createMyDocument() {
    // validation TODO
    var validateFields = [{
        field_id: 'folder_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Folder Name field is required.'
        ]
    }];

    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;


    var formData = {
        folder_name: $('#folder_name').val()
    };

    callAjax({
        url: BASE_URL + '/documentation/organization/my_doc/create',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshMyDocTbl();
                toastr.success("New Folder is successfully created.", "Success");

                $('#folder_name').val('');

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

function shareMyDocument(id) {

    // validation TODO
    var validateFields = [{
        field_id: 'share_emp',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Share To field is required.'
        ]
    }];

    var formData = {
        id: id,
        email: $('#share_emp').val()
    };

    callAjax({
        url: BASE_URL + '/documentation/organization/my_doc/share',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                // Refresh Table.
                refreshShareDocTbl();
                toastr.success("Folder is successfully shared.", "Success");

            } else {
                toastr.error("That user doesn't exist.", "Error");
            }
            $('#folder_name').val('');
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
