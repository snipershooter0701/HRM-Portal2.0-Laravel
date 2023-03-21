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
<div id="panel-all-documents" class="move-panel">
    <!-- BEGIN PAGE HEADER-->
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar c-page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ url('/') }}">All Documents</a>
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
                            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" data-panelname="panel-create-document"><i class="fa fa-plus-circle"></i> Add Document </button>
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

                        {{-- document list table --}}
                        <table id="tbl_all_document" class="table table-striped table-bordered table-hover table-checkable">
                            <thead>
                                <tr role="row" class="heading">
                                    <th width="2%">
                                        <input type="checkbox" class="group-checkable"> </th>
                                    <th width="5%"> No </th>
                                    <th width="20%"> Title</th>
                                    <th width="10%"> Documents type </th>
                                    <th width="15%"> Client Name </th>
                                    <th width="15%"> Employee </th>
                                    <th width="10%"> status </th>
                                    <th width="10%"> Except Date</th>
                                    <th width="13%"> Action </th>
                                </tr>
                                <tr role="row" class="filter">
                                    <td> </td>
                                    <td> </td>

                                    {{-- Title --}}
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="filt_title"> </td>

                                    {{-- Document type--}}
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="filt_document_type"> </td>

                                    {{-- Client Name --}}
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="filt_client_name"> </td>

                                    {{-- employee--}}
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="filt_employee"> </td>

                                    {{-- status --}}
                                    <td>
                                        <select name="filt_status" class="form-control form-filter input-sm">
                                            <option value="">Select...</option>
                                            <option value="pending">active</option>
                                            <option value="closed">inactive</option>
                                        </select>
                                    </td>

                                    {{-- except Date --}}
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="filt_except_date"> </td>

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
            </div>
            <!-- End: life time stats -->
        </div>
    </div>
</div>

<div id="panel-create-document" class="move-panel display-none">
    @include('client.add_document')
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
    var PAGE_SUB_ID = "page-client-all-documents-inv";
</script>
<script src="{{ url('assets/custom/scripts/client/all_document.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection