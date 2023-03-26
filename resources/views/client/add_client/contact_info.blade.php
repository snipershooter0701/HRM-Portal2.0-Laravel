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
                    <span class="caption-helper mr-10 active-tab btn-move-panel" data-panelname="panel-contact-info">Contact Info</span>
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel-add-confidential">Add Confidential</span>
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
                            <div class="col-lg-12 text-right">
                                <button type="button" class="btn btn-sm btn-c-primary btn-move-panel pull-right" data-panelname="panel-add-contact-info"><i class="fa fa-plus-circle"></i> Add Contact </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-2 col-sm-2 col-xs-3">
                            </div>
                            <div class="form-group col-lg-4 col-sm-4 col-xs-6">
                                <label class="control-label">First Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-sm-4 col-xs-6">
                                <label class="control-label">Last Name</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-2 col-sm-3 col-xs-12">
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Email</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Phone</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-sm-3 col-xs-12">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-2 col-sm-3 col-xs-12">
                            </div>
                            <div class="form-group col-lg-8 col-md-3 col-sm-4 col-xs-6">
                                <div class="input-group">
                                    <div class="icheck-inline">
                                        <label>
                                            <input type="checkbox" class="icheck"> Add email to CC list </label>
                                        <label>
                                            <input type="checkbox" checked class="icheck"> Primary Contact </label>
                                        <label>
                                            <input type="checkbox" class="icheck"> Primary accounts email </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- business info --}}

                        {{-- CC List --}}
                        <h4 class="section-head color-primary">Notifiers</h4>
                        <hr>
                        {{-- <div class="row"> --}}

                        <div class="form-group has-notifier">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    To:
                                </span>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group has-notifier">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    CC:
                                </span>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group has-notifier">
                            <textarea class="form-control" row="15"></textarea>
                        </div>
                    </div>
                    <div class="form-actions text-right">
                        <button type="submit" class="btn btn-sm btn-c-primary">Save</button>
                        <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-client">Cancel</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
