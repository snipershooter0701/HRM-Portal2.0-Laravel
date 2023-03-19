<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ url('/') }}">Add Document</a>
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
                        {{-- add Document info --}}
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-3">
                                <label class="control-label">Employee Name</label>
                                <select class="form-control">
                                    <option>Makarov</option>
                                    <option>Makarov</option>
                                    <option>Makarov</option>
                                </select>
                                <div class="icheck-inline mt-10">
                                    <label>
                                        <input type="checkbox" class="icheck"> General Document </label>
                                </div>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-3">
                                <label class="control-label">Client Name</label>
                                <select class="form-control">
                                    <option>snipershooter</option>
                                    <option>snipershooter</option>
                                    <option>snipershooter</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-3">
                                <label class="control-label">Job Tire</label>
                                <select class="form-control">
                                    <option>snipershooter</option>
                                    <option>snipershooter</option>
                                    <option>snipershooter</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-3">
                                <label class="control-label">Placement ID</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-3">
                                <label class="control-label">Document Type</label>
                                <select class="form-control">
                                    <option>W2</option>
                                    <option>C2C</option>
                                    <option>1099</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-3">
                                <label class="control-label">Conmments</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-3">
                                <label class="control-label">Title</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-3">
                                <label class="control-label">Expiration Date</label>
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
                        {{-- add placement info --}}
                    </div>

                    {{-- Vendor/Contractor Bill Rate --}}
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
