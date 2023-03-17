@extends('layouts.app')

@section('page_css')
<link href="{{ url('assets/custom/css/employee.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div id="panel-employee-list" class="move-panel">
    @include('employee.employee-list')
</div>
<div id="panel-create-employee" class="move-panel display-none">
    @include('employee.employee-add')
</div>
<div id="panel-request-list" class="move-panel display-none">
    @include('employee.request-list')
</div>
<div id="panel-create-request" class="move-panel display-none">
    @include('employee.request-add')
</div>
<div id="panel-import-employee" class="move-panel display-none">
    @include('employee.employee-import')
</div>
<div id="panel-export-employee" class="move-panel display-none">
    @include('employee.employee-export')
</div>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page-employee";

</script>
<script src="{{ url('assets/custom/scripts/employee/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
