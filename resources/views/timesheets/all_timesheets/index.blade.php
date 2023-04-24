@extends('layouts.app')

@section('page_template_css')
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page_css')
<link href="{{ url('assets/custom/css/timesheets.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
{{-- BEGIN ALL TIMESHEETS --}}
<div id="panel_all_timesheet_list" class="move-panel">
    @include('timesheets.all_timesheets.list')
</div>
<div id="panel_create_timesheet" class="move-panel display-none">
    @include('timesheets.all_timesheets.create')
</div>
<div id="panel_edit_timesheet" class="move-panel display-none">
    @include('timesheets.all_timesheets.edit')
</div>
{{-- END ALL TIMESHEETS --}}
@endsection

@section('page_template_js')
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page_timesheets";
    var PAGE_SUB_ID = "page_timesheets_all";

</script>
<script src="{{ url('assets/custom/scripts/timesheets/all_timesheets/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
