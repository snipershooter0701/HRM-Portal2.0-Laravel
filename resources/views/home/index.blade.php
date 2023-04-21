@extends('layouts.app')

@section('page_template_css')
<link href="{{ url('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/jquery-multi-select/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/select2/css/select2.min.css" rel="stylesheet') }}" type="text/css" />
<link href="{{ url('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" />
@endsection

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
        </div>
    </div>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <h1>Welcome!</h1>
    </div>
    <div class="col-md-12 display-none">
        <input id="enc_key" type="text" style="width: 300px">
        <input id="email" type="text" style="width: 300px">
        <button id="btn_generate" class="btn btn-sm">Generate</button>
    </div>
</div>
@endsection

@section('modal')
    <div id="request_modal" class="modal fade" tabindex="-1" data-width="1200" data-backdrop="static">
        <div class="modal-header">
            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
            <h4 class="modal-title">My Document</h4>
        </div>
        <div class="modal-body">
            <form action="#">
                <div class="form-body">
                    {{-- BEGIN SSN --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="req-add-section-header">
                                <label>
                                    <input type="checkbox" class="icheck req-checkbox req-checkbox" data-checkbox="icheckbox_square-blue" id="req_ssn">
                                </label>
                                <span class="req-header-icon req-star-opt" id="req_ssn_star">
                                    <i class="fa fa-star icon-16"></i>
                                </span>
                                <span class="req-header-title">SSN</span>
                            </div>
                        </div>
                    </div>
                    <div class="row req-add-section-body">
                        <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                            <label class="control-label">Document No</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="ssn_no">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                            <label class="control-label"></label>
                            <input type="file" class="form-control" id="ssn_file">
                        </div>
                    </div>
                    {{-- END SSN --}}
                    {{-- BEGIN Work Authorization --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="req-add-section-header">
                                <label>
                                    <input type="checkbox" class="icheck req-checkbox" data-checkbox="icheckbox_square-blue" id="req_auth">
                                </label>
                                <span class="req-header-icon req-star-opt" id="req_auth_star">
                                    <i class="fa fa-star icon-16"></i>
                                </span>
                                <span class="req-header-title">Work Authorization</span>
                            </div>
                        </div>
                    </div>
                    <div class="req-add-section-body">
                        <div class="row ">
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Work Auth List</label>
                                <select class="form-control" id="auth_list">
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Document No</label>
                                <input type="text" class="form-control" id="auth_no">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Start Date</label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" class="form-control" id="auth_start_date">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">End Date</label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" class="form-control" id="auth_end_date">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label"></label>
                                <input type="file" class="form-control" id="auth_file">
                            </div>
                        </div>
                    </div>
                    {{-- END Work Authorization --}}
                    {{-- BEGIN State ID/Drive License --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="req-add-section-header">
                                <label>
                                    <input type="checkbox" class="icheck req-checkbox" data-checkbox="icheckbox_square-blue" id="req_state">
                                </label>
                                <span class="req-header-icon req-star-opt" id="req_state_star">
                                    <i class="fa fa-star icon-16"></i>
                                </span>
                                <span class="req-header-title">State ID/Drive License</span>
                            </div>
                        </div>
                    </div>
                    <div class="req-add-section-body">
                        <div class="row ">
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Document No</label>
                                <input type="text" class="form-control" id="state_no">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Exp Date</label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" class="form-control" id="state_exp_date">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label"></label>
                                <input type="file" class="form-control" id="state_file">
                            </div>
                        </div>
                    </div>
                    {{-- END State ID/Drive License --}}
                    {{-- BEGIN Passport --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="req-add-section-header">
                                <label>
                                    <input type="checkbox" class="icheck req-checkbox" data-checkbox="icheckbox_square-blue" id="req_passport">
                                </label>
                                <span class="req-header-icon req-star-opt" id="req_passport_star">
                                    <i class="fa fa-star icon-16"></i>
                                </span>
                                <span class="req-header-title">Passport</span>
                            </div>
                        </div>
                    </div>
                    <div class="req-add-section-body">
                        <div class="row ">
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Document No</label>
                                <input type="text" class="form-control" id="passport_no">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Exp Date</label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" class="form-control" id="passport_exp_date">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label"></label>
                                <input type="file" class="form-control" id="passport_file">
                            </div>
                        </div>
                    </div>
                    {{-- END Passport --}}
                    {{-- BEGIN I-94 --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="req-add-section-header">
                                <label>
                                    <input type="checkbox" class="icheck req-checkbox" data-checkbox="icheckbox_square-blue" id="req_i94">
                                </label>
                                <span class="req-header-icon req-star-opt" id="req_i94_star">
                                    <i class="fa fa-star icon-16"></i>
                                </span>
                                <span class="req-header-title">I-94</span>
                            </div>
                        </div>
                    </div>
                    <div class="req-add-section-body">
                        <div class="row ">
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Document No</label>
                                <input type="text" class="form-control" id="i94_no">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Admit Until date</label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" class="form-control" id="i94_admit_date">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label"></label>
                                <div class="radio-list mt-7">
                                    <label class="radio-inline">
                                        <input type="radio" name="optionsRadios1" id="i94_d_s_radio" value="option1" checked> D/S
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="optionsRadios1" id="i94_other_radio" value="option2" > Other
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label"></label>
                                <input type="file" class="form-control" id="i94_file">
                            </div>
                        </div>
                    </div>
                    {{-- END I-94 --}}
                    {{-- BEGIN Visa --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="req-add-section-header">
                                <label>
                                    <input type="checkbox" class="icheck req-checkbox" data-checkbox="icheckbox_square-blue" id="req_visa">
                                </label>
                                <span class="req-header-icon req-star-opt" id="req_visa_star">
                                    <i class="fa fa-star icon-16"></i>
                                </span>
                                <span class="req-header-title">Visa</span>
                            </div>
                        </div>
                    </div>
                    <div class="req-add-section-body">
                        <div class="row ">
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Document No</label>
                                <input type="text" class="form-control" id="visa_no">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Exp Date</label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" class="form-control" id="visa_exp_date">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label"></label>
                                <input type="file" class="form-control" id="visa_file">
                            </div>
                        </div>
                    </div>
                    {{-- END Visa --}}
                    {{-- BEGIN Other Document --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="req-add-section-header">
                                <label>
                                    <input type="checkbox" class="icheck req-checkbox"  data-checkbox="icheckbox_square-blue" id="req_other">
                                </label>
                                <span class="req-header-icon req-star-opt" id="req_other_star">
                                    <i class="fa fa-star icon-16"></i>
                                </span>
                                <span class="req-header-title">Other Document</span>
                                <a id="btn_add_other_doc" href="javascript:;" class="btn-c-no-border-primary text-right"><i class="fa fa-plus-circle icon-16"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="req-add-section-body other-doc">
                        <div class="row row-0" data-id="1">
                            <div class="form-group col-md-2">
                                <label class="control-label">Comment</label>
                                <input type="text" class="form-control other-comment-0" id="other_comment">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="control-label">Document No</label>
                                <input type="text" class="form-control other-no-0" id="other_no">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="control-label">Exp Date</label>
                                <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" class="form-control other-exp-date-0" id="other_exp_date">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label class="control-label"></label>
                                <div class="radio-list mt-7">
                                    <label class="radio-inline">
                                        <input type="radio" id="other_n_a_radio"> N/A
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label class="control-label"></label>
                                <input type="file" class="form-control other-file-0" id="other_file">
                            </div>
                        </div>
                    </div>
                    {{-- END Other Document --}}
                    {{-- BEGIN Comment --}}
                    <div class="row">
                        <div class="col-md-12">
                            <textarea type="text" class="form-control" placeholder="Comments" rows="10" id="req_comment"></textarea>
                        </div>
                    </div>
                    {{-- END Comment --}}
                </div>
                <div class="form-actions text-right mt-20" id="add_req_action">
                    <button type="button" class="btn btn-sm btn-c-primary" id="create_req_details">Create</button>
                    <button type="button" class="btn btn-sm btn-c-grey" data-dismiss="modal" id="req_cancel">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('page_template_js')
<script src="{{ url('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
@endsection

@section('page_js')
<script type="text/javascript">
    var PAGE_ID = "page-dashboard";
    var modal_status = {{ $status }};
</script>
<script src="{{ url('assets/custom/scripts/home/main.js?v=' . $randNum) }}" type="text/javascript"></script>
@endsection
