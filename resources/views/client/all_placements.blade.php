<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ url('/') }}">All Placements</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
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
                        <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" data-panelname="panel-create-placement"><i class="fa fa-plus-circle"></i> Add Placement </button>
                        <div id="tbl_placements_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-copy"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-upload"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-download"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-print"></i></a>
                        </div>
                    </div>
                    <div class="table-actions-wrapper">
                        <span> </span>
                        <select class="table-group-action-input form-control input-inline input-small input-sm">
                            <option value="">Select...</option>
                            <option value="Cancel">Delete</option>
                        </select>
                        <button class="btn btn-sm table-group-action-submit btn-c-primary">
                            <i class="fa fa-check"></i> Submit</button>
                    </div>

                    {{-- placement list table --}}
                    <table id="tbl_all_placement" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable"> </th>
                                <th width="5%"> No </th>
                                <th width="15%"> Employee Name </th>
                                <th width="15%"> Client </th>
                                <th width="10%"> Job Tire </th>
                                <th width="10%"> Project Type </th>
                                <th width="10%"> Status </th>
                                <th width="10%"> Start Date </th>
                                <th width="10%"> End Date</th>
                                <th width="13%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td> </td>

                                {{-- Employee name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_employee_name"> </td>

                                {{-- Client --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_client"> </td>

                                {{-- Job Tire --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_job_tire"> </td>

                                {{-- Project Type --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_project_type"> </td>

                                {{-- Job Status --}}
                                <td>
                                    <select name="filt_job_status" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="pending">active</option>
                                        <option value="closed">inactive</option>
                                    </select>
                                </td>

                                {{-- Start Date --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_start_date"> </td>

                                {{-- End Date --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_end_date"> </td>

                                {{-- Action --}}
                                <td>
                                    <button class="btn btn-xs btn-c-primary filter-submit"><i class="fa fa-search"></i></button>
                                    <button class="btn btn-xs btn-c-grey filter-cancel"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>

                    {{-- activities table --}}
                    <h4 class="section-head">Activities</h4>
                    <hr>
                    
                    <table id="tbl_activity" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="20%"> Date & Time </th>
                                <th width="15%"> Updated By </th>
                                <th width="15%"> Description </th>
                            </tr>
                            <tr role="row" class="filter">
                               
                                {{-- time_date --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_time_date"> </td>

                                {{-- updated by --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_updated_by"> </td>

                                {{-- description --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_description"> </td>

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
