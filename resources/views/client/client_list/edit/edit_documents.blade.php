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
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel_edit_confidential">Add Confidential</span>
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel_edit_placement">Placements</span>
                    <span class="caption-helper active-tab btn-move-panel" data-panelname="panel_edit_documents">Documents</span>
                </div>
            </div>
            <div class="portlet-body">
                {{-- BEGIN DOCUMENT TABLE --}}
                <div class="table-container">
                    <div class="actions">
                        <button id="btn_show_add_document" type="button" class="btn btn-sm btn-c-primary mr-10"><i class="fa fa-plus-circle"></i> Add Document </button>
                        <button id="btn_go_add_document" type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10 display-none" data-panelname="panel_create_document"><i class="fa fa-plus-circle"></i> Add Document </button>
                        <div id="tbl_document_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-copy"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-upload"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-download"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-print"></i></a>
                        </div>
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

                    <table id="tbl_document" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable"> </th>
                                <th width="5%"> No </th>
                                <th width="20%"> Title</th>
                                <th width="13%"> Documents type </th>
                                <th width="15%"> Employee </th>
                                <th width="15%"> Status </th>
                                <th width="15%"> Expire Date</th>
                                <th width="15%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td>
                                    <input id="filt_tbl_document_client_id" type="hidden" class="form-control form-filter input-sm" name="filt_client_id">
                                </td>

                                {{-- Title --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_title">
                                </td>

                                {{-- Document type--}}
                                <td>
                                    <select name="filt_document_type" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        @php
                                        foreach($docTypes as $docType)
                                        echo '<option value="' . $docType->id . '">' . $docType->name . '</option>'
                                        @endphp
                                    </select>
                                </td>

                                {{-- Employee--}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_employee">
                                </td>

                                {{-- Status --}}
                                <td>
                                    <select name="filt_status" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="{{ config('constants.STATE_ACTIVE') }}">Active</option>
                                        <option value="{{ config('constants.STATE_INACTIVE') }}">Inactive</option>
                                    </select>
                                </td>

                                {{-- Expire Date --}}
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_expiredate_from" placeholder="From">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_expiredate_to" placeholder="To">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>

                                {{-- Action --}}
                                <td>
                                    <button id="btn_tbl_document_search" class="btn btn-xs btn-c-primary filter-submit"><i class="fa fa-search"></i></button>
                                    <button id="btn_tbl_document_reset" class="btn btn-xs btn-c-grey filter-cancel"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>

                </div>
                {{-- END DOCUMENT TABLE --}}
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
