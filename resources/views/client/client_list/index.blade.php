@extends('layouts.app')

@section('page_template_css')
{{-- <link href="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/icheck/skins/all.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/jquery-multi-select/css/multi-select.css?v=' . $randNum)}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/select2/css/select2.min.css" rel="stylesheet?v=' . $randNum) }}" type="text/css" />
<link href="{{ url('assets/global/plugins/select2/css/select2-bootstrap.min.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" /> --}}
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('page_css')
<link href="{{ url('assets/custom/css/client.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
<div id="panel-client" class="move-panel">
    @include('client.client_list.list')
</div>
<div id="panel-create-businfo" class="move-panel display-none">
    @include('client.client_list.create_bus_info')
</div>
<div id="panel-edit-businfo" class="move-panel display-none">
    @include('client.client_list.edit_bus_info')
</div>
{{-- <div id="panel-contact-info" class="move-panel display-none">
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
</div> --}}
@endsection

@section('page_template_js')
{{-- <script src="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js?v=' . $randNum) }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/icheck/icheck.min.js?v=' . $randNum) }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js?v=' . $randNum) }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js?v=' . $randNum) }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/select2/js/select2.full.min.js?v=' . $randNum) }}" type="text/javascript"></script> --}}
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page-client";
    var PAGE_SUB_ID = "page-client-list";

</script>
<script src="{{ url('assets/custom/scripts/client/client_list/list.js?v=' . $randNum) }}" type="text/javascript"></script>
<script src="{{ url('assets/custom/scripts/client/client_list/create_bus_info.js?v=' . $randNum) }}" type="text/javascript"></script>
<script src="{{ url('assets/custom/scripts/client/client_list/edit_bus_info.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
