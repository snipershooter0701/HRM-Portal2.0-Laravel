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
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel-business-info">Business Info</span>
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel-contact-info">Contact Info</span>
                    <span class="caption-helper active-tab mr-10 btn-move-panel" data-panelname="panel-add-confidential">Add Confidential</span>
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel-placement">Placements</span>
                    <span class="caption-helper btn-move-panel" data-panelname="panel-document">Documents</span>
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form action="#">
                    <div class="form-body">
                        <div class="row ">
                            <div class="form-group col-lg-12 text-right">
                                <button type="button" class="btn btn-sm btn-c-primary btn-move-panel pull-right" data-panelname="panel-add-contact-info"><i class="fa fa-plus-circle"></i> New Record </button>
                            </div>
                        </div>
                        {{-- business info --}}
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Bank Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Account Type</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Account Number</label>
                                <input type="text" class="form-control" disabled>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Routing Number</label>
                                <input type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <h4 class="section-head">Address</h4>
                        <hr>
                        <div class="row">

                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Street</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Suite/Apt No</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">City/Town</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">State</label>
                                <select class="form-control">
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Country</label>
                                <select class="form-control">
                                    <option>United State</option>
                                    <option>Alaska</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Zip Code</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Cancelled Check</label>
                                <input type="file" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Record Status</label>
                                <select class="form-control">
                                    <option>active</option>
                                    <option>inactive</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Other Attachment</label>
                                <input type="file" class="form-control">
                            </div>
                        </div>
                        {{-- business info --}}

                        {{-- BEGIN ACTIVITIES FORM --}}
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="section-head">Old Records List</h4>
                            </div>
                            <div class="col-md-6 section-action">
                            </div>
                        </div>
                        <hr class="">
                        <div class="table-container">
                            <table id="tbl_confidential_old_records" class="table table-striped table-bordered table-hover table-checkable">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="5%"> No </th>
                                        <th width="20%"> Bank Name </th>
                                        <th width="20%"> Account Type </th>
                                        <th width="15%"> Account Number </th>
                                        <th width="20%"> Routing Number </th>
                                        <th width="20%"> Updated On </th>
                                    </tr>
                                    <tr role="row" class="filter display-none">
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                    </tr>
                                </thead>
                                <tbody> </tbody>
                            </table>
                        </div>
                        {{-- END ACTIVITIES FORM --}}
                    </div>
                    <div class="form-actions text-right">
                        <button type="submit" class="btn btn-sm btn-c-primary">Create</button>
                        <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-employee-list">Cancel</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
