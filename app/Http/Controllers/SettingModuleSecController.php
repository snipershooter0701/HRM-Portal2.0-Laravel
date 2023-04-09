<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Role;
use App\Models\Module;
use App\Models\RoleModule;

class SettingModuleSecController extends Controller
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
     * Show the Module Security Settings page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $modules = Module::all();

        return view('settings.module_sec.index')->with([
            'randNum' => rand(),
            'modules' => $modules
        ]);
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get module security list from model and generate columns for ajax table. (tbl_module_security)
     */
    public function getTableRoles()
    {
        $recordData = $this->getModuleSecTableList();
        $result = $this->makeModuleSecTblItems($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Get role and modules of role by role_id
     */
    public function getRoleById()
    {
        $role = Role::find($this->request['id']);
        $roleModule = RoleModule::where([
            ['role_id', $this->request['id']]
        ])->get();
        return response()->json([
            'role' => $role,
            'roleModule' => $roleModule,
            'result' => 'success'
        ]);
    }

    /**
     * Update role and role's modules
     */
    public function update()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
            'access_view' => ['required'],
            'access_add' => ['required'],
            'access_edit' => ['required'],
            'access_delete' => ['required'],
            'modules' => ['required']
        ]);

        $roleModuleIds = $this->request['modules'];
        $role = Role::find($this->request['id']);
        $role->update([
            'access_view' => $this->request['access_view'],
            'access_add' => $this->request['access_add'],
            'access_edit' => $this->request['access_edit'],
            'access_delete' => $this->request['access_delete'],
            'access_permission' => count($roleModuleIds)
        ]);

        // Add RoleModules
        RoleModule::where([
            ['role_id', $this->request['id']]
        ])->delete();
        foreach($roleModuleIds as $roleModuleId) {
            RoleModule::create([
                'role_id' => $this->request['id'],
                'module_id' => $roleModuleId
            ]);
        }

        return response()->json([
            'result' => 'success'
        ]);
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    /**
     * Get module security list from model.
     */
    private function getModuleSecTableList()
    {
        // Params
        $columns = ['', 'name', '', '', '', '', 'access_permission', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get filter condition.
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_name'] != NULL)
                $whereConds[] = ['name', 'like', '%' . $this->request['filt_name'] . '%'];
            if ($this->request['filt_view'] != NULL)
                $whereConds[] = ['access_view', '=', $this->request['filt_view']];
            if ($this->request['filt_add'] != NULL)
                $whereConds[] = ['access_add', '=', $this->request['filt_add']];
            if ($this->request['filt_edit'] != NULL)
                $whereConds[] = ['access_edit', '=', $this->request['filt_edit']];
            if ($this->request['filt_delete'] != NULL)
                $whereConds[] = ['access_delete', '=', $this->request['filt_delete']];
            if ($this->request['filt_permi_from'] != NULL)
                $whereConds[] = ['access_permission', '>=', $this->request['filt_permi_from']];
            if ($this->request['filt_permi_to'] != NULL)
                $whereConds[] = ['access_permission', '<=', $this->request['filt_permi_to']];
        }

        // All record count
        $totalRecordCnt = Role::count();

        // Filtered records
        $filteredRecords = Role::where($whereConds)
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
     * Generate module security list table items
     */
    private function makeModuleSecTblItems($finalRecords, $totalCnt, $filteredCnt)
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
            $viewRoleArr = ['None', 'Own', 'Subordinates', 'Own & Subordinates', 'All Records'];
            $addRoleArr = ['Restricted', 'Allowed to Add'];
            $editRoleArr = ['None', 'Own', 'Subordinates', 'Own & Subordinates', 'All Records'];
            $deleteRoleArr = ['None', 'Own', 'Subordinates', 'Own & Subordinates', 'All Records'];

            $records["data"][] = array(
                $idx,
                $finalRecord->name,
                $viewRoleArr[$finalRecord->access_view],
                $addRoleArr[$finalRecord->access_add],
                $editRoleArr[$finalRecord->access_edit],
                $deleteRoleArr[$finalRecord->access_delete],
                'Access to ' . $finalRecord->access_permission . ' Actions',
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-role-edit" data-id="' . $finalRecord->id . '"><i class="fa fa-pencil"></i></a>'
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