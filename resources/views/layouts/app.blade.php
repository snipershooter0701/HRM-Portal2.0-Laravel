<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Revanth') }}</title>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ url('assets/global/plugins/datatables/datatables.min.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/global/plugins/bootstrap-toastr/toastr.min.css?v=' . $randNum) }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" />
    @yield('page_template_css')
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ url('assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ url('assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{ url('assets/layouts/layout/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/layouts/layout/css/themes/default.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{ url('assets/layouts/layout/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ url('assets/custom/css/layout.css') }}" rel="stylesheet" type="text/css" />
    @yield('page_css')
    <!-- END PAGE LEVEL STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="{{ url('/employee') }}">
                    <h4 class="logo-default"><b>Revanth Vytla</b></h4>
                </a>
                <div class="menu-toggler sidebar-toggler"> </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-default"> 0 </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>
                                    <span class="bold">0 pending</span> notifications</h3>
                                <a href="page_user_profile_1.html">view all</a>
                            </li>`
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                    {{-- <li>
                                        <a href="javascript:;">
                                            <span class="time">just now</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-success">
                                                    <i class="fa fa-plus"></i>
                                                </span> New user registered. </span>
                                        </a>
                                    </li> --}}
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- END NOTIFICATION DROPDOWN -->



                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="../assets/layouts/layout/img/avatar3_small.jpg" />
                            <span class="username username-hide-on-mobile"> {{ Auth::user()->name }} </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="page_user_profile_1.html">
                                    <i class="icon-user"></i> My Profile </a>
                            </li>
                            {{-- <li>
                                <a href="app_calendar.html">
                                    <i class="icon-calendar"></i> My Calendar </a>
                            </li>
                            <li>
                                <a href="app_inbox.html">
                                    <i class="icon-envelope-open"></i> My Inbox
                                    <span class="badge badge-danger"> 3 </span>
                                </a>
                            </li>
                            <li>
                                <a href="app_todo.html">
                                    <i class="icon-rocket"></i> My Tasks
                                    <span class="badge badge-success"> 7 </span>
                                </a>
                            </li> --}}
                            <li class="divider"> </li>
                            <li>
                                <a href="page_user_lock_1.html">
                                    <i class="icon-lock"></i> Lock Screen </a>
                            </li>
                            <li>
                                <a href="page_user_lock_1.html">
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    {{-- <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href="javascript:;" class="dropdown-toggle">
                            <i class="icon-logout"></i>
                        </a>
                    </li> --}}
                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- BEGIN SIDEBAR -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                    <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                    <li class="sidebar-toggler-wrapper hide">
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        <div class="sidebar-toggler"> </div>
                        <!-- END SIDEBAR TOGGLER BUTTON -->
                    </li>
                    <li id="page-dashboard" class="nav-item start">
                        <a href="{{ url('/home') }}" class="nav-link">
                            <i class="fa fa-dashboard "></i>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li id="page_employee" class="nav-item">
                        <a class="nav-link nav-toggle">
                            <i class="fa fa-users"></i>
                            <span class="title">Employee</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item" id="page_employee_list">
                                <a href="{{ url('/employee/all_employees') }}" class="nav-link ">
                                    <span class="title">All Employee List</span>
                                </a>
                            </li>
                            <li class="nav-item" id="page_request_list">
                                <a href="{{ url('/employee/all_request_details') }}" class="nav-link ">
                                    <span class="title">All Request Details</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="page-timesheets" class="nav-item">
                        <a class="nav-link nav-toggle">
                            <i class="fa fa-calendar"></i>
                            <span class="title">Timesheets</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item" id="page-client-list">
                                <a href="{{ url('/timesheets/all') }}" class="nav-link ">
                                    <span class="title">All Timesheets</span>
                                </a>
                            </li>
                            <li class="nav-item" id="page-client-all-placements">
                                <a href="{{ url('/timesheets/due') }}" class="nav-link ">
                                    <span class="title">Due Timesheets</span>
                                </a>
                            </li>
                            <li class="nav-item" id="page-client-all-documents">
                                <a href="{{ url('/timesheets/awaiting') }}" class="nav-link ">
                                    <span class="title">Awaiting Timesheets</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="page_expenses" class="nav-item">
                        <a class="nav-link nav-toggle">
                            <i class="fa fa-dollar"></i>
                            <span class="title">Expenses</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item" id="page_expense_list">
                                <a href="{{ url('/expenses') }}" class="nav-link ">
                                    <span class="title">Expense List</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="page-client" class="nav-item">
                        <a class="nav-link nav-toggle">
                            <i class="fa fa-user-secret"></i>
                            <span class="title">Client</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item" id="page-client-list">
                                <a href="{{ url('/client/list') }}" class="nav-link ">
                                    <span class="title">Client List</span>
                                </a>
                            </li>
                            <li class="nav-item" id="page-client-all-placements">
                                <a href="{{ url('/client/all_placements') }}" class="nav-link ">
                                    <span class="title">All Placements</span>
                                </a>
                            </li>
                            <li class="nav-item" id="page-client-all-documents">
                                <a href="{{ url('/client/all_documents') }}" class="nav-link ">
                                    <span class="title">All Documents</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="page-vendor" class="nav-item">
                        <a class="nav-link nav-toggle">
                            <i class="fa fa-globe"></i>
                            <span class="title">Vendor</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item  ">
                                <a href="{{ url('/vendor/list') }}" class="nav-link ">
                                    <span class="title">Vendor List</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="{{ url('/vendor/all_placements') }}" class="nav-link ">
                                    <span class="title">All Placements</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="{{ url('/vendor/all_documents') }}" class="nav-link ">
                                    <span class="title">All Documents</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="page-invoices" class="nav-item">
                        <a class="nav-link nav-toggle">
                            <i class="fa fa-sticky-note"></i>
                            <span class="title">Invoices</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li id="page-invoices-all-inv" class="nav-item">
                                <a href="{{ url('/invoices/all_inv') }}" class="nav-link ">
                                    <span class="title">All Invoices</span>
                                </a>
                            </li>
                            <li id="page-invoices-due-inv" class="nav-item">
                                <a href="{{ url('/invoices/due_inv') }}" class="nav-link ">
                                    <span class="title">Due Invoices</span>
                                </a>
                            </li>
                            <li id="page-invoices-await-inv" class="nav-item">
                                <a href="{{ url('/invoices/await_inv') }}" class="nav-link ">
                                    <span class="title">Awaiting Invoices</span>
                                </a>
                            </li>
                            <li id="page-invoices-client-pay" class="nav-item">
                                <a href="{{ url('/invoices/client_pay') }}" class="nav-link ">
                                    <span class="title">Client Payments</span>
                                </a>
                            </li>
                            <li id="page-invoices-employee-pay" class="nav-item">
                                <a href="{{ url('/invoices/employee_pay') }}" class="nav-link ">
                                    <span class="title">Employee Payments</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="page_tickets" class="nav-item">
                        <a class="nav-link nav-toggle">
                            <i class="fa fa-bookmark"></i>
                            <span class="title">Tickets</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li id="page_ticket_list" class="nav-item">
                                <a href="{{ url('/tickets') }}" class="nav-link ">
                                    <span class="title">Ticket List</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="page-settings" class="nav-item">
                        <a class="nav-link nav-toggle">
                            <i class="fa fa-cog"></i>
                            <span class="title">Settings</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li id="page-settings-org-hierarchy" class="nav-item">
                                <a href="{{ url('/settings/org_hierarchy') }}" class="nav-link ">
                                    <span class="title">Organization Hierarchy</span>
                                </a>
                            </li>
                            <li id="page-settings-role-perm" class="nav-item">
                                <a href="{{ url('/settings/role_perm') }}" class="nav-link ">
                                    <span class="title">Role Permission</span>
                                </a>
                            </li>
                            <li id="page-settings-module-sec" class="nav-item">
                                <a href="{{ url('/settings/module_sec') }}" class="nav-link ">
                                    <span class="title">Module Security</span>
                                </a>
                            </li>
                            <li id="page-settings-general" class="nav-item">
                                <a href="{{ url('/settings/general') }}" class="nav-link ">
                                    <span class="title">General Module</span>
                                </a>
                            </li>
                            <li id="page-invoices-employee-pay" class="nav-item">
                                <a href="{{ url('/settings/invoice') }}" class="nav-link ">
                                    <span class="title">Invoice Setting</span>
                                </a>
                            </li>
                            <li id="page-invoices-employee-pay" class="nav-item">
                                <a href="{{ url('/settings/new_company') }}" class="nav-link ">
                                    <span class="title">Create New Company</span>
                                </a>
                            </li>
                            <li id="page-invoices-employee-pay" class="nav-item">
                                <a href="{{ url('/settings/application') }}" class="nav-link ">
                                    <span class="title">Application Setting</span>
                                </a>
                            </li>
                            <li id="page-invoices-employee-pay" class="nav-item">
                                <a href="{{ url('/settings/backup') }}" class="nav-link ">
                                    <span class="title">Backup and Download</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="page_documentation" class="nav-item">
                        <a class="nav-link nav-toggle">
                            <i class="fa fa-file-text"></i>
                            <span class="title">Documentation</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li id="page_organization_documents" class="nav-item">
                                <a href="{{ url('/documentation/organization') }}" class="nav-link ">
                                    <span class="title">Organization Documents</span>
                                </a>
                            </li>
                            <li id="page_employee_documents" class="nav-item">
                                <a href="{{ url('/documentation/employee') }}" class="nav-link ">
                                    <span class="title">Employee Documents</span>
                                </a>
                            </li>
                            <li id="page-expiring_documents" class="nav-item">
                                <a href="{{ url('/documentation/expiring') }}" class="nav-link ">
                                    <span class="title">Expiring Documents</span>
                                </a>
                            </li>
                            <li id="page_group_documents" class="nav-item">
                                <a href="{{ url('/documentation/group') }}" class="nav-link ">
                                    <span class="title">Group Documents</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- END SIDEBAR MENU -->
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                @yield('content')
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
        <!-- BEGIN QUICK SIDEBAR -->
        <!-- END QUICK SIDEBAR -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        <span class="page-footer-inner">Copyright &copy; 2023 www.revanthvytal.com <span>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
    </div>
    @yield('modal')
    <!-- END FOOTER -->

    {{-- modal --}}
    <div id="confirm_modal" class="modal fade" tabindex="-1" data-width="600">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body text-center">

        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-c-primary" data-name="ok" id="ok_btn">Ok</button>
            <button type="button" data-dismiss="modal" class="btn btn-c-grey" data-name="cancel" id="cancel_btn">Cancel</button>
        </div>
    </div>


    <!-- BEGIN JS CONSTANTS -->
    <script type="text/javascript">
        const BASE_URL = "{{ url('') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";
    </script>
    <!-- END JS CONSTANTS -->
    
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{ url('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ url('assets/global/scripts/datatable.js?v=' . $randNum) }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/datatables/datatables.min.js?v=' . $randNum) }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js?v=' . $randNum) }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js?v=' . $randNum) }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
    @yield('page_template_js')
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{ url('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->

    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="{{ url('assets/layouts/layout/scripts/layout.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/layouts/layout/scripts/demo.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->

    <!-- BEGIN CUSTOM GLOBAL SCRIPTS -->
    <script src="{{ url('assets/custom/scripts/utils/date-util.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/custom/scripts/utils/constants.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/custom/scripts/utils/cookie.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/custom/scripts/utils/ajax-util.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/custom/scripts/utils/utils.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/custom/scripts/utils/validator.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/custom/scripts/utils/global.js') }}" type="text/javascript"></script>
    <!-- END CUSTOM GLOBAL SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ url('assets/pages/scripts/form-icheck.js') }}" type="text/javascript"></script>
    @yield('page_js')

    <script type="text/javascript">
        $('.nav-item').removeClass("active");
        $('.nav-item').removeClass("open");
        $('.nav-item').find(".selected").remove();
        $('#' + PAGE_ID).addClass('active');
        $('#' + PAGE_ID).addClass('open');
        if (typeof PAGE_SUB_ID !== 'undefined') {
            $('#' + PAGE_ID).find('a span.arrow').addClass('open');
            $('#' + PAGE_SUB_ID).addClass('active');
            $('#' + PAGE_SUB_ID).addClass('open');
        }
        // $('#' + PAGE_ID).find('a').append('<span class="selected"></span>');

    </script>
    <!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
