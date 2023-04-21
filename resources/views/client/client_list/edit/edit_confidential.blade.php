<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="bread-active">Edit Client</a>
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
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel_edit_businfo">Business Info</span>
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel_edit_contactinfo">Contact Info</span>
                    <span class="caption-helper mr-10 active-tab btn-move-panel" data-panelname="panel_edit_confidential">Add Confidential</span>
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel_edit_placement">Placements</span>
                    <span class="caption-helper btn-move-panel" data-panelname="panel_edit_documents">Documents</span>
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <div class="form-body">
                    <div class="row ">
                        <div class="col-lg-12 text-right">
                            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel pull-right" data-panelname="panel-add-contact-info"><i class="fa fa-plus-circle"></i> New Record </button>
                        </div>
                    </div>
                    {{-- BEGIN NEW RECORD FORM --}}
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label class="control-label">Bank Name <span class="required" aria-required="true">*</span></label>
                            <input id="add_conf_bankname" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">Account Type <span class="required" aria-required="true">*</span></label>
                            <input id="add_conf_accounttype" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">Account Number <span class="required" aria-required="true">*</span></label>
                            <input id="add_conf_accountnumber" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">Routing Number <span class="required" aria-required="true">*</span></label>
                            <input id="add_conf_routingnumber" type="text" class="form-control">
                        </div>
                    </div>
                    <h4 class="section-head">Address</h4>
                    <hr>
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label class="control-label">Suite/Apt No <span class="required" aria-required="true">*</span></label>
                            <input id="add_conf_aptno" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">Street <span class="required" aria-required="true">*</span></label>
                            <input id="add_conf_street" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">City/Town <span class="required" aria-required="true">*</span></label>
                            <input id="add_conf_city" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">State <span class="required" aria-required="true">*</span></label>
                            <select id="add_conf_state" class="form-control">
                                @php
                                foreach($states as $state)
                                echo '<option value="' . $state['id'] . '">' . $state['state_name'] . '</option>';
                                @endphp
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">Country <span class="required" aria-required="true">*</span></label>
                            <select id="add_conf_country" class="form-control">
                                @php
                                foreach($countries as $country)
                                if ($country['code'] == 'US')
                                echo '<option value="' . $country['id'] . '" selected>' . $country['name'] . '</option>';
                                else
                                echo '<option value="' . $country['id'] . '">' . $country['name'] . '</option>';
                                @endphp
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">Zip Code <span class="required" aria-required="true">*</span></label>
                            <input id="add_conf_zipcode" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label class="control-label">Cancelled Check</label>
                            <input id="add_conf_cancelledcheck" type="file" class="form-control">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">Record Status <span class="required" aria-required="true">*</span></label>
                            <select id="add_conf_status" class="form-control">
                                <option value="{{ config('constants.STATE_ACTIVE') }}">Active</option>
                                <option value="{{ config('constants.STATE_INACTIVE') }}">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">Other Attachment</label>
                            <input id="add_conf_otherattachment" type="file" class="form-control">
                        </div>
                    </div>
                    {{-- END NEW RECORD FORM --}}
                </div>
                <div class="form-actions text-right">
                    <button id="btn_create_confidential" class="btn btn-sm btn-c-primary">Create</button>
                    <button class="btn btn-sm btn-c-primary display-none">Update</button>
                    <button class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel_client">Cancel</button>
                </div>
                <!-- END FORM-->

                {{-- BEGIN OLD RECORD LIST --}}
                <div class="panel-group accordion mt-30" id="accordion_confidential_old_list">
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion_confidential_old_list" href="#collapse_confidential_old_list" aria-expanded="false"> Old Record List </a>
                            </h4>
                        </div>
                        <div id="collapse_confidential_old_list" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                                <div class="table-container">
                                    <table id="tbl_confidential_old_records" class="table table-striped table-bordered table-hover table-checkable">
                                        <thead>
                                            <tr role="row" class="heading">
                                                <th width="5%"> No </th>
                                                <th width="15%"> Bank Name </th>
                                                <th width="15%"> Account Type </th>
                                                <th width="15%"> Account Number </th>
                                                <th width="15%"> Routing Number </th>
                                                <th width="20%"> Updated On </th>
                                                <th width="15%"> Action </th>
                                            </tr>
                                            <tr role="row" class="filter">
                                                <td>
                                                    <input id="filt_tbl_confidential_client_id" type="hidden" class="form-control form-filter input-sm" name="filt_client_id">
                                                </td>

                                                {{-- Bank Name --}}
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="filt_bankname">
                                                </td>

                                                {{-- Account Type --}}
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="filt_account_type">
                                                </td>

                                                {{-- Account Number --}}
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="filt_account_number">
                                                </td>

                                                {{-- Routing Number --}}
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="filt_routing_number">
                                                </td>

                                                {{-- Updated On --}}
                                                <td>
                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_updated_from" placeholder="From">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_updated_to" placeholder="To">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </td>

                                                {{-- Action --}}
                                                <td>
                                                    <button id="btn_tbl_confidential_search" class="btn btn-xs btn-c-primary filter-submit"><i class="fa fa-search"></i></button>
                                                    <button id="btn_tbl_confidential_reset" class="btn btn-xs btn-c-grey filter-cancel"><i class="fa fa-times"></i></button>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody> </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END OLD RECORD LIST --}}
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
