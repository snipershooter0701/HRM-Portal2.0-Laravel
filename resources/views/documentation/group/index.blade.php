<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="btn-move-panel" data-panelname="panel-org-doc-list">Organization Document</a>
        </li>
        <li>
            <a href="javascript:;" class="btn-move-panel " data-panelname="panel-emp-doc-list">Employee Documents</a>
        </li>
        <li>
            <a href="javascript:;" class="btn-move-panel" data-panelname="panel-exp-doc-list">Expiring Documents</a>
        </li>
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active" data-panelname="panel-group-doc-list">Group Documents</a>
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
                            <div id="tbl_group_docs_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
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
                    <table id="tbl_group_docs" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="3%">
                                    <input type="checkbox" class="group-checkable"> </th>
                                <th width="7%"> No </th>
                                <th width="30%"> Employee Name </th>
                                <th width="30%"> Attachment </th>
                                <th width="30%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td> </td>

                                {{-- Employee Name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_last_name">
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
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
