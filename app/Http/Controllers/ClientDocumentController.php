<?php

namespace App\Http\Controllers;

use App\Models\ClientPlacementDoc;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ClientDocumentController extends Controller
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
     * Get a client's document list from model and generate columns for ajax table. (tbl_placements)
     */
    public function getTableDocumentList()
    {
        $recordData = $this->getDocumentTblRecords();
        $result = $this->makeDocumentTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Create document.
     */
    public function create()
    {
        // Check Validation
        $this->request->validate([
            'employee_id' => ['required'],
            'client_id' => ['required'],
            'job_tire_id' => ['required'],
            'client_placement_id' => ['required'],
            'client_placement_doctype_id' => ['required'],
            'title' => ['required'],
            'comment' => ['required'],
            'expire_date' => ['required'],
            'attachment' => ['required'],
        ]);

        // Create new record
        ClientPlacementDoc::create([
            'employee_id' => $this->request['employee_id'],
            'client_id' => $this->request['client_id'],
            'job_tire_id' => $this->request['job_tire_id'],
            'client_placement_id' => $this->request['client_placement_id'],
            'client_placement_doctype_id' => $this->request['client_placement_doctype_id'],
            'title' => $this->request['title'],
            'comment' => $this->request['comment'],
            'expire_date' => $this->request['expire_date'],
            'attachment' => $this->request['attachment'],
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Delete client's document.
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
    private function getDocumentTblRecords()
    {
        // Params
        $columns = ['', 'title', '', '', 'status', 'expire_date', ''];
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
            if ($this->request['filt_title'] != NULL)
                $whereConds[] = ['title', 'like', '%' . $this->request['filt_title'] . '%'];
            if ($this->request['filt_document_type'] != NULL)
                $whereConds[] = ['client_placement_doctype_id', '=', $this->request['filt_document_type']];
            if ($this->request['filt_status'] != NULL)
                $whereConds[] = ['status', '=', $this->request['filt_status']];
            if ($this->request['filt_expiredate_from'] != NULL)
                $whereConds[] = ['expire_date', '>=', $this->request['filt_expiredate_from']];
            if ($this->request['filt_expiredate_to'] != NULL)
                $whereConds[] = ['expire_date', '<=', $this->request['filt_expiredate_to']];
        }

        // All record count
        $totalRecordCnt = count(ClientPlacementDoc::where($whereOwnConds)->get());

        // Filtered records
        $filteredRecords = ClientPlacementDoc::with([
            'employee',
            'doctype'
        ])->where($whereConds)
            ->whereHas('employee', function (Builder $query) {
                if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
                    if ($this->request['filt_employee'] != NULL)
                        $query->where('email', 'like', '%' . $this->request['filt_employee'] . '%');
                }
            })
            // ->whereRelation('employee', 'email', 'like', '%' . $this->request['filt_employee'] . '%')
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record count
        $filteredCnt = count(
            ClientPlacementDoc::with([
                'employee',
                'doctype'
            ])->where($whereConds)
                ->whereHas('employee', function (Builder $query) {
                    if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
                        if ($this->request['filt_employee'] != NULL)
                            $query->where('email', 'like', '%' . $this->request['filt_employee'] . '%');
                    }
                })->get()
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
    private function makeDocumentTblColumns($finalRecords, $totalCnt, $filteredCnt)
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
                $finalRecord->title,
                $finalRecord->doctype->name,
                $finalRecord->employee->email,
                $finalRecord->status == config('constants.STATE_ACTIVE') ? '<span class="label label-sm label-primary">Active</span>' : '<span class="label label-sm label-grey">Inactive</span>',
                $finalRecord->expire_date,
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-view" data-id="' . $finalRecord->id . '"><i class="fa fa-eye"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-primary btn-client-edit" data-id="' . $finalRecord->id . '"><i class="fa fa-pencil"></i></a>'
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