<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active" data-panelname="panel-employee-list">View Employee</a>
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
                                <label class="control-label">First Name <span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Middle Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Last Name <span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Title <span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Email Address <span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Phone Number <span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Date of Birth <span class="required" aria-required="true">*</span></label>
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
                                <label class="control-label">Date of Joining <span class="required" aria-required="true">*</span></label>
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
                                <label class="control-label">Gender <span class="required" aria-required="true">*</span></label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Employment Type <span class="required" aria-required="true">*</span></label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Category <span class="required" aria-required="true">*</span></label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Employee Type <span class="required" aria-required="true">*</span></label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Employee ID <span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Employee Status <span class="required" aria-required="true">*</span></label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Employee Status Date</label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                    <input type="text" class="form-control" readonly>
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Department</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Role <span class="required" aria-required="true">*</span></label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Point of Contact (POC) <span class="required" aria-required="true">*</span></label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Classification <span class="required" aria-required="true">*</span></label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                        </div>
                        {{--END BASE FORM --}}

                        {{-- BEGIN ADDRESS FORM --}}
                        <h4 class="section-head">Address</h4>
                        <hr>
                        <div class="row">
                            <div class="form-group col-lg-2 col-md-3 col-sm-6 col-xs-6">
                                <label class="control-label">Street</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Suite/Apt No</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">City/Town</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">State</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Country</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Zip Code</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        {{-- END ADDRESS FORM --}}

                        {{-- BEGIN DOCUMENTATION FORM --}}
                        <div class="row">
                            <div class="col-md-6 ">
                                <h4 class="section-head">Documentation</h4>
                            </div>
                            <div class="col-md-6 section-action mt-25 text-right">
                                <label>
                                    <input type="checkbox" class="icheck"> Allow Employee to add Later
                                </label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="row">
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label doc-label">SSN</label>
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">Document No</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label"> </label>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="input-group">
                                            <div class="form-control uneditable-input" data-trigger="fileinput">
                                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                <span class="fileinput-filename"> </span>
                                            </div>
                                            <span class="input-group-btn input-group-addon btn default btn-file">
                                                <button class="btn default fileinput-new" type="button">
                                                    <i class="fa fa-upload"></i>
                                                </button>
                                                <button class="btn default fileinput-exists" type="button">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <input type="file" name="...">
                                            </span>
                                            <button class="btn red input-group-btn fileinput-exists" data-dismiss="fileinput" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label doc-label">Work Authorization</label>
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">Work Auth List</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">Document No</label>
                                    <input type="text" class="form-control">
                                </div>
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
                            <div class="row">
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label doc-label">State ID/Drive License</label>
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
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label doc-label">Passport</label>
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
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label doc-label">I-94</label>
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">Document No</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">Admit Until date</label>
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="optionsRadios25" value="option1" checked=""> D/S
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="optionsRadios26" value="option2" checked=""> Other
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label"></label>
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label doc-label">Visa</label>
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
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label doc-label">Other Docummment</label>
                                </div>
                                <div class="form-group col-md-10" style="padding-top: 6px;">
                                    <a id="btn-add-other-doc" href="javascript:;" class="btn-tbl-action btn-c-no-border-primary"><i class="fa fa-plus-circle icon-16"></i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label doc-label"></label>
                                </div>
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
                                    <input type="file" class="form-control">
                                </div>
                                <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6" style="padding-top: 15px;">
                                    <a id="btn-remove-other-doc" href="javascript:;" class="btn-tbl-action btn-c-no-border-primary"><i class="fa fa-minus-circle icon-16"></i></a>
                                </div>
                            </div>
                        </div>
                        {{-- END DOCUMENTATION FORM --}}

                        {{-- BEGIN PAY CLASSIFICATION FORM --}}
                        <div class="row">
                            <div class="col-md-6 ">
                                <h4 class="section-head">Pay Classification</h4>
                            </div>
                            <div class="col-md-6 section-action mt-25 text-right">
                                <label>
                                    <input type="checkbox" class="icheck"> Add Later
                                </label>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="margin-bottom: 13px;">
                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label>
                                    <input type="checkbox" class="icheck"> Standard Time
                                </label>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label>
                                    <input type="checkbox" class="icheck"> Over Time
                                </label>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label>
                                    <input type="checkbox" class="icheck"> Double Time
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Pay Scale</label>
                                <select class="form-control">
                                    <option>Pay % Scale</option>
                                    <option>Pay Rate Scale</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Pay % <span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control" value="75">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Change After Hrs <span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Change Pay % to <span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        {{-- END PAY CLASSIFICATION FORM --}}
                        {{-- BEGIN ACTIVITIES FORM --}}
                        <div class="panel-group accordion mt-30" id="accordion1">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_1" aria-expanded="false"> Activities </a>
                                    </h4>
                                </div>
                                <div id="collapse_1_1" class="panel-collapse collapse" aria-expanded="false">
                                    <div class="panel-body">
                                        <div class="table-container">
                                            <table id="tbl_view_emp_activities" class="table table-striped table-bordered table-hover table-checkable">
                                                <thead>
                                                    <tr role="row" class="heading">
                                                        <th width="10%"> No </th>
                                                        <th width="20%"> Date & Time </th>
                                                        <th width="30%"> Updated By </th>
                                                        <th width="40%"> Description </th>
                                                    </tr>
                                                    <tr role="row" class="filter display-none">
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                    </tr>
                                                </thead>
                                                <tbody> </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END ACTIVITIES FORM --}}
                    </div>
                    <div class="form-actions text-right">
                        <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-employee-list">Cancel</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
