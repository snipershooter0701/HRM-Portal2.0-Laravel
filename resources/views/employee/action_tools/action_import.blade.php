<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active" data-panelname="panel-employee-list">Import Employees</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" data-panelname="panel-create-employee"> Import Template </button>
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
                <div class="row">
                    <div class="col-md-6">
                        <!-- BEGIN FORM-->
                        <form action="javascript:;">
                            <div class="form-body">
                                {{-- BEGIN BASE FORM --}}
                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-8 col-xs-12">
                                        <label class="control-label">Attachment</label>
                                        <input type="file" class="form-control">
                                    </div>
                                </div>
                                {{--END BASE FORM --}}
                                {{-- BEGIN BASE FORM --}}
                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-8 col-xs-12">
                                        <label class="control-label">Duplicate Records</label>
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                                <input type="radio" name="optionsRadios" id="options_skip" value="option1" checked=""> Skip
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="optionsRadios" id="options_overwrite" value="option2"> Overwrite
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{--END BASE FORM --}}
                                {{-- BEGIN BASE FORM --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-sm btn-c-primary">Next</button>
                                        <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-employee-list">Cancel</button>
                                    </div>
                                </div>
                                {{--END BASE FORM --}}
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                    <div class="col-md-6">
                        <div class="import-info">
                            <div class="import-info-section">
                                <span>Supported Formats and Size</span>
                                <ul>
                                    <li> Only CSV and XLSX formats are supported. In case of XLS file, only MS Excel 97 - 2003 format is supported. </li>
                                    <li> File size cannot exceed 5MB. </li>
                                </ul>
                            </div>
                            <div class="import-info-section">
                                <span>Supported Formats and Size</span>
                                <ul>
                                    <li> File Name </li>
                                    <li> Last Name </li>
                                    <li> Email </li>
                                    <li> Employment Type </li>
                                    <li> Date of Joining </li>
                                </ul>
                            </div>
                            <div class="import-info-section">
                                <span>Please Note</span>
                                <ul>
                                    <li> Duplicates will be verified based on Email field. </li>
                                    <li> First row in the file will be treated as file names. </li>
                                    <li> Date include be in mm/dd/yyyy format only. </li>
                                    <li> While checking for duplicate records. you can choose to overwrite or skip any duplicates. </li>
                                    <li> Import may fail if the document has images or special controls (like combo filters) </li>
                                    <li> Import may fail if the file is corrupted or contains unreadable characters. </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
