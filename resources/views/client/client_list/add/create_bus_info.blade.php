<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="bread-active">Add Client</a>
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
                    <span class="caption-helper mr-10 active-tab btn-move-panel" data-panelname="panel-business-info">Business Info</span>
                    {{-- <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel-contact-info">Contact Info</span> --}}
                    {{-- <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel-add-confidential">Add Confidential</span> --}}
                    {{-- <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel-placement">Placements</span> --}}
                    {{-- <span class="caption-helper btn-move-panel" data-panelname="panel-document">Documents</span> --}}
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <div class="form-body">
                    {{-- business info --}}
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label class="control-label">Business Name <span class="required" aria-required="true">*</span></label>
                            <input id="create_bus_name" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">Contact Number <span class="required" aria-required="true">*</span></label>
                            <input id="create_bus_contact_num" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">Client ID</label>
                            <input id="create_bus_client_id" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">Federal ID <span class="required" aria-required="true">*</span></label>
                            <input id="create_bus_federal_id" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">Email <span class="required" aria-required="true">*</span></label>
                            <input id="create_bus_email" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">Website</label>
                            <input id="create_bus_website" type="text" class="form-control">
                        </div>
                    </div>
                    {{-- business info --}}

                    {{-- Invoice Location --}}
                    <h4 class="section-head">Invoice Location</h4>
                    <hr>
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label class="control-label">Suite/Apt No <span class="required" aria-required="true">*</span></label>
                            <input id="create_bus_inv_apt" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">Street <span class="required" aria-required="true">*</span></label>
                            <input id="create_bus_inv_street" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">City/Town <span class="required" aria-required="true">*</span></label>
                            <input id="create_bus_inv_city" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">State <span class="required" aria-required="true">*</span></label>
                            <select id="create_bus_inv_state" class="form-control">
                                @php
                                foreach($states as $state)
                                echo '<option value="' . $state['id'] . '">' . $state['state_name'] . '</option>';
                                @endphp
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">Country <span class="required" aria-required="true">*</span></label>
                            <select id="create_bus_inv_country" class="form-control">
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
                            <input id="create_bus_inv_zipcode" type="text" class="form-control">
                        </div>
                    </div>
                    {{-- Invoice Location --}}

                    {{-- Client Address --}}
                    <div class="row">
                        <div class="col-md-6 ">
                            <h4 class="section-head">Client Address</h4>
                        </div>
                        <div class="col-md-6 section-action mt-25 text-right">
                            <label>
                                <input id="create_bus_cli_sameas" type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" checked> Same as invoice address
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label class="control-label">Suite/Apt No <span class="required" aria-required="true">*</span></label>
                            <input id="create_bus_cli_apt" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">Street <span class="required" aria-required="true">*</span></label>
                            <input id="create_bus_cli_street" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">City/Town <span class="required" aria-required="true">*</span></label>
                            <input id="create_bus_cli_city" type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">State <span class="required" aria-required="true">*</span></label>
                            <select id="create_bus_cli_state" class="form-control">
                                @php
                                foreach($states as $state)
                                echo '<option value="' . $state['id'] . '">' . $state['state_name'] . '</option>';
                                @endphp
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="control-label">Country <span class="required" aria-required="true">*</span></label>
                            <select id="create_bus_cli_country" class="form-control">
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
                            <input id="create_bus_cli_zipcode" type="text" class="form-control">
                        </div>
                    </div>
                    {{-- Client Address --}}

                </div>
                <div class="form-actions text-right">
                    <button id="btn_create_businfo" type="submit" class="btn btn-sm btn-c-primary">Create</button>
                    <button id="btn_cancel_businfo" type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel_client">Cancel</button>
                </div>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
