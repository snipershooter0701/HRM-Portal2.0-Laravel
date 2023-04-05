var TableClient = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleClientList = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#tbl_clients"),
            onSuccess: function (grid, response) { },
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
                    "url": BASE_URL + "/client/get_clients", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 1, 8]
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
        $('#tbl_clients_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            grid.getDataTable().button(action).trigger();
        });
    }

    var handlePlacement = function () {

        var grid_placements = new Datatable();

        grid_placements.init({
            src: $("#tbl_placements"),
            onSuccess: function (grid_placements, response) { },
            onError: function (grid_placements) { },
            onDataLoad: function (grid_placements) {
            },
            loadingMessage: 'Loading...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                // "dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": BASE_URL + "/client/get_placements", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0, 1, 8]
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
        grid_placements.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid_placements.getTableWrapper());
            if (action.val() != "" && grid_placements.getSelectedRowsCount() > 0) {
                grid_placements.setAjaxParam("customActionType", "group_action");
                grid_placements.setAjaxParam("customActionName", action.val());
                grid_placements.setAjaxParam("id", grid_placements.getSelectedRows());
                grid_placements.getDataTable().ajax.reload();
                grid_placements.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid_placements.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid_placements.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid_placements.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid_placements.setAjaxParam("customActionType", "group_action");
        // grid_placements.getDataTable().ajax.reload();
        // grid_placements.clearAjaxParams();

        // handle datatable custom tools
        $('#tbl_placements_tools > a.tool-action').on('click', function () {
            var action = $(this).attr('data-action');
            grid_placements.getDataTable().button(action).trigger();
        });
    }

    var handleAddPlacementActivity = function () {

        var grid_addplacements_activity = new Datatable();

        grid_addplacements_activity.init({
            src: $("#tbl_addplacement_activity"),
            onSuccess: function (grid_addplacements_activity, response) { },
            onError: function (grid_addplacements_activity) { },
            onDataLoad: function (grid_addplacements_activity) {
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
                    "url": BASE_URL + "/client/get_addplacement_activities", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': true,
                        'targets': [0]
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
        grid_addplacements_activity.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid_addplacements_activity.getTableWrapper());
            if (action.val() != "" && grid_addplacements_activity.getSelectedRowsCount() > 0) {
                grid_addplacements_activity.setAjaxParam("customActionType", "group_action");
                grid_addplacements_activity.setAjaxParam("customActionName", action.val());
                grid_addplacements_activity.setAjaxParam("id", grid_addplacements_activity.getSelectedRows());
                grid_addplacements_activity.getDataTable().ajax.reload();
                grid_addplacements_activity.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid_addplacements_activity.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid_addplacements_activity.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid_addplacements_activity.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid_addplacements_activity.setAjaxParam("customActionType", "group_action");
        // grid_addplacements_activity.getDataTable().ajax.reload();
        // grid_addplacements_activity.clearAjaxParams();

        // handle datatable custom tools
        // $('#tbl_activity_tools > a.tool-action').on('click', function () {
        //     var action = $(this).attr('data-action');
        //     grid_addplacements_activity.getDataTable().button(action).trigger();
        // });
    }

    var handleActivity = function () {

        var grid_activity = new Datatable();

        grid_activity.init({
            src: $("#tbl_activity"),
            onSuccess: function (grid_activity, response) { },
            onError: function (grid_activity) { },
            onDataLoad: function (grid_activity) {
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
                    "url": BASE_URL + "/client/get_activities", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': true,
                        'targets': [0]
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
        grid_activity.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid_activity.getTableWrapper());
            if (action.val() != "" && grid_activity.getSelectedRowsCount() > 0) {
                grid_activity.setAjaxParam("customActionType", "group_action");
                grid_activity.setAjaxParam("customActionName", action.val());
                grid_activity.setAjaxParam("id", grid_activity.getSelectedRows());
                grid_activity.getDataTable().ajax.reload();
                grid_activity.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid_activity.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid_activity.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid_activity.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid_activity.setAjaxParam("customActionType", "group_action");
        // grid_activity.getDataTable().ajax.reload();
        // grid_activity.clearAjaxParams();

        // handle datatable custom tools
        // $('#tbl_activity_tools > a.tool-action').on('click', function () {
        //     var action = $(this).attr('data-action');
        //     grid_activity.getDataTable().button(action).trigger();
        // });
    }

    var handleContact = function () {

        var grid_contact = new Datatable();

        grid_contact.init({
            src: $("#tbl_contact"),
            onSuccess: function (grid_contact, response) { },
            onError: function (grid_contact) { },
            onDataLoad: function (grid_contact) {
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
                    "url": BASE_URL + "/client/get_contact_info", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': true,
                        'targets': [0, 1, 6]
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
        grid_contact.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid_contact.getTableWrapper());
            if (action.val() != "" && grid_contact.getSelectedRowsCount() > 0) {
                grid_contact.setAjaxParam("customActionType", "group_action");
                grid_contact.setAjaxParam("customActionName", action.val());
                grid_contact.setAjaxParam("id", grid_contact.getSelectedRows());
                grid_contact.getDataTable().ajax.reload();
                grid_contact.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid_contact.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid_contact.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid_contact.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid_contact.setAjaxParam("customActionType", "group_action");
        // grid_contact.getDataTable().ajax.reload();
        // grid_contact.clearAjaxParams();

        // handle datatable custom tools
        // $('#tbl_activity_tools > a.tool-action').on('click', function () {
        //     var action = $(this).attr('data-action');
        //     grid_contact.getDataTable().button(action).trigger();
        // });
    }

    var handleInvoice = function () {

        var grid_invoice = new Datatable();

        grid_invoice.init({
            src: $("#tbl_invoice"),
            onSuccess: function (grid_invoice, response) { },
            onError: function (grid_invoice) { },
            onDataLoad: function (grid_invoice) {
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
                    "url": BASE_URL + "/client/get_invoices", // ajax source
                },
                "columnDefs": [
                    {  // set default column settings
                        'orderable': true,
                        'targets': [0, 1, 6]
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
        grid_invoice.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid_invoice.getTableWrapper());
            if (action.val() != "" && grid_invoice.getSelectedRowsCount() > 0) {
                grid_invoice.setAjaxParam("customActionType", "group_action");
                grid_invoice.setAjaxParam("customActionName", action.val());
                grid_invoice.setAjaxParam("id", grid_invoice.getSelectedRows());
                grid_invoice.getDataTable().ajax.reload();
                grid_invoice.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid_invoice.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid_invoice.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid_invoice.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid_invoice.setAjaxParam("customActionType", "group_action");
        // grid_invoice.getDataTable().ajax.reload();
        // grid_invoice.clearAjaxParams();

        // handle datatable custom tools
        // $('#tbl_activity_tools > a.tool-action').on('click', function () {
        //     var action = $(this).attr('data-action');
        //     grid_invoice.getDataTable().button(action).trigger();
        // });
    }

    var handleDocument = function () {

        var grid_docuements = new Datatable();

        grid_docuements.init({
            src: $("#tbl_document"),
            onSuccess: function (grid_docuements, response) { },
            onError: function (grid_docuements) { },
            onDataLoad: function (grid_docuements) {
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
                    "url": BASE_URL + "/client/get_documents", // ajax source
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
        grid_docuements.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid_docuements.getTableWrapper());
            if (action.val() != "" && grid_docuements.getSelectedRowsCount() > 0) {
                grid_docuements.setAjaxParam("customActionType", "group_action");
                grid_docuements.setAjaxParam("customActionName", action.val());
                grid_docuements.setAjaxParam("id", grid_docuements.getSelectedRows());
                grid_docuements.getDataTable().ajax.reload();
                grid_docuements.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid_docuements.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid_docuements.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid_docuements.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid_docuements.setAjaxParam("customActionType", "group_action");
        // grid_docuements.getDataTable().ajax.reload();
        // grid_docuements.clearAjaxParams();

        // handle datatable custom tools
        // $('#tbl_activity_tools > a.tool-action').on('click', function () {
        //     var action = $(this).attr('data-action');
        //     grid_docuements.getDataTable().button(action).trigger();
        // });
    }

    var handleConfidentials = function () {

        let grid_old_records = new Datatable();

        grid_old_records.init({
            src: $("#tbl_confidential_old_records"),
            onSuccess: function (grid_old_records, response) { },
            onError: function (grid_old_records) { },
            onDataLoad: function (grid_old_records) {
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
                    "url": BASE_URL + "/client/get_old_confidentials", // ajax source
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
        grid_old_records.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid_old_records.getTableWrapper());
            if (action.val() != "" && grid_old_records.getSelectedRowsCount() > 0) {
                grid_old_records.setAjaxParam("customActionType", "group_action");
                grid_old_records.setAjaxParam("customActionName", action.val());
                grid_old_records.setAjaxParam("id", grid_old_records.getSelectedRows());
                grid_old_records.getDataTable().ajax.reload();
                grid_old_records.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid_old_records.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid_old_records.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid_old_records.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid_old_records.setAjaxParam("customActionType", "group_action");
        // grid_old_records.getDataTable().ajax.reload();
        // grid_old_records.clearAjaxParams();

        // handle datatable custom tools
        // $('#tbl_activity_tools > a.tool-action').on('click', function () {
        //     var action = $(this).attr('data-action');
        //     grid_old_records.getDataTable().button(action).trigger();
        // });
    }

    var handlePlacmentActivities = function () {

        var grid_activity = new Datatable();

        grid_activity.init({
            src: $("#tbl_placement_activities"),
            onSuccess: function (grid_activity, response) { },
            onError: function (grid_activity) { },
            onDataLoad: function (grid_activity) {
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
                    "url": BASE_URL + "/client/get_activities", // ajax source
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
        grid_activity.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid_activity.getTableWrapper());
            if (action.val() != "" && grid_activity.getSelectedRowsCount() > 0) {
                grid_activity.setAjaxParam("customActionType", "group_action");
                grid_activity.setAjaxParam("customActionName", action.val());
                grid_activity.setAjaxParam("id", grid_activity.getSelectedRows());
                grid_activity.getDataTable().ajax.reload();
                grid_activity.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid_activity.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid_activity.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid_activity.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        // grid_activity.setAjaxParam("customActionType", "group_action");
        // grid_activity.getDataTable().ajax.reload();
        // grid_activity.clearAjaxParams();

        // handle datatable custom tools
        // $('#tbl_placement_activities_tools > a.tool-action').on('click', function () {
        //     var action = $(this).attr('data-action');
        //     grid_activity.getDataTable().button(action).trigger();
        // });
    }


    return {
        //main function to initiate the module
        init: function () {
            initPickers();
            handleClientList();
            handlePlacement();
            handleActivity();
            handleAddPlacementActivity();
            handleContact();
            handleInvoice();
            handleDocument();
            handleConfidentials();
            handlePlacmentActivities();
        }
    };
}();

$(document).ready(function () {
    TableClient.init();

    $('#add_contact').click(function () {
        $('#contact_modal').modal();
    })
});