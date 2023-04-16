
// var data = {
//     id: 0
// };

var grid = new Datatable();
$(document).ready(function () {
    TableDocumentation.init(grid);

    // create group
    $('#view_group').change(function () {
        if ($(this).val() == '-1') {
            $('#create_group_modal').modal();
        } else {
            var title_id = $(this).val();
            searchGroup(title_id);
        }
    });

    // save group
    $('#save_group').click(function () {
        createGroup();
    });
});



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

    var handleGroupDocList = function (grid) {

        grid.init({
            src: $("#tbl_group_docs"),
            onSuccess: function (grid, response) {

                $groupArr = response['group'];
                var group = '<option value="">View Group(s)</option>';

                for (var i in $groupArr) {
                    group += '<option value="' + $groupArr[i].doc_title_id + '">' + $groupArr[i].name + '</option>'
                }

                group += '<option value="-1">Create Group</option>';
                $('#view_group').html(group);
            },
            onError: function (grid) { },
            onDataLoad: function (grid) {
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
                    "url": BASE_URL + "/documentation/group/list", // ajax source
                },
                "data": 789456,
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
        $('#tbl_org_docs_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            grid.getDataTable().button(action).trigger();
        });
    }



    let grid_org_doc = new Datatable();

    grid_org_doc.init({
        src: $("#tbl_emp_doc_act"),
        onSuccess: function (grid_org_doc, response) { },
        onError: function (grid_org_doc) { },
        onDataLoad: function (grid_org_doc) {
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
                "url": BASE_URL + "/documentation/get-org-docs-activity", // ajax source
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
    grid_org_doc.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
        e.preventDefault();
        var action = $(".table-group-action-input", grid_org_doc.getTableWrapper());
        if (action.val() != "" && grid_org_doc.getSelectedRowsCount() > 0) {
            grid_org_doc.setAjaxParam("customActionType", "group_action");
            grid_org_doc.setAjaxParam("customActionName", action.val());
            grid_org_doc.setAjaxParam("id", grid_org_doc.getSelectedRows());
            grid_org_doc.getDataTable().ajax.reload();
            grid_org_doc.clearAjaxParams();
        } else if (action.val() == "") {
            App.alert({
                type: 'danger',
                icon: 'warning',
                message: 'Please select an action',
                container: grid_org_doc.getTableWrapper(),
                place: 'prepend'
            });
        } else if (grid_org_doc.getSelectedRowsCount() === 0) {
            App.alert({
                type: 'danger',
                icon: 'warning',
                message: 'No record selected',
                container: grid_org_doc.getTableWrapper(),
                place: 'prepend'
            });
        }
    });

    // grid_org_doc.setAjaxParam("customActionType", "group_action");
    // grid_org_doc.getDataTable().ajax.reload();
    // grid_org_doc.clearAjaxParams();

    // handle datatable custom tools
    $('#tbl_org_doc_act_tools > a.tool-action').on('click', function () {
        var action = $(this).attr('data-action');
        grid_org_doc.getDataTable().button(action).trigger();
    });

    return {
        //main function to initiate the module
        init: function (grid) {
            initPickers();
            // handleBootstrapSelect();
            handleGroupDocList(grid);
        }
    };
}();


function createGroup() {

    // validation TODO
    var validateFields = [{
        field_id: 'group_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Group Name field is required.'
        ]
    }, {
        field_id: 'doc_name',
        conditions: [
            'required' + CONST_VALIDATE_SPLITER + 'Document Title field is required.'
        ]
    }];

    var isValid = doValidationForm(validateFields);
    if (!isValid)
        return;


    var formData = {
        group_name: $('#group_name').val(),
        doc_title_id: $('#doc_name').val()
    };

    callAjax({
        url: BASE_URL + '/documentation/group/create',
        type: "POST",
        data: formData,
        success: function (data) {
            if (data['result'] == 'success') {

                $groupArr = data['group'];
                var group = '<option value="">View Group(s)</option>';

                for (var i in $groupArr) {
                    group += '<option value="' + $groupArr[i].id + '">' + $groupArr[i].name + '</option>'
                }

                group += '<option value="-1">Create Group</option>';
                $('#view_group').html(group);

                toastr.success("Group is successfully created.", "Success");

                $('#create_group_modal #group_name').val('');
                $('#create_group_modal #doc_name').val('');
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

function searchGroup(id) {
    var formData = {
        id: id
    };

    console.log(id);

    $('#tbl_group_docs').destroy();
    // grid.getDataTable().ajax.reload();
    // grid.clearAjaxParams();

    var grid_doc = dataTable();
    TableDocumentation.init(grid_doc);

    // callAjax({
    //     url: BASE_URL + '/documentation/group/searchGroup',
    //     type: "POST",
    //     data: formData,
    //     success: function (data) {
    //         if (data['result'] == 'success') {

    //             $groupArr = data['group'];
    //             var group = '<option value="">View Group(s)</option>';

    //             for (var i in $groupArr) {
    //                 group += '<option value="' + $groupArr[i].id + '">' + $groupArr[i].name + '</option>';
    //             }

    //             group += '<option value="-1">Create Group</option>';
    //             $('#view_group').html(group);

    //             toastr.success("Group is successfully created.", "Success");

    //             $('#create_group_modal #group_name').val('');
    //             $('#create_group_modal #doc_name').val('');
    //         }
    //     },
    //     error: function (err) {
    //         var errors = err.errors;
    //         if (errors) {
    //             // Show server validation error.
    //             var validationFields = [
    //                 'business_name' + CONST_VALIDATE_SPLITER + 'create_bus_name',
    //                 'contact_number' + CONST_VALIDATE_SPLITER + 'create_bus_contact_num',
    //                 'federal_id' + CONST_VALIDATE_SPLITER + 'create_bus_federal_id',
    //                 'email' + CONST_VALIDATE_SPLITER + 'create_bus_email',
    //                 'website' + CONST_VALIDATE_SPLITER + 'create_bus_website',
    //                 'inv_country_id' + CONST_VALIDATE_SPLITER + 'create_bus_inv_country',
    //                 'inv_state_id' + CONST_VALIDATE_SPLITER + 'create_bus_inv_state',
    //                 'inv_city' + CONST_VALIDATE_SPLITER + 'create_bus_inv_city',
    //                 'inv_street' + CONST_VALIDATE_SPLITER + 'create_bus_inv_street',
    //                 'inv_suite_aptno' + CONST_VALIDATE_SPLITER + 'create_bus_inv_apt',
    //                 'inv_zipcode' + CONST_VALIDATE_SPLITER + 'create_bus_inv_zipcode',
    //                 'addr_country_id' + CONST_VALIDATE_SPLITER + 'create_bus_cli_country',
    //                 'addr_state_id' + CONST_VALIDATE_SPLITER + 'create_bus_cli_state',
    //                 'addr_city' + CONST_VALIDATE_SPLITER + 'create_bus_cli_city',
    //                 'addr_street' + CONST_VALIDATE_SPLITER + 'create_bus_cli_street',
    //                 'addr_suite_aptno' + CONST_VALIDATE_SPLITER + 'create_bus_cli_apt',
    //                 'addr_zipcode' + CONST_VALIDATE_SPLITER + 'create_bus_cli_zipcode',
    //             ];
    //             showServerValidationErrors(validationFields, errors);

    //             toastr.error(err.message, "Error");
    //         }
    //     }
    // });

}



