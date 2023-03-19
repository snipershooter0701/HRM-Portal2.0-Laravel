<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ url('/') }}">Client List</a>
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
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel-business-info">Business Info</span>
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel-contact-info">Contact Info</span>
                    <span class="caption-helper active-tab mr-10 btn-move-panel" data-panelname="panel-add-confidential">Add Confidential</span>
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel-placement">Placements</span>
                    <span class="caption-helper btn-move-panel" data-panelname="panel-document">Documents</span>
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form action="#">
                    <div class="form-body">
                        {{-- business info --}}
                        <div class="row">
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Bank Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Account Type</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Account Number</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Routing Number</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <h4 class="section-head">Address</h4>
                        <hr>
                        <div class="row">
                            
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Street</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Suite/Apt No</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">City/Town</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">State</label>
                                <select class="form-control">
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Zip Code</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-30">
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Cancelled Check</label>
                                <input type="file" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Other Attachment</label>
                                <input type="file" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Record Status</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        {{-- business info --}}

                    </div>
                    <div class="form-actions text-right">
                        <button type="submit" class="btn btn-sm btn-c-primary">Create</button>
                        <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-employee-list">Cancel</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
