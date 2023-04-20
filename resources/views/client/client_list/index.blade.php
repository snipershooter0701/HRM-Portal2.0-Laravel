@extends('layouts.app')

@section('page_template_css')
<link href="{{ url('assets/global/plugins/icheck/skins/all.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('page_css')
<link href="{{ url('assets/custom/css/client.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
<div id="panel_client" class="move-panel">
    @include('client.client_list.list')
</div>

{{-- BEGIN CREATE PANELS --}}
<div id="panel_create_businfo" class="move-panel display-none">
    @include('client.client_list.add.create_bus_info')
</div>
{{-- END CREATE PANELS --}}

{{-- BEGIN EDIT PANELS --}}
<div id="panel_edit_businfo" class="move-panel display-none">
    @include('client.client_list.edit.edit_bus_info')
</div>
<div id="panel_edit_contactinfo" class="move-panel display-none">
    @include('client.client_list.edit.edit_contact_info')
</div>
<div id="panel_edit_confidential" class="move-panel display-none">
    @include('client.client_list.edit.edit_confidential')
</div>
<div id="panel_edit_placement" class="move-panel display-none">
    @include('client.client_list.edit.edit_placements')
</div>
<div id="panel_edit_documents" class="move-panel display-none">
    @include('client.client_list.edit.edit_documents')
</div>
{{-- END EDIT PANELS --}}

{{-- BEGIN PLACEMENT PANELS --}}
<div id="panel_create_placement" class="move-panel display-none">
    @include('client.all_placements.add_placement')
</div>
{{-- END PLACEMENT PANELS --}}

{{-- BEGIN DOCUMENT PANELS --}}
<div id="panel_create_document" class="move-panel display-none">
    @include('client.all_documents.add_document')
</div>
{{-- END DOCUMENT PANELS --}}
@endsection

@section('modal')
@endsection

@section('page_template_js')
<script src="{{ url('assets/global/plugins/icheck/icheck.min.js?v=' . $randNum) }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page_client";
    var PAGE_SUB_ID = "page_client_list";

</script>
<script src="{{ url('assets/custom/scripts/client/client_list/list.js?v=' . $randNum) }}" type="text/javascript"></script>
<script src="{{ url('assets/custom/scripts/client/client_list/add/create_bus_info.js?v=' . $randNum) }}" type="text/javascript"></script>

<script src="{{ url('assets/custom/scripts/client/client_list/edit/edit_bus_info.js?v=' . $randNum) }}" type="text/javascript"></script>
<script src="{{ url('assets/custom/scripts/client/client_list/edit/edit_contact_info.js?v=' . $randNum) }}" type="text/javascript"></script>
<script src="{{ url('assets/custom/scripts/client/client_list/edit/edit_confidential.js?v=' . $randNum) }}" type="text/javascript"></script>
<script src="{{ url('assets/custom/scripts/client/client_list/edit/edit_placement.js?v=' . $randNum) }}" type="text/javascript"></script>
<script src="{{ url('assets/custom/scripts/client/client_list/edit/edit_document.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
