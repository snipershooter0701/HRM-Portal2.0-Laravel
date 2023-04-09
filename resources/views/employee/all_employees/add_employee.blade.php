<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active" data-panelname="panel-employee-list">Add Employee</a>
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
                            <div class="form-group col-sm-2">
                                <label class="control-label">First Name <span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control" id="create_first_name">
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="control-label">Middle Name</label>
                                <input type="text" class="form-control" id="create_middle_name">
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="control-label">Last Name <span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control" id="create_last_name">
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="control-label">Title <span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control" id="create_title">
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="control-label">Email Address <span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control" id="create_email_address">
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="control-label">Phone Number <span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control" id="create_phone_num">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label class="control-label">Date of Birth <span class="required" aria-required="true">*</span></label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" class="form-control" id="create_birth">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="control-label">Date of Joining <span class="required" aria-required="true">*</span></label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" class="form-control" id="create_join">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="control-label">Gender <span class="required" aria-required="true">*</span></label>
                                <select class="form-control" id="create_gender">
                                    <option value="">Select</option>
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="control-label">Employment Type <span class="required" aria-required="true">*</span></label>
                                <select class="form-control" id="create_employment_type">
                                    <option value="">Select</option>
                                    <option value="0">Employee</option>
                                    <option value="1">Contractor</option>
                                </select>
                            </div>
                        
                            <div class="form-group col-sm-2">
                                <label class="control-label">Category <span class="required" aria-required="true">*</span></label>
                                <select class="form-control" id="create_category">
                                    <option value="">Select</option>
                                    <option value="0">W2</option>
                                    <option value="1">C2C</option>
                                    <option value="2">1099</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="control-label">Employee Type <span class="required" aria-required="true">*</span></label>
                                <select class="form-control" id="create_employee_type">
                                    <option value="">Select</option>
                                    <option value="0">Employee/Contractor</option>
                                    <option value="1">Back-office Staff</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label class="control-label">Employee ID <span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control" value="45" id="create_employee_id" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="control-label">Employee Status <span class="required" aria-required="true">*</span></label>
                                <select class="form-control" id="create_employee_status">
                                    <option value="">Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="control-label">Employee Status Date</label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                    <input type="text" class="form-control" id="create_employee_status_date" readonly>
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="control-label">Department</label>
                                <select class="form-control" id="create_deparment">
                                    <option value="">Select</option>
                                    <option value="0">HR</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="control-label">Role <span class="required" aria-required="true">*</span></label>
                                <select class="form-control" id="create_role">
                                    <option value="">Select</option>
                                    <option value="0">Employee</option>
                                    <option value="1">Admin</option>
                                    <option value="2">CEO</option>
                                    <option value="3">CTO</option>
                                    <option value="4">Partner</option>
                                    <option value="5">Timesheets Approver</option>
                                    <option value="6">Immigration</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="control-label">Point of Contact (POC) <span class="required" aria-required="true">*</span></label>
                                <select class="form-control" id="create_poc">
                                    <option value="">Select</option>
                                    <option value="0">Lead Names</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label class="control-label">Classification <span class="required" aria-required="true">*</span></label>
                                <select class="form-control" id="create_classification">
                                    <option value="">Select</option>
                                    <option value="1">Billable</option>
                                    <option value="0">Non-Billable</option>
                                </select>
                            </div>
                        </div>
                        {{--END BASE FORM --}}

                        {{-- BEGIN ADDRESS FORM --}}
                        <h4 class="section-head">Address</h4>
                        <hr>
                        <div class="row">
                            <div class="form-group col-lg-2 col-md-3 col-sm-6 col-xs-6">
                                <label class="control-label">Street<span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control" id="create_emp_street">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Suite/Apt No<span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control" id="create_emp_apt">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">City/Town<span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control" id="create_emp_city">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">State<span class="required" aria-required="true">*</span></label>
                                <select class="form-control" id="create_emp_state">
                                    <option value="">Select</option>
                                    <option value="0">caliponia</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Country<span class="required" aria-required="true">*</span></label>
                                <select class="form-control" id="create_emp_country">
                                    <option value="">Select</option>
                                    <option value="0">America</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Zip Code<span class="required" aria-required="true">*</span></label>
                                <input type="text" class="form-control" id="create_emp_zipcode">
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
                                    <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Allow Employee to add Later
                                </label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label class="control-label doc-label">SSN</label>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label">Document No</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
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
                                <div class="form-group col-md-2">
                                    <label class="control-label doc-label">Work Authorization</label>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label">Work Auth List</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label">Document No</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
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
                                <div class="form-group col-md-2">
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
                                <div class="form-group col-md-2">
                                    <label class="control-label"></label>
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label class="control-label doc-label">State ID/Drive License</label>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label">Document No</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
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
                                <div class="form-group col-md-2">
                                    <label class="control-label"></label>
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label class="control-label doc-label">Passport</label>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label">Document No</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
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
                                <div class="form-group col-md-2">
                                    <label class="control-label"></label>
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label class="control-label doc-label">I-94</label>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label">Document No</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
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
                                <div class="form-group col-md-2">
                                    <label class="control-label"></label>
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label class="control-label doc-label">Visa</label>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label">Document No</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
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
                                <div class="form-group col-md-2">
                                    <label class="control-label"></label>
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label class="control-label doc-label">Other Docummment</label>
                                </div>
                                <div class="form-group col-md-10" style="padding-top: 6px;">
                                    <a id="btn-add-other-doc" href="javascript:;" class="btn-c-no-border-primary"><i class="fa fa-plus-circle icon-16"></i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label class="control-label doc-label"></label>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label">Title</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label">Document No</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
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
                                <div class="form-group col-md-2">
                                    <label class="control-label"></label>
                                    <input type="file" class="form-control">
                                </div>
                                <div class="form-group col-md-2" style="padding-top: 15px;">
                                    <a id="btn-remove-other-doc" href="javascript:;" class="btn-c-no-border-primary"><i class="fa fa-minus-circle icon-16"></i></a>
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
                                    <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Add Later
                                </label>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="margin-bottom: 13px;">
                            <div class="col-md-2">
                                <label>
                                    <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" id="create_pay_standard_time" checked> Standard Time
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label>
                                    <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" id="create_pay_over_time"> Over Time
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label>
                                    <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" id="create_pay_double_time"> Double Time
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label class="control-label">Pay Scale</label>
                                <select class="form-control" id="create_pay_scale">
                                    <option value="0">Pay % Scale</option>
                                    <option value="1">Pay Rate Scale</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div id="pay_classification">
                                <div class="form-group col-md-2">
                                    <label class="control-label">Pay % <span class="required" aria-required="true">*</span></label>
                                    <input type="text" class="form-control" value="75" id="create_pay_percent_val">
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label">Change After Hrs <span class="required" aria-required="true">*</span></label>
                                    <input type="text" class="form-control" value="1920" id="create_pay_percent_hrs">
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label">Change Pay % to <span class="required" aria-required="true">*</span></label>
                                    <input type="text" class="form-control" value="80" id="create_pay_percent_to">
                                </div>
                            </div>
                        </div>
                        {{-- END PAY CLASSIFICATION FORM --}}
                        {{-- BEGIN PLACEMENT FORM --}}
                        <div class="row display-none">
                            <div class="col-md-6 ">
                                <h4 class="section-head">Placement List</h4>
                            </div>
                            <div class="col-md-6 section-action">
                                <button type="submit" class="btn btn-sm btn-c-primary">Add Placement</button>
                            </div>
                        </div>
                        <hr class="display-none">
                        <div class="table-container display-none">
                            <table id="tbl_add_placements" class="table table-striped table-bordered table-hover table-checkable">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="10%"> Placement ID </th>
                                        <th width="15%"> Client </th>
                                        <th width="15%"> Status </th>
                                        <th width="10%"> Start Date </th>
                                        <th width="10%"> End Date </th>
                                        <th width="15%"> Total hours </th>
                                        <th width="10%"> Pay Rate/hr </th>
                                        <th width="10%"> Jo Tire </th>
                                    </tr>
                                    <tr role="row" class="filter" style="display:none;">
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                    </tr>
                                </thead>
                                <tbody> </tbody>
                            </table>
                        </div>
                        {{-- END PLACEMENT FORM --}}
                        {{-- BEGIN ACTIVITIES FORM --}}

                        <div class="panel-group accordion mt-30" id="accordion3">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1" aria-expanded="false"> Activities </a>
                                    </h4>
                                </div>
                                <div id="collapse_3_1" class="panel-collapse collapse" aria-expanded="false">
                                    <div class="panel-body">
                                        <div class="table-container">
                                            <table id="tbl_emp_activity" class="table table-striped table-bordered table-hover table-checkable">
                                                <thead>
                                                    <tr role="row" class="heading">
                                                        <th width="10%"> No </th>
                                                        <th width="30%"> Date & Time </th>
                                                        <th width="20%"> Updated By </th>
                                                        <th width="40%"> Description </th>
                                                    </tr>

                                                    <tr role="row" class="filter">
                                                        <td> </td>
                        
                                                        {{-- Date & Time--}}
                                                        <td>
                                                            <input type="text" class="form-control form-filter input-sm" name="filt_act_date_time"> </td>
                        
                                                        {{-- updated_by --}}
                                                        <td>
                                                            <input type="text" class="form-control form-filter input-sm" name="filt_act_updated_by"> </td>
                        
                                                        {{-- description --}}
                                                        <td>
                                                            <input type="text" class="form-control form-filter input-sm" name="filt_act_description"> </td>
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
                    <div class="form-actions text-right" id="add_emp_action">
                        <button type="button" class="btn btn-sm btn-c-primary" id="signup_employee">Register</button>
                        <button type="button" class="btn btn-sm btn-c-grey page-move-btn" data-panelname="panel-employee-list">Cancel</button>
                    </div>
                    <div class="form-actions text-right hide" id="update_emp_action">
                        <button type="button" class="btn btn-sm btn-c-primary" id="update_employee">Update</button>
                        <button type="button" class="btn btn-sm btn-c-grey page-move-btn" data-panelname="panel-employee-list">Cancel</button>
                    </div>
                    <div class="form-actions text-right hide" id="view_emp_action">
                        <button type="button" class="btn btn-sm btn-c-grey page-move-btn" data-panelname="panel-employee-list">Cancel</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
