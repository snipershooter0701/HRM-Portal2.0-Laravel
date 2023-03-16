@extends('layouts.app')

@section('page_css')
<link href="{{ url('assets/custom/css/client.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div id="panel-client-list" class="move-panel ">
    @include('client.client_list')
</div>
<div id="panel-create-client-business" class="move-panel display-none">
    @include('client.add_client.business_info')
</div>
<div id="panel-create-client" class="move-panel display-none">
    @include('client.add_client.contact_info')
</div>
<div id="panel-create-client" class="move-panel display-none">
    @include('client.add_client.add_confidential')
</div>
<div id="panel-create-client" class="move-panel display-none">
    @include('client.add_client.placements')
</div>
<div id="panel-create-client" class="move-panel display-none">
    @include('client.add_client.documents')
</div>
{{-- <div id="panel-create-details" class="move-panel display-none">
    <h1>Create Details</h1>
</div> --}}
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page-client";
</script>
<script src="{{ url('assets/custom/scripts/client/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection