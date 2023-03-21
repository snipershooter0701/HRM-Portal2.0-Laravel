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
                <form action="#">
                    <div class="form-body">
                        {{-- BEGIN BASE FORM --}}
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <label class="control-label">Include PO Attachment in Email</label>
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label class="control-label">Auto Invoicing</label>
                                <div class="radio-list">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="radio-inline">
                                                <input type="radio" name="optionsRadios" id="optionsRadios25" value="option1" checked=""> Create Invoice before month End
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="radio-inline">
                                                <input type="radio" name="optionsRadios" id="optionsRadios26" value="option2" checked=""> Custom select date of month
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label class="control-label">Auto Reminder</label>
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
                                        <div class="col-md-8">
                                            <label class="radio-inline inline-flex-center">
                                                <input type="radio" name="optionsRadios" id="optionsRadios26" value="option2" checked=""> Send reminder once every 10 days after the first reminder until we receive some payment
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label class="control-label">Vendor service discount</label>
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
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label class="control-label">Other Discount(s)</label>
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
                                            <a id="btn-add-other-doc" href="javascript:;" class="btn-tbl-action btn-c-no-border-primary"><i class="fa fa-plus-circle" style="font-size: 20px !important"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label class="control-label">Auto Invoicing</label>
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
                    <div class="form-actions text-right">
                        <button type="submit" class="btn btn-sm btn-c-primary">Save</button>
                        <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-invoice-inv-list">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
