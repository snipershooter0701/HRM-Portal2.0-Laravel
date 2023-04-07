<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active" data-panelname="panel-expense-list">Add Expense(s)</a>
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
                <div class="row">
                    <div class="col-md-2">
                        <!-- BEGIN FORM-->
                        <form action="#" class="left-panel">
                            <div class="form-body">
                                {{-- BEGIN BASE FORM --}}
                                <div class="row border-right">
                                    <div class="form-group col-md-12">
                                        <label class="control-label">Expense Category</label>
                                        <select class="form-control" id="expense_category">
                                            <option value="">Select</option>
                                            <option value="0">Employee Expense</option>
                                            <option value="1">Company Expense</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label">Expense Type</label>
                                        <select class="form-control" id="expense_type">
                                            <option value="">Select</option>
                                            <option value="0">Advance</option>
                                            <option value="1">Service(s)</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label">Expense ID</label>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label">Select Employee</label>
                                        <select class="form-control" id="expense_emp">
                                            <option value="">Select</option>
                                            <option value="8">qqqqqqq</option>
                                        </select>
                                    </div>
                                </div>
                                {{--END BASE FORM --}}
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-12 float-right">
                                <button type="button" class="btn btn-sm btn-c-primary float-right" id="add_bill" data-idx="1"><i class="fa fa-plus-circle"></i> Add Bill </button>
                            </div>
                        </div>
                        <div class="table-container right-panel mt-20">
                            <table id="tbl_add_expenses" class="table table-striped table-bordered table-hover table-checkable" style="margin-top: 0px !important;">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="5%"> No </th>
                                        <th width="15%"> Date </th>
                                        <th width="30%"> Expense Details </th>
                                        <th width="15%"> Amount </th>
                                        <th width="20%"> Attachment </th>
                                        <th width="15%"> Action </th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                <input type="text" class="form-control input-sm bill-date-1">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-sm default" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control input-sm bill-detail-1">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control input-sm bill-amount-1">
                                        </td>
                                        <td>
                                            <input type="file" class="form-control input-sm bill-attachment bill-attachment-1">
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-actions text-right" id="add_expense_action">
                    <button type="submit" class="btn btn-sm btn-c-primary" id="save_expense">Save</button>
                    <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-expense-list">Cancel</button>
                </div>
                <div class="form-actions text-right hide" id="update_expense_action">
                    <button type="submit" class="btn btn-sm btn-c-primary" id="update_expense">Update</button>
                    <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-expense-list">Cancel</button>
                </div>
                <div class="form-actions text-right hide" id="view_expense_action">
                    <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-expense-list">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
