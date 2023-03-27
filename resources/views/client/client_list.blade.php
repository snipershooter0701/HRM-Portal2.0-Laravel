<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ url('/client') }}" class="bread-active">Client List</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" data-panelname="panel-business-info"><i class="fa fa-plus-circle"></i> Add Client </button>
            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" data-panelname="panel-create-placement"><i class="fa fa-plus-circle"></i> Add Placement </button>
            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" data-panelname="panel-create-document"><i class="fa fa-plus-circle"></i> Add Document </button>
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
                        <div id="tbl_clients_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
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

                    <table id="tbl_clients" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable"> </th>
                                <th width="5%"> No </th>
                                <th width="20%"> Business Name </th>
                                <th width="15%"> Email </th>
                                <th width="15%"> Contact Number </th>
                                <th width="10%"> Net Terms </th>
                                <th width="10%"> Status</th>
                                <th width="8%"> Active Placements </th>
                                <th width="10%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td> </td>

                                {{-- Business name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_business_name"> </td>

                                {{-- Email --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_email"> </td>

                                {{-- Contact Number --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_contact_number"> </td>

                                {{-- net Terms --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_net_terms"> </td>

                                {{-- Status --}}
                                <td>
                                    <select name="filt_status" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="pending">Active</option>
                                        <option value="closed">Inactive</option>
                                    </select>
                                </td>

                                {{-- Active Placements --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_active_placements"> </td>

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
        <!-- End: life time stats -->
    </div>
</div>
