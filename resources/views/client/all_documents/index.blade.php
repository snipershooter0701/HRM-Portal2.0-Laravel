@extends('layouts.app')

@section('page_template_css')
{{-- <link href="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" /> --}}
<link href="{{ url('assets/global/plugins/icheck/skins/all.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
{{-- <link href="{{ url('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/jquery-multi-select/css/multi-select.css?v=' . $randNum)}}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/select2/css/select2.min.css" rel="stylesheet?v=' . $randNum) }}" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/select2/css/select2-bootstrap.min.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" /> --}}
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('page_css')
<link href="{{ url('assets/custom/css/client.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
<div id="panel-edit-documents" class="move-panel">
    @include('client.all_documents.list')
</div>
<div id="panel-create-document" class="move-panel display-none">
    @include('client.all_documents.add_document')
</div>
@endsection

@section('modal')
@endsection

@section('page_template_js')
{{-- <script src="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js?v=' . $randNum) }}" type="text/javascript"></script> --}}
<script src="{{ url('assets/global/plugins/icheck/icheck.min.js?v=' . $randNum) }}" type="text/javascript"></script>
{{-- <script src="{{ url('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js?v=' . $randNum) }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js?v=' . $randNum) }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/select2/js/select2.full.min.js?v=' . $randNum) }}" type="text/javascript"></script> --}}
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page-client";
    var PAGE_SUB_ID = "page-client-all-documents";

</script>
<script src="{{ url('assets/custom/scripts/client/all_documents/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
