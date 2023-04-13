<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="bread-active">Ticket List</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" id="create_ticket_btn" data-panelname="panel-ticket-create"><i class="fa fa-plus-circle"></i> Create Ticket </button>
            <button id="btn_show_user_tickets" type="button" class="btn btn-sm btn-c-primary btn-move-panel display-none" data-panelname="panel-ticket-user"><i class="fa fa-plus-circle"></i> Show User Ticket </button>
            <a id="btn_show_ticket" class="btn display-none" data-target="#modal_view_ticket" data-toggle="modal"></a>
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
                            <div id="tbl_tickets_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
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
                    <table id="tbl_tickets" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable">
                                </th>
                                <th width="4%"> No </th>
                                <th width="10%"> Employee Name </th>
                                <th width="10%"> Subject </th>
                                <th width="10%"> Department </th>
                                <th width="10%"> Assigned to </th>
                                <th width="15%"> Created On </th>
                                <th width="15%"> Closed On </th>
                                <th width="10%"> Status </th>
                                <th width="14%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>

                                {{-- No --}}
                                <td> </td>

                                {{-- Employee Name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_emp_name">
                                </td>

                                {{-- Subject --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_emp_name">
                                </td>

                                {{-- Department --}}
                                <td>
                                    <select name="filt_status" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                    </select>
                                </td>

                                {{-- Assigned to --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_emp_name">
                                </td>

                                {{-- Created On --}}
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_join_date_from" placeholder="From">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_join_date_to" placeholder="To">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>

                                {{-- Closed On --}}
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_join_date_from" placeholder="From">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_join_date_to" placeholder="To">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
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
                                    <table id="tbl_pay_activities" class="table table-striped table-bordered table-hover table-checkable">
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
                    </div>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>

<div id="modal_view_ticket" class="modal fade" tabindex="-1" data-width="900">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Ticket</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group col-sm-12">
                        <label class="col-sm-5 control-label pd-0 text-right">Employee Name:</label>
                        <label class="col-sm-7 control-label" id="view_emp_name"></label>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-5 control-label pd-0 text-right">Ticket No:</label>
                        <label class="col-sm-7 control-label" id="view_ticket_no"></label>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-5 control-label pd-0 text-right">Subject:</label>
                        <label class="col-sm-7 control-label" id="view_subject"></label>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-5 control-label pd-0 text-right">Explain Briefly:</label>
                        <label class="col-sm-7 control-label" id="view_details"></label>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-5 control-label pd-0 text-right">Status:</label>
                        <label class="col-sm-7 control-label" id="view_status"></label>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-5 control-label pd-0 text-right">Assigned To:</label>
                        <label class="col-sm-7 control-label" id="view_assigned_to"></label>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-5 control-label pd-0 text-right">Created On:</label>
                        <label class="col-sm-7 control-label" id="view_created_on"></label>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-5 control-label pd-0 text-right">Closed On:</label>
                        <label class="col-sm-7 control-label" id="view_closed_on"></label>
                    </div>
                    <div class="form-group col-sm-12">
                        <input type="file" class="form-control" id="view_file">
                    </div>
                </div>
                <div class="col-sm-8">
                    <div>Discussion:</div>
                    <div class="discussion-chat">
                        <div class="chat-message">
                            <div class="post out">
                                <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar3.jpg" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Bob Nilson</a>
                                    <span class="datetime">20:15</span>
                                    <span class="body"> When could you send me the report ? </span>
                                </div>
                            </div>
                            <div class="post in">
                                <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar2.jpg" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Ella Wong</a>
                                    <span class="datetime">20:15</span>
                                    <span class="body"> Its almost done. I will be sending it shortly </span>
                                </div>
                            </div>
                            <div class="post out">
                                <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar3.jpg" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Bob Nilson</a>
                                    <span class="datetime">20:15</span>
                                    <span class="body"> When could you send me the report ? </span>
                                </div>
                            </div>
                            <div class="post in">
                                <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar2.jpg" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Ella Wong</a>
                                    <span class="datetime">20:15</span>
                                    <span class="body"> Its almost done. I will be sending it shortly </span>
                                </div>
                            </div>
                        </div>
                        <div class="chat-form">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Type a message here...">
                                <div class="input-group-btn">
                                    <button type="button" class="btn green" id="ticket_discuss">
                                        <i class="icon-paper-clip"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer display-none">
        <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
        <button type="button" class="btn green">Save changes</button>
    </div>
</div>
