<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ url('/') }}" class="bread-active">Add Client</a>
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
                <div class="caption">
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel-business-info">Business Info</span>
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel-contact-info">Contact Info</span>
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel-add-confidential">Add Confidential</span>
                    <span class="caption-helper active-tab mr-10 btn-move-panel" data-panelname="panel-placement">Placements</span>
                    <span class="caption-helper btn-move-panel" data-panelname="panel-document">Documents</span>
                </div>
            </div>
            <div class="portlet-body">
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
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable"> </th>
                                <th width="5%"> No </th>
                                <th width="20%"> Employee Name </th>
                                <th width="15%"> Job Tire </th>
                                <th width="15%"> Job Status </th>
                                <th width="10%"> Start Date </th>
                                <th width="10%"> End Date</th>
                                <th width="8%"> PO Attachment </th>
                                <th width="10%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td> </td>

                                {{-- Employee name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_employee_name"> </td>

                                {{-- Job Tire --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_job_tire"> </td>

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

                                {{-- End Date --}}
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

                                {{-- PO Attachment --}}
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

                    {{-- activities table --}}
                    <h4 class="section-head">Activities</h4>
                    <hr>

                    <table id="tbl_placement_activities" class="table table-striped table-bordered table-hover">
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

                    {{-- invoice table --}}
                    <h4 class="section-head">Invoices</h4>
                    <hr>
                    <div class="actions">
                        <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" data-panelname="panel-create-client"><i class="fa fa-plus-circle"></i> Add Invoice </button>
                        <div id="tbl_invoice_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
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
                    <table id="tbl_invoice" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable"> </th>
                                <th width="5%"> No </th>
                                <th width="20%"> Employee Name </th>
                                <th width="15%"> Invoice Date </th>
                                <th width="15%"> Invoice Due Date </th>
                                <th width="15%"> Status </th>
                                <th width="15%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td></td>
                                <td></td>
                                {{-- Employee Name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_employee_name"> </td>

                                {{-- Invoice Date --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_invoice_date"> </td>

                                {{-- Invoice Due Date --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_invoice_due_date"> </td>

                                {{-- Status --}}
                                <td>
                                    <select name="filt_job_status" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="pending">Active</option>
                                        <option value="closed">Inactive</option>
                                    </select>
                                </td>

                                {{-- Action --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_action">
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
