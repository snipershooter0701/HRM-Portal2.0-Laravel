<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active" data-panelname="panel-due-timesheet-list">Due Timesheets</a>
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
                            <button id="btn_to_submit_page" type="button" class="btn btn-sm btn-c-primary btn-move-panel display-none" data-panelname="panel_due_timesheet_submit"> </button>
                        </div>
                        <div class="col-md-4 actions">
                            <div id="tbl_due_timesheet_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
                                <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-copy"></i></a>
                                <a class="btn-tbl-action btn-move-panel" data-panelname="panel-import-employee"><i class="fa fa-upload"></i></a>
                                <a class="btn-tbl-action btn-move-panel" data-panelname="panel-export-employee"><i class="fa fa-download"></i></a>
                                <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-print"></i></a>
                            </div>
                        </div>
                    </div>
                    <table id="tbl_due_timesheet" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="5%"> No </th>
                                <th width="15%"> Employee Name </th>
                                <th width="15%"> Month-Week </th>
                                <th width="15%"> Placement ID </th>
                                <th width="20%"> Job Tire </th>
                                <th width="15%"> Client Name </th>
                                <th width="15%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">

                                {{-- No --}}
                                <td> </td>

                                {{-- Employee--}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_employee">
                                </td>

                                {{-- Month/week--}}
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_monthweek_from" placeholder="From">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_monthweek_to" placeholder="To">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>

                                {{-- Placement ID --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_placement_id">
                                </td>

                                {{-- Job Tire --}}
                                <td>
                                    <select name="filt_jobtire" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        @foreach($jobTires as $jobTire)
                                        <option value="{{ $jobTire->id }}">{{ $jobTire->name }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                {{-- Client Name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_client">
                                </td>

                                {{-- Action --}}
                                <td>
                                    <button class="btn btn-xs btn-c-primary filter-submit"><i class="fa fa-search"></i></button>
                                    <button class="btn btn-xs btn-c-grey filter-cancel"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
