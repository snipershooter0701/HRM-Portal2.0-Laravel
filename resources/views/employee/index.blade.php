@extends('layouts.app')

@section('page_css')
<link href="{{ url('assets/custom/css/employee.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div id="panel-employee-list" class="move-panel ">
    @include('employee.employee_list')
</div>
<div id="panel-create-employee" class="move-panel display-none">
    @include('employee.employee_add')
</div>
<div id="panel-create-details" class="move-panel display-none">
    <h1>Create Details</h1>
</div>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page-employee";

</script>
<script src="{{ url('assets/custom/scripts/employee/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
