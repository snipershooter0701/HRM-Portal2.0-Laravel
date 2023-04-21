<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="bread-active">Add Placement</a>
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
                    {{-- BEGIN PLACEMENT BASE INFORMATION --}}
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">Client Name <span class="required" aria-required="true">*</span></label>
                            <select id="add_placement_client" class="form-control">
                                <option value="">Select...</option>
                                @php
                                foreach($clients as $client) {
                                echo "<option value='" . $client->id . "'>" . $client->business_name . "</option>";
                                }
                                @endphp
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Employee Name <span class="required" aria-required="true">*</span></label>
                            <select id="add_placement_employee" class="form-control">
                                <option value="">Select...</option>
                                @php
                                foreach($employees as $employee) {
                                echo "<option value='" . $employee->id . "'>" . $employee->first_name . ' ' .$employee->last_name . "</option>";
                                }
                                @endphp
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Placement ID <span class="required" aria-required="true">*</span></label>
                            <input id="add_placement_id" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Category</label>
                            <select id="add_placement_category" class="form-control" readonly>
                                <option value="">Select...</option>
                                <option value="{{ config('constants.EMP_CATEGORY_W2') }}">W2</option>
                                <option value="{{ config('constants.EMP_CATEGORY_C2C') }}">C2C</option>
                                <option value="{{ config('constants.EMP_CATEGORY_1099') }}">1099</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" form-group col-sm-3">
                            <label class="control-label">Job Tire <span class="required" aria-required="true">*</span></label>
                            <select id="add_placement_jobtire" class="form-control">
                                <option value="">Select...</option>
                                @php
                                foreach($jobTires as $jobTire) {
                                echo "<option value='" . $jobTire->id . "'>" . $jobTire->name . "</option>";
                                }
                                @endphp
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Client Net Terms(Days) <span class="required" aria-required="true">*</span></label>
                            <input id="add_placement_netterms" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Client PO Attachment <span class="required" aria-required="true">*</span></label>
                            <input id="add_placement_po_attachment" type="file" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Client PO ID <span class="required" aria-required="true">*</span></label>
                            <input id="add_placement_po_id" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">Job Title <span class="required" aria-required="true">*</span></label>
                            <input id="add_placement_jobtitle" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Job Status</label>
                            <select id="add_placement_jobstatus" class="form-control" readonly>
                                <option value="">Select...</option>
                                <option value="{{ config('constants.STATE_ACTIVE') }}">Active</option>
                                <option value="{{ config('constants.STATE_INACTIVE') }}">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Job Start Date <span class="required" aria-required="true">*</span></label>
                            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                <input id="add_placement_startdate" type="text" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Job Estimated End Date <span class="required" aria-required="true">*</span></label>
                            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                <input id="add_placement_enddate" type="text" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">Invoice Frequency <span class="required" aria-required="true">*</span></label>
                            <select id="add_placement_inv_frequency" class="form-control">
                                <option value="">Select...</option>
                                <option value="{{ config('constants.INVOICE_FREQUENCY_WEEKLY') }}">Weekly</option>
                                <option value="{{ config('constants.INVOICE_FREQUENCY_BYWEEKLY') }}">By-Weekly</option>
                                <option value="{{ config('constants.INVOICE_FREQUENCY_MONTHLY') }}">Monthly</option>
                                <option value="{{ config('constants.INVOICE_FREQUENCY_QUARTERLY') }}">Quarterly</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Payments Effective Date <span class="required" aria-required="true">*</span></label>
                            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                <input id="add_placement_pay_effect_date" type="text" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    {{-- END PLACEMENT BASE INFORMATION --}}

                    {{-- BEGIN CLIENT BILL RATE --}}
                    <h4 class="section-head">Client Bill Rate</h4>
                    <hr>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">Bill Rate/hr <span class="required" aria-required="true">*</span></label>
                            <input id="add_placement_billrate" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">OT Bill Rate/hr</label>
                            <input id="add_placement_ot_billrate" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">DT Bill Rate/hr</label>
                            <input id="add_placement_dt_billrate" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">Select Vendor/Contractor</label>
                            <select id="add_placement_vendor" class="form-control" disabled>
                                <option value="">Select...</option>
                                <option value="1">vendor1</option>
                                <option value="2">vendor2</option>
                                <option value="3">vendor3</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Vendor / Contractor net Terms <span class="required" aria-required="true">*</span></label>
                            <input id="add_placement_vendor_netterms" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Vendor / Contractor PO Attachment <span class="required" aria-required="true">*</span></label>
                            <input id="add_placement_vendor_po_attachment" type="file" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Vendor / Contractor PO ID <span class="required" aria-required="true">*</span></label>
                            <input id="add_placement_vendor_po_id" type="text" class="form-control" disabled>
                        </div>
                    </div>
                    {{-- END CLIENT BILL RATE --}}

                    {{-- BEGIN VENDOR/CONTRACTOR BILL RATE --}}
                    <h4 class="section-head">Vendor / Contractor Bill Rate</h4>
                    <hr>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">Bill Rate/hr <span class="required" aria-required="true">*</span></label>
                            <input id="add_placement_vendor_billrate" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">OT Bill Rate/hr</label>
                            <input id="add_placement_vendor_ot_billrate" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">DT Bill Rate/hr</label>
                            <input id="add_placement_vendor_dt_billrate" type="text" class="form-control" disabled>
                        </div>
                    </div>
                    {{-- END VENDOR/CONTRACTOR BILL RATE --}}

                    {{-- BEGIN DOCUMENTS --}}
                    <div class="row">
                        <div class="col-md-6 ">
                            <h4 class="section-head">Documents</h4>
                        </div>
                        <div class="col-md-6 section-action mt-10">
                            <a href="javascript:;" class="btn-c-no-border-primary pull-right"><i class="fa fa-plus-circle icon-16"></i></a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <div>
                                <label class="control-label">Document Type <span class="required" aria-required="true">*</span></label>
                                <a href="javascript:;" class="btn-c-no-border-primary pull-right line-height-none"><i class="fa fa-plus-circle icon-16"></i></a>
                            </div>
                            <select id="add_placement_doc_doctype" class="form-control">
                                <option value="">Select...</option>
                                @php
                                foreach($docTypes as $docType) {
                                echo "<option value='" . $docType->id . "'>" . $docType->name . "</option>";
                                }
                                @endphp
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Comments</label>
                            <input id="add_placement_doc_comments" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Title <span class="required" aria-required="true">*</span></label>
                            <input id="add_placement_doc_title" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Expire Date <span class="required" aria-required="true">*</span></label>
                            <div id="add_placement_doc_expiredate" class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                <input type="text" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                            <div class="icheck-list mt-10">
                                <label>
                                    <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Same as placement Expire date </label>
                                <label>
                                    <input type="checkbox" checked class="icheck" data-checkbox="icheckbox_square-blue"> No Expiration date </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">Attachment <span class="required" aria-required="true">*</span></label>
                            <input id="add_placement_doc_file" type="file" class="form-control">
                        </div>
                    </div>
                    {{-- END DOCUMENTS --}}
                </div>

                {{-- BEGIN ACTION --}}
                <div class="form-actions text-right">
                    <button type="button" class="btn btn-sm btn-c-primary pull-left">End Placement</button>
                    <button id="btn_add_placement_create" type="submit" class="btn btn-sm btn-c-primary">Save</button>
                    <button id="btn_add_placement_cancel" type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel_edit_placement">Cancel</button>
                </div>
                <!-- END ACTION -->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
