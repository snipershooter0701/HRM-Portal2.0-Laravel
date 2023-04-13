@extends('layouts.app')

@section('page_template_css')
<link href="{{ url('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page_css')
<link href="{{ url('assets/custom/css/documentation.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div id="panel-group-doc-list" class="move-panel">
    @include('documentation.group.group_list')
</div>
@endsection

@section('modal')
<div id="modal-create-group" class="modal fade" tabindex="-1" data-width="760" style="padding-right: 0px !important;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Create Group</h4>
    </div>
    <div class="modal-body">
        <form action="javascript:;" class="form-horizontal form-row-seperated">
            <div class="form-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group mr-0 ml-0 ">
                            <label class="control-label">Group Name <span class="required" aria-required="true">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mr-0 ml-0">
                            <label class="control-label">Add Document Titles <span class="required" aria-required="true">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-c-primary">Save</button>
        <button type="button" data-dismiss="modal" class="btn btn-c-grey">Close</button>
    </div>
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
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page_documentation";
    var PAGE_SUB_ID = "page_group_document";
</script>
<script src="{{ url('assets/custom/scripts/documentation/index.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
