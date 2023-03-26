<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active" data-panelname="panel-employee-list">Add Document</a>
        </li>
    </ul>
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
                        {{-- BEGIN BASE FORM --}}
                        <div class="row">
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Title</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Comment</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Start Date</label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                    <input type="text" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Exp Date</label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                    <input type="text" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Modified By</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Modified On</label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                    <input type="text" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Attachment</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        {{--END BASE FORM --}}
                    </div>
                    <div class="form-actions text-right">
                        <button type="submit" class="btn btn-sm btn-c-primary">Register</button>
                        <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-org-doc-list">Cancel</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
