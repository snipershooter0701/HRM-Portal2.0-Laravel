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
            <a href="javascript:;" class="btn-move-panel bread-active">Module Security</a>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-body">
                {{-- BEGIN MODULE SECURITY TABLE --}}
                <div class="table-container">
                    <div class="actions">
                        <button id="btn_show_role_edit_modal" type="button" class="btn btn-sm btn-c-primary display-none" data-target="#modal_edit_role" data-toggle="modal"></button>
                        <div id="tbl_module_security_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-copy"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-upload"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-download"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-print"></i></a>
                        </div>
                    </div>
                    <table id="tbl_module_security" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="5%"> No </th>
                                <th width="15%"> Role </th>
                                <th width="12%"> View </th>
                                <th width="12%"> Add </th>
                                <th width="12%"> Edit </th>
                                <th width="12%"> Delete </th>
                                <th width="20%"> Action Permission </th>
                                <th width="12%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>

                                {{-- Role --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_name">
                                </td>

                                {{-- View --}}
                                <td>
                                    <select name="filt_view" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="{{ config('constants.ROLE_ACCESS_VIEW_NONE') }}">None</option>
                                        <option value="{{ config('constants.ROLE_ACCESS_VIEW_OWN') }}">Own</option>
                                        <option value="{{ config('constants.ROLE_ACCESS_VIEW_SUBORDINATES') }}">Subordinate</option>
                                        <option value="{{ config('constants.ROLE_ACCESS_VIEW_OWN_SUBORDINATES') }}">Own & Subordinate</option>
                                        <option value="{{ config('constants.ROLE_ACCESS_VIEW_ALL_RECORDS') }}">All Records</option>
                                    </select>
                                </td>

                                {{-- Add --}}
                                <td>
                                    <select name="filt_add" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="{{ config('constants.ROLE_ACCESS_ADD_RESTRICTED') }}">Restricted</option>
                                        <option value="{{ config('constants.ROLE_ACCESS_ADD_ALLOWED') }}">Allowed to Add</option>
                                    </select>
                                </td>

                                {{-- Edit --}}
                                <td>
                                    <select name="filt_edit" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="{{ config('constants.ROLE_ACCESS_EDIT_NONE') }}">None</option>
                                        <option value="{{ config('constants.ROLE_ACCESS_EDIT_OWN') }}">Own</option>
                                        <option value="{{ config('constants.ROLE_ACCESS_EDIT_SUBORDINATES') }}">Subordinate</option>
                                        <option value="{{ config('constants.ROLE_ACCESS_EDIT_OWN_SUBORDINATES') }}">Own & Subordinate</option>
                                        <option value="{{ config('constants.ROLE_ACCESS_EDIT_ALL_RECORDS') }}">All Records</option>
                                    </select>
                                </td>

                                {{-- Delete --}}
                                <td>
                                    <select name="filt_delete" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="{{ config('constants.ROLE_ACCESS_DELETE_NONE') }}">None</option>
                                        <option value="{{ config('constants.ROLE_ACCESS_DELETE_OWN') }}">Own</option>
                                        <option value="{{ config('constants.ROLE_ACCESS_DELETE_SUBORDINATES') }}">Subordinate</option>
                                        <option value="{{ config('constants.ROLE_ACCESS_DELETE_OWN_SUBORDINATES') }}">Own & Subordinate</option>
                                        <option value="{{ config('constants.ROLE_ACCESS_DELETE_ALL_RECORDS') }}">All Records</option>
                                    </select>
                                </td>

                                {{-- Permission --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm margin-bottom-5" name="filt_permi_from" placeholder="From">
                                    <input type="text" class="form-control form-filter input-sm" name="filt_permi_to" placeholder="To">
                                </td>

                                {{-- Action --}}
                                <td>
                                    <button class="btn btn-xs btn-c-primary filter-submit"><i class="fa fa-search"></i></button>
                                    <button class="btn btn-xs btn-c-grey filter-cancel"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                </div>
                {{-- END MODULE SECURITY TABLE --}}

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
                                    <table id="tbl_module_sec_activities" class="table table-striped table-bordered table-hover table-checkable">
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
<div id="modal_edit_role" class="modal fade" tabindex="-1" data-width="1200">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Permission</h4>
    </div>
    <div class="modal-body">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr role="row" class="heading">
                        <th width="15%"> Role </th>
                        <th width="15%"> View </th>
                        <th width="15%"> Add </th>
                        <th width="15%"> Edit </th>
                        <th width="15%"> Delete </th>
                        <th width="25%"> Module Access </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input id="edit_perm_role_id" type="hidden" value="">
                            <div id="edit_perm_role" class="form-group">
                                HR
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="icheck-list">
                                        <label><input id="edit_perm_view_{{ config('constants.ROLE_ACCESS_VIEW_NONE') }}" type="radio" name="view_perm" class="icheck" value="{{ config('constants.ROLE_ACCESS_VIEW_NONE') }}"> None </label>
                                        <label><input id="edit_perm_view_{{ config('constants.ROLE_ACCESS_VIEW_OWN') }}" type="radio" name="view_perm" checked class="icheck" value="{{ config('constants.ROLE_ACCESS_VIEW_OWN') }}"> Own</label>
                                        <label><input id="edit_perm_view_{{ config('constants.ROLE_ACCESS_VIEW_SUBORDINATES') }}" type="radio" name="view_perm" class="icheck" value="{{ config('constants.ROLE_ACCESS_VIEW_SUBORDINATES') }}"> Subordinates </label>
                                        <label><input id="edit_perm_view_{{ config('constants.ROLE_ACCESS_VIEW_OWN_SUBORDINATES') }}" type="radio" name="view_perm" class="icheck" value="{{ config('constants.ROLE_ACCESS_VIEW_OWN_SUBORDINATES') }}"> Own & Subordinates </label>
                                        <label><input id="edit_perm_view_{{ config('constants.ROLE_ACCESS_VIEW_ALL_RECORDS') }}" type="radio" name="view_perm" class="icheck" value="{{ config('constants.ROLE_ACCESS_VIEW_ALL_RECORDS') }}"> All Records </label>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="icheck-list">
                                        <label><input id="edit_perm_add_{{ config('constants.ROLE_ACCESS_ADD_RESTRICTED') }}" type="radio" name="add_perm" class="icheck" value="{{ config('constants.ROLE_ACCESS_ADD_RESTRICTED') }}"> Restircted </label>
                                        <label><input id="edit_perm_add_{{ config('constants.ROLE_ACCESS_ADD_ALLOWED') }}" type="radio" name="add_perm" checked class="icheck" value="{{ config('constants.ROLE_ACCESS_ADD_ALLOWED') }}"> Allowed to Add </label>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="icheck-list">
                                        <label><input id="edit_perm_edit_{{ config('constants.ROLE_ACCESS_EDIT_NONE') }}" type="radio" name="edit_perm" class="icheck" value="{{ config('constants.ROLE_ACCESS_EDIT_NONE') }}"> None </label>
                                        <label><input id="edit_perm_edit_{{ config('constants.ROLE_ACCESS_EDIT_OWN') }}" type="radio" name="edit_perm" checked class="icheck" value="{{ config('constants.ROLE_ACCESS_EDIT_OWN') }}"> Own</label>
                                        <label><input id="edit_perm_edit_{{ config('constants.ROLE_ACCESS_EDIT_SUBORDINATES') }}" type="radio" name="edit_perm" class="icheck" value="{{ config('constants.ROLE_ACCESS_EDIT_SUBORDINATES') }}"> Subordinates </label>
                                        <label><input id="edit_perm_edit_{{ config('constants.ROLE_ACCESS_EDIT_OWN_SUBORDINATES') }}" type="radio" name="edit_perm" class="icheck" value="{{ config('constants.ROLE_ACCESS_EDIT_OWN_SUBORDINATES') }}"> Own & Subordinates </label>
                                        <label><input id="edit_perm_edit_{{ config('constants.ROLE_ACCESS_EDIT_ALL_RECORDS') }}" type="radio" name="edit_perm" class="icheck" value="{{ config('constants.ROLE_ACCESS_EDIT_ALL_RECORDS') }}"> All Records </label>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="icheck-list">
                                        <label><input id="edit_perm_delete_{{ config('constants.ROLE_ACCESS_DELETE_NONE') }}" type="radio" name="delete_perm" class="icheck" value="{{ config('constants.ROLE_ACCESS_DELETE_NONE') }}"> None </label>
                                        <label><input id="edit_perm_delete_{{ config('constants.ROLE_ACCESS_DELETE_OWN') }}" type="radio" name="delete_perm" checked class="icheck" value="{{ config('constants.ROLE_ACCESS_DELETE_OWN') }}"> Own</label>
                                        <label><input id="edit_perm_delete_{{ config('constants.ROLE_ACCESS_DELETE_SUBORDINATES') }}" type="radio" name="delete_perm" class="icheck" value="{{ config('constants.ROLE_ACCESS_DELETE_SUBORDINATES') }}"> Subordinates </label>
                                        <label><input id="edit_perm_delete_{{ config('constants.ROLE_ACCESS_DELETE_OWN_SUBORDINATES') }}" type="radio" name="delete_perm" class="icheck" value="{{ config('constants.ROLE_ACCESS_DELETE_OWN_SUBORDINATES') }}"> Own & Subordinates </label>
                                        <label><input id="edit_perm_delete_{{ config('constants.ROLE_ACCESS_DELETE_ALL_RECORDS') }}" type="radio" name="delete_perm" class="icheck" value="{{ config('constants.ROLE_ACCESS_DELETE_ALL_RECORDS') }}"> All Records </label>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="icheck-list">
                                        @php
                                        foreach($modules as $module)
                                        {
                                        if ($module->level == config('constants.ROLE_MODULE_LEVEL_MODULE'))
                                        echo '<label><input id="edit_perm_module_' . $module->id . '" type="checkbox" class="icheck check-module" data-id="' . $module->id . '"> ' . $module->name . ' </label>';
                                        else if ($module->level == config('constants.ROLE_MODULE_LEVEL_SUBMODULE'))
                                        echo '<label class="ml-30"><input id="edit_perm_module_' . $module->id . '" type="checkbox" class="icheck check-module" data-id="' . $module->id . '"> ' . $module->name . ' </label>';
                                        else
                                        echo '<label class="ml-30"><input id="edit_perm_module_' . $module->id . '" type="checkbox" class="icheck check-module" data-id="' . $module->id . '"> ' . $module->name . ' </label>';
                                        }
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_modal_edit_role_ok" type="button" class="btn btn-sm btn-c-primary">OK</button>
        <button id="btn_modal_edit_role_close" type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
@endsection

@section('page_template_js')
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page_settings";
    var PAGE_SUB_ID = "page_settings_module_sec";

</script>
<script src="{{ url('assets/custom/scripts/settings/module_sec/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
