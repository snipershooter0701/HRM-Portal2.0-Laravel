<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="btn-move-panel" data-panelname="panel-all-timesheet-list">All Timesheets</a>
        </li>
        <li>
            <a href="javascript:;" class="btn-move-panel" data-panelname="panel-due-timesheet-list">Due Timesheets</a>
        </li>
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active" data-panelname="panel-awaiting-invoices-list">Awaiting invoices</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" data-panelname="panel-submit-timesheet"> Submit Timesheet </button>
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
                        </div>
                        <div class="col-md-4 actions">
                            <div id="time_await_invoices_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
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
                            <option value="Cancel">Cancel</option>
                            <option value="Cancel">Hold</option>
                            <option value="Cancel">On Hold</option>
                            <option value="Close">Close</option>
                        </select>
                        <button class="btn btn-sm table-group-action-submit btn-c-primary">
                            <i class="fa fa-check"></i> Submit</button>
                    </div>
                    <table id="time_await_invoices" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable"> </th>
                                <th width="5%"> No </th>
                                <th width="15%"> Employee </th>
                                <th width="15%"> Client </th>
                                <th width="10%"> Invoice Frequency </th>
                                <th width="10%"> Invoice Period </th>
                                <th width="10%"> Total Hours </th>
                                <th width="15%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td> </td>

                                {{-- Employee --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_first_name"> </td>

                                {{-- Client --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_last_name"> </td>

                                {{-- Invoice Frequency --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_phone"> </td>

                                {{-- Invoice Period --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_category">
                                </td>

                                {{-- Total Hours --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_poc">
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
    </div>
</div>
