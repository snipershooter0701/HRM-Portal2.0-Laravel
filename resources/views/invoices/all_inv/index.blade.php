@extends('layouts.app')

@section('page_template_css')
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-summernote/summernote.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page_css')
<link href="{{ url('assets/custom/css/invoices.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div id="panel_invoice_inv_list" class="move-panel">
    @include('invoices.all_inv.list')
</div>
<div id="panel_invoice_add" class="move-panel display-none">
    @include('invoices.all_inv.add')
</div>
<div id="panel_invoice_client_setting" class="move-panel display-none">
    @include('invoices.all_inv.client_invoice_settings')
</div>
@endsection

@section('page_template_js')
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-summernote/summernote.min.js') }}" type="text/javascript"></script>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page_invoices";
    var PAGE_SUB_ID = "page_invoices_all_inv";

</script>
<script src="{{ url('assets/custom/scripts/invoices/all_inv/index.js?v=' . $randNum) }}" type="text/javascript"></script>
<script src="{{ url('assets/custom/scripts/invoices/all_inv/create.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
