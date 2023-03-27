<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active" data-panelname="panel-employee-list">Create Request</a>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form action="#">
                    <div class="form-body">
                        {{-- BEGIN BASE FORM --}}
                        <div class="row">
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Employee Name <span class="required" aria-required="true">*</span></label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                        </div>
                        {{--END BASE FORM --}}
                        {{-- BEGIN SSN --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="req-add-section-header">
                                    <label>
                                        <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue">
                                    </label>
                                    <span class="req-header-icon icon-16">
                                        <i class="fa fa-star"></i>
                                    </span>
                                    <span class="req-header-title">SSN</span>
                                </div>
                            </div>
                        </div>
                        <div class="row req-add-section-body">
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Document No</label>
                                <div class="input-group">
                                    <input type="text" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label"></label>
                                <input type="file" class="form-control">
                            </div>
                        </div>
                        {{-- END SSN --}}
                        {{-- BEGIN Work Authorization --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="req-add-section-header">
                                    <label>
                                        <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue">
                                    </label>
                                    <span class="req-header-icon">
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
                                    <select class="form-control">
                                        <option>Select</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">Document No</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">Start Date</label>
                                    <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input type="text" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">End Date</label>
                                    <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input type="text" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label"></label>
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{-- END Work Authorization --}}
                        {{-- BEGIN State ID/Drive License --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="req-add-section-header">
                                    <label>
                                        <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue">
                                    </label>
                                    <span class="req-header-icon">
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
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">Exp Date</label>
                                    <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input type="text" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label"></label>
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{-- END State ID/Drive License --}}
                        {{-- BEGIN Passport --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="req-add-section-header">
                                    <label>
                                        <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue">
                                    </label>
                                    <span class="req-header-icon">
                                        <i class="fa fa-star"></i>
                                    </span>
                                    <span class="req-header-title">Passport</span>
                                </div>
                            </div>
                        </div>
                        <div class="req-add-section-body">
                            <div class="row ">
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">Document No</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">Exp Date</label>
                                    <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input type="text" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label"></label>
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{-- END Passport --}}
                        {{-- BEGIN I-94 --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="req-add-section-header">
                                    <label>
                                        <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue">
                                    </label>
                                    <span class="req-header-icon">
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
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">Admit Until date</label>
                                    <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input type="text" class="form-control">
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
                                            <input type="radio" name="optionsRadios1" id="optionsRadios25" value="option1" checked=""> D/S
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios1" id="optionsRadios26" value="option2" > Other
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label"></label>
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{-- END I-94 --}}
                        {{-- BEGIN Visa --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="req-add-section-header">
                                    <label>
                                        <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue">
                                    </label>
                                    <span class="req-header-icon">
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
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">Exp Date</label>
                                    <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input type="text" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label"></label>
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{-- END Visa --}}
                        {{-- BEGIN Other Document --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="req-add-section-header">
                                    <label>
                                        <input type="checkbox" class="icheck"  data-checkbox="icheckbox_square-blue">
                                    </label>
                                    <span class="req-header-icon">
                                        <i class="fa fa-star icon-16"></i>
                                    </span>
                                    <span class="req-header-title">Other Document</span>
                                    <a id="btn-add-other-doc" href="javascript:;" class="btn-c-no-border-primary text-right"><i class="fa fa-plus-circle icon-16"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="req-add-section-body">
                            <div class="row ">
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">Title</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">Document No</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">Exp Date</label>
                                    <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input type="text" class="form-control">
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
                                            <input type="radio" name="optionsRadios2" id="optionsRadios25" value="option1" checked=""> N/A
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label"></label>
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{-- END Other Document --}}
                        {{-- BEGIN Comment --}}
                        <div class="row">
                            <div class="col-md-12">
                                <textarea type="text" class="form-control" placeholder="Comments" rows="10"></textarea>
                            </div>
                        </div>
                        {{-- END Comment --}}
                    </div>
                    <div class="form-actions text-right mt-20">
                        <button type="submit" class="btn btn-sm btn-c-primary">Register Details</button>
                        <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-request-list">Cancel</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
    <!-- End: life time stats -->
</div>
