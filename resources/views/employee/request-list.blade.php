<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="btn-move-panel" data-panelname="panel-employee-list">All Employees</a>
        </li>
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active" data-panelname="panel-request-list">All Request Details</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" data-panelname="panel-create-request"><i class="fa fa-plus-circle"></i> Create Request </button>
            <button type="button" class="btn btn-sm btn-c-grey dropdown-toggle" data-toggle="dropdown"> More
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="#">
                        <i class="icon-bell"></i> Request Details</a>
                </li>
            </ul>
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
                    <div class="actions">
                        <div id="tbl_request_details_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-copy"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-upload"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-download"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-print"></i></a>
                            {{-- <a href="javascript:;" data-action="0" class="btn-tbl-action tool-action"><i class="icon-printer"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="icon-check"></i></a>
                            <a href="javascript:;" data-action="2" class="btn-tbl-action tool-action"><i class="icon-doc"></i></a>
                            <a href="javascript:;" data-action="3" class="btn-tbl-action tool-action"><i class="icon-paper-clip"></i></a>
                            <a href="javascript:;" data-action="4" class="btn-tbl-action tool-action"><i class="icon-cloud-upload"></i></a>
                            <a href="javascript:;" data-action="5" class="btn-tbl-action tool-action"><i class="icon-refresh"></i></a> --}}
                        </div>
                    </div>
                    <div class="table-actions-wrapper">
                        <span> </span>
                        <select class="table-group-action-input form-control input-inline input-small input-sm">
                            <option value="">Select...</option>
                            <option value="Cancel">Cancel</option>
                            <option value="Cancel">Hold</option>
                            <option value="Cancel">On Hold</option>
                            <option value="Close">Close</option>
                        </select>
                        <button class="btn btn-sm table-group-action-submit btn-c-primary">
                            <i class="fa fa-check"></i> Submit</button>
                    </div>
                    <table id="tbl_request_details" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable"> </th>
                                <th width="5%"> No </th>
                                <th width="15%"> Request ID </th>
                                <th width="15%"> Employee Name </th>
                                <th width="20%"> Requested On </th>
                                <th width="20%"> Responsed On </th>
                                <th width="10%"> Requested By </th>
                                <th width="10%"> Approver </th>
                                <th width="10%"> Template Name </th>
                                <th width="10%"> Request Status </th>
                                <th width="20%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td> </td>

                                {{-- Request ID --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_first_name">
                                </td>

                                {{-- Employee Name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_last_name">
                                </td>

                                {{-- Responsed On --}}
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

                                {{-- Responsed On --}}
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

                                {{-- Requested By --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_category">
                                </td>

                                {{-- Approver --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_category">
                                </td>

                                {{-- Template Name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_poc">
                                </td>

                                {{-- Request Status --}}
                                <td>
                                    <select name="filt_status" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="pending">active</option>
                                        <option value="closed">inactive</option>
                                    </select>
                                </td>

                                {{-- Action --}}
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
