<?php

use Illuminate\Support\Str;

return [
    'AUTH_ID' => 1,

    'STATE_ACTIVE' => 1,
    'STATE_INACTIVE' => 0,

    'EMP_CATEGORY_W2' => 0,
    'EMP_CATEGORY_C2C' => 1,
    'EMP_CATEGORY_1099' => 2,

    'JOB_TIRE_REGULAR' => 1,
    'JOB_TIRE_2ND' => 2,
    'JOB_TIRE_3RD' => 3,

    'INVOICE_FREQUENCY_WEEKLY' => 0,
    'INVOICE_FREQUENCY_BYWEEKLY' => 1,
    'INVOICE_FREQUENCY_MONTHLY' => 2,
    'INVOICE_FREQUENCY_QUARTERLY' => 3,

    'DATE_RANGE_ALL' => 0,
    'DATE_RANGE_CUR_WEEK' => 1,
    'DATE_RANGE_LAST_WEEK' => 2,
    'DATE_RANGE_CUR_MTH' => 3,
    'DATE_RANGE_LAST_MTH' => 4,
    'DATE_RANGE_LAST_3_MTH' => 5,
    'DATE_RANGE_LAST_6_MTH' => 6,
    'DATE_RANGE_CUSTOM' => 7,

    'TIMESHEET_STATUS_REQESTED' => 0,
    'TIMESHEET_STATUS_APPROVED' => 1,
    'TIMESHEET_STATUS_REJECTED' => 2,

    // ========================== BEGIN MODULE SECURITY ============================
    'ROLE_ACCESS_VIEW_NONE' => 0,
    'ROLE_ACCESS_VIEW_OWN' => 1,
    'ROLE_ACCESS_VIEW_SUBORDINATES' => 2,
    'ROLE_ACCESS_VIEW_OWN_SUBORDINATES' => 3,
    'ROLE_ACCESS_VIEW_ALL_RECORDS' => 4,

    'ROLE_ACCESS_ADD_RESTRICTED' => 0,
    'ROLE_ACCESS_ADD_ALLOWED' => 1,

    'ROLE_ACCESS_EDIT_NONE' => 0,
    'ROLE_ACCESS_EDIT_OWN' => 1,
    'ROLE_ACCESS_EDIT_SUBORDINATES' => 2,
    'ROLE_ACCESS_EDIT_OWN_SUBORDINATES' => 3,
    'ROLE_ACCESS_EDIT_ALL_RECORDS' => 4,
    
    'ROLE_ACCESS_DELETE_NONE' => 0,
    'ROLE_ACCESS_DELETE_OWN' => 1,
    'ROLE_ACCESS_DELETE_SUBORDINATES' => 2,
    'ROLE_ACCESS_DELETE_OWN_SUBORDINATES' => 3,
    'ROLE_ACCESS_DELETE_ALL_RECORDS' => 4,

    'ROLE_MODULE_LEVEL_MODULE' => 0,
    'ROLE_MODULE_LEVEL_SUBMODULE' => 1,
    'ROLE_MODULE_LEVEL_ACCESS' => 2,
    // =========================== END MODULE SECURITY =============================

    // ============================ BEGIN USER SIGNUPS ==============================
    'USER_SIGNUP_NOT_WATECHED' => 0,
    'USER_SIGNUP_WATECHED' => 1,
    // ============================= END USER SIGNUPS ===============================
    
    // ============================ BEGIN TICKETS ==============================
    'TICKET_STATUS_REQUESTED' => 0,
    'TICKET_STATUS_ASSIGNED' => 1,
    'TICKET_STATUS_COMPLETED' => 2,
    // ============================ END TICKETS ==============================
];