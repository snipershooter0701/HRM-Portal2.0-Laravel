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
                <form action="#">
                    <div class="form-body">
                        {{-- BEGIN BASE FORM --}}
                        <div class="row">
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Select Client</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Select Employee</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Invoice Frequency</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Client Billing Address</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">From Address</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Net Terms</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Invoice Created</label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                    <input type="text" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Due Date</label>
                                <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                    <input type="text" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Include POA in Email</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Invoice Requirements</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">CC Emails</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">BCC Emails</label>
                                <input type="text" class="form-control">
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
                                            <th width="5%"> Employee Name </th>
                                            <th width="15%"> Invoice No </th>
                                            <th width="20%"> Invoice Cycle </th>
                                            <th width="15%"> Invoiced Amount </th>
                                            <th width="10%"> Payment Received </th>
                                            <th width="10%"> Due Payment </th>
                                            <th width="10%"> Mode of Payment </th>
                                        </tr>
                                        <tr role="row" class="filter display-none">
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
                                            <label class="control-label">Notes</label>
                                            <textarea class="form-control"></textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Statement Memo</label>
                                            <textarea class="form-control"></textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Invoice Category</label>
                                            <select class="form-control">
                                                <option>Select</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Attachment</label>
                                            <input type="file" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Payable To</label>
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
                        <div name="summernote" id="summernote_1"> </div>
                        {{-- END ADDITIONAL INFO --}}
                    </div>
                    <div class="form-actions text-right">
                        <button type="submit" class="btn btn-sm btn-c-primary">Create</button>
                        <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-invoice-inv-list">Cancel</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
