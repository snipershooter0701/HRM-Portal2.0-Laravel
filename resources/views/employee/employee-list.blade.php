<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active" data-panelname="panel-employee-list">All Employees</a>
        </li>
        <li>
            <a href="javascript:;" class="btn-move-panel" data-panelname="panel-request-list">All Request Details</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel" data-panelname="panel-create-employee"><i class="fa fa-plus-circle"></i> Add Employee </button>
            <button id="btn_show_emp_view_panel" type="button" class="btn-move-panel display-none" data-panelname="panel-view-employee"></button>
            <button id="btn_show_edit_view_panel" type="button" class="btn-move-panel display-none" data-panelname="panel-edit-employee"></button>
        </div>
    </div>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-body">
                <div class="table-container">
                    <div class="row">
                        <div class="col-md-8">
                            <label>
                                <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Billable
                            </label>
                            <label style="margin-left: 10px;">
                                <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue">Non-Billable
                            </label>
                        </div>
                        <div class="col-md-4 actions">
                            <div id="tbl_employees_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
                                <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-copy"></i></a>
                                <a class="btn-tbl-action btn-move-panel" data-panelname="panel-import-employee"><i class="fa fa-upload"></i></a>
                                <a class="btn-tbl-action" data-target="#modal-export" data-toggle="modal"><i class="fa fa-download"></i></a>
                                <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-print"></i></a>
                                {{-- <a href="javascript:;" data-action="0" class="btn-tbl-action tool-action"><i class="icon-printer"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="icon-check"></i></a>
                            <a href="javascript:;" data-action="2" class="btn-tbl-action tool-action"><i class="icon-doc"></i></a>
                            <a href="javascript:;" data-action="3" class="btn-tbl-action tool-action"><i class="icon-paper-clip"></i></a>
                            <a href="javascript:;" data-action="4" class="btn-tbl-action tool-action"><i class="icon-cloud-upload"></i></a>
                            <a href="javascript:;" data-action="5" class="btn-tbl-action tool-action"><i class="icon-refresh"></i></a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="table-actions-wrapper">
                        <span> </span>
                        <select class="table-group-action-input form-control input-inline input-small input-sm">
                            <option value="">Select...</option>
                            <option value="Delete">Delete</option>
                        </select>
                        <button class="btn btn-sm table-group-action-submit btn-c-primary">
                            <i class="fa fa-check"></i> Submit</button>
                    </div>
                    <table id="tbl_employees" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable"> </th>
                                <th width="5%"> No </th>
                                <th width="15%"> First Name </th>
                                <th width="15%"> Last Name </th>
                                <th width="10%"> Phone </th>
                                <th width="10%"> Category </th>
                                <th width="12%"> Date of Joining </th>
                                <th width="10%"> POC </th>
                                <th width="10%"> Status </th>
                                <th width="11%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td> </td>

                                {{-- first name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_first_name"> </td>

                                {{-- last name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_last_name"> </td>

                                {{-- Phone --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_phone"> </td>

                                {{-- category --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_category"> </td>

                                {{-- date of joining --}}
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_join_date_from" placeholder="From">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_join_date_to" placeholder="To">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>

                                {{-- supervisor --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_poc"> </td>

                                {{-- status --}}
                                <td>
                                    <select name="filt_status" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="pending">active</option>
                                        <option value="closed">inactive</option>
                                    </select>
                                </td>
                                <td>
                                    <button class="btn btn-xs btn-c-primary filter-submit"><i class="fa fa-search"></i></button>
                                    <button class="btn btn-xs btn-c-grey filter-cancel"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>

<div id="modal-export" class="modal fade" tabindex="-1" data-width="760">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Export</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <form action="javascript:;" class="form-horizontal form-row-seperated">
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-4" style="text-align: center;">
                            </div>
                            <div class="col-md-4 export-label-title">
                                <span>Export List</span>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="display:flex; justify-content: center;">
                                <select multiple="multiple" class="multi-select" id="my_multi_select1" name="my_multi_select1[]">
                                    <option>Dallas Cowboys</option>
                                    <option>New York Giants</option>
                                    <option selected>Philadelphia Eagles</option>
                                    <option selected>Washington Redskins</option>
                                    <option>Chicago Bears</option>
                                    <option>Detroit Lions</option>
                                    <option>Green Bay Packers</option>
                                    <option>Minnesota Vikings</option>
                                    <option selected>Atlanta Falcons</option>
                                    <option>Carolina Panthers</option>
                                    <option>New Orleans Saints</option>
                                    <option>Tampa Bay Buccaneers</option>
                                    <option>Arizona Cardinals</option>
                                    <option>St. Louis Rams</option>
                                    <option>San Francisco 49ers</option>
                                    <option>Seattle Seahawks</option>
                                </select>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="text-align: center;">
                                <hr>
                                <button type="submit" class="btn btn-sm btn-c-primary">Export</button>
                                <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-employee-list">Cancel</button></div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-c-grey">Close</button>
    </div>
</div>
