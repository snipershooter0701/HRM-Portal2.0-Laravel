<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ url('/') }}">All Documents</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-sm btn-c-grey dropdown-toggle" data-toggle="dropdown"> More
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="#">
                        <i class="icon-bell"></i> Request Details</a>
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
                <div class="table-container">
                    <div class="actions">
                        <button type="button" class="btn btn-sm btn-c-primary btn-move-panel mr-10" data-panelname="panel-create-client"><i class="fa fa-plus-circle"></i> Add Document </button>
                        <div id="tbl_placements_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-copy"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-upload"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-download"></i></a>
                            <a href="javascript:;" data-action="1" class="btn-tbl-action tool-action"><i class="fa fa-print"></i></a>
                        </div>
                    </div>
                    <div class="table-actions-wrapper">
                        <span> </span>
                        <select class="table-group-action-input form-control input-inline input-small input-sm">
                            <option value="">Select...</option>
                            <option value="Cancel">Delete</option>
                        </select>
                        <button class="btn btn-sm table-group-action-submit btn-c-primary">
                            <i class="fa fa-check"></i> Submit</button>
                    </div>

                    {{-- document list table --}}
                    <table id="tbl_all_document" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable"> </th>
                                <th width="5%"> No </th>
                                <th width="20%"> Title</th>
                                <th width="10%"> Documents type </th>
                                <th width="15%"> Client Name </th>
                                <th width="15%"> Employee </th>
                                <th width="10%"> status </th>
                                <th width="10%"> Except Date</th>
                                <th width="13%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td> </td>

                                {{-- Title --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_title"> </td>

                                {{-- Document type--}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_document_type"> </td>

                                {{-- Client Name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_client_name"> </td>

                                {{-- employee--}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_employee"> </td>

                                {{-- status --}}
                                <td>
                                    <select name="filt_status" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="pending">active</option>
                                        <option value="closed">inactive</option>
                                    </select>
                                </td>

                                {{-- except Date --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_except_date"> </td>

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
