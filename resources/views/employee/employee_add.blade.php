<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ url('/employee') }}">Add Employee</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-sm btn-c-grey dropdown-toggle" data-toggle="dropdown"> More
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="#">
                        <i class="icon-bell"></i> Request Details</a>
                </li>
            </ul>
        </div>
    </div>
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
                                <label class="control-label">First Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Middle Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Last Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Job Title</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Email Address</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Phone Number</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Date of Birth</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Date of Birth</label>
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
                                <label class="control-label">Employee Title</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Date of Joining</label>
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
                                <label class="control-label">Gender</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Employment Type</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Category</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Employee Type</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Employee ID</label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Employee Status</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Department</label>
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
                                <label class="control-label">Role</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Point of Contact (POC)</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Classification</label>
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
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
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
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Zip Code</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        {{-- END ADDRESS FORM --}}

                        {{-- BEGIN DOCUMENTATION FORM --}}
                        <h4 class="section-head">Documentation</h4>
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
                                    <label class="control-label"></label>
                                    <input type="file" class="form-control">
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
                                    <label class="control-label doc-label">1-94</label>
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
                                    <a id="btn-add-other-doc" href="javascript:;" class="btn-tbl-action btn-c-no-border-primary"><i class="fa fa-plus-circle"></i></a>
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
                                    <a id="btn-remove-other-doc" href="javascript:;" class="btn-tbl-action btn-c-no-border-primary"><i class="fa fa-minus-circle"></i></a>
                                </div>
                            </div>
                        </div>
                        {{-- END DOCUMENTATION FORM --}}

                        {{-- BEGIN PAY CLASSIFICATION FORM --}}
                        <div class="row">
                            <div class="col-md-6 ">
                                <h4 class="section-head">Pay Classification</h4>
                            </div>
                            <div class="col-md-6 section-action">
                                <label class="checkbox-inline">
                                    <label>
                                        <input type="checkbox" class="icheck"> Add Later
                                    </label>
                                </label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-2">
                                <label>
                                    <input type="checkbox" class="icheck"> Standard Time
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label>
                                    <input type="checkbox" class="icheck"> Over Time
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label>
                                    <input type="checkbox" class="icheck"> Double Time
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label class="control-label">Pay Scale</label>
                                <select class="form-control">
                                    <option>Pay % Scale</option>
                                    <option>Pay Rate Scale</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label class="control-label">Pay %</label>
                                <input type="text" class="form-control" value="75">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="control-label">Change After Hrs</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="control-label">Change Pay % to</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        {{-- END PAY CLASSIFICATION FORM --}}
                        {{-- BEGIN PLACEMENT FORM --}}
                        <div class="row">
                            <div class="col-md-6 ">
                                <h4 class="section-head">Placement List</h4>
                            </div>
                            <div class="col-md-6 section-action">
                                <button type="submit" class="btn btn-sm btn-c-primary">Add Placement</button>
                            </div>
                        </div>
                        <hr>
                        <div class="table-container">
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
                    </div>
                    <div class="form-actions text-right">
                        <button type="submit" class="btn btn-sm btn-c-primary">Register</button>
                        <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-employee-list">Cancel</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
