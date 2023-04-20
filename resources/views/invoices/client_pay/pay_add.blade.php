<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="bread-active">Create Client Payment</a>
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
                <div class="form-body">
                    {{-- BEGIN BASE FORM --}}
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">Client <span class="required" aria-required="true">*</span></label>
                            <select id="add_client" class="form-control">
                                <option value="">Select...</option>
                                @php
                                foreach($clients as $client)
                                echo '<option value="' . $client->id . '">' . $client->email . '</option>';
                                @endphp
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Payment Received Date <span class="required" aria-required="true">*</span></label>
                            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                <input id="add_pay_date" type="text" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Amount Received <span class="required" aria-required="true">*</span></label>
                            <input id="add_amount_received" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Payment Method <span class="required" aria-required="true">*</span></label>
                            <select id="add_pay_method" class="form-control">
                                <option value="">Select...</option>
                                <option value="1">Pay Method 1</option>
                                <option value="2">Pay Method 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">Bank <span class="required" aria-required="true">*</span></label>
                            <select id="add_bank" class="form-control">
                                <option value="">Select...</option>
                                <option value="1">Bank 1</option>
                                <option value="2">Bank 2</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Reference No <span class="required" aria-required="true">*</span></label>
                            <input id="add_ref_no" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Comments</label>
                            <input id="add_comment" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Attachment <span class="required" aria-required="true">*</span></label>
                            <input id="add_attachment" type="file" class="form-control">
                        </div>
                    </div>
                    {{--END BASE FORM --}}
                </div>
                <div class="form-actions text-right">
                    <button id="btn_add_pay_ok" type="submit" class="btn btn-sm btn-c-primary">Save</button>
                    <button id="btn_add_pay_cancel" type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel_client_pay_list">Cancel</button>
                </div>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
