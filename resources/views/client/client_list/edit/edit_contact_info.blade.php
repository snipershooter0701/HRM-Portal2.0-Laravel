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
                    <span class="caption-helper mr-10 btn-move-panel active-tab" data-panelname="panel_edit_contactinfo">Contact Info</span>
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel_edit_confidential">Add Confidential</span>
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel_edit_placement">Placements</span>
                    <span class="caption-helper btn-move-panel" data-panelname="panel_edit_documents">Documents</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-container">
                    <div class="actions">
                        <button type="button" class="btn btn-sm btn-c-primary" data-target="#modal_add_contact" data-toggle="modal"><i class="fa fa-plus-circle"></i> Add Contact </button>
                        <button id="btn_show_edit_contactinfo_modal" type="button" class="display-none" data-target="#modal_edit_contact" data-toggle="modal"></button>
                    </div>
                    <div class="table-actions-wrapper">
                        <span> </span>
                        <select class="table-group-action-input form-control input-inline input-small input-sm">
                            <option value="">Select...</option>
                            <option value="Cancel">Delete</option>
                        </select>
                        <button class="btn btn-sm table-group-action-submit btn-c-primary">
                            <i class="fa fa-check"></i> Submit</button>
                    </div>
                    <table id="tbl_contact_infos" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="3%">
                                    <input type="checkbox" class="group-checkable"> </th>
                                <th width="5%"> No </th>
                                <th width="15%"> First Name </th>
                                <th width="15%"> Last Name </th>
                                <th width="15%"> Email </th>
                                <th width="10%"> Phone </th>
                                <th width="20%"> Checkbox </th>
                                <th width="17%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td><input type="text" id="filt_tbl_contact_info_client_id" class="form-control form-filter input-sm display-none" name="filt_client_id"></td>

                                {{-- First name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm tbl-contact-infos-filter" name="filt_firstname">
                                </td>

                                {{-- Last Name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm tbl-contact-infos-filter" name="filt_lastname">
                                </td>

                                {{-- Email --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm tbl-contact-infos-filter" name="filt_email">
                                </td>

                                {{-- Phone --}}
                                <td>
                                    <input type=" text" class="form-control form-filter input-sm tbl-contact-infos-filter" name="filt_phone">
                                </td>

                                {{-- Checkbox --}}
                                <td></td>

                                {{-- Action --}}
                                <td>
                                    <button id="btn_tbl_contact_info_search" class="btn btn-xs btn-c-primary filter-submit"><i class="fa fa-search"></i></button>
                                    <button id="btn_tbl_contact_info_reset" class="btn btn-xs btn-c-grey filter-custom-cancel" data-classname="tbl-contact-infos-filter" data-search="btn_tbl_contact_info_search"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>

                </div>

                <!-- BEGIN FORM-->
                <div class="form-body">
                    {{-- CC List --}}
                    <h4 class="section-head color-primary">Notifiers</h4>
                    <hr>
                    {{-- <div class="row"> --}}

                    <div class="form-group has-notifier">
                        <div class="input-group">
                            <span style="font-size:16px;">To: </span>
                            <input id="notifier_to" type="text">
                        </div>
                    </div>
                    <div class="form-group has-notifier">
                        <div class="input-group">
                            <span style="font-size:16px;">CC: </span>
                            <input id="notifier_cc" type="text">
                        </div>
                    </div>
                    <div class="form-group has-notifier">
                        <textarea class="form-control" row="10"></textarea>
                    </div>
                </div>
                <div class="form-actions text-right">
                    <button id="btn_edit_contract_send" type="submit" class="btn btn-sm btn-c-primary">Send</button>
                    <button id="btn_edit_contract_cancel" type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel_client">Cancel</button>
                </div>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>

{{-- BEGIN CREATE CONTACT INFO MODAL --}}
<div id="modal_add_contact" class="modal fade" tabindex="-1" data-width="540">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add Contact</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="control-label">First Name<span class="required" aria-required="true">*</span></label>
                    <input id="add_contact_firstname" type="text" class="form-control">
                </div>
                <div class="form-group col-sm-6">
                    <label class="control-label">Last Name<span class="required" aria-required="true">*</span></label>
                    <input id="add_contact_lastname" type="text" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="control-label">Email<span class="required" aria-required="true">*</span></label>
                    <input id="add_contact_email" type="text" class="form-control">
                </div>
                <div class="form-group col-sm-6">
                    <label class="control-label">Phone<span class="required" aria-required="true">*</span></label>
                    <input id="add_contact_phone" type="text" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_modal_add_contact_create" type="button" class="btn btn-sm btn-c-primary">Create</button>
        <button id="btn_modal_add_contact_close" type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
<div id="modal_edit_contact" class="modal fade" tabindex="-1" data-width="540">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Contact</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="row">
                <input id="edit_contact_id" type="hidden" class="form-control">
                <div class="form-group col-sm-6">
                    <label class="control-label">First Name<span class="required" aria-required="true">*</span></label>
                    <input id="edit_contact_firstname" type="text" class="form-control">
                </div>
                <div class="form-group col-sm-6">
                    <label class="control-label">Last Name<span class="required" aria-required="true">*</span></label>
                    <input id="edit_contact_lastname" type="text" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="control-label">Email<span class="required" aria-required="true">*</span></label>
                    <input id="edit_contact_email" type="text" class="form-control">
                </div>
                <div class="form-group col-sm-6">
                    <label class="control-label">Phone<span class="required" aria-required="true">*</span></label>
                    <input id="edit_contact_phone" type="text" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_modal_edit_contact_update" type="button" class="btn btn-sm btn-c-primary">Update</button>
        <button id="btn_modal_edit_contact_close" type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
{{-- END CREATE CONTACT INFO MODAL --}}
