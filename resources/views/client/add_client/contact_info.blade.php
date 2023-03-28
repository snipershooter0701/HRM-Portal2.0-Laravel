<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar c-page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ url('/') }}" class="bread-active">Add Client</a>
        </li>
    </ul>

</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel-business-info">Business Info</span>
                    <span class="caption-helper mr-10 active-tab btn-move-panel" data-panelname="panel-contact-info">Contact Info</span>
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel-add-confidential">Add Confidential</span>
                    <span class="caption-helper mr-10 btn-move-panel" data-panelname="panel-placement">Placements</span>
                    <span class="caption-helper btn-move-panel" data-panelname="panel-document">Documents</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-container">
                    <div class="actions">
                        <button type="button" class="btn btn-sm btn-c-primary" id="add_contact"><i class="fa fa-plus-circle"></i> Add Contact </button>
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

                    <table id="tbl_contact" class="table table-striped table-bordered table-hover table-checkable">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable"> </th>
                                <th width="5%"> No </th>
                                <th width="20%"> First Name </th>
                                <th width="20%"> Last Name </th>
                                <th width="20%"> Email </th>
                                <th width="15%"> Phone </th>
                                <th width="18%"> Action </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td> </td>

                                {{-- First name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_employee_name"> </td>

                                {{-- Last Name --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_job_tire"> </td>

                                {{-- Email --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_job_tire"> </td>

                                {{-- Phone --}}
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="filt_job_tire"> </td>

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

                <!-- BEGIN FORM-->
                <form action="#">
                    <div class="form-body">
                        {{-- CC List --}}
                        <h4 class="section-head color-primary">Notifiers</h4>
                        <hr>
                        {{-- <div class="row"> --}}

                        <div class="form-group has-notifier">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    To:
                                </span>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group has-notifier">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    CC:
                                </span>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group has-notifier">
                            <textarea class="form-control" row="15"></textarea>
                        </div>
                    </div>
                    <div class="form-actions text-right">
                        <button type="submit" class="btn btn-sm btn-c-primary">Save</button>
                        <button type="button" class="btn btn-sm btn-c-grey btn-move-panel" data-panelname="panel-client">Cancel</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>