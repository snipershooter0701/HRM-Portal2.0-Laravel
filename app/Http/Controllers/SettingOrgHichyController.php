<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Level;
use App\Models\LevelRole;
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
     * Get level by level_id
     */
    public function getLevelById()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required']
        ]);

        $levelId = $this->request['id'];

        $level = Level::with('roles')->where(['id' => $levelId])->first();

        return response()->json([
            'result' => 'success',
            'level' => $level
        ]);
    }

    /**
     * Create level.
     */
    public function create()
    {
        // Check Validation
        $this->request->validate([
            'name' => ['required', 'numeric']
        ]);

        // Create new record
        $level = Level::create([
            'name' => $this->request['name']
        ]);

        // Create new activity.
        $description = "Created new level (Level: " . $level['name'] . ")";
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
            'level_id' => ['required']
        ]);

        // Update
        $levelId = $this->request['level_id'];
        $roles = $this->request['roles'];
        LevelRole::where([
            'level_id' => $levelId
        ])->delete();
        foreach ($roles as $role) {
            LevelRole::create([
                'level_id' => $levelId,
                'role_id' => $role,
            ]);
        }

        // Create new activity.
        $level = Level::find($levelId);
        $description = "Updated role (Level: " . $level['name'] . ")";
        LevelActivity::create([
            'level_id' => $level['id'],
            'updated_by' => Auth::user()->employee->id,
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

        LevelRole::where([
            'level_id' => $this->request['id']
        ])->delete();

        // Create new activity.
        $description = "Deleted level (Level: " . $level['name'] . ")";
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
        $filteredRecords = Level::select(['levels.id as id', 'levels.name as name', 'level_roles.role_id as role_id'])
            ->leftJoin('level_roles', function ($join) {
                $join->on('levels.id', '=', 'level_roles.level_id');
            })->where($whereConds)
            ->groupBy(['id'])
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
            $actionBtn = '
                <a href="javascript:;" class="btn btn-xs btn-c-primary btn-level-edit" data-id="' . $finalRecord->id . '">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-level-delete" data-id="' . $finalRecord->id . '">
                    <i class="fa fa-trash"></i>
                </a>
            ';

            $roleNames = "";
            $roleCnt = count($finalRecord->roles);
            for ($i = 0; $i < $roleCnt; $i++)
                $roleNames .= ($i == 0 ? "" : ", ") . $finalRecord->roles[$i]->role->name;

            $records["data"][] = array(
                $idx,
                $finalRecord->name,
                $roleNames,
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