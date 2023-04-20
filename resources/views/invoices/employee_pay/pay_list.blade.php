<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="bread-active">Employee Payments</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" data-panelname="panel-invoice-add"><i class="fa fa-plus-circle"></i> Add Employee Payment </button>
            <a id="btn_show_emp_payment" class="btn display-none" data-target="#modal-view-emp-payment" data-toggle="modal"></a>
            <a id="btn_pay_emp_payment" class="btn display-none" data-target="#modal-pay-emp-payment" data-toggle="modal"></a>
            <button type="button" class="btn btn-sm btn-c-grey dropdown-toggle" data-toggle="dropdown"> More
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="javascript:;">
                        <i class="icon-bell"></i> Create Due payments invoice
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="icon-bell"></i> Client invoice settings
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-body">
                {{-- BEGIN EMPLOYEE PAY TABLE --}}
                <div class="table-container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-body">
                                <div class="form-group col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">Date Range</label>
                                    <select class="form-control">
                                        <option>Select</option>
                                        <option>All</option>
                                        <option>Current Week</option>
                                        <option>Last Week</option>
                                        <option>Current Month</option>
                                        <option>Last Month</option>
                                        <option>last 3 Months</option>
                                        <option>Last 6 Months</option>
                                        <option>Custom</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-4 col-xs-6">
                                    <label class="control-label">Frequency</label>
                                    <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input type="text" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 actions">
                            <div id="tbl_employee_pays_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
                                <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-copy"></i></a>
                                <a class="btn-tbl-action btn-move-panel" data-panelname="panel-import-employee"><i class="fa fa-upload"></i></a>
                                <a class="btn-tbl-action btn-move-panel" data-panelname="panel-export-employee"><i class="fa fa-download"></i></a>
                                <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-print"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-actions-wrapper">
                        <span> </span>
                        <select class="table-group-action-input form-control input-inline input-small input-sm">
                            <option value="">Select...</option>
                            <option value="Cancel">Cancel</option>
                            <option value="Cancel">Hold</option>
                            <option value="Cancel">On Hold</option>
                            <option value="Close">Close</option>
                        </select>
                        <button class="btn btn-sm table-group-action-submit btn-c-primary">
                            <i class="fa fa-check"></i> Submit</button>
                    </div>
                    <table id="tbl_employee_pays" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable">
                                </th>
                                <th width="3%"> No </th>
                                <th width="10%"> Employee </th>
                                <th width="10%"> Client </th>
                                <th width="8%"> Month </th>
                                <th width="8%"> Bill Rate </th>
                                <th width="8%"> Pay Rate </th>
                                <th width="8%"> Hours </th>
                                <th width="8%"> Pay Amount </th>
                                <th width="8%"> Paid Amount </th>
                                <th width="8%"> Total Balance </th>
                                <th width="8%"> Status </th>
                                <th width="11%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>

                                {{-- No --}}
                                <td> </td>

                                {{-- Employee --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_emp_name">
                                </td>

                                {{-- Client --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_emp_name">
                                </td>

                                {{-- Month --}}
                                <td>
                                    <select name="filt_status" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="1">January</option>
                                        <option value="2">Febrary</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </td>

                                {{-- Bill Rate --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm margin-bottom-5" name="filt_last_name" placeholder="From">
                                    <input type="text" class="form-control form-filter input-sm" name="filt_last_name" placeholder="To">
                                </td>

                                {{-- Pay Rate --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm margin-bottom-5" name="filt_last_name" placeholder="From">
                                    <input type="text" class="form-control form-filter input-sm" name="filt_last_name" placeholder="To">
                                </td>

                                {{-- Hours --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm margin-bottom-5" name="filt_last_name" placeholder="From">
                                    <input type="text" class="form-control form-filter input-sm" name="filt_last_name" placeholder="To">
                                </td>

                                {{-- Pay Amount --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm margin-bottom-5" name="filt_last_name" placeholder="From">
                                    <input type="text" class="form-control form-filter input-sm" name="filt_last_name" placeholder="To">
                                </td>

                                {{-- Paid Amount --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm margin-bottom-5" name="filt_last_name" placeholder="From">
                                    <input type="text" class="form-control form-filter input-sm" name="filt_last_name" placeholder="To">
                                </td>

                                {{-- Total Balance --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm margin-bottom-5" name="filt_last_name" placeholder="From">
                                    <input type="text" class="form-control form-filter input-sm" name="filt_last_name" placeholder="To">
                                </td>

                                {{-- Status --}}
                                <td>
                                    <select name="filt_status" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="pending">active</option>
                                        <option value="closed">inactive</option>
                                    </select>
                                </td>

                                {{-- Action --}}
                                <td>
                                    <button class="btn btn-xs btn-c-primary filter-submit"><i class="fa fa-search"></i></button>
                                    <button class="btn btn-xs btn-c-grey filter-cancel"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                </div>
                {{-- END EMPLOYEE PAY TABLE --}}

                {{-- BEGIN ACTIVITIES TABLE --}}
                <div class="panel-group accordion mt-30" id="accordion_acts">
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion_acts" href="#collapse_activities" aria-expanded="false"> Activities </a>
                            </h4>
                        </div>
                        <div id="collapse_activities" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                                <div class="table-container">
                                    <table id="tbl_pay_activities" class="table table-striped table-bordered table-hover table-checkable">
                                        <thead>
                                            <tr role="row" class="heading">
                                                <th width="10%"> No </th>
                                                <th width="20%"> Date & Time </th>
                                                <th width="30%"> Updated By </th>
                                                <th width="40%"> Description </th>
                                            </tr>
                                            <tr role="row" class="filter">
                                                {{-- No --}}
                                                <td>
                                                    <button class="btn btn-xs btn-c-primary filter-submit"><i class="fa fa-search"></i></button>
                                                    <button class="btn btn-xs btn-c-grey filter-cancel"><i class="fa fa-times"></i></button>
                                                </td>

                                                {{-- Date & Time --}}
                                                <td>
                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_act_date_from" placeholder="From">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_act_date_to" placeholder="To">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </td>

                                                {{-- Updated by --}}
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="filt_act_updatedby">
                                                </td>

                                                {{-- Description --}}
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="filt_act_description">
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody> </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END ACTIVITIES TABLE --}}
            </div>
        </div>
    </div>
</div>

{{-- BEGIN VIEW PAY MODAL --}}
<div id="modal-pay-emp-payment" class="modal fade" tabindex="-1" data-width="760">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Employee Pay</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="row">
                <div class="form-group col-md-3">
                    <label class="control-label">Pay</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label class="control-label">Paid on</label>
                    <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn default" type="button">
                                <i class="fa fa-calendar"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="mr-10">
                        <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Last Month End
                    </label>
                    <label class="mr-10">
                        <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> This Month Start
                    </label>
                    <label>
                        <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> This Month Mid
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-c-primary">Pay</button>
        <button type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
{{-- END VIEW PAY MODAL --}}

{{-- BEGIN EMPLOYEE PAYMENT VIEW MODAL --}}
<div id="modal-view-emp-payment" class="modal fade" tabindex="-1" data-width="760">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Employee Payments View</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="row">
                <div class="form-group col-md-3">
                    <label class="control-label">Pay[Employee Name]</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label class="control-label">Data Range</label>
                    <select class="form-control">
                        <option>Select</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="table-container">
            <table id="tbl_emp_pay_details" class="table table-striped table-bordered table-hover table-checkable">
                <thead>
                    <tr role="row" class="heading">
                        <th width="10%"> Client </th>
                        <th width="10%"> Month </th>
                        <th width="12%"> Bill Rate </th>
                        <th width="12%"> Pay Rate </th>
                        <th width="10%"> Hours </th>
                        <th width="10%"> Pay Amount </th>
                        <th width="10%"> Paid Amount </th>
                        <th width="14%"> Paid On </th>
                        <th width="12%"> Balance </th>
                    </tr>
                    <tr role="row" class="filter display-none">
                        <td> </td>
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
                <tbody>
                    <tr>
                        <td>Anthony</td>
                        <td>6</td>
                        <td>03/07/2023</td>
                        <td>$1900</td>
                        <td>7</td>
                        <td>5</td>
                        <td>8</td>
                        <td>03/07/2023</td>
                        <td>152</td>
                    </tr>
                    <tr>
                        <td>Anthony</td>
                        <td>6</td>
                        <td>03/07/2023</td>
                        <td>$1900</td>
                        <td>7</td>
                        <td>5</td>
                        <td>8</td>
                        <td>03/07/2023</td>
                        <td>152</td>
                    </tr>
                    <tr>
                        <td colspan="8">Advance</td>
                        <td>152</td>
                    </tr>
                    <tr>
                        <td colspan="8">Service(s)</td>
                        <td>152</td>
                    </tr>
                    <tr>
                        <td colspan="8">Total Balance</td>
                        <td>152</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="form-body">
            <div class="row">
                <div class="form-group col-md-3">
                    <label class="control-label">Pay</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label class="control-label">Paid on</label>
                    <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn default" type="button">
                                <i class="fa fa-calendar"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="mr-10">
                        <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Last Month End
                    </label>
                    <label class="mr-10">
                        <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> This Month Start
                    </label>
                    <label>
                        <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> This Month Mid
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-sm btn-c-grey">Close</button>
    </div>
</div>
{{-- END EMPLOYEE PAYMENT VIEW MODAL --}}