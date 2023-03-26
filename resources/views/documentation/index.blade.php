@extends('layouts.app')

@section('page_template_css')
<link href="{{ url('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/jquery-multi-select/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/select2/css/select2.min.css" rel="stylesheet') }}" type="text/css" />
<link href="{{ url('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page_css')
<link href="{{ url('assets/custom/css/documentation.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div id="panel-org-doc-list" class="move-panel">
    @include('documentation.organization.index')
</div>
<div id="panel-org-doc-create" class="move-panel display-none">
    @include('documentation.organization.create')
</div>
<div id="panel-emp-doc-list" class="move-panel display-none">
    @include('documentation.employee.index')
</div>
<div id="panel-exp-doc-list" class="move-panel display-none">
    @include('documentation.expiring.index')
</div>
<div id="panel-group-doc-list" class="move-panel display-none">
    @include('documentation.group.index')
</div>
@endsection

@section('page_template_js')
<script src="{{ url('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page-documentation";

</script>
<script src="{{ url('assets/custom/scripts/documentation/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
