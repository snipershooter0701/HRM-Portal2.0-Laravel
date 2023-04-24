<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb ">
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active" data-panelname="panel_all_timesheet_list">Edit Timesheet</a>
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
                            <input type="hidden" id="edit_timesheet_id" class="form-control">
                            <div class="form-group col-sm-3">
                                <label class="control-label">Employee Name<span class="required" aria-required="true">*</span></label>
                                <select id="edit_timesheet_employee" class="form-control">
                                    <option value="">Select...</option>
                                    @php
                                    foreach($employees as $employee) {
                                    echo '<option value="' . $employee->id . '">' . $employee->first_name . ' ' . $employee->last_name . '</option>';
                                    }
                                    @endphp
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label class="control-label">Job Tire<span class="required" aria-required="true">*</span></label>
                                <select id="edit_timesheet_jobtire" class="form-control">
                                    <option value="">Select...</option>
                                    @php
                                    foreach($jobTires as $jobTire) {
                                    echo '<option value="' . $jobTire->id . '">' . $jobTire->name . '</option>';
                                    }
                                    @endphp
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label class="control-label">Work Range<span class="required" aria-required="true">*</span></label>
                                <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input id="edit_timesheet_workrange" type="text" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <label class="control-label">Attachment<span class="required" aria-required="true">*</span></label>
                                <input id="edit_timesheet_attachment" type="file" class="form-control">
                            </div>
                            <input id="edit_timesheet_overtime" type="hidden" value="0">
                            <input id="edit_timesheet_doubletime" type="hidden" value="0">
                        </div>
                        {{--END BASE FORM --}}
                        {{-- BEGIN PLACEMENT FORM --}}
                        <div class="table-container">
                            <table id="tbl_submit_timesheets" class="table table-striped table-bordered table-hover table-checkable">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="15%" class="backcolor-light-grey"> <b>Month-Week No</b> </th>
                                        <th width="10%"> <b>Mon</b> </th>
                                        <th width="10%"> <b>Tue</b> </th>
                                        <th width="10%"> <b>Wed</b> </th>
                                        <th width="10%"> <b>Thu</b> </th>
                                        <th width="10%"> <b>Fri</b> </th>
                                        <th width="10%" class="backcolor-light-grey"> <b>Sat</b> </th>
                                        <th width="10%" class="backcolor-light-grey"> <b>Sun</b> </th>
                                        <th width="15%" class="backcolor-light-grey" rowspan="2"> <button id="btn_submit_edit_add_item" type="button" class="btn btn-sm btn-c-primary">Add Item</button> </th>
                                    </tr>
                                    <tr role="row">
                                        <th width="15%" class="backcolor-light-grey"> <b>Pay Classification</b> </th>
                                        <th id="edit_pay_clf_mon" width="10%"> 20-Feb </th>
                                        <th id="edit_pay_clf_tue" width="10%"> 21-Feb </th>
                                        <th id="edit_pay_clf_wed" width="10%"> 22-Feb </th>
                                        <th id="edit_pay_clf_thu" width="10%"> 23-Feb </th>
                                        <th id="edit_pay_clf_fri" width="10%"> 24-Feb </th>
                                        <th id="edit_pay_clf_sat" width="10%" class="backcolor-light-grey"> 25-Feb </th>
                                        <th id="edit_pay_clf_sun" width="10%" class="backcolor-light-grey"> 26-Feb </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input id="edit_show_order" type="hidden" value="0">
                                    <tr id="time_std" role="row">
                                        <td class="backcolor-light-grey"> <b>Standard Time</b> </td>
                                        <td>
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_std_mon" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="08:00">
                                            </div>
                                        </td>
                                        <td>
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_std_tue" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="08:00">
                                            </div>
                                        </td>
                                        <td>
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_std_wed" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="08:00">
                                            </div>
                                        </td>
                                        <td>
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_std_thu" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="08:00">
                                            </div>
                                        </td>
                                        <td>
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_std_fri" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="08:00">
                                            </div>
                                        </td>
                                        <td class="backcolor-light-grey">
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_std_sat" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="00:00">
                                            </div>
                                        </td>
                                        <td class="backcolor-light-grey">
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_std_sun" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="00:00">
                                            </div>
                                        </td>
                                        <td id="edit_timesheet_std_sum" class="backcolor-light-grey"> 40:00 </td>
                                    </tr>
                                    <tr id="edit_time_over" role="row" class="display-none">
                                        <td class="backcolor-light-grey"> <b>Over Time</b> </td>
                                        <td>
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_over_mon" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="00:00">
                                            </div>
                                        </td>
                                        <td>
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_over_tue" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="00:00">
                                            </div>
                                        </td>
                                        <td>
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_over_wed" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="00:00">
                                            </div>
                                        </td>
                                        <td>
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_over_thu" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="00:00">
                                            </div>
                                        </td>
                                        <td>
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_over_fri" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="00:00">
                                            </div>
                                        </td>
                                        <td class="backcolor-light-grey">
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_over_sat" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="00:00">
                                            </div>
                                        </td>
                                        <td class="backcolor-light-grey">
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_over_sun" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="00:00">
                                            </div>
                                        </td>
                                        <td id="edit_timesheet_over_sum" class="backcolor-light-grey"> 00:00 </td>
                                    </tr>
                                    <tr id="edit_time_double" role="row" class="display-none">
                                        <td class="backcolor-light-grey"> <b>Double Time</b> </td>
                                        <td>
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_double_mon" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="00:00">
                                            </div>
                                        </td>
                                        <td>
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_double_tue" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="00:00">
                                            </div>
                                        </td>
                                        <td>
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_double_wed" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="00:00">
                                            </div>
                                        </td>
                                        <td>
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_double_thu" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="00:00">
                                            </div>
                                        </td>
                                        <td>
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_double_fri" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="00:00">
                                            </div>
                                        </td>
                                        <td class="backcolor-light-grey">
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_double_sat" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="00:00">
                                            </div>
                                        </td>
                                        <td class="backcolor-light-grey">
                                            <div class=" form-group mb-0 ">
                                                <input id="edit_timesheet_double_sun" type="text" class="form-control timepicker timepicker-24 edit-time-picker" value="00:00">
                                            </div>
                                        </td>
                                        <td id="edit_timesheet_double_sum" class="backcolor-light-grey"> 00:00 </td>
                                    </tr>
                                    <tr role="row">
                                        <td class="backcolor-light-grey"> <b>Total Billable Hours</b> </td>
                                        <td id="edit_tot_bill_mon"> 08:00 </td>
                                        <td id="edit_tot_bill_tue"> 08:00 </td>
                                        <td id="edit_tot_bill_wed"> 08:00 </td>
                                        <td id="edit_tot_bill_thu"> 08:00 </td>
                                        <td id="edit_tot_bill_fri"> 08:00 </td>
                                        <td id="edit_tot_bill_sat" class="backcolor-light-grey"> 00:00 </td>
                                        <td id="edit_tot_bill_sun" class="backcolor-light-grey"> 00:00 </td>
                                        <td id="edit_tot_bill_sum" class="backcolor-light-grey"> 40:00 </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- END PLACEMENT FORM --}}
                        {{-- BEGIN REPORT FORM --}}
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label class="control-label">Report <span class="required" aria-required="true">*</span></label>
                                <textarea id="edit_timesheet_report" class="form-control" rows="6" placeholder="Report"></textarea>
                            </div>
                        </div>
                        {{-- END REPORT FORM --}}
                    </div>
                    <div class="form-actions text-right">
                        <button id="btn_edit_timeheet_ok" type="submit" class="btn btn-sm btn-c-primary">Update</button>
                        <button id="btn_edit_timeheet_cancel" type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel_all_timesheet_list">Cancel</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
