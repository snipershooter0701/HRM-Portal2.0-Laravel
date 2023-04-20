<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="bread-active">Invoice Settings</a>
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
                    <div class="row mb-10">
                        <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                            <label class="control-label">Include PO Attachment in Email</label>
                            <select class="form-control">
                                <option>Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="form-group col-lg-12">
                            <label>
                                <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Auto Invoicing
                            </label>
                            <div class="radio-list">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="radio-inline">
                                            <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Create Invoice before month End
                                        </label>
                                    </div>
                                    <div class="col-md-8 display-webkit-inline-box">
                                        <label class="radio-inline">
                                            <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Custom select date of the month
                                        </label>
                                        <select class="form-control ml-20" style="width: 100px">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                            <option>11</option>
                                            <option>12</option>
                                            <option>13</option>
                                            <option>14</option>
                                            <option>15</option>
                                            <option>16</option>
                                            <option>17</option>
                                            <option>18</option>
                                            <option>19</option>
                                            <option>20</option>
                                            <option>21</option>
                                            <option>22</option>
                                            <option>23</option>
                                            <option>24</option>
                                            <option>25</option>
                                            <option>26</option>
                                            <option>27</option>
                                            <option>28</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="form-group col-lg-12">
                            <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Auto Reminder
                            <div class="radio-list">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="radio-inline inline-flex-center">
                                            <input type="radio" name="optionsRadios" id="optionsRadios25" value="option1" checked="">
                                            <input type="text" class="form-control ml-10">
                                            <span class="width-webkit-fill ml-10">No of days</span>
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="radio-inline inline-flex-center">
                                            <input type="radio" name="optionsRadios" id="optionsRadios26" value="option2" checked=""> Net terms days
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="radio-inline inline-flex-center">
                                            <input type="radio" name="optionsRadios" id="optionsRadios26" value="option2" checked=""> Net Terms + 7 days
                                        </label>
                                    </div>
                                </div>
                                <div class="ml-20">
                                    <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Send reminder once every 10 days after the first reminder until we receive some payment
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="form-group col-lg-12">
                            <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Vendor service discount
                            <div class="radio-list">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="radio-inline inline-flex-center">
                                            <input type="radio" name="optionsRadios" id="optionsRadios25" value="option1" checked="">
                                            <input type="text" class="form-control ml-10">
                                            <span class="width-webkit-fill ml-10">%</span>
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="radio-inline inline-flex-center">
                                            <input type="radio" name="optionsRadios" id="optionsRadios26" value="option2" checked="">
                                            <input type="text" class="form-control ml-10">
                                            <select class="form-control ml-10">
                                                <option>Select</option>
                                                <option>$/hr</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="form-group col-lg-12">
                            <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Other Discount(s)
                            <div class="radio-list">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="radio-inline inline-flex-center">
                                            <input type="radio" name="optionsRadios" id="optionsRadios25" value="option1" checked="">
                                            <input type="text" class="form-control ml-10" placeholder="Comment">
                                            <input type="text" class="form-control ml-10">
                                            <span class="width-webkit-fill ml-10">%</span>
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="radio-inline inline-flex-center">
                                            <input type="radio" name="optionsRadios" id="optionsRadios26" value="option2" checked="">
                                            <input type="text" class="form-control ml-10">
                                            <select class="form-control ml-10">
                                                <option>Select</option>
                                                <option>$/hr</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <a id="btn-add-other-doc" href="javascript:;" class="btn-tbl-action btn-c-no-border-primary"><i class="fa fa-plus-circle icon-16 display-flex mt-5"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="form-group col-lg-12">
                            <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Include Due Payments
                            <div class="radio-list">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="radio-inline inline-flex-center">
                                            <input type="radio" name="optionsRadios" id="optionsRadios25" value="option1" checked="">
                                            In Email
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="radio-inline inline-flex-center">
                                            <input type="radio" name="optionsRadios" id="optionsRadios26" value="option2" checked="">
                                            Within invoice PDF
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-container">
                    <table id="tbl_setting-invs" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="15%"> Employee Name </th>
                                <th width="10%"> Invoice No </th>
                                <th width="20%"> Invoice Cycle </th>
                                <th width="15%"> Invoiced Amount </th>
                                <th width="15%"> Payment Received </th>
                                <th width="10%"> Due Payment </th>
                                <th width="15%"> Mode of payment </th>
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
                        <tbody>
                            <tr>
                                <td> Name </td>
                                <td> 132345 </td>
                                <td> 03/01/2023 ~ 03/31/2023 </td>
                                <td> 2500 </td>
                                <td> 2000 </td>
                                <td> 500 </td>
                                <td> Cheque </td>
                            </tr>
                            <tr>
                                <td> Name </td>
                                <td> 132346 </td>
                                <td> 03/01/2023 ~ 03/31/2023 </td>
                                <td> 2500 </td>
                                <td> 2000 </td>
                                <td> 500 </td>
                                <td> Cheque </td>
                            </tr>
                            <tr>
                                <td> Name </td>
                                <td> 132347 </td>
                                <td> 03/01/2023 ~ 03/31/2023 </td>
                                <td> 2500 </td>
                                <td> 2000 </td>
                                <td> 500 </td>
                                <td> Cheque </td>
                            </tr>
                            <tr>
                                <td> Name </td>
                                <td> 132348 </td>
                                <td> 03/01/2023 ~ 03/31/2023 </td>
                                <td> 2500 </td>
                                <td> 2000 </td>
                                <td> 500 </td>
                                <td> Cheque </td>
                            </tr>
                            <tr>
                                <td> Name </td>
                                <td> 132349 </td>
                                <td> 03/01/2023 ~ 03/31/2023 </td>
                                <td> 2500 </td>
                                <td> 2000 </td>
                                <td> 500 </td>
                                <td> Cheque </td>
                            </tr>
                            <tr>
                                <td> Name </td>
                                <td> 132350 </td>
                                <td> 03/01/2023 ~ 03/31/2023 </td>
                                <td> 2500 </td>
                                <td> 2000 </td>
                                <td> 500 </td>
                                <td> Cheque </td>
                            </tr>
                            <tr>
                                <td colspan="5"> Total Due Payment </td>
                                <td colspan="2"> 3000 </td>
                            </tr>
                            <tr>
                                <td colspan="2"> This Invoice </td>
                                <td colspan="5"> </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td> 132350 </td>
                                <td> 03/01/2023 ~ 03/31/2023 </td>
                                <td> 2500 </td>
                                <td colspan="3"> </td>
                            </tr>
                            <tr>
                                <td colspan="5"> Total payment including this invoice </td>
                                <td colspan="2"> 5500 </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-body">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Send approved Timesheets to Client
                        </div>
                    </div>
                </div>
                <div class="form-actions text-right">
                    <button type="submit" class="btn btn-sm btn-c-primary">Save</button>
                    <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel_invoice_inv_list">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
