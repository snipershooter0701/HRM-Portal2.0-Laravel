<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ url('/documentation/organization') }}" class="btn-move-panel" data-panelname="panel-org-doc-list">Organization Document</a>
        </li>
        <li>
            <a href="{{ url('/documentation/employee') }}" class="btn-move-panel bread-active" data-panelname="panel-emp-doc-list">Employee Documents</a>
        </li>
        <li>
            <a href="{{ url('/documentation/expiring') }}" class="btn-move-panel" data-panelname="panel-exp-doc-list">Expiring Documents</a>
        </li>
        <li>
            <a href="{{ url('/documentation/group') }}" class="btn-move-panel" data-panelname="panel-group-doc-list">Group Documents</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-sm btn-c-primary btn-move-panel" data-panelname="panel-org-doc-create"><i class="fa fa-plus-circle"></i> Add Document </button>
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
                            <div id="tbl_emp_docs_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
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
                            <option value="Delete">Delete</option>
                        </select>
                        <button class="btn btn-sm table-group-action-submit btn-c-primary">
                            <i class="fa fa-check"></i> Submit</button>
                    </div>
                    <table id="tbl_emp_docs" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable"> </th>
                                <th width="5%"> No </th>
                                <th width="15%"> Employee Name </th>
                                <th width="10%"> Title </th>
                                <th width="13%"> Comment </th>
                                <th width="10%"> Exp Date </th>
                                <th width="10%"> Modified By </th>
                                <th width="10%"> Modified On </th>
                                <th width="10%"> Attachment </th>
                                <th width="15%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td> </td>

                                {{-- Employee Name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_emp_name">
                                </td>

                                {{-- Title --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_tile">
                                </td>

                                {{-- Comment --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_comment">
                                </td>

                                {{-- Exp Date --}}
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy/mm/dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_exp_date_from" placeholder="From">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="input-group date date-picker" data-date-format="yyyy/mm/dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_exp_date_to" placeholder="To">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>

                                {{-- Modified By --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_modified_by">
                                </td>

                                {{-- Modified On --}}
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy/mm/dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_modified_on_from" placeholder="From">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="input-group date date-picker" data-date-format="yyyy/mm/dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_modified_on_to" placeholder="To">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>

                                {{-- Attachment --}}
                                <td></td>

                                {{-- Action --}}
                                <td>
                                    <button class="btn btn-xs btn-c-primary filter-submit"><i class="fa fa-search"></i></button>
                                    <button class="btn btn-xs btn-c-grey filter-cancel"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>

                    {{-- BEGIN ACTIVITIES FORM --}}
                    <div class="panel-group accordion mt-30" id="accordion5">
                        <div class="panel">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion5" href="#collapse_5_1" aria-expanded="false"> Activities </a>
                                </h4>
                            </div>
                            <div id="collapse_5_1" class="panel-collapse collapse" aria-expanded="false">
                                <div class="panel-body">
                                    <div class="table-container">
                                        <table id="tbl_emp_doc_act" class="table table-striped table-bordered table-hover table-checkable">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="10%"> No </th>
                                                    <th width="20%"> Date & Time </th>
                                                    <th width="30%"> Updated By </th>
                                                    <th width="40%"> Description </th>
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
                    {{-- END ACTIVITIES FORM --}}
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
