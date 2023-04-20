@extends('layouts.app')

@section('page_template_css')
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
            <a href="javascript:;" class="btn-move-panel bread-active">Role Permission</a>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-body">
                {{-- BEGIN ROLE PERMISSION TABLE --}}
                <div class="table-container">
                    <div class="actions">
                        <button type="button" class="btn btn-sm btn-c-primary" data-target="#modal_add_role" data-toggle="modal"><i class="fa fa-plus-circle"></i> Add Role </button>
                        <button id="btn_show_role_edit_modal" type="button" class="btn btn-sm btn-c-primary display-none" data-target="#modal_edit_role" data-toggle="modal"></button>
                        <div id="tbl_role_permission_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-copy"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-upload"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-download"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-print"></i></a>
                        </div>
                    </div>
                    <table id="tbl_role_permission" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="5%"> No </th>
                                <th width="30%"> Role </th>
                                <th width="45%"> Department </th>
                                <th width="20%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>

                                {{-- Role --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_name">
                                </td>

                                {{-- Department --}}
                                <td>
                                    <select name="filt_department" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        @php
                                        foreach($departments as $department)
                                        echo '<option value="' . $department->id . '">' . $department->name . '</option>';
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
                {{-- END ROLE PERMISSION TABLE --}}

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
                                    <table id="tbl_role_activities" class="table table-striped table-bordered table-hover table-checkable">
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

{{-- BEGIN ROLE MODAL --}}
<div id="modal_add_role" class="modal fade" tabindex="-1" data-width="480">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add Role</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Name<span class="required" aria-required="true">*</span></label>
                        <input id="add_role_name" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Department<span class="required" aria-required="true">*</span></label>
                        <select id="add_role_department" class="form-control">
                            <option value="">Select...</option>
                            @php
                            foreach($departments as $department)
                            echo '<option value="' . $department->id . '">' . $department->name . '</option>'
                            @endphp
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_modal_add_role_ok" type="button" class="btn btn-sm btn-c-primary">OK</button>
        <button id="btn_modal_add_role_close" type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
<div id="modal_edit_role" class="modal fade" tabindex="-1" data-width="480">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Role</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <input id="edit_role_id" type="hidden" class="form-control">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Name<span class="required" aria-required="true">*</span></label>
                        <input id="edit_role_name" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Department<span class="required" aria-required="true">*</span></label>
                        <select id="edit_role_department" class="form-control">
                            <option value="">Select...</option>
                            @php
                            foreach($departments as $department)
                            echo '<option value="' . $department->id . '">' . $department->name . '</option>'
                            @endphp
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_modal_edit_role_ok" type="button" class="btn btn-sm btn-c-primary">OK</button>
        <button id="btn_modal_edit_role_close" type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
{{-- END ROLE MODAL --}}
@endsection

@section('page_template_js')
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page_settings";
    var PAGE_SUB_ID = "page_settings_role_perm";

</script>
<script src="{{ url('assets/custom/scripts/settings/role/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
