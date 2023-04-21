@extends('layouts.app')

@section('page_template_css')
{{-- <link href="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/jquery-multi-select/css/multi-select.css')}}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/select2/css/select2.min.css" rel="stylesheet') }}" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" /> --}}
@endsection

@section('page_css')
<link href="{{ url('assets/custom/css/settings.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div id="panel_setting_backup">
    <!-- BEGIN PAGE HEADER-->
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar c-page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="javascript:;" class="btn-move-panel bread-active">Backup and Download</a>
            </li>
        </ul>
    </div>

    <!-- END PAGE BAR -->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-body">
                    <a id="download_file_latest" class="display-none" href="{{ $last != null ? url('/storage/backup/' . $last->name) : '' }}">1</a>
                    <a id="download_file_old" class="display-none" href="{{ $old != null ? url('/storage/backup/' . $old->name) : '' }}">1</a>
                    <iframe id="my_iframe" style="display:none;"></iframe>
                    <div class="row">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-4">Database Backup</label>
                                <div class="col-md-8">
                                    <p id="span_availalble" class="backup-info {{ $last != null ? '' : 'display-none' }}"><i class="backup-icon-avaiable fa fa-check"></i> Available</p>
                                    <p id="span_unavailalble" class="backup-info {{ $last != null ? 'display-none' : '' }}"><i class="backup-icon-unavaiable fa fa-close"></i> Unavailable</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-4">File Information</label>
                                <div class="col-md-8">
                                    <div id="file_info_exist" class="{{$last != null ? '' : 'display-none'}}">
                                        <p class="backup-info">File Name: <b id="backup_filename">{{ $last != null ? $last->name : '' }}</b></p>
                                        <p class="backup-info">Size: <b id="backup_filesize">{{ $last != null ? (round($last->size / 1024, 2)) : '' }} KB ({{ $last != null ? $last->size : '' }} bytes)</b></p>
                                        <p class="backup-info">Backup Date: <b id="backup_date">{{ $last != null ? $last->created_at : '' }} ({{ $last != null ? Carbon\Carbon::now()->diffInDays(date_create($last->created_at)) : '' }} days ago)</b></p>
                                    </div>
                                    <div id="file_info_no" class="{{$last != null ? 'display-none' : ''}}">
                                        <p class="backup-info">No Information</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-4">Auto Backup</label>
                                <div class="col-md-4">
                                    <select id="backup_auto" class="form-control">
                                        <option value="{{ config('constants.BACKUP_NONE') }}">None</option>
                                        <option value="{{ config('constants.BACKUP_DAILY') }}">Daily</option>
                                        <option value="{{ config('constants.BACKUP_WEEKILY') }}">Weekly</option>
                                        <option value="{{ config('constants.BACKUP_BIWEEKLY') }}">Bi Weekly</option>
                                        <option value="{{ config('constants.BACKUP_MONTHLY') }}">Monthly</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <button id="btn_download_custom" type="button" class="btn btn-lg btn-c-primary mt-20 pl-30 pr-30"><i class="fa fa-download"></i> Download Current One</button>
                        </div>
                        <div class="col-md-4 text-center">
                            <button id="btn_download_auto_new" type="button" class="btn btn-lg btn-c-primary mt-20 pl-30 pr-30 {{ $last == null ? 'display-none' : '' }}"><i class="fa fa-download"></i> Download Latest One </button>
                        </div>
                        <div class="col-md-4 text-center">
                            <button id="btn_download_auto_old" type="button" class="btn btn-lg btn-c-primary mt-20 pl-30 pr-30 {{ $old == null ? 'display-none' : '' }}"><i class="fa fa-download"></i> Download Old One </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
@endsection

@section('page_template_js')
{{-- <script src="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script> --}}
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page_settings";
    var PAGE_SUB_ID = "page_settings_backup";

</script>
<script src="{{ url('assets/custom/scripts/settings/backup/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
