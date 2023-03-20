<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;">Add Expense(s)</a>
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
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="control-label">Expense Category</label>
                                        <select class="form-control">
                                            <option>Select</option>
                                            <option>Employee Expense</option>
                                            <option>Company Expense</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label">Expense Type</label>
                                        <select class="form-control">
                                            <option>Select</option>
                                            <option>Advance</option>
                                            <option>Service(s)</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label">Expense ID</label>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label">Select Employee</label>
                                        <select class="form-control">
                                            <option>Select</option>
                                        </select>
                                    </div>
                                </div>
                                {{--END BASE FORM --}}
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                    <div class="col-md-10 border-left">
                        <div class="row">
                            <div class="col-md-12 float-right">
                                <button type="button" class="btn btn-sm btn-c-primary float-right"><i class="fa fa-plus-circle"></i> Add Bill </button>
                            </div>
                        </div>
                        <div class="table-container right-panel">
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
                                    <tr role="row" class="filter display-none">
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
                            <div class="form-body">
                                {{-- BEGIN EXPENSE FORM --}}
                                <div class="row">
                                    <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                        <label class="control-label">Deduct Amount</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                {{-- END EXPENSE FORM --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions text-right">
                    <button type="submit" class="btn btn-sm btn-c-primary">Save</button>
                    <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-expense-list">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
