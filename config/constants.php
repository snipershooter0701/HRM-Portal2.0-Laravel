<?php

use Illuminate\Support\Str;

return [
    'AUTH_ID' => 1,

    'STATE_ACTIVE' => 1,
    'STATE_INACTIVE' => 0,

    // Max Integer
    'MAX_INTEGER' => 1000000000,

    'EMP_CATEGORY_W2' => 0,
    'EMP_CATEGORY_C2C' => 1,
    'EMP_CATEGORY_1099' => 2,

    // User Signup watch
    'USER_SIGNUP_NOT_WATECHED' => 0,
    'USER_SIGNUP_WATECHED' => 1,

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

    // ============================ BEGIN TIMESHEET ==============================
    'TIMESHEET_STATUS_REQESTED' => 0,
    'TIMESHEET_STATUS_APPROVED' => 1,
    'TIMESHEET_STATUS_REJECTED' => 2,
    // ============================ END TIMESHEET ==============================
    
    // ============================ BEGIN TICKETS ==============================
    'TICKET_STATUS_REQUESTED' => 0,
    'TICKET_STATUS_ASSIGNED' => 1,
    'TICKET_STATUS_COMPLETED' => 2,
    // ============================ END TICKETS ==============================

    // ========================== BEGIN SETTINGS MOUDLE ============================
    // Module security
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
    
    // Company Alignment
    'COMPANY_ALIGNMENT_LEFTTORIGHT' => 0,
    'COMPANY_ALIGNMENT_RIGHTTOLEFT' => 1,

    'BACKUP_NONE' => 0,
    'BACKUP_DAILY' => 1,
    'BACKUP_WEEKILY' => 2,
    'BACKUP_BIWEEKLY' => 3,
    'BACKUP_MONTHLY' => 4,
    // =========================== END SETTTINGS MODULE =============================

    // ============================ BEGIN USER SIGNUPS ==============================
    'USER_SIGNUP_NOT_WATECHED' => 0,
    'USER_SIGNUP_WATECHED' => 1,
    // ============================= END USER SIGNUPS ===============================
    
    // ============================ BEGIN TICKETS ==============================
    'TICKET_STATUS_REQUESTED' => 0,
    'TICKET_STATUS_ASSIGNED' => 1,
    'TICKET_STATUS_COMPLETED' => 2,
    // ============================ END TICKETS ==============================

    // employee request
    'EMP_REQ' => '0',
    'EMP_RESPONSE' => '1',
    'EMP_APPROV' => '2',
    'EMP_REJECT' => '3',


    // i94-type
    'i94_DS' => '0',
    'i94_other' => '1',


    // Documentation
    'doc_ssn' => '0',
    'doc_auth' => '1',
    'doc_state' => '2',
    'doc_passport' => '3',
    'doc_i94' => '4',
    'doc_visa' => '5',
    'doc_other' => '6',
];