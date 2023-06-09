<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientPlacement;
use App\Models\ClientPlacementActivity;
use App\Models\Employee;
use App\Models\Invoice;
use App\Models\JobTire;
use Illuminate\Http\Request;

/**
 * Client -> Client List (Edit -> Placement)
 */
class ClientPlacementController extends Controller
{
    private $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get a client's placement list from model and generate columns for ajax table. (tbl_placements)
     */
    public function getTableOnesPlacementList()
    {
        $recordData = $this->getOnesPlacementTblRecords();
        $result = $this->makeOnesPlacementTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Get placement activities list from model and generate columns for ajax table. (tbl_placement_activities)
     */
    public function getTableActivitiesList()
    {
        $recordData = $this->getActivitiesTblRecords();
        $result = $this->makeActivitiesTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    public function getTableInvoicesList()
    {
        $recordData = $this->getInvoicesTblRecords();
        $result = $this->makeInvoicesTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Create client's placement.
     */
    public function create()
    {
        // Check Validation
        $this->request->validate([
            'client_id' => ['required'],
            'employee_id' => ['required'],
            'job_tire_id' => ['required'],
            'net_terms' => ['required', 'numeric'],
            'po_attachment' => ['required'],
            'po_id' => ['required'],
            'job_title' => ['required'],
            'job_status' => ['required'],
            'job_start_date' => ['required'],
            'job_end_date' => ['required'],
            'invoice_frequency' => ['required'],
            'pay_effect_date' => ['required'],

            'client_bill_rate' => ['required', 'numeric'],
            // 'client_ot_bill_rate' => ['numeric'],
            // 'client_dt_bill_rate' => ['numeric'],
            // 'client_vendor_id' => ['required', 'numeric'],
            
            // 'vendor_contractor_id' => ['numeric'],
            // 'vendor_contractor_netterms' => ['numeric'],
            // 'vendor_contractor_po_attachment' => ['required'],
            // 'vendor_contractor_po_id' => ['required'],
            // 'vendor_contractor_bill_rate' => ['required'],
            // 'vendor_contractor_at_bill_rate' => ['required'],
            // 'vendor_contractor_dt_bill_rate' => ['required'],
        ]);

        // Create new record
        ClientPlacement::create([
            'client_id' => $this->request['client_id'],
            'employee_id' => $this->request['employee_id'],
            'job_tire_id' => $this->request['job_tire_id'],
            'net_terms' => $this->request['net_terms'],
            'po_attachment' => $this->request['po_attachment'],
            'po_id' => $this->request['po_id'],
            'job_title' => $this->request['job_title'],
            'job_status' => $this->request['job_status'],
            'job_start_date' => $this->request['job_start_date'],
            'job_end_date' => $this->request['job_end_date'],
            'invoice_frequency' => $this->request['invoice_frequency'],
            'pay_effect_date' => $this->request['pay_effect_date'],

            'client_bill_rate' => $this->request['client_bill_rate'],
            'client_ot_bill_rate' => $this->request['client_ot_bill_rate'],
            'client_dt_bill_rate' => $this->request['client_dt_bill_rate'],
            // 'client_vendor_id' => $this->request['client_vendor_id'],
            
            'vendor_contractor_id' => $this->request['vendor_contractor_id'],
            'vendor_contractor_netterms' => $this->request['vendor_contractor_netterms'],
            'vendor_contractor_po_attachment' => $this->request['vendor_contractor_po_attachment'],
            'vendor_contractor_po_id' => $this->request['vendor_contractor_po_id'],
            'vendor_contractor_bill_rate' => $this->request['vendor_contractor_bill_rate'],
            'vendor_contractor_at_bill_rate' => $this->request['vendor_contractor_at_bill_rate'],
            'vendor_contractor_dt_bill_rate' => $this->request['vendor_contractor_dt_bill_rate']
        ]);

        // Create new activity.
        $client = Client::find($this->request['client_id']);
        $employee = Employee::find($this->request['employee_id']);
        $jobTire = JobTire::find($this->request['job_tire_id']);
        $description = "Created new placement (ClientName: " . $client['business_name'] . ", EmployeeName: " . $employee['first_name'] . ", JobTire: " . $jobTire['name'] . ", JobTitle: " . $this->request['job_title'] . ")";
        ClientPlacementActivity::create([
            'client_id' => $this->request['client_id'],
            'updated_by' => config('constants.AUTH_ID'),
            'description' => $description
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Delete client's placement.
     */
    public function delete()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
        ]);

        // Delete placement.
        $placement = ClientPlacement::find($this->request['id']);
        $placement->delete();

        // Create new activity.
        $client = Client::find($placement['client_id']);
        $employee = Employee::find($placement['employee_id']);
        $jobTire = JobTire::find($placement['job_tire_id']);
        $description = "Deleted placement (ClientName: " . $client['business_name'] . ", EmployeeName: " . $employee['first_name'] . ", JobTire: " . $jobTire['name'] . ", JobTitle: " . $placement['job_title'] . ")";
        ClientPlacementActivity::create([
            'client_id' => $placement['client_id'],
            'updated_by' => config('constants.AUTH_ID'),
            'description' => $description
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    public function getNew()
    {
        $last = ClientPlacement::all()->last();

        return response()->json([
            'result' => 'success',
            'last' => $last
        ]);
    }

    /**
     * Get Employee By Id
     */
    public function getEmployeeById()
    {
        // Check Validation
        $this->request->validate([
            'empId' => ['required'],
        ]);

        $employee = Employee::find($this->request['empId']);
        $vendors = array();
        $contractors = array();
        if ($employee['category'] == config('constants.EMP_CATEGORY_C2C')) {
            // $vendors = Vendor::all();
        } else if ($employee['category'] == config('constants.EMP_CATEGORY_1099')) {
            $contractors = Employee::where([
                ['category', '=', config('constants.EMP_CATEGORY_1099')]
            ])->get();
        }

        return response()->json([
            'result' => 'success',
            'employee' => $employee,
            'vendors' => $vendors,
            'contractors' => $contractors
        ]);
    }
    // =========================== END PUBLIC FUNCTIONS ===========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    /**
     * Get client's placements from model.
     */
    private function getOnesPlacementTblRecords()
    {
        // Params
        $columns = ['', '', 'employee_id', 'job_tire_id', 'job_status', 'job_start_date', 'job_end_date', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get client records for filter condition.
        $whereConds = array();
        $whereOwnConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_client_id'] != NULL) {
                $whereConds[] = ['client_id', '=', $this->request['filt_client_id']];
                $whereOwnConds[] = ['client_id', '=', $this->request['filt_client_id']];
            }
            if ($this->request['filt_employee_name'] != NULL)
                $whereConds[] = ['bankname', 'like', '%' . $this->request['filt_employee_name'] . '%'];
            if ($this->request['filt_job_tire'] != NULL)
                $whereConds[] = ['job_tire_id', '=', $this->request['filt_job_tire']];
            if ($this->request['filt_job_status'] != NULL)
                $whereConds[] = ['job_status', 'like', $this->request['filt_job_status']];
            if ($this->request['filt_netterms_from'] != NULL)
                $whereConds[] = ['net_terms', '>=', $this->request['filt_netterms_from']];
            if ($this->request['filt_netterms_to'] != NULL)
                $whereConds[] = ['net_terms', '<=', $this->request['filt_netterms_to']];
            if ($this->request['filt_start_date_from'] != NULL)
                $whereConds[] = ['job_start_date', '>=', $this->request['filt_start_date_from']];
            if ($this->request['filt_start_date_to'] != NULL)
                $whereConds[] = ['job_start_date', '<=', $this->request['filt_start_date_to']];
            if ($this->request['filt_end_date_from'] != NULL)
                $whereConds[] = ['job_end_date', '>=', $this->request['filt_end_date_from']];
            if ($this->request['filt_end_date_to'] != NULL)
                $whereConds[] = ['job_end_date', '<=', $this->request['filt_end_date_to']];
        }

        // All record count
        $totalRecordCnt = count(ClientPlacement::where($whereOwnConds)->get());

        // Filtered records
        $filteredRecords = ClientPlacement::with([
            'client',
            'employee',
            'jobTire'
        ])->where($whereConds)
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record count
        $filteredCnt = count(ClientPlacement::where($whereConds)->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate client's placement list table items
     */
    private function makeOnesPlacementTblColumns($finalRecords, $totalCnt, $filteredCnt)
    {
        $iTotalRecords = $filteredCnt;
        $iDisplayLength = intval($this->request['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($this->request['start']);
        $sEcho = intval($this->request['draw']);

        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $idx = $iDisplayStart + 1;
        foreach ($finalRecords as $finalRecord) {
            $employeeName = ($finalRecord->employee != null) ? ($finalRecord->employee->first_name . ' ' . $finalRecord->employee->last_name) : '';
            $jobTireName = ($finalRecord->jobTire != null) ? $finalRecord->jobTire->name : '';

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $finalRecord->id . '">',
                $idx,
                $employeeName,
                $jobTireName,
                $finalRecord->net_terms,
                $finalRecord->job_status == 1 ? '<span class="label label-sm label-primary">Active</span>' : '<span class="label label-sm label-grey">Inactive</span>',
                $finalRecord->job_start_date,
                $finalRecord->job_end_date,
                '<a href="javascript:;" class="btn btn-xs btn-c-grey btn-placement-delete" data-id="' . $finalRecord->id . '"*><i class="fa fa-trash"></i></a>'
            );
            $idx++;
        }

        if (isset($this->request['customActionType']) && $this->request['customActionType'] == "group_action") {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $totalCnt;
        $records["recordsFiltered"] = $filteredCnt;

        return response()->json($records);
    }

    /**
     * Get placement activities from model.
     */
    private function getActivitiesTblRecords()
    {
        // Params
        $columns = ['', 'created_at', 'updated_by', 'description'];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get client records for filter condition.
        $whereConds = array();
        $whereOwnConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_client_id'] != NULL) {
                $whereConds[] = ['client_id', '=', $this->request['filt_client_id']];
                $whereOwnConds[] = ['client_id', '=', $this->request['filt_client_id']];
            }
            if ($this->request['filt_act_date_from'] != NULL)
                $whereConds[] = ['created_at', '>=', $this->request['filt_act_date_from']];
            if ($this->request['filt_act_date_to'] != NULL)
                $whereConds[] = ['created_at', '<=', $this->request['filt_act_date_to']];
            if ($this->request['filt_act_description'] != NULL)
                $whereConds[] = ['description', 'like', '%' . $this->request['filt_act_description'] . '%'];
        }

        // All record count
        $totalRecordCnt = count(ClientPlacementActivity::where($whereOwnConds)->get());

        // Filtered records
        $filteredRecords = ClientPlacementActivity::with([
            'updatedBy'
        ])->where($whereConds)
            ->whereRelation('updatedBy', 'email', 'like', '%' . $this->request['filt_act_updatedby'] . '%')
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record count
        $filteredCnt = count(ClientPlacementActivity::with([
            'updatedBy'
        ])->where($whereConds)
            ->whereRelation('updatedBy', 'email', 'like', '%' . $this->request['filt_act_updatedby'] . '%')
            ->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate placement activities list table items
     */
    private function makeActivitiesTblColumns($finalRecords, $totalCnt, $filteredCnt)
    {
        $iTotalRecords = $filteredCnt;
        $iDisplayLength = intval($this->request['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($this->request['start']);
        $sEcho = intval($this->request['draw']);

        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $idx = $iDisplayStart + 1;
        foreach ($finalRecords as $finalRecord) {
            $records["data"][] = array(
                $idx,
                $finalRecord->created_at,
                $finalRecord->updatedBy->email,
                $finalRecord->description
            );
            $idx++;
        }

        if (isset($this->request['customActionType']) && $this->request['customActionType'] == "group_action") {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $totalCnt;
        $records["recordsFiltered"] = $filteredCnt;

        return response()->json($records);
    }

    /**
     * Get client's invoices from model.
     */
    private function getInvoicesTblRecords()
    {
        // Params
        $columns = ['', 'employee_id', 'invoice_date', 'invoice_due_date', '', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get client records for filter condition.
        $whereConds = array();
        $whereOwnConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_client_id'] != NULL) {
                $whereConds[] = ['client_id', '=', $this->request['filt_client_id']];
                $whereOwnConds[] = ['client_id', '=', $this->request['filt_client_id']];
            }
            if ($this->request['filt_invdate_from'] != NULL)
                $whereConds[] = ['invoice_date', '>=', $this->request['filt_invdate_from']];
            if ($this->request['filt_invdate_to'] != NULL)
                $whereConds[] = ['invoice_date', '<=', $this->request['filt_invdate_to']];
            if ($this->request['filt_invduedate_from'] != NULL)
                $whereConds[] = ['invoice_due_date', '>=', $this->request['filt_invduedate_from']];
            if ($this->request['filt_invduedate_to'] != NULL)
                $whereConds[] = ['invoice_due_date', '<=', $this->request['filt_invduedate_to']];
            // if ($this->request['filt_status'] != NULL)
            //     $whereConds[] = ['status', '==', $this->request['filt_status']];
        }

        // All record count
        $totalRecordCnt = count(Invoice::where($whereOwnConds)->get());

        // Filtered records
        $filteredRecords = Invoice::with([
            'employee'
        ])->where($whereConds)
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record count
        $filteredCnt = count(Invoice::with([
            'employee'
        ])->where($whereConds)
            ->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate client's invoices list table items
     */
    private function makeInvoicesTblColumns($finalRecords, $totalCnt, $filteredCnt)
    {
        $iTotalRecords = $filteredCnt;
        $iDisplayLength = intval($this->request['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($this->request['start']);
        $sEcho = intval($this->request['draw']);

        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $idx = $iDisplayStart + 1;
        foreach ($finalRecords as $finalRecord) {
            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $finalRecord->id . '">',
                $idx,
                $finalRecord->employee->first_name,
                $finalRecord->invoice_date,
                $finalRecord->invoice_due_date,
                rand() % 2 == 0 ? '<span class="label label-sm label-primary">Active</span>' : '<span class="label label-sm label-grey">Inactive</span>',
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-eye"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-primary btn-client-edit" data-id="' . $finalRecord->id . '"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-client-download" data-id="' . $finalRecord->id . '"><i class="fa fa-download"></i></a>'
            );
            $idx++;
        }

        if (isset($this->request['customActionType']) && $this->request['customActionType'] == "group_action") {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $totalCnt;
        $records["recordsFiltered"] = $filteredCnt;

        return response()->json($records);
    }
// ========================== END PRIVATE FUNCTIONS ==========================
}