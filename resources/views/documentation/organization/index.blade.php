<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;" class="btn-move-panel bread-active" data-panelname="panel-org-doc-list">Organization Document</a>
        </li>
        <li>
            <a href="javascript:;" class="btn-move-panel" data-panelname="panel-emp-doc-list">Employee Documents</a>
        </li>
        <li>
            <a href="javascript:;" class="btn-move-panel" data-panelname="panel-exp-doc-list">Expiring Documents</a>
        </li>
        <li>
            <a href="javascript:;" class="btn-move-panel" data-panelname="panel-group-doc-list">Group Documents</a>
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
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-c-primary pull-right"><i class="fa fa-plus-circle"></i> Create Folder </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="section-head">My Documents</h4>
                        <hr>
                        <div class="table-container">
                            <table id="tbl_org_my_docs" class="table table-striped table-bordered table-hover table-checkable">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="10%"> No </th>
                                        <th width="60%"> Folder Name </th>
                                        <th width="30%"> Action </th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <td> </td>

                                        {{-- Folder Name --}}
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="filt_first_name">
                                        </td>

                                        {{-- Action --}}
                                        <td>
                                            <button class="btn btn-xs btn-c-primary filter-submit"><i class="fa fa-search"></i></button>
                                            <button class="btn btn-xs btn-c-grey filter-cancel"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Folder1</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-share-alt"></i></a>
                                            <a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-plus"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Folder2</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-share-alt"></i></a>
                                            <a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-plus"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Folder3</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-share-alt"></i></a>
                                            <a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-plus"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Folder4</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-share-alt"></i></a>
                                            <a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-plus"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4 class="section-head">Shared Documents</h4>
                        <hr>
                        <div class="table-container">
                            <table id="tbl_org_shared_docs" class="table table-striped table-bordered table-hover table-checkable">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="10%"> No </th>
                                        <th width="20%"> Folder Name </th>
                                        <th width="50%"> Shared To </th>
                                        <th width="20%"> Action </th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <td> </td>

                                        {{-- Folder Name --}}
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="filt_first_name">
                                        </td>

                                        {{-- Shared To --}}
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="filt_first_name">
                                        </td>

                                        {{-- Action --}}
                                        <td>
                                            <button class="btn btn-xs btn-c-primary filter-submit"><i class="fa fa-search"></i></button>
                                            <button class="btn btn-xs btn-c-grey filter-cancel"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Folder1</td>
                                        <td>a@a.com, b@b.com</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-pencil"></i></a>
                                            <a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Folder2</td>
                                        <td>a@a.com, b@b.com</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-pencil"></i></a>
                                            <a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Folder3</td>
                                        <td>a@a.com, c@c.com</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-pencil"></i></a>
                                            <a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Folder4</td>
                                        <td>a@a.com, d@d.com</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-pencil"></i></a>
                                            <a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="table-container">
                    <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-4 actions">
                            <div id="tbl_org_docs_tools" class="btn-group btn-group-devided clearfix tbl-ajax-tools" data-toggle="buttons">
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
                    <table id="tbl_org_docs" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable"> </th>
                                <th width="3%"> No </th>
                                <th width="10%"> Title </th>
                                <th width="15%"> Comment </th>
                                <th width="15%"> Exp Date </th>
                                <th width="10%"> Modified By </th>
                                <th width="10%"> Modified On </th>
                                <th width="10%"> Status </th>
                                <th width="10%"> Attachment </th>
                                <th width="15%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td> </td>

                                {{-- Title --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_first_name">
                                </td>

                                {{-- Comment --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_last_name">
                                </td>

                                {{-- Exp Date --}}
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_join_date_from" placeholder="From">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_join_date_to" placeholder="To">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>

                                {{-- Modified By --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_last_name">
                                </td>

                                {{-- Modified On --}}
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_join_date_from" placeholder="From">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="filt_join_date_to" placeholder="To">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td>
                                    <select name="filt_status" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="pending">active</option>
                                        <option value="closed">inactive</option>
                                    </select>
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

                {{-- BEGIN ACTIVITIES FORM --}}
                <div class="panel-group accordion mt-30" id="accordion4">
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion4" href="#collapse_4_1" aria-expanded="false"> Activities </a>
                            </h4>
                        </div>
                        <div id="collapse_4_1" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                                <div class="table-container">
                                    <table id="tbl_org_doc_act" class="table table-striped table-bordered table-hover table-checkable">
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
        <!-- End: life time stats -->
    </div>
</div>
