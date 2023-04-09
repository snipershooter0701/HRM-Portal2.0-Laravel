<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ url('/employee/all_employees') }}" class="btn-move-panel bread-active" data-panelname="panel-employee-list">All Employees</a>
        </li>
        <li>
            <a href="{{ url('/employee/all_request_details') }}" class="btn-move-panel" data-panelname="panel-request-list">All Request Details</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button id="add_employee_btn" type="button" class="btn btn-sm btn-c-primary btn-move-panel" data-panelname="panel-add-employee"><i class="fa fa-plus-circle"></i> Add Employee </button>
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
                    <table id="tbl_employee_list" class="table table-striped table-bordered table-hover table-checkable">
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
                                    <select name="filt_category" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="0">W2</option>
                                        <option value="1">C2C</option>
                                        <option value="2">1099</option>
                                    </select>
                                </td>

                                {{-- date of joining --}}
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_join_date_from" placeholder="From">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
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
                                    <select name="filt_poc" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="0">Lead Names</option>
                                </td>

                                {{-- status --}}
                                <td>
                                    <select name="filt_status" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
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
