@extends('layouts.app')

@section('page_template_css')
{{-- <link href="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/jquery-multi-select/css/multi-select.css')}}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/select2/css/select2.min.css" rel="stylesheet') }}" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> --}}
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page_css')
<link href="{{ url('assets/custom/css/settings.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active">Organization Hierarchy</a>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-body">
                {{-- BEGIN LEVEL TABLE --}}
                <div class="table-container">
                    <div class="actions">
                        <button type="button" class="btn btn-sm btn-c-primary" data-target="#modal_add_level" data-toggle="modal"><i class="fa fa-plus-circle"></i> Add Level </button>
                        <button id="btn_show_level_edit_modal" type="button" class="btn btn-sm btn-c-primary display-none" data-target="#modal_edit_level" data-toggle="modal"></button>
                        <div id="tbl_level_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-copy"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-upload"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-download"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-print"></i></a>
                        </div>
                    </div>
                    <table id="tbl_level" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="5%"> No </th>
                                <th width="30%"> Level </th>
                                <th width="45%"> Role </th>
                                <th width="20%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>

                                {{-- Level --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_name">
                                </td>

                                {{-- Role --}}
                                <td>
                                    <select name="filt_role" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        @php
                                        foreach($roles as $role)
                                        echo '<option value="' . $role->id . '">' . $role->name . '</option>';
                                        @endphp
                                    </select>
                                </td>

                                {{-- Action --}}
                                <td>
                                    <button class="btn btn-xs btn-c-primary filter-submit"><i class="fa fa-search"></i></button>
                                    <button class="btn btn-xs btn-c-grey filter-cancel"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                {{-- END LEVEL TABLE --}}

                {{-- BEGIN ACTIVITIES TABLE --}}
                <div class="panel-group accordion mt-30" id="accordion_acts">
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion_acts" href="#collapse_activities" aria-expanded="false"> Activities </a>
                            </h4>
                        </div>
                        <div id="collapse_activities" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                                <div class="table-container">
                                    <table id="tbl_level_activities" class="table table-striped table-bordered table-hover table-checkable">
                                        <thead>
                                            <tr role="row" class="heading">
                                                <th width="10%"> No </th>
                                                <th width="20%"> Date & Time </th>
                                                <th width="30%"> Updated By </th>
                                                <th width="40%"> Description </th>
                                            </tr>
                                            <tr role="row" class="filter">
                                                {{-- No --}}
                                                <td>
                                                    <button class="btn btn-xs btn-c-primary filter-submit"><i class="fa fa-search"></i></button>
                                                    <button class="btn btn-xs btn-c-grey filter-cancel"><i class="fa fa-times"></i></button>
                                                </td>

                                                {{-- Date & Time --}}
                                                <td>
                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_act_date_from" placeholder="From">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_act_date_to" placeholder="To">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </td>

                                                {{-- Updated by --}}
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="filt_act_updatedby">
                                                </td>

                                                {{-- Description --}}
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="filt_act_description">
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
                {{-- END ACTIVITIES TABLE --}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')

{{-- BEGIN LEVEL MODAL --}}
<div id="modal_add_level" class="modal fade" tabindex="-1" data-width="480">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add Level</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Name<span class="required" aria-required="true">*</span></label>
                        <input id="add_level_name" type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_modal_add_level_ok" type="button" class="btn btn-sm btn-c-primary">OK</button>
        <button id="btn_modal_add_level_close" type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
<div id="modal_edit_level" class="modal fade" tabindex="-1" data-width="480">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Level</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <input id="edit_level_id" type="hidden" class="form-control">
            <div class="row">
                @php
                foreach($roles as $role) {
                echo
                '<div class="col-md-6">
                    <label><input type="checkbox" id="edit_role' . $role->id . '" class="icheck edit-role" data-checkbox="icheckbox_square-blue" data-id="' . $role->id . '">' . $role->name . '</label>
                </div>';
                }
                @endphp
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_modal_edit_level_ok" type="button" class="btn btn-sm btn-c-primary">OK</button>
        <button id="btn_modal_edit_level_close" type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
{{-- END LEVEL MODAL --}}
@endsection

@section('page_template_js')
{{-- <script src="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script> --}}
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page_settings";
    var PAGE_SUB_ID = "page_settings_org_hierarchy";

</script>
<script src="{{ url('assets/custom/scripts/settings/org_hierarchy/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
