<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Role;
use App\Models\Level;
use App\Models\LevelActivity;

class SettingOrgHichyController extends Controller
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
     * Show the Organization Hierarchy Settings page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $roles = Role::all();

        return view('settings.org_hierarchy.index')->with([
            'randNum' => rand(),
            'roles' => $roles
        ]);
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get role list from model and generate columns for ajax table. (tbl_role_permission)
     */
    public function getTableRoles()
    {
        $recordData = $this->getLevelTableList();
        $result = $this->makeLevelTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Create level.
     */
    public function create()
    {
        // Check Validation
        $this->request->validate([
            'name' => ['required'],
            'role_id' => ['required']
        ]);

        // Create new record
        $level = Level::create([
            'name' => $this->request['name'],
            'role_id' => $this->request['role_id']
        ]);

        // Create new activity.
        $role = Role::find($this->request['role_id']);
        $description = "Created new level (Level: " . $level['name'] . ", Role: " . $role['name'] . ")";
        LevelActivity::create([
            'level_id' => $level['id'],
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
            'role_id' => ['required']
        ]);

        // Update
        $level = Level::find($this->request['id']);
        $level->update([
            'name' => $this->request['name'],
            'role_id' => $this->request['role_id']
        ]);

        // Create new activity.
        $role = Role::find($this->request['role_id']);
        $description = "Updated role (Level: " . $level['name'] . ", Role: " . $role['name'] . ")";
        LevelActivity::create([
            'level_id' => $level['id'],
            'updated_by' => config('constants.AUTH_ID'),
            'description' => $description
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Delete level.
     */
    public function delete()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required']
        ]);

        // Delete
        $level = Level::find($this->request['id']);
        $level->delete();

        // Create new activity.
        $role = Role::find($level['role_id']);
        $description = "Deleted level (Level: " . $level['name'] . ", Role: " . $role['name'] . ")";
        LevelActivity::create([
            'level_id' => $level['id'],
            'updated_by' => config('constants.AUTH_ID'),
            'description' => $description
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Get level list from model and generate columns for ajax table. (tbl_level_activities)
     */
    public function getTableLevelActs()
    {
        $recordData = $this->getLevelActTableList();
        $result = $this->makeLevelActTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    /**
     * Get level list from model.
     */
    private function getLevelTableList()
    {
        // Params
        $columns = ['', 'name', '', ''];
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
        $totalRecordCnt = Level::count();

        // Filtered records
        $filteredRecords = Level::with([
            'role'
        ])->where($whereConds)
            ->whereHas('role', function (Builder $query) {
                if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
                    if ($this->request['filt_role'] != NULL)
                        $query->where('id', $this->request['filt_role']);
                }
            })
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record cnt
        $filteredCnt = count(Level::where($whereConds)->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate role list table items
     */
    private function makeLevelTblColumns($finalRecords, $totalCnt, $filteredCnt)
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
            $actionBtn = '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-level-edit" data-id="' . $finalRecord->id . '"  data-name="' . $finalRecord->name . '" data-role="' . $finalRecord->role_id . '"><i class="fa fa-pencil"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-c-grey btn-level-delete" data-id="' . $finalRecord->id . '" data-name="' . $finalRecord->name . '"><i class="fa fa-trash"></i></a>';

            $records["data"][] = array(
                $idx,
                $finalRecord->name,
                ($finalRecord->role) ? $finalRecord->role->name : '',
                $actionBtn
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
     * Get level activity list from model.
     */
    private function getLevelActTableList()
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
        $totalRecordCnt = LevelActivity::count();

        // Filtered records
        $filteredRecords = LevelActivity::with([
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
        $filteredCnt = count(LevelActivity::where($whereConds)->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate level activity list table items
     */
    private function makeLevelActTblColumns($finalRecords, $totalCnt, $filteredCnt)
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