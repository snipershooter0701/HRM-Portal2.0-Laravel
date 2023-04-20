@extends('layouts.app')

@section('page_template_css')
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('page_css')
<link href="{{ url('assets/custom/css/invoices.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div id="panel_client_pay_list" class="move-panel">
    @include('invoices.client_pay.pay_list')
</div>
<div id="panel_client_pay_add" class="move-panel display-none">
    @include('invoices.client_pay.pay_add')
</div>
@endsection

@section('page_template_js')
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page_invoices";
    var PAGE_SUB_ID = "page_invoices_client_pay";

</script>
<script src="{{ url('assets/custom/scripts/invoices/client_pay/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
