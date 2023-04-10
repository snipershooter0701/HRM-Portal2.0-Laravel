<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Role;
use App\Models\RoleActivity;
use App\Models\Department;

class SettingRoleController extends Controller
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
        $departments = Department::all();

        return view('settings.role.index')->with([
            'randNum' => rand(),
            'departments' => $departments
        ]);
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get role list from model and generate columns for ajax table. (tbl_role_permission)
     */
    public function getTableRoles()
    {
        $recordData = $this->getRoleTableList();
        $result = $this->makeRoleTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Create role.
     */
    public function create()
    {
        // Check Validation
        $this->request->validate([
            'name' => ['required'],
            'department_id' => ['required']
        ]);

        // Create new record
        $role = Role::create([
            'name' => $this->request['name'],
            'department_id' => $this->request['department_id']
        ]);

        // Create new activity.
        $department = Department::find($this->request['department_id']);
        $description = "Created new role (Role: " . $role['name'] . ", Department: " . $department['name'] . ")";
        RoleActivity::create([
            'role_id' => $role['id'],
            'updated_by' => config('constants.AUTH_ID'),
            'description' => $description
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Update role.
     */
    public function update()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
            'name' => ['required'],
            'department_id' => ['required']
        ]);

        // Update
        $role = Role::find($this->request['id']);
        $role->update([
            'name' => $this->request['name'],
            'department_id' => $this->request['department_id']
        ]);

        // Create new activity.
        $department = Department::find($this->request['department_id']);
        $description = "Updated role (Role: " . $role['name'] . ", Department: " . $department['name'] . ")";
        RoleActivity::create([
            'role_id' => $role['id'],
            'updated_by' => config('constants.AUTH_ID'),
            'description' => $description
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Delete role.
     */
    public function delete()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required']
        ]);

        // Delete
        $role = Role::find($this->request['id']);
        $role->delete();

        // Create new activity.
        $department = Department::find($role['department_id']);
        $description = "Deleted role (Role: " . $role['name'] . ", Department: " . $department['name'] . ")";
        RoleActivity::create([
            'role_id' => $role['id'],
            'updated_by' => config('constants.AUTH_ID'),
            'description' => $description
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Get role list from model and generate columns for ajax table. (tbl_role_activities)
     */
    public function getTableRoleActs()
    {
        $recordData = $this->getRoleActTableList();
        $result = $this->makeRoleActTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    /**
     * Get role list from model.
     */
    private function getRoleTableList()
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
        $totalRecordCnt = Role::count();

        // Filtered records
        $filteredRecords = Role::with([
            'department'
        ])->where($whereConds)
            ->whereHas('department', function (Builder $query) {
                if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
                    if ($this->request['filt_department'] != NULL)
                        $query->where('id', $this->request['filt_department']);
                }
            })
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record cnt
        $filteredCnt = count(Role::where($whereConds)->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate role list table items
     */
    private function makeRoleTblColumns($finalRecords, $totalCnt, $filteredCnt)
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
                ($finalRecord->department) ? $finalRecord->department->name : '',
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-role-edit" data-id="' . $finalRecord->id . '"  data-name="' . $finalRecord->name . '" data-department="' . $finalRecord->department_id . '"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-role-delete" data-id="' . $finalRecord->id . '" data-name="' . $finalRecord->name . '"><i class="fa fa-trash"></i></a>'
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
     * Get role activity list from model.
     */
    private function getRoleActTableList()
    {
        // Params
        $columns = ['', 'created_at', '', 'description'];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['lengh'];

        // Get filter condition.t
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_act_date_from'] != NULL)
                $whereConds[] = ['created_at', '>=', $this->request['filt_act_date_from']];
            if ($this->request['filt_act_date_to'] != NULL)
                $whereConds[] = ['created_at', '<=', $this->request['filt_act_date_to']];
            if ($this->request['filt_act_description'] != NULL)
                $whereConds[] = ['description', 'like', '%' . $this->request['filt_act_description'] . '%'];
        }

        // All record count
        $totalRecordCnt = RoleActivity::count();

        // Filtered records
        $filteredRecords = RoleActivity::with([
            'updatedBy'
        ])->where($whereConds)
            ->whereHas('updatedBy', function (Builder $query) {
                if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
                    if ($this->request['filt_act_updatedby'] != NULL)
                        $query->where('email', 'like', '%' . $this->request['filt_act_updatedby'] . '%');
                }
            })
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record cnt
        $filteredCnt = count(RoleActivity::where($whereConds)->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate role activity list table items
     */
    private function makeRoleActTblColumns($finalRecords, $totalCnt, $filteredCnt)
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
                ($finalRecord->updatedBy) ? $finalRecord->updatedBy->email : '',
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