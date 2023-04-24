<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active" data-panelname="panel-awaiting-invoices-list">Awaiting invoices</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
        </div>
    </div>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-body">
                <div class="table-container">
                    <div class="row">
                        <div class="col-md-8">
                            {{-- <button type="button" class="btn btn-sm btn-c-primary"><i class="fa fa-plus-circle"></i> Create Invoice </button> --}}
                        </div>
                        <div class="col-md-4 actions">
                            <div id="time_await_invoices_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
                                <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-copy"></i></a>
                                <a class="btn-tbl-action btn-move-panel" data-panelname="panel-import-employee"><i class="fa fa-upload"></i></a>
                                <a class="btn-tbl-action btn-move-panel" data-panelname="panel-export-employee"><i class="fa fa-download"></i></a>
                                <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-print"></i></a>
                            </div>
                        </div>
                    </div>
                    <table id="time_await_invoices" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="5%"> No </th>
                                <th width="20%"> Employee </th>
                                <th width="20%"> Client </th>
                                <th width="15%"> Invoice Frequency </th>
                                <th width="15%"> Invoice Period </th>
                                <th width="10%"> Total Hours </th>
                                <th width="15%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>

                                {{-- Employee --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_employee">
                                </td>

                                {{-- Client --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_client">
                                </td>

                                {{-- Invoice Frequency --}}
                                <td>
                                    <select name="filt_inv_frequency" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="{{config('constants.INVOICE_FREQUENCY_WEEKLY')}}">Weekly</option>
                                        <option value="{{config('constants.INVOICE_FREQUENCY_BYWEEKLY')}}">By-Weekly</option>
                                        <option value="{{config('constants.INVOICE_FREQUENCY_MONTHLY')}}">Monthly</option>
                                        <option value="{{config('constants.INVOICE_FREQUENCY_QUARTERLY')}}">Quarterly</option>
                                    </select>
                                </td>

                                {{-- Invoice Period --}}
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_inv_period_from" placeholder="From">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_inv_period_to" placeholder="To">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>

                                {{-- Total Hours --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm margin-bottom-5" name="filt_total_hours_from" placeholder="From">
                                    <input type="text" class="form-control form-filter input-sm" name="filt_total_hours_to" placeholder="To">
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
            </div>
        </div>
    </div>
</div>
