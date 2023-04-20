<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="bread-active">Create Invoice</a>
        </li>
    </ul>
    <div class="page-toolbar">
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
                <div class="form-body">
                    {{-- BEGIN BASE FORM --}}
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">Select Client <span class="required" aria-required="true">*</span></label>
                            <select id="add_invoice_client" class="form-control">
                                <option value="">Select...</option>
                                @php
                                foreach($clients as $client) {
                                echo '<option value="' . $client->id . '">' . $client->business_name . '</option>';
                                }
                                @endphp
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Select Employee <span class="required" aria-required="true">*</span></label>
                            <select id="add_invoice_employee" class="form-control">
                                <option value="">Select...</option>
                                @php
                                foreach($employees as $employee) {
                                echo '<option value="' . $employee->id . '">' . $employee->first_name . ' ' . $employee->last_name . '</option>';
                                }
                                @endphp
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Invoice Frequency <span class="required" aria-required="true">*</span></label>
                            <select id="add_invoice_invfrequency" class="form-control">
                                <option value="">Select...</option>
                                <option value="{{ config('constants.INVOICE_FREQUENCY_WEEKLY') }}">Weekly</option>
                                <option value="{{ config('constants.INVOICE_FREQUENCY_BYWEEKLY') }}">By-Weekly</option>
                                <option value="{{ config('constants.INVOICE_FREQUENCY_MONTHLY') }}" selected>Monthly</option>
                                <option value="{{ config('constants.INVOICE_FREQUENCY_QUARTERLY') }}">Quarterly</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Net Terms <span class="required" aria-required="true">*</span></label>
                            <input id="add_invoice_netterms" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">Client Billing Address <span class="required" aria-required="true">*</span></label>
                            <textarea id="add_invoice_client_address" type="text" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">From Address <span class="required" aria-required="true">*</span></label>
                            <textarea id="add_invoice_from_address" type="text" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">CC Emails</label>
                            <textarea id="add_invoice_cc_emails" type="text" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">BCC Emails</label>
                            <textarea id="add_invoice_bcc_emails" type="text" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">Invoice Created <span class="required" aria-required="true">*</span></label>
                            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                <input id="add_invoice_created" type="text" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Due Date <span class="required" aria-required="true">*</span></label>
                            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                <input id="add_invoice_dueddate" type="text" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Include PO Attachment in Email</label>
                            <select id="add_invoice_include_po_attachment" class="form-control">
                                <option value="">Select...</option>
                                <option value="{{ config('constants.STATE_ACTIVE') }}">Yes</option>
                                <option value="{{ config('constants.STATE_INACTIVE') }}">No</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Invoice Recipient <span class="required" aria-required="true">*</span></label>
                            <input id="add_invoice_invoice_recipient" type="text" class="form-control">
                        </div>
                    </div>
                    {{--END BASE FORM --}}

                    {{-- BEGIN SERVICE SUMMARY --}}
                    <h4 class="section-head">Service Summary</h4>
                    <hr>
                    <div class="table-container">
                        <table id="tbl_inv_add_svc_smry" class="table table-striped table-bordered table-hover table-checkable">
                            <thead>
                                <tr role="row" class="heading">
                                    <th width="5%"> S.No </th>
                                    <th width="15%"> Service Summary </th>
                                    <th width="20%"> Activity </th>
                                    <th width="15%"> Quantity (hrs/days) </th>
                                    <th width="10%"> Rate </th>
                                    <th width="10%"> Amount </th>
                                    <th width="10%"> Attachment </th>
                                    <th width="15%"> Actions </th>
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
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>
                    </div>
                    {{-- END SERVICE SUMMARY --}}

                    {{-- BEGIN NOTE & TOTAL --}}
                    <h4 class="section-head">Notes & Total</h4>
                    <hr>
                    <div>
                        <div class="table-container">
                            <table id="tbl_inv_add_note_total" class="table table-striped table-bordered table-hover table-checkable">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="10%"> Employee Name </th>
                                        <th width="10%"> Invoice No </th>
                                        <th width="20%"> Invoice Cycle </th>
                                        <th width="15%"> Invoiced Amount </th>
                                        <th width="10%"> Payment Received </th>
                                        <th width="10%"> Due Payment </th>
                                        <th width="10%"> Mode of Payment </th>
                                    </tr>
                                <tbody> </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="optionsRadios" id="optionsRadios25" value="option1" checked=""> Add Due Invoice
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="optionsRadios" id="optionsRadios26" value="option2" checked=""> In Email
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="optionsRadios" id="optionsRadios26" value="option2" checked=""> In Invoice
                                    </label>
                                </div>
                                <div class="row form-body mt-30">
                                    <div class="form-group col-md-6">
                                        <label id="add_invoice_notes" class="control-label">Notes</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label id="add_invoice_statement_memo" class="control-label">Statement Memo</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label id="add_invoice_attachment" class="control-label">Attachment</label>
                                        <input type="file" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label id="add_invoice_payable_to" class="control-label">Payable To</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                                <div class="note-total">
                                    <p>Due Total: $0.00</p>
                                    <p>Grand Total: $0.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- END NOTE & TOTAL --}}

                    {{-- BEGIN ADDITIONAL INFO --}}
                    <h4 class="section-head">Additional Info</h4>
                    <hr>
                    <div name="summernote" id="summernote_addinfo"> </div>
                    {{-- END ADDITIONAL INFO --}}
                </div>
                <div class="form-actions text-right">
                    <button id="btn_create_invoice_ok" type="submit" class="btn btn-sm btn-c-primary">Create</button>
                    <button id="btn_create_invoice_cancel" type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel_invoice_inv_list">Cancel</button>
                </div>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
