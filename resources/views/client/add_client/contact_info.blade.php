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
                    <span class="caption-helper mr-10">Business Info</span>
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
                            <div class="form-group col-lg-6 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">First Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-6 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Last Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-6 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Email</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-6 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Phone</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="icheck-inline">
                                        <label>
                                            <input type="checkbox" class="icheck"> Checkbox 1 </label>
                                        <label>
                                            <input type="checkbox" checked class="icheck"> Checkbox 2 </label>
                                        <label>
                                            <input type="checkbox" class="icheck"> Checkbox 3 </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- business info --}}

                        {{-- CC List --}}
                        <h4 class="section-head">Notifiers</h4>
                        <hr>
                        <h4 class="section-head">To:</h4>
                        <hr>
                        <h4 class="section-head">CC:</h4>
                        <hr>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
