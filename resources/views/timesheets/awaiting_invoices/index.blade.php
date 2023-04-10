@extends('layouts.app')

@section('page_template_css')
{{-- <link href="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/jquery-multi-select/css/multi-select.css')}}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/select2/css/select2.min.css" rel="stylesheet') }}" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> --}}
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page_css')
<link href="{{ url('assets/custom/css/timesheets.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
{{-- BEGIN AWITING INVOICES --}}
<div id="panel-awaiting-invoices-list" class="move-panel">
    @include('timesheets.awaiting_invoices.list')
</div>
{{-- END AWITING INVOICES --}}
@endsection

@section('page_template_js')
{{-- <script src="{{ url('assets/global/scripts/datatable.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script> --}}
<script src="{{ url('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page_timesheets";
    var PAGE_SUB_ID = "page_timesheets_awaiting";

</script>
<script src="{{ url('assets/custom/scripts/timesheets/awaiting_invoices/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
