@extends('layouts.app')

@section('page_css')
<link href="{{ url('assets/custom/css/client.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div id="panel-create-placement" class="move-panel">
    @include('client.all_placements')
</div>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page-all-placements";
</script>
<script src="{{ url('assets/custom/scripts/client/all_placement.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection