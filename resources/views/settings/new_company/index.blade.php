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
            <a href="javascript:;" class="btn-move-panel bread-active">Create New Company</a>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-body">
                {{-- BEGIN COMPANY TABLE --}}
                <div class="table-container">
                    <div class="actions">
                        <button type="button" class="btn btn-sm btn-c-primary" data-target="#modal_add_company" data-toggle="modal"><i class="fa fa-plus-circle"></i> Add Company </button>
                        <button id="btn_show_company_edit_modal" type="button" class="btn btn-sm btn-c-primary display-none" data-target="#modal_edit_company" data-toggle="modal"></button>
                        <div id="tbl_company_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
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
                            <option value="delete">Delete</option>
                        </select>
                        <button class="btn btn-sm table-group-action-submit btn-c-primary">
                            <i class="fa fa-check"></i> Submit</button>
                    </div>
                    <table id="tbl_company" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable">
                                </th>
                                <th width="5%"> No </th>
                                <th width="18%"> Title </th>
                                <th width="15%"> Email </th>
                                <th width="15%"> Currency </th>
                                <th width="15%"> Timezone </th>
                                <th width="15%"> Alignment </th>
                                <th width="15%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td> </td>

                                {{-- Title --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_title">
                                </td>

                                {{-- Email --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_email">
                                </td>

                                {{-- Currency --}}
                                <td>
                                    <select name="filt_currency" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        @php
                                        foreach($currencies as $currency)
                                        echo '<option value="' . $currency->id . '">' . $currency->name . '</option>';
                                        @endphp
                                    </select>
                                </td>

                                {{-- Timezone --}}
                                <td>
                                    <select name="filt_timezone" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        @php
                                        foreach($timezones as $timezone)
                                        echo '<option value="' . $timezone->id . '">' . $timezone->code . '</option>';
                                        @endphp
                                    </select>
                                </td>

                                {{-- Alignment --}}
                                <td>
                                    <select name="filt_alignment" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="{{ config('constants.COMPANY_ALIGNMENT_LEFTTORIGHT') }}">Left To Right</option>
                                        <option value="{{ config('constants.COMPANY_ALIGNMENT_RIGHTTOLEFT') }}">Right To Left</option>
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
                {{-- END COMPANY TABLE --}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')

{{-- BEGIN COMPANY MODAL --}}
<div id="modal_add_company" class="modal fade" tabindex="-1" data-width="540">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add Company</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Company Title<span class="required" aria-required="true">*</span></label>
                        <input id="add_company_title" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Email Address<span class="required" aria-required="true">*</span></label>
                        <input id="add_company_email" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Address</label>
                        <input id="add_company_address" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Phone</label>
                        <input id="add_company_phone" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Favicon</label>
                        <input id="add_company_favicon" type="file" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Logo</label>
                        <input id="add_company_logo" type="file" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Currency<span class="required" aria-required="true">*</span></label>
                        <select id="add_company_currency" class="form-control">
                            <option value="">Select...</option>
                            @php
                            foreach($currencies as $currency) {
                            echo '<option value="' . $currency->id . '" '. ($currency->id == 121 ? ' selected' : '' ) .'>' . $currency->name . '</option>';
                            }
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Time Zone<span class="required" aria-required="true">*</span></label>
                        <select id="add_company_timezone" class="form-control" value="233">
                            <option value="">Select...</option>
                            @php
                            foreach($timezones as $timezone)
                            echo '<option value="' . $timezone->id . '"'. ($timezone->id == 233 ? ' selected' : '' ) .'>' . $timezone->code . '</option>';
                            @endphp
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Application Alignment<span class="required" aria-required="true">*</span></label>
                        <select id="add_company_alignment" class="form-control">
                            <option value="">Select...</option>
                            <option value="{{ config('constants.COMPANY_ALIGNMENT_LEFTTORIGHT') }}" selected>Left To Right</option>
                            <option value="{{ config('constants.COMPANY_ALIGNMENT_RIGHTTOLEFT') }}">Right To Left</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Footer Text<span class="required" aria-required="true">*</span></label>
                        <textarea id="add_company_footer" type="text" class="form-control" rows="5"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_modal_add_company_ok" type="button" class="btn btn-sm btn-c-primary">OK</button>
        <button id="btn_modal_add_company_close" type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
<div id="modal_edit_company" class="modal fade" tabindex="-1" data-width="540">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Company</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="row">
                <input id="edit_company_id" type="hidden" class="form-control">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Company Title<span class="required" aria-required="true">*</span></label>
                        <input id="edit_company_title" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Email Address<span class="required" aria-required="true">*</span></label>
                        <input id="edit_company_email" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Address</label>
                        <input id="edit_company_address" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Phone</label>
                        <input id="edit_company_phone" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Favicon</label>
                        <input id="edit_company_favicon" type="file" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Logo</label>
                        <input id="edit_company_logo" type="file" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Currency<span class="required" aria-required="true">*</span></label>
                        <select id="edit_company_currency" class="form-control">
                            <option value="">Select...</option>
                            @php
                            foreach($currencies as $currency) {
                            echo '<option value="' . $currency->id . '" '. ($currency->id == 121 ? ' selected' : '' ) .'>' . $currency->name . '</option>';
                            }
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Time Zone<span class="required" aria-required="true">*</span></label>
                        <select id="edit_company_timezone" class="form-control" value="233">
                            <option value="">Select...</option>
                            @php
                            foreach($timezones as $timezone)
                            echo '<option value="' . $timezone->id . '"'. ($timezone->id == 233 ? ' selected' : '' ) .'>' . $timezone->code . '</option>';
                            @endphp
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Application Alignment<span class="required" aria-required="true">*</span></label>
                        <select id="edit_company_alignment" class="form-control">
                            <option value="">Select...</option>
                            <option value="{{ config('constants.COMPANY_ALIGNMENT_LEFTTORIGHT') }}" selected>Left To Right</option>
                            <option value="{{ config('constants.COMPANY_ALIGNMENT_RIGHTTOLEFT') }}">Right To Left</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Footer Text<span class="required" aria-required="true">*</span></label>
                        <textarea id="edit_company_footer" type="text" class="form-control" rows="5"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btn_modal_edit_company_ok" type="button" class="btn btn-sm btn-c-primary">OK</button>
        <button id="btn_modal_edit_company_close" type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
{{-- END COMPANY MODAL --}}
@endsection

@section('page_template_js')
{{-- <script src="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script> --}}
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page_settings";
    var PAGE_SUB_ID = "page_settings_new_company";

</script>
<script src="{{ url('assets/custom/scripts/settings/new_company/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
