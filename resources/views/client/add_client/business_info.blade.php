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
                    <span class="caption-helper mr-10 active-tab">Business Info</span>
                    <span class="caption-helper mr-10">Contact Info</span>
                    <span class="caption-helper mr-10">Add Confidential</span>
                    <span class="caption-helper mr-10">Placements</span>
                    <span class="caption-helper">Documents</span>
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form action="#">
                    <div class="form-body">
                        {{-- business info --}}
                        <div class="row">
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Business Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Contact Number</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Client ID</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Federal ID</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Email</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Website</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        {{-- business info --}}

                        {{-- Invoice Location --}}
                        <h4 class="section-head">Invoice Location</h4>
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
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Zip Code</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        {{-- Invoice Location --}}

                        {{-- Client Address --}}
                        <h4 class="section-head">Client Address</h4>
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
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Zip Code</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        {{-- Client Address --}}
                       
                    </div>
                    <div class="form-actions text-right">
                        <button type="submit" class="btn btn-sm btn-c-primary">Create</button>
                        <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-client-list">Cancel</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
