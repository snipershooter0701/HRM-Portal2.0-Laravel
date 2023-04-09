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
<link href="{{ url('assets/global/plugins/bootstrap-summernote/summernote.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page_css')
<link href="{{ url('assets/custom/css/invoices.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div id="panel-invoice-inv-list" class="move-panel">
    @include('invoices.all-inv.list')
</div>
<div id="panel-invoice-add" class="move-panel display-none">
    @include('invoices.all-inv.add')
</div>
<div id="panel-invoice-client-setting" class="move-panel display-none">
    @include('invoices.all-inv.client-invoice-settings')
</div>
@endsection

@section('page_template_js')
{{-- <script src="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script> --}}
<script src="{{ url('assets/global/plugins/bootstrap-summernote/summernote.min.js') }}" type="text/javascript"></script>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page-invoices";
    var PAGE_SUB_ID = "page-invoices-all-inv";

</script>
<script src="{{ url('assets/custom/scripts/invoices/all_inv/index.js?v=' . $randNum) }}" type="text/javascript"></script>
<script src="{{ url('assets/custom/scripts/invoices/all_inv/create.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
