<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="bread-active">All Placements</a>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
            </div>
            <div class="portlet-body">
                {{-- BEGIN PLACEMENT TABLE --}}
                <div class="table-container">
                    <div class="actions">
                        <button type="button" class="btn btn-sm btn-c-primary btn-move-panel" data-panelname="panel-create-placement"><i class="fa fa-plus-circle"></i> Add Placement </button>
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
                    <table id="tbl_placements" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="3%">
                                    <input type="checkbox" class="group-checkable"> </th>
                                <th width="5%"> No </th>
                                <th width="12%"> Employee Name </th>
                                <th width="12%"> Client </th>
                                <th width="10%"> Job Tire </th>
                                <th width="10%"> Net Terms </th>
                                <th width="11%"> Job Status </th>
                                <th width="11%"> Start Date </th>
                                <th width="11%"> End Date</th>
                                <th width="15%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td></td>

                                {{-- Employee Name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_employee">
                                </td>

                                {{-- Client Name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_client">
                                </td>

                                {{-- Job Tire --}}
                                <td>
                                    <select name="filt_job_tire" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        @php
                                            foreach($jobTires as $jobTire)
                                            echo '<option value="' . $jobTire->id . '">' . $jobTire->name . '</option>'
                                        @endphp
                                    </select>
                                </td>

                                {{-- Net Terms --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm margin-bottom-5" name="filt_netterms_from" placeholder="From">
                                    <input type="text" class="form-control form-filter input-sm" name="filt_netterms_to" placeholder="To">
                                </td>

                                {{-- Job Status --}}
                                <td>
                                    <select name="filt_job_status" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="{{ config('contants.STATE_ACTIVE') }}">Active</option>
                                        <option value="{{ config('contants.STATE_INACTIVE') }}">Inactive</option>
                                    </select>
                                </td>

                                {{-- Start Date --}}
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_start_date_from" placeholder="From">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_start_date_to" placeholder="To">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>

                                {{-- End Date --}}
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_end_date_from" placeholder="From">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_end_date_to" placeholder="To">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>

                                {{-- Action --}}
                                <td>
                                    <button id="btn_tbl_placement_search" class="btn btn-xs btn-c-primary filter-submit"><i class="fa fa-search"></i></button>
                                    <button id="btn_tbl_placement_reset" class="btn btn-xs btn-c-grey filter-cancel"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                </div>
                {{-- END PLACEMENT TABLE --}}

                {{-- BEGIN ACTIVITIES TABLE --}}
                <div class="panel-group accordion mt-30" id="accordion_placement_acts">
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion_placement_acts" href="#collapse_placement_acts" aria-expanded="false"> Activities </a>
                            </h4>
                        </div>
                        <div id="collapse_placement_acts" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                                <div class="table-container">
                                    <table id="tbl_placement_activities" class="table table-striped table-bordered table-hover table-checkable">
                                        <thead>
                                            <tr role="row" class="heading">
                                                <th width="10%"> No </th>
                                                <th width="20%"> Date & Time </th>
                                                <th width="30%"> Updated By </th>
                                                <th width="40%"> Description </th>
                                            </tr>
                                            <tr role="row" class="filter">
                                                <td>
                                                    <button id="btn_tbl_placement_act_search" class="btn btn-xs btn-c-primary filter-submit"><i class="fa fa-search"></i></button>
                                                    <button id="btn_tbl_placement_act_reset" class="btn btn-xs btn-c-grey filter-cancel"><i class="fa fa-times"></i></button>
                                                </td>
                                                <td>
                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_act_date_from" placeholder="From">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_act_date_to" placeholder="To">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="filt_act_updatedby">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="filt_act_description">
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
                {{-- END ACTIVITIES TABLE --}}
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
