@extends('layouts.app')

@section('page_css')
<link href="{{ url('assets/custom/css/home.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ url('/home') }}">Dashboard</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="#">
                        <i class="icon-bell"></i> Action</a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-shield"></i> Another action</a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-user"></i> Something else here</a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a href="#">
                        <i class="icon-bag"></i> Separated link</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <input id="enc_key" type="text" placeholder="EncKey" />
        <input id="email" type="text" readonly placeholder="Email" />
        <input id="btn_generate" type="button" value="Generate" />
    </div>
</div>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page-dashboard";

</script>
<script src="{{ url('assets/custom/scripts/home/main.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
