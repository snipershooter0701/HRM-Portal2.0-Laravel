<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active" data-panelname="panel-expense-list">Expense List</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel" data-panelname="panel-expense-add"><i class="fa fa-plus-circle"></i> Add Expense </button>
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
                <div class="table-container">
                    <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-4 actions">
                            <div id="tbl_expenses_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
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
                            <option value="delete">Delete</option>
                        </select>
                        <button class="btn btn-sm table-group-action-submit btn-c-primary">
                            <i class="fa fa-check"></i> Submit
                        </button>
                    </div>
                    <table id="tbl_expenses" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable">
                                </th>
                                <th width="5%"> No </th>
                                <th width="20%"> Expenses Category </th>
                                <th width="20%"> Employee </th>
                                <th width="15%"> Amount </th>
                                <th width="20%"> Expense Type </th>
                                <th width="18%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td> </td>

                                {{-- Expenses Category --}}
                                <td>
                                    <select name="filt_expenses_category" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="pending">Employee Expense</option>
                                        <option value="closed">Company Expense</option>
                                    </select>
                                </td>

                                {{-- Employee --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_employee">
                                </td>

                                {{-- Amount --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm margin-bottom-5" name="filt_amount" placeholder="From">
                                    <input type="text" class="form-control form-filter input-sm" name="filt_amount" placeholder="To">
                                </td>

                                {{-- Expense Type --}}
                                <td>
                                    <select name="filt_expense_type" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="pending">Advance</option>
                                        <option value="closed">Service(s)</option>
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
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <label class="expenses-total">
                                <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Total of the above shown Expense(s)
                            </label>
                            <input type="text" class="form-control form-filter input-sm auto-width" placeholder="Total" id="expense_total">
                        </div>
                    </div>
                </div>
                <h4 class="section-head">Activities</h4>
                <hr>
                <div class="table-container">
                    <table id="tbl_expense_activities" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="5%"> No </th>
                                <th width="25%"> Date & Time </th>
                                <th width="25%"> Updated By </th>
                                <th width="45%"> Description </th>
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
        <!-- End: life time stats -->
    </div>
</div>
