<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="bread-active">Create ticket</a>
        </li>
    </ul>
    <div class="page-toolbar">
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
                        {{-- BEGIN BASE FORM --}}
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Employee Name <span class="required" aria-required="true">*</span></label>
                                <select class="form-control" id="create_emp_id">
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Department<span class="required" aria-required="true">*</span></label>
                                <select class="form-control" id="create_department_id">
                                    
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Subject</label>
                                <input type="text" class="form-control" id="create_subject">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Attachment</label>
                                <input type="file" class="form-control" id="create_file">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Explain Briefly</label>
                                <textarea class="form-control" rows="8" id="create_detail"></textarea>
                            </div>
                        </div>
                        {{--END BASE FORM --}}
                        <div class="form-actions text-right" id="add_ticket_action">
                            <button type="submit" class="btn btn-sm btn-c-primary" id="create_ticket">Create</button>
                            <button type="button" class="btn btn-sm btn-c-grey page-move-btn" data-panelname="panel-ticket-list">Cancel</button>
                        </div>
                        <div class="form-actions text-right hide" id="update_ticket_action">
                            <button type="submit" class="btn btn-sm btn-c-primary" id="update_ticket">Update</button>
                            <button type="button" class="btn btn-sm btn-c-grey page-move-btn" data-panelname="panel-ticket-list">Cancel</button>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
