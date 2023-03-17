@extends('layouts.app')

@section('page_css')
<link href="{{ url('assets/custom/css/timesheet.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div id="panel-all-timesheet-list" class="move-panel">
    @include('timesheets.timesheet-all-list')
</div>
<div id="panel-due-timesheet-list" class="move-panel display-none">
    @include('timesheets.timesheet-due-list')
</div>
<div id="panel-awaiting-invoices-list" class="move-panel display-none">
    @include('timesheets.timesheet-await-invoice')
</div>
<div id="panel-submit-timesheet" class="move-panel display-none">
    @include('timesheets.timesheet-submit')
</div>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page-timesheets";
</script>
<script src="{{ url('assets/custom/scripts/timesheets/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
