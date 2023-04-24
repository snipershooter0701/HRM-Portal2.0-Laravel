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
{{-- BEGIN AWITING INVOICES --}}
<div id="panel_awaiting_invoices_list" class="move-panel">
    @include('timesheets.awaiting_invoices.list')
</div>
{{-- END AWITING INVOICES --}}
@endsection

@section('page_template_js')
<script src="{{ url('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page_timesheets";
    var PAGE_SUB_ID = "page_timesheets_awaiting";

</script>
<script src="{{ url('assets/custom/scripts/timesheets/awaiting_invoices/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
