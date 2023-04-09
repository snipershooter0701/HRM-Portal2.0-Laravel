<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\WorkAuth;
use App\Models\Poc;
use App\Models\JobTire;

class SettingGeneralController extends Controller
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
     * Show the General Settings page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('settings.general.index')->with('randNum', rand());
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get department list from model and generate columns for ajax table. (tbl_department)
     */
    public function getDepartmentList()
    {
        $recordData = $this->getDepartmentTableList();
        $result = $this->makeDepartmentTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Create department.
     */
    public function createDepartment()
    {
        // Check Validation
        $this->request->validate([
            'name' => ['required']
        ]);

        // Create new record
        Department::create([
            'name' => $this->request['name']
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Update department.
     */
    public function updateDepartment()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
            'name' => ['required']
        ]);

        // Update
        $department = Department::find($this->request['id']);
        $department->update([
            'name' => $this->request['name']
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Delete department.
     */
    public function deleteDepartment()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required']
        ]);

        // Update
        $department = Department::find($this->request['id']);
        $department->delete();

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Get workauth list from model and generate columns for ajax table. (tbl_work_auths)
     */
    public function getWorkauthList()
    {
        $recordData = $this->getWorkauthTableList();
        $result = $this->makeWorkauthTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Create workauth.
     */
    public function createWorkAuth()
    {
        // Check Validation
        $this->request->validate([
            'name' => ['required']
        ]);

        // Create new record
        WorkAuth::create([
            'name' => $this->request['name']
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Update workauth.
     */
    public function updateWorkAuth()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
            'name' => ['required']
        ]);

        // Update
        $workauth = WorkAuth::find($this->request['id']);
        $workauth->update([
            'name' => $this->request['name']
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Delete workauth.
     */
    public function deleteWorkAuth()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required']
        ]);

        // Update
        $workauth = WorkAuth::find($this->request['id']);
        $workauth->delete();

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Get poc list from model and generate columns for ajax table. (tbl_pocs)
     */
    public function getPocList()
    {
        $recordData = $this->getPocTableList();
        $result = $this->makePocTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Create poc.
     */
    public function createPoc()
    {
        // Check Validation
        $this->request->validate([
            'name' => ['required']
        ]);

        // Create new record
        Poc::create([
            'name' => $this->request['name']
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Update poc.
     */
    public function updatePoc()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
            'name' => ['required']
        ]);

        // Update
        $poc = Poc::find($this->request['id']);
        $poc->update([
            'name' => $this->request['name']
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Delete jobtire.
     */
    public function deletePoc()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required']
        ]);

        // Update
        $jobtire = Poc::find($this->request['id']);
        $jobtire->delete();

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Get job tire list from model and generate columns for ajax table. (tbl_job_tires)
     */
    public function getJobtireList()
    {
        $recordData = $this->getJobtireTableList();
        $result = $this->makeJobtireTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Create jobtire.
     */
    public function createJobTire()
    {
        // Check Validation
        $this->request->validate([
            'name' => ['required']
        ]);

        // Create new record
        JobTire::create([
            'name' => $this->request['name']
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Update jobtire.
     */
    public function updateJobTire()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
            'name' => ['required']
        ]);

        // Update
        $jobtire = JobTire::find($this->request['id']);
        $jobtire->update([
            'name' => $this->request['name']
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Delete jobtire.
     */
    public function deleteJobTire()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required']
        ]);

        // Update
        $jobtire = JobTire::find($this->request['id']);
        $jobtire->delete();

        return response()->json([
            'result' => 'success'
        ]);
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    /**
     * Get department list from model.
     */
    private function getDepartmentTableList()
    {
        // Params
        $columns = ['', 'name', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get filter condition.
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_name'] != NULL)
                $whereConds[] = ['name', 'like', '%' . $this->request['filt_name'] . '%'];
        }

        // All record count
        $totalRecordCnt = Department::count();

        // Filtered records
        $filteredRecords = Department::where($whereConds)
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record cnt
        $filteredCnt = count(Department::where($whereConds)->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate department list table items
     */
    private function makeDepartmentTblColumns($finalRecords, $totalCnt, $filteredCnt)
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
                $finalRecord->name,
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-department-edit" data-id="' . $finalRecord->id . '"  data-name="' . $finalRecord->name . '"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-department-delete" data-id="' . $finalRecord->id . '" data-name="' . $finalRecord->name . '"><i class="fa fa-trash"></i></a>'
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
     * Get work auth list from model.
     */
    private function getWorkauthTableList()
    {
        // Params
        $columns = ['', 'name', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get filter condition.
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_name'] != NULL)
                $whereConds[] = ['name', 'like', '%' . $this->request['filt_name'] . '%'];
        }

        // All record count
        $totalRecordCnt = WorkAuth::count();

        // Filtered records
        $filteredRecords = WorkAuth::where($whereConds)
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record cnt
        $filteredCnt = count(WorkAuth::where($whereConds)->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate work auth list table items
     */
    private function makeWorkauthTblColumns($finalRecords, $totalCnt, $filteredCnt)
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
                $finalRecord->name,
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-workauth-edit" data-id="' . $finalRecord->id . '"  data-name="' . $finalRecord->name . '"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-workauth-delete" data-id="' . $finalRecord->id . '" data-name="' . $finalRecord->name . '"><i class="fa fa-trash"></i></a>'
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
     * Get poc list from model.
     */
    private function getPocTableList()
    {
        // Params
        $columns = ['', 'name', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get filter condition.
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_name'] != NULL)
                $whereConds[] = ['name', 'like', '%' . $this->request['filt_name'] . '%'];
        }

        // All record count
        $totalRecordCnt = Poc::count();

        // Filtered records
        $filteredRecords = Poc::where($whereConds)
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record cnt
        $filteredCnt = count(Poc::where($whereConds)->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate poc list table items
     */
    private function makePocTblColumns($finalRecords, $totalCnt, $filteredCnt)
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
                $finalRecord->name,
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-poc-edit" data-id="' . $finalRecord->id . '"  data-name="' . $finalRecord->name . '"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-poc-delete" data-id="' . $finalRecord->id . '" data-name="' . $finalRecord->name . '"><i class="fa fa-trash"></i></a>'
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
     * Get job tire list from model.
     */
    private function getJobtireTableList()
    {
        // Params
        $columns = ['', 'name', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get filter condition.
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_name'] != NULL)
                $whereConds[] = ['name', 'like', '%' . $this->request['filt_name'] . '%'];
        }

        // All record count
        $totalRecordCnt = JobTire::count();

        // Filtered records
        $filteredRecords = JobTire::where($whereConds)
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record cnt
        $filteredCnt = count(JobTire::where($whereConds)->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate job tire list table items
     */
    private function makeJobtireTblColumns($finalRecords, $totalCnt, $filteredCnt)
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
                $finalRecord->name,
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-jobtire-edit" data-id="' . $finalRecord->id . '"  data-name="' . $finalRecord->name . '"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-jobtire-delete" data-id="' . $finalRecord->id . '" data-name="' . $finalRecord->name . '"><i class="fa fa-trash"></i></a>'
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