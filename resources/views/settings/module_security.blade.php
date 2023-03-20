@extends('layouts.app')

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
@endsection



@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page-settings-role_permission";

</script>
<script src="{{ url('assets/custom/scripts/settings/module_security.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
