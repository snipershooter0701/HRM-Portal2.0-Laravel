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
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page_css')
<link href="{{ url('assets/custom/css/client.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
<div class="move-panel" id="panel-client">
    @include('client.client_list')
</div>
<div id="panel-business-info" class="move-panel display-none">
    @include('client.add_client.business_info')
</div>
<div id="panel-contact-info" class="move-panel display-none">
    @include('client.add_client.contact_info')
</div>
<div id="panel-add-confidential" class="move-panel display-none">
    @include('client.add_client.add_confidential')
</div>
<div id="panel-placement" class="move-panel display-none">
    @include('client.add_client.placements')
</div>
<div id="panel-document" class="move-panel display-none">
    @include('client.add_client.documents')
</div>

<div id="panel-create-placement" class="move-panel display-none">
    @include('client.add_placement')
</div>

<div id="panel-create-document" class="move-panel display-none">
    @include('client.add_document')
</div>
@endsection

@section('modal')
<div id="contact_modal" class="modal fade" tabindex="-1" data-width="760">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add Contact</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="row">
                <div class="form-group col-lg-6 col-sm-4 col-xs-6">
                    <label class="control-label">First Name</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group col-lg-6 col-sm-4 col-xs-6">
                    <label class="control-label">Last Name</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6 col-md-3 col-sm-4 col-xs-6">
                    <label class="control-label">Email</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group col-lg-6 col-md-3 col-sm-4 col-xs-6">
                    <label class="control-label">Phone</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-8 col-md-3 col-sm-4 col-xs-6">
                    <div class="input-group">
                        <div class="icheck-inline">
                            <label>
                                <input type="checkbox" class="icheck"> Add email to CC list </label>
                            <label>
                                <input type="checkbox" checked class="icheck"> Primary Contact </label>
                            <label>
                                <input type="checkbox" class="icheck"> Primary accounts email </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-c-primary" data-dismiss="modal">Create</button>
        <button type="button" class="btn btn-c-grey" data-dismiss="modal">Cancel</button>
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
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page-client";
    var PAGE_SUB_ID = "page-client-list-inv";
</script>
<script src="{{ url('assets/custom/scripts/client/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection