@extends('layouts.app')

@section('page_template_css')
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="bread-active">General</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
        </div>
    </div>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-body">
                <div class="row">
                    {{-- BEGIN DEPARTMENT LIST --}}
                    <div class="col-md-6">
                        <h4 class="section-head">Department List</h4>
                        <hr>
                        <div class="table-container">
                            <div class="actions">
                                <button type="button" class="btn btn-sm btn-c-primary" data-target="#modal_add_department" data-toggle="modal"><i class="fa fa-plus-circle"></i> Add Department </button>
                                <button id="btn_show_department_edit_modal" type="button" class="btn btn-sm btn-c-primary display-none" data-target="#modal_edit_department" data-toggle="modal"></button>
                                <div id="tbl_department_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
                                    <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-copy"></i></a>
                                    <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-upload"></i></a>
                                    <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-download"></i></a>
                                    <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-print"></i></a>
                                </div>
                            </div>
                            <table id="tbl_department" class="table table-striped table-bordered table-hover table-checkable">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="10%"> No </th>
                                        <th width="60%"> Department </th>
                                        <th width="30%"> Action </th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <td> </td>

                                        {{-- Department --}}
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="filt_name">
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
                    </div>
                    {{-- END DEPARTMENT LIST --}}
                    {{-- BEGIN WORK AUTH LIST --}}
                    <div class="col-md-6">
                        <h4 class="section-head">Work Auth List</h4>
                        <hr>
                        <div class="table-container">
                            <div class="actions">
                                <button type="button" class="btn btn-sm btn-c-primary" data-target="#modal_add_workauth" data-toggle="modal"><i class="fa fa-plus-circle"></i> Add Work Auth </button>
                                <button id="btn_show_workauth_edit_modal" type="button" class="btn btn-sm btn-c-primary display-none" data-target="#modal_edit_workauth" data-toggle="modal"></button>
                                <div id="tbl_work_auths_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
                                    <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-copy"></i></a>
                                    <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-upload"></i></a>
                                    <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-download"></i></a>
                                    <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-print"></i></a>
                                </div>
                            </div>
                            <table id="tbl_work_auths" class="table table-striped table-bordered table-hover table-checkable">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="10%"> No </th>
                                        <th width="60%"> Work Auth </th>
                                        <th width="30%"> Action </th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <td> </td>

                                        {{-- Work Auth --}}
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="filt_name">
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
                    </div>
                    {{-- END WORK AUTH LIST --}}
                </div>
                <div class="row">
                    {{-- BEGIN POC LIST --}}
                    <div class="col-md-6">
                        <h4 class="section-head">POC List</h4>
                        <hr>
                        <div class="table-container">
                            <div class="actions">
                                <button type="button" class="btn btn-sm btn-c-primary" data-target="#modal_add_poc" data-toggle="modal"><i class="fa fa-plus-circle"></i> Add POC </button>
                                <button id="btn_show_poc_edit_modal" type="button" class="btn btn-sm btn-c-primary display-none" data-target="#modal_edit_poc" data-toggle="modal"></button>
                                <div id="tbl_pocs_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
                                    <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-copy"></i></a>
                                    <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-upload"></i></a>
                                    <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-download"></i></a>
                                    <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-print"></i></a>
                                </div>
                            </div>
                            <table id="tbl_pocs" class="table table-striped table-bordered table-hover table-checkable">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="10%"> No </th>
                                        <th width="60%"> POC Name </th>
                                        <th width="30%"> Action </th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <td> </td>

                                        {{-- POC Name --}}
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="filt_name">
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
                    </div>
                    {{-- END POC LIST --}}
                    {{-- BEGIN JOB TIRE LIST --}}
                    <div class="col-md-6">
                        <h4 class="section-head">Job Tire</h4>
                        <hr>
                        <div class="table-container">
                            <div class="actions">
                                <button type="button" class="btn btn-sm btn-c-primary" data-target="#modal_add_jobtire" data-toggle="modal"><i class="fa fa-plus-circle"></i> Add Job Tire </button>
                                <button id="btn_show_jobtire_edit_modal" type="button" class="btn btn-sm btn-c-primary display-none" data-target="#modal_edit_jobtire" data-toggle="modal"></button>
                                <div id="tbl_job_tires_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
                                    <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-copy"></i></a>
                                    <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-upload"></i></a>
                                    <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-download"></i></a>
                                    <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-print"></i></a>
                                </div>
                            </div>
                            <table id="tbl_job_tires" class="table table-striped table-bordered table-hover table-checkable">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="10%"> No </th>
                                        <th width="60%"> Work Auth </th>
                                        <th width="30%"> Action </th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <td> </td>

                                        {{-- POC --}}
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="filt_name">
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
                    </div>
                    {{-- END JOB TIRE LIST --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
{{-- BEGIN DEPARTMENT MODAL --}}
<div id="modal_add_department" class="modal fade" tabindex="-1" data-width="480">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add Department</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="form-group">
                <label class="control-label">Name<span class="required" aria-required="true">*</span></label>
                <input id="add_department_name" type="text" class="form-control">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_modal_add_department_ok" type="button" class="btn btn-sm btn-c-primary">OK</button>
        <button id="btn_modal_add_department_close" type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
<div id="modal_edit_department" class="modal fade" tabindex="-1" data-width="480">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Department</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <input id="edit_department_id" type="hidden" class="form-control">
            <div class="form-group">
                <label class="control-label">Name<span class="required" aria-required="true">*</span></label>
                <input id="edit_department_name" type="text" class="form-control">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_modal_edit_department_ok" type="button" class="btn btn-sm btn-c-primary">OK</button>
        <button id="btn_modal_edit_department_close" type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
{{-- END DEPARTMENT MODAL --}}

{{-- BEGIN WORK AUTH MODAL --}}
<div id="modal_add_workauth" class="modal fade" tabindex="-1" data-width="480">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add Work Auth</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="form-group">
                <label class="control-label">Name<span class="required" aria-required="true">*</span></label>
                <input id="add_workauth_name" type="text" class="form-control">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_modal_add_workauth_ok" type="button" class="btn btn-sm btn-c-primary">OK</button>
        <button id="btn_modal_add_workauth_close" type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
<div id="modal_edit_workauth" class="modal fade" tabindex="-1" data-width="480">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Work Auth</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <input id="edit_workauth_id" type="hidden" class="form-control">
            <div class="form-group">
                <label class="control-label">Name<span class="required" aria-required="true">*</span></label>
                <input id="edit_workauth_name" type="text" class="form-control">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_modal_edit_workauth_ok" type="button" class="btn btn-sm btn-c-primary">OK</button>
        <button id="btn_modal_edit_workauth_close" type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
{{-- END WORK AUTH MODAL --}}

{{-- BEGIN POC MODAL --}}
<div id="modal_add_poc" class="modal fade" tabindex="-1" data-width="480">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add POC</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="form-group">
                <label class="control-label">Name<span class="required" aria-required="true">*</span></label>
                <input id="add_poc_name" type="text" class="form-control">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_modal_add_poc_ok" type="button" class="btn btn-sm btn-c-primary">OK</button>
        <button id="btn_modal_add_poc_close" type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
<div id="modal_edit_poc" class="modal fade" tabindex="-1" data-width="480">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit POC</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <input id="edit_poc_id" type="hidden" class="form-control">
            <div class="form-group">
                <label class="control-label">Name<span class="required" aria-required="true">*</span></label>
                <input id="edit_poc_name" type="text" class="form-control">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_modal_edit_poc_ok" type="button" class="btn btn-sm btn-c-primary">OK</button>
        <button id="btn_modal_edit_poc_close" type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
{{-- END POC MODAL --}}

{{-- BEGIN JOB TIRE MODAL --}}
<div id="modal_add_jobtire" class="modal fade" tabindex="-1" data-width="480">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add Job Tire</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="form-group">
                <label class="control-label">Name<span class="required" aria-required="true">*</span></label>
                <input id="add_jobtire_name" type="text" class="form-control">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_modal_add_jobtire_ok" type="button" class="btn btn-sm btn-c-primary">OK</button>
        <button id="btn_modal_add_jobtire_close" type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
<div id="modal_edit_jobtire" class="modal fade" tabindex="-1" data-width="480">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Job Tire</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <input id="edit_jobtire_id" type="hidden" class="form-control">
            <div class="form-group">
                <label class="control-label">Name<span class="required" aria-required="true">*</span></label>
                <input id="edit_jobtire_name" type="text" class="form-control">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_modal_edit_jobtire_ok" type="button" class="btn btn-sm btn-c-primary">OK</button>
        <button id="btn_modal_edit_jobtire_close" type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
{{-- END JOB TIRE MODAL --}}
@endsection

@section('page_template_js')
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page_settings";
    var PAGE_SUB_ID = "page_settings_general";

</script>
<script src="{{ url('assets/custom/scripts/settings/general/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
