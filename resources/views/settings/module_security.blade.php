@extends('layouts.app')

@section('page_template_css')
<link href="{{ url('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/jquery-multi-select/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/select2/css/select2.min.css" rel="stylesheet') }}" type="text/css" />
<link href="{{ url('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
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
                <a href="{{ url('/settings') }}" class="btn-move-panel ">Organization Hierachy</a>
            </li>
            <li>
                <a href="{{ url('/settings/role_permission') }}" class="btn-move-panel" >Role Permission</a>
            </li>
            <li>
                <a href="{{ url('/settings/module_security') }}" class="btn-move-panel bread-active" >Module Security</a>
            </li>
            <li>
                <a href="{{ url('/settings/create_new_company') }}" class="btn-move-panel" >Create New Company</a>
            </li>
            <li>
                <a href="{{ url('/settings/application_setting') }}" class="btn-move-panel" >Application Setting</a>
            </li>
            <li>
                <a href="{{ url('/settings/backup_download') }}" class="btn-move-panel" >Backup and Download</a>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- Begin: life time stats -->
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-body">
                    <div class="table-container">
                        {{-- <div class="actions">
                            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" data-panelname="panel-create-placement"><i class="fa fa-plus-circle"></i> Add Role </button>
                            <div id="tbl_placements_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
                                <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-copy"></i></a>
                                <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-upload"></i></a>
                                <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-download"></i></a>
                                <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-print"></i></a>
                            </div>
                        </div> --}}
                        {{-- <div class="table-actions-wrapper">
                            <span> </span>
                            <select class="table-group-action-input form-control input-inline input-small input-sm">
                                <option value="">Select...</option>
                                <option value="Cancel">Delete</option>
                            </select>
                            <button class="btn btn-sm table-group-action-submit btn-c-primary">
                                <i class="fa fa-check"></i> Submit</button>
                        </div> --}}

                        {{-- level list --}}
                        <table id="tbl_module_security" class="table table-striped table-bordered table-hover table-checkable">
                            <thead>
                                <tr role="row" class="heading">
                                    <th width="20%"> Roles </th>
                                    <th width="20%"> View </th>
                                    <th width="10%"> Add </th>
                                    <th width="10%"> Edit </th>
                                    <th width="10%"> Delete </th>
                                    <th width="20%"> Action Permission </th>
                                    <th width="10%"> Action </th>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>

                        {{-- activities table --}}
                        <h4 class="section-head">Activities</h4>
                        <hr>
                        
                        <table id="tbl_organization_hierachy_activity" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr role="row" class="heading">
                                    <th width="25%"> Date & Time </th>
                                    <th width="25%"> Updated By </th>
                                    <th width="50%"> Description </th>
                                </tr>
                                <tr role="row" class="filter">
                                
                                    {{-- time_date --}}
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="filt_time_date"> </td>

                                    {{-- updated by --}}
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="filt_updated_by"> </td>

                                    {{-- description --}}
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="filt_description"> </td>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- End: life time stats -->
        </div>
    </div>

    {{-- modal --}}
    <div id="modal_edit_permission" class="modal fade" tabindex="-1" data-width="1200">
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
                                <div class="form-group">
                                    HR
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="icheck-list">
                                            <label>
                                                <input type="radio" name="radio1" class="icheck"> None </label>
                                            <label>
                                                <input type="radio" name="radio1" checked class="icheck"> Own</label>
                                            <label>
                                                <input type="radio" name="radio1" class="icheck"> Subbordinates </label>
                                            <label>
                                                <input type="radio" name="radio1" class="icheck"> Own & Subbordinates </label>
                                            <label>
                                                <input type="radio" name="radio1" class="icheck"> All Records </label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="icheck-list">
                                            <label>
                                                <input type="radio" name="radio2" class="icheck"> Restircted </label>
                                            <label>
                                                <input type="radio" name="radio2" checked class="icheck"> Allowed to Add </label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="icheck-list">
                                            <label>
                                                <input type="radio" name="radio3" class="icheck"> None </label>
                                            <label>
                                                <input type="radio" name="radio3" checked class="icheck"> Own</label>
                                            <label>
                                                <input type="radio" name="radio3" class="icheck"> Subbordinates </label>
                                            <label>
                                                <input type="radio" name="radio3" class="icheck"> Own & Subbordinates </label>
                                            <label>
                                                <input type="radio" name="radio3" class="icheck"> All Records </label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="icheck-list">
                                            <label>
                                                <input type="radio" name="radio4" class="icheck"> None </label>
                                            <label>
                                                <input type="radio" name="radio4" checked class="icheck"> Own</label>
                                            <label>
                                                <input type="radio" name="radio4" class="icheck"> Subbordinates </label>
                                            <label>
                                                <input type="radio" name="radio4" class="icheck"> Own & Subbordinates </label>
                                            <label>
                                                <input type="radio" name="radio4" class="icheck"> All Records </label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="icheck-list">
                                            <label>
                                                <input type="checkbox" class="icheck"> All </label>
                                            <label>
                                                <input type="checkbox" checked class="icheck"> Dashboard </label>
                                            <label>
                                                <input type="checkbox" class="icheck"> Timesheets </label>
                                            <label class="ml-30">
                                                <input type="checkbox" class="icheck"> All Timesheets </label>
                                            <label class="ml-30">
                                                <input type="checkbox" class="icheck"> Due Timesheets </label>
                                            <label class="ml-30">
                                                <input type="checkbox" class="icheck"> Awaiting Invoice </label>
                                            <label class="ml-30">
                                                <input type="checkbox" class="icheck"> Timesheet Dashboard </label>
                                            <label>
                                                <input type="checkbox" class="icheck"> Expenses </label>
                                            <label>
                                                <input type="checkbox" class="icheck"> Client </label>
                                            <label>
                                                <input type="checkbox" class="icheck"> Vendor </label>
                                            <label>
                                                <input type="checkbox" class="icheck"> Invoices </label>
                                            <label class="ml-30">
                                                <input type="checkbox" class="icheck"> All Invoices </label>
                                            <label class="ml-30">
                                                <input type="checkbox" class="icheck"> Due Invoices </label>
                                            <label class="ml-30">
                                                <input type="checkbox" class="icheck"> Awaiting Invoice </label>
                                            <label class="ml-30">
                                                <input type="checkbox" class="icheck"> Client Payments </label>
                                            <label class="ml-30">
                                                <input type="checkbox" class="icheck"> Employee Payments </label>
                                            <label>
                                                <input type="checkbox" class="icheck"> Work Authorization </label>
                                            <label>
                                                <input type="checkbox" class="icheck"> Asset Management </label>
                                            <label>
                                                <input type="checkbox" class="icheck"> Tickets </label>
                                            <label>
                                                <input type="checkbox" class="icheck"> Settings </label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('page_template_js')
<script src="{{ url('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page-settings-role_permission";

</script>
<script src="{{ url('assets/custom/scripts/settings/module_security.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
