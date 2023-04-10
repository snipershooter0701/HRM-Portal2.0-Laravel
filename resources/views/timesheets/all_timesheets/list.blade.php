<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active" data-panelname="panel-all-timesheet-list">All Timesheets</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
        </div>
    </div>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-body">
                <div class="table-container">
                    <div class="row">
                        <div class="col-md-8">
                            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel" data-panelname="panel-create-timesheet"> Submit Timesheet </button>
                        </div>
                        <div class="col-md-4 actions">
                            <div id="tbl_all_timesheets_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
                                <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-copy"></i></a>
                                <a class="btn-tbl-action btn-move-panel" data-panelname="panel-import-employee"><i class="fa fa-upload"></i></a>
                                <a class="btn-tbl-action btn-move-panel" data-panelname="panel-export-employee"><i class="fa fa-download"></i></a>
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
                    <table id="tbl_all_timesheets" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable"> </th>
                                <th width="5%"> No </th>
                                <th width="13%"> Employee </th>
                                <th width="13%"> Client </th>
                                <th width="13%"> Date Range </th>
                                <th width="10%"> Total Billable Hours </th>
                                <th width="10%"> Status </th>
                                <th width="12%"> Submitted On </th>
                                <th width="8%"> Attachment </th>
                                <th width="14%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td> </td>

                                {{-- Employee --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_employee">
                                </td>

                                {{-- Client --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_client">
                                </td>

                                {{-- Data Range --}}
                                <td>
                                    <select name="filt_date_range" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="{{config('constants.DATE_RANGE_ALL')}}">All</option>
                                        <option value="{{config('constants.DATE_RANGE_CUR_WEEK')}}">Current Week</option>
                                        <option value="{{config('constants.DATE_RANGE_LAST_WEEK')}}">Last Week</option>
                                        <option value="{{config('constants.DATE_RANGE_CUR_MTH')}}">Current Month</option>
                                        <option value="{{config('constants.DATE_RANGE_LAST_MTH')}}">Last Month</option>
                                        <option value="{{config('constants.DATE_RANGE_LAST_3_MTH')}}">Last 3 Month</option>
                                        <option value="{{config('constants.DATE_RANGE_LAST_6_MTH')}}">Last 6 Months</option>
                                        <option value="{{config('constants.DATE_RANGE_CUSTOM')}}">Custom</option>
                                    </select>
                                    <div class="input-group date date-picker margin-bottom-5 display-none" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_date_from" placeholder="From">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="input-group date date-picker display-none" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_date_to" placeholder="To">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>

                                {{-- Total Billable Hours --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_bill_hours">
                                </td>

                                {{-- Status --}}
                                <td>
                                    <select name="filt_status" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="{{ config('constants.TIMESHEET_STATUS_REQESTED') }}">Request</option>
                                        <option value="{{ config('constants.TIMESHEET_STATUS_APPROVED') }}">Approved</option>
                                        <option value="{{ config('constants.TIMESHEET_STATUS_REJECTED') }}">Rejected</option>
                                    </select>
                                </td>

                                {{-- Submitted On --}}
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_submitted_on_from" placeholder="From">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_submitted_on_to" placeholder="To">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>

                                {{-- Attachment --}}
                                <td>
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
    </div>
</div>
