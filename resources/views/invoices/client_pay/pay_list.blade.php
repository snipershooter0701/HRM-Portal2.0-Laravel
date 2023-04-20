<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="bread-active">Client Payments</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" data-panelname="panel_client_pay_add"><i class="fa fa-plus-circle"></i> Add Client Payment </button>
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
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-body">
                {{-- BEGIN CLIENT PAYMENT TABLE --}}
                <div class="table-container">
                    <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-4 actions">
                            <div id="tbl_client_pays_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
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
                    <table id="tbl_client_pays" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable">
                                </th>
                                <th width="5%"> No </th>
                                <th width="13%"> Client </th>
                                <th width="10%"> Invoice Number </th>
                                <th width="15%"> Payment Date </th>
                                <th width="10%"> Payment Method </th>
                                <th width="10%"> Due Amount </th>
                                <th width="10%"> Received Amount </th>
                                <th width="10%"> Bank </th>
                                <th width="15%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>

                                {{-- No --}}
                                <td> </td>

                                {{-- Client --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_client">
                                </td>

                                {{-- Invoice Number --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_inv_num">
                                </td>

                                {{-- Payment Date --}}
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_pay_date_from" placeholder="From">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_pay_date_to" placeholder="To">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>

                                {{-- Payment Method --}}
                                <td>
                                    <select name="filt_pay_method" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                    </select>
                                </td>

                                {{-- Reference Number --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm margin-bottom-5" name="filt_receve_due_from" placeholder="From">
                                    <input type="text" class="form-control form-filter input-sm" name="filt_receve_due_to" placeholder="To">
                                </td>

                                {{-- Received Amount --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm margin-bottom-5" name="filt_receve_amount_from" placeholder="From">
                                    <input type="text" class="form-control form-filter input-sm" name="filt_receve_amount_to" placeholder="To">
                                </td>

                                {{-- Bank --}}
                                <td>
                                    <select name="filt_bank" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
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
                {{-- END CLIENT PAYMENT TABLE --}}

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
        <!-- End: life time stats -->
    </div>
</div>
