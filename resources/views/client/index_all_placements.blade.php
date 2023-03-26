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
@endsection

@section('page_css')
<link href="{{ url('assets/custom/css/client.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div id="panel-all-placements" class="move-panel">
    <!-- BEGIN PAGE HEADER-->
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar c-page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ url('/') }}">All Placements</a>
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
                        <div class="actions">
                            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" data-panelname="panel-create-placement"><i class="fa fa-plus-circle"></i> Add Placement </button>
                            <div id="tbl_placements_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
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

                        {{-- placement list table --}}
                        <table id="tbl_all_placement" class="table table-striped table-bordered table-hover table-checkable">
                            <thead>
                                <tr role="row" class="heading">
                                    <th width="2%">
                                        <input type="checkbox" class="group-checkable"> </th>
                                    <th width="5%"> No </th>
                                    <th width="15%"> Employee Name </th>
                                    <th width="15%"> Client </th>
                                    <th width="10%"> Job Tire </th>
                                    <th width="10%"> Category </th>
                                    <th width="10%"> Status </th>
                                    <th width="10%"> Start Date </th>
                                    <th width="10%"> End Date</th>
                                    <th width="13%"> Action </th>
                                </tr>
                                <tr role="row" class="filter">
                                    <td> </td>
                                    <td> </td>

                                    {{-- Employee name --}}
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="filt_employee_name"> </td>

                                    {{-- Client --}}
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="filt_client"> </td>

                                    {{-- Job Tire --}}
                                    <td>
                                        <select name="filt_job_status" class="form-control form-filter input-sm">
                                            <option value="">Select...</option>
                                            <option value="pending">Regular</option>
                                            <option value="closed">2nd</option>
                                            <option value="closed">3rd</option>
                                        </select>
                                    </td>

                                    {{-- Category --}}
                                    <td>
                                        <select name="filt_job_status" class="form-control form-filter input-sm">
                                            <option value="">Select...</option>
                                            <option value="">W2</option>
                                            <option value="">C2C</option>
                                            <option value="">1099</option>
                                        </select>
                                    </td>

                                    {{-- Job Status --}}
                                    <td>
                                        <select name="filt_job_status" class="form-control form-filter input-sm">
                                            <option value="">Select...</option>
                                            <option value="pending">Active</option>
                                            <option value="closed">Inactive</option>
                                        </select>
                                    </td>

                                    {{-- Start Date --}}
                                    <td>
                                        <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                            <input type="text" class="form-control form-filter input-sm" readonly name="filt_join_date_from" placeholder="From">
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                        <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                            <input type="text" class="form-control form-filter input-sm" readonly name="filt_join_date_to" placeholder="To">
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </td>

                                    {{-- End Date --}}
                                    <td>
                                        <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                            <input type="text" class="form-control form-filter input-sm" readonly name="filt_join_date_from" placeholder="From">
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                        <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                            <input type="text" class="form-control form-filter input-sm" readonly name="filt_join_date_to" placeholder="To">
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
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

                        {{-- activities table --}}
                        <h4 class="section-head">Activities</h4>
                        <hr>

                        <table id="tbl_activity" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr role="row" class="heading">
                                    <th width="20%"> Date & Time </th>
                                    <th width="15%"> Updated By </th>
                                    <th width="15%"> Description </th>
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
</div>

<div id="panel-create-placement" class="move-panel display-none">
    @include('client.add_placement')
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
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page-client";
    var PAGE_SUB_ID = "page-client-all-placements-inv";

</script>
<script src="{{ url('assets/custom/scripts/client/all_placement.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
