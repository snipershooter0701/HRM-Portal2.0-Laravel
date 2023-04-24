<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ClientPlacementDoctype;
use App\Models\Employee;
use App\Models\Client;
use App\Models\ClientPlacement;
use App\Models\ClientPlacementActivity;
use App\Models\JobTire;

class ClientAllPlacementController extends Controller
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

    /**
     * Show the client list page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients = Client::all();
        $employees = Employee::all();
        $jobTires = JobTire::all();
        $docTypes = ClientPlacementDoctype::all();

        return view('client.all_placements.index')->with([
            'randNum' => rand(),
            'clients' => $clients,
            'employees' => $employees,
            'jobTires' => $jobTires,
            'docTypes' => $docTypes
        ]);
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get a client's placement list from model and generate columns for ajax table. (tbl_placements)
     */
    public function getTablePlacementList()
    {
        $recordData = $this->getOnesPlacementTblRecords();
        $result = $this->makeOnesPlacementTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Get placement activities list from model and generate columns for ajax table. (tbl_placement_activities)
     */
    public function getTableActivitieList()
    {
        $recordData = $this->getActivitiesTblRecords();
        $result = $this->makeActivitiesTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
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
            'client_bill_rate' => ['required'],
            // 'client_ot_bill_rate' => ['required'],
            // 'client_dt_bill_rate' => ['required'],
            // 'client_vendor_id' => ['required', 'numeric'],
            // 'vendor_contractor_id' => ['required'],
            // 'vendor_contractor_netterms' => ['required'],
            // 'vendor_contractor_po_attachment' => ['required'],
            // 'vendor_contractor_po_id' => ['required'],
            // 'vendor_contractor_bill_rate' => ['required'],
            // 'vendor_contractor_at_bill_rate' => ['required'],
            // 'vendor_contractor_dt_bill_rate' => ['required'],
            'job_title' => ['required'],
            'job_status' => ['required'],
            'job_start_date' => ['required'],
            'job_end_date' => ['required'],
            'invoice_frequency' => ['required'],
            'pay_effect_date' => ['required'],
        ]);

        // Create new record
        ClientPlacement::create([
            'client_id' => $this->request['client_id'],
            'employee_id' => $this->request['employee_id'],
            'job_tire_id' => $this->request['job_tire_id'],
            'net_terms' => $this->request['net_terms'],
            'po_attachment' => $this->request['po_attachment'],
            'po_id' => $this->request['po_id'],
            'client_bill_rate' => $this->request['client_bill_rate'],
            'client_ot_bill_rate' => $this->request['client_ot_bill_rate'],
            'client_dt_bill_rate' => $this->request['client_dt_bill_rate'],
            'client_vendor_id' => $this->request['client_vendor_id'],
            'vendor_contractor_id' => $this->request['vendor_contractor_id'],
            'vendor_contractor_netterms' => $this->request['vendor_contractor_netterms'],
            'vendor_contractor_po_attachment' => $this->request['vendor_contractor_po_attachment'],
            'vendor_contractor_po_id' => $this->request['vendor_contractor_po_id'],
            'vendor_contractor_bill_rate' => $this->request['vendor_contractor_bill_rate'],
            'vendor_contractor_at_bill_rate' => $this->request['vendor_contractor_at_bill_rate'],
            'vendor_contractor_dt_bill_rate' => $this->request['vendor_contractor_dt_bill_rate'],
            'job_title' => $this->request['job_title'],
            'job_status' => $this->request['job_status'],
            'job_start_date' => $this->request['job_start_date'],
            'job_end_date' => $this->request['job_end_date'],
            'invoice_frequency' => $this->request['invoice_frequency'],
            'pay_effect_date' => $this->request['pay_effect_date']
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
    // =========================== END PUBLIC FUNCTIONS ===========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    /**
     * Get client's placements from model.
     */
    private function getOnesPlacementTblRecords()
    {
        // Params
        $columns = ['', '', 'employee_id', 'client_id', 'job_tire_id', 'net_terms', 'job_status', 'job_start_date', 'job_end_date', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get client records for filter condition.
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            // if ($this->request['filt_employee'] != NULL)
            //     $whereConds[] = ['employee', 'like', '%' . $this->request['filt_employee'] . '%'];
            // if ($this->request['filt_client'] != NULL)
            //     $whereConds[] = ['bankname', 'like', '%' . $this->request['filt_client'] . '%'];
            if ($this->request['filt_job_tire'] != NULL)
                $whereConds[] = ['job_tire_id', '=', $this->request['filt_job_tire']];
            if ($this->request['filt_netterms_from'] != NULL)
                $whereConds[] = ['net_terms', '>=', $this->request['filt_netterms_from']];
            if ($this->request['filt_netterms_to'] != NULL)
                $whereConds[] = ['net_terms', '<=', $this->request['filt_netterms_to']];
            if ($this->request['filt_job_status'] != NULL)
                $whereConds[] = ['job_status', '=', $this->request['filt_job_status']];
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
        $totalRecordCnt = count(ClientPlacement::all());

        // Filtered records
        $filteredRecords = ClientPlacement::with([
            'client',
            'employee',
            'jobTire'
        ])->where($whereConds)
            ->whereHas('employee', function (Builder $query) {
                if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
                    if ($this->request['filt_employee'] != NULL)
                        $query->where('email', 'like', '%' . $this->request['filt_employee'] . '%');
                }
            })
            ->whereHas('client', function (Builder $query) {
                if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
                    if ($this->request['filt_client'] != NULL)
                        $query->where('email', 'like', '%' . $this->request['filt_client'] . '%');
                }
            })
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record count
        $filteredCnt = count(
            ClientPlacement::with([
                'client',
                'employee',
                'jobTire'
            ])->where($whereConds)
                ->whereHas('employee', function (Builder $query) {
                    if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
                        if ($this->request['filt_employee'] != NULL)
                            $query->where('email', 'like', '%' . $this->request['filt_employee'] . '%');
                    }
                })
                ->whereHas('client', function (Builder $query) {
                    if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
                        if ($this->request['filt_client'] != NULL)
                            $query->where('email', 'like', '%' . $this->request['filt_client'] . '%');
                    }
                })
                ->get()
        );

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
            $employeeName = ($finalRecord->employee != null) ? ($finalRecord->employee->email) : '';
            $clientName = ($finalRecord->client != null) ? ($finalRecord->client->email) : '';
            $jobTireName = ($finalRecord->jobTire != null) ? $finalRecord->jobTire->name : '';

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $finalRecord->id . '">',
                $idx,
                $employeeName,
                $clientName,
                $jobTireName,
                $finalRecord->net_terms,
                $finalRecord->job_status == config('constants.STATE_ACTIVE') ? '<span class="label label-sm label-primary">Active</span>' : '<span class="label label-sm label-grey">Inactive</span>',
                $finalRecord->job_start_date,
                $finalRecord->job_end_date,
                '<a href="javascript:;" class="btn btn-xs btn-c-grey btn-placement-edit" data-id="' . $finalRecord->id . '"*><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-placement-delete" data-id="' . $finalRecord->id . '"*><i class="fa fa-trash"></i></a>'
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
// ========================== END PRIVATE FUNCTIONS ==========================
}