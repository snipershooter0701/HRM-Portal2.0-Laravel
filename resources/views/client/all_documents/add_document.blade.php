<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="bread-active">Add Document</a>
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
                <div class="form-body">
                    {{-- add Document info --}}
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">Employee Name <span class="required" aria-required="true">*</span></label>
                            <select id="add_document_employee" class="form-control">
                                <option value="">Select...</option>
                                @php
                                foreach($employees as $employee)
                                echo '<option value="' . $employee->id . '">' . $employee->first_name . '</option>'
                                @endphp
                            </select>
                            <div class="icheck-inline mt-10">
                                <label><input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" style="height: 15px !important;"> General Document </label>
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Client Name <span class="required" aria-required="true">*</span></label>
                            <select id="add_document_client" class="form-control">
                                <option value="">Select...</option>
                                @php
                                foreach($clients as $client)
                                echo '<option value="' . $client->id . '">' . $client->business_name . '</option>'
                                @endphp
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Job Tire <span class="required" aria-required="true">*</span></label>
                            <select id="add_document_jobtire" class="form-control">
                                <option value="">Select...</option>
                                @php
                                foreach($jobTires as $jobTire)
                                echo '<option value="' . $jobTire->id . '">' . $jobTire->name . '</option>'
                                @endphp
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Placement ID <span class="required" aria-required="true">*</span></label>
                            <input id="add_document_placement_id" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label pull-left">Document Type <span class="required" aria-required="true">*</span></label>
                            <div class="pull-right">
                                <a href="javascript:;" class="btn-plus-primary"><i class="fa fa-plus-circle"></i></a>
                            </div>
                            <select id="add_document_doctype_id" class="form-control">
                                <option value="">Select...</option>
                                @php
                                foreach($docTypes as $docType)
                                echo '<option value="' . $docType->id . '">' . $docType->name . '</option>'
                                @endphp
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Title <span class="required" aria-required="true">*</span></label>
                            <input id="add_document_title" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Comment <span class="required" aria-required="true">*</span></label>
                            <input id="add_document_comment" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Expiration Date <span class="required" aria-required="true">*</span></label>
                            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                <input id="add_document_expiredate" type="text" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                            <div class="mt-10">
                                <label><input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" style="height: 15px !important;"> Same as placement Expire date </label>
                                <label><input type="checkbox" checked class="icheck" data-checkbox="icheckbox_square-blue" style="height: 15px !important;"> No Expiration date </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">Attachment <span class="required" aria-required="true">*</span></label>
                            <input id="add_document_attachment" type="file" class="form-control">
                        </div>
                    </div>
                    {{-- add placement info --}}
                </div>

                {{-- Vendor/Contractor Bill Rate --}}
                <div class="form-actions text-right">
                    <button id="btn_add_document_create" type="button" class="btn btn-sm btn-c-primary">Save</button>
                    <button id="btn_add_document_cancel" type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel_edit_documents">Cancel</button>
                </div>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
