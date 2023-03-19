<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ url('/') }}">Add Placement</a>
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
                <!-- BEGIN FORM-->
                <form action="#">
                    <div class="form-body">
                        {{-- add placement info --}}
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Client Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Employee Number</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Placement ID</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Project Type</label>
                                <select class="form-control">
                                    <option>W2</option>
                                    <option>C2C</option>
                                    <option>1099</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Job Tire</label>
                                <select class="form-control">
                                    <option>Regular</option>
                                    <option>2nd</option>
                                    <option>3rd</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Client Net Terms(Days)</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Client PO Attachment</label>
                                <input type="file" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Client PO ID</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        {{-- add placement info --}}

                        {{-- Client Bill Rate --}}
                        <h4 class="section-head">Client Bill Rate</h4>
                        <hr>
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Bill Rate/hr</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">OT Bill Rate/hr</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">DT Bill Rate/hr</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        {{-- select vendor --}}
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Select Vendor/Contractor</label>
                                <select class="form-control">
                                    <option>vendor1</option>
                                    <option>vendor2</option>
                                    <option>vendor3</option>
                                </select>
                            </div>
                        </div>
                        {{-- select vendor --}}

                        {{-- Vendor info --}}
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Vendor / Contractor net Terms</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Vendor / Contractor PO Attachment</label>
                                <input type="file" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Vendor / Contractor PO ID</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        {{-- Vendor info --}}

                        {{-- Vendor/Contractor Bill Rate --}}
                        <h4 class="section-head">Vendor / Contractor Bill Rate</h4>
                        <hr>
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Bill Rate/hr</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">OT Bill Rate/hr</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">DT Bill Rate/hr</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        {{-- Vendor/Contractor Bill Rate --}}

                        {{-- add placements info --}}
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Job Title</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Job Status</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Job Start Date</label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                    <input type="text" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Job Estimated End Date</label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                    <input type="text" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Invoice Frequency</label>
                                <select class="form-control">
                                    <option>vendor1</option>
                                    <option>vendor2</option>
                                    <option>vendor3</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Payments Effective Date</label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                    <input type="text" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        {{--  add placements info --}}

                        {{-- Vendor/Contractor Bill Rate --}}
                        <h4 class="section-head">Documents</h4>
                        <hr>
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Document Type</label>
                                <select class="form-control">
                                    <option>doc1</option>
                                    <option>doc2</option>
                                    <option>doc3</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Comments</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Title</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Expire Date</label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                    <input type="text" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                                <div class="icheck-list mt-10">
                                    <label>
                                        <input type="checkbox" class="icheck"> Same as placement Expire date </label>
                                    <label>
                                        <input type="checkbox" checked class="icheck"> No Expiration date </label>
                                </div>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Attachment</label>
                                <input type="file" class="form-control">
                            </div>
                        </div>
                    </div>

                    {{-- Vendor/Contractor Bill Rate --}}
                    <div class="form-actions text-right">
                        <button type="submit" class="btn btn-sm btn-c-primary">Create</button>
                        <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-client-list">Cancel</button>
                    </div>
                </form>
                <!-- END FORM-->

                <div class="table-container">
                        {{-- activities table --}}
                    <h4 class="section-head">Activities</h4>
                    <hr>
                    <table id="tbl_addplacement_activity" class="table table-striped table-bordered table-hover">
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
