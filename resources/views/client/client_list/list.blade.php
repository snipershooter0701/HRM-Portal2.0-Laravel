<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="bread-active">Client List</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" data-panelname="panel_create_businfo"><i class="fa fa-plus-circle"></i> Add Client </button>
            <button id="btn_edit_client_page" class="btn-move-panel display-none" data-panelname="panel_edit_businfo"><i class="fa fa-plus-circle"></i> Edit Client </button>
            {{-- <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" data-panelname="panel_create_placement"><i class="fa fa-plus-circle"></i> Add Placement </button> --}}
            {{-- <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" data-panelname="panel_create_document"><i class="fa fa-plus-circle"></i> Add Document </button> --}}
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
                        <div id="tbl_client_list_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
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

                    <table id="tbl_client_list" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable">
                                </th>
                                <th width="5%"> No </th>
                                <th width="20%"> Business Name </th>
                                <th width="15%"> Email </th>
                                <th width="15%"> Contact Number </th>
                                <th width="10%"> Status</th>
                                <th width="8%"> Active Placements </th>
                                <th width="10%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td> </td>

                                {{-- Business name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_business_name">
                                </td>

                                {{-- Email --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_email">
                                </td>

                                {{-- Contact Number --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_contact_number">
                                </td>

                                {{-- Status --}}
                                <td>
                                    <select name="filt_status" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="{{ config('status.STATE_ACTIVE') }}">Active</option>
                                        <option value="{{ config('status.STATE_INACTIVE') }}">Inactive</option>
                                    </select>
                                </td>

                                {{-- Active Placements --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm margin-bottom-5" name="filt_placements_from" placeholder="From">
                                    <input type="text" class="form-control form-filter input-sm" name="filt_placements_to" placeholder="To">
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

                {{-- BEGIN ACTIVITIES TABLE --}}
                <div class="panel-group accordion mt-30" id="accordion_client_acts">
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion_client_acts" href="#collapse_client_activities" aria-expanded="false"> Activities </a>
                            </h4>
                        </div>
                        <div id="collapse_client_activities" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                                <div class="table-container">
                                    <table id="tbl_client_list_activities" class="table table-striped table-bordered table-hover table-checkable">
                                        <thead>
                                            <tr role="row" class="heading">
                                                <th width="10%"> No </th>
                                                <th width="20%"> Date & Time </th>
                                                <th width="30%"> Updated By </th>
                                                <th width="40%"> Description </th>
                                            </tr>
                                            <tr role="row" class="filter">
                                                <td>
                                                    <button class="btn btn-xs btn-c-primary filter-submit"><i class="fa fa-search"></i></button>
                                                    <button class="btn btn-xs btn-c-grey filter-cancel"><i class="fa fa-times"></i></button>
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
