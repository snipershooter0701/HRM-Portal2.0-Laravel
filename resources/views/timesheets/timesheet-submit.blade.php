<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb ">
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active" data-panelname="panel-all-timesheet-list">Submit Timesheets</a>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form action="javascript:;">
                    <div class="form-body">
                        {{-- BEGIN BASE FORM --}}
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                <label class="control-label">Employee Name</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                <label class="control-label">Job Title</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                <label class="control-label">Work Range</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                <label class="control-label">Attachment</label>
                                <input type="file" class="form-control">
                            </div>
                        </div>
                        <hr>
                        {{--END BASE FORM --}}
                        {{-- BEGIN PLACEMENT FORM --}}
                        <div class="table-container">
                            <table id="tbl_submit_timesheets" class="table table-striped table-bordered table-hover table-checkable">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="15%"> Month-Week No </th>
                                        <th width="10%"> Mon </th>
                                        <th width="10%"> Tue </th>
                                        <th width="10%"> Wed </th>
                                        <th width="10%"> Thu </th>
                                        <th width="10%"> Fri </th>
                                        <th width="10%"> Sat </th>
                                        <th width="10%"> Sun </th>
                                        <th width="15%"> Add Item </th>
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
                                <tbody> </tbody>
                            </table>
                        </div>
                        <hr>
                        {{-- END PLACEMENT FORM --}}
                        {{-- BEGIN REPORT FORM --}}
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <textarea class="form-control" rows="6" placeholder="Report"></textarea>
                            </div>
                        </div>
                        {{-- END REPORT FORM --}}
                    </div>
                    <div class="form-actions text-right">
                        <button type="submit" class="btn btn-sm btn-c-primary">Submit</button>
                        <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-all-timesheet-list">Cancel</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
