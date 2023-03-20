<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Activity;
use App\Models\Setting;

class SettingController extends Controller
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
     * Show the settings page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('settings.organization_hierachy')->with('randNum', rand());
    }
    public function index_role_permission()
    {
        return view('settings.role_permission')->with('randNum', rand());
    }
    public function index_module_security()
    {
        return view('settings.module_security')->with('randNum', rand());
    }
    public function index_create_new_company()
    {
        return view('settings.create_new_company')->with('randNum', rand());
    }
    public function index_application_setting()
    {
        return view('settings.application_setting')->with('randNum', rand());
    }
    public function index_backup_download()
    {
        return view('settings.backup_download')->with('randNum', rand());
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    
    /**
     * Get Level list
     * 
     * @return $placements
     */
    public function getLevelList()
    {
        $ajaxData = $this->getLevelListTblData();
        $result = $this->makeLevelListTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }

    public function getRolePermission()
    {
        $ajaxData = $this->getRolePermissionTblData();
        $result = $this->makeRolePermissionTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }

    public function getModuleSecurity()
    {
        $ajaxData = $this->getModuleSecurityTblData();
        $result = $this->makeModuleSecurityTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }

    public function getCreateNewCompany()
    {
        $ajaxData = $this->getCreateNewCompanyTblData();
        $result = $this->makeCreateNewCompanyTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }

    public function getApplicationSetting()
    {
        $ajaxData = $this->getApplicationSettingTblData();
        $result = $this->makeApplicationSettingTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }

    public function getBackupDownload()
    {
        $ajaxData = $this->getBackupDownloadTblData();
        $result = $this->makeBackupDownloadTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }

    /**
     * Get All Request Details
     * 
     * @return $requestDetails
     */
    public function getActivity()
    {
        $ajaxData = $this->getActivityTblData();
        $result = $this->makeLevelListActivityItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    /**
     * Generate 
     */
    private function getLevelListTblData()
    {
        // Get total employees
        $totalEmployees = Client::all();

        return [
            'totalItems' => $totalEmployees,
            'filterItems' => ''
        ];
    }
    private function getRolePermissionTblData()
    {
        // Get total employees
        $totalEmployees = Client::all();

        return [
            'totalItems' => $totalEmployees,
            'filterItems' => ''
        ];
    }
    private function getModuleSecurityTblData()
    {
        // Get total employees
        $totalEmployees = Client::all();

        return [
            'totalItems' => $totalEmployees,
            'filterItems' => ''
        ];
    }

    /**
     * Generate 
     */
    private function getActivityTblData()
    {
       // Get total Activity
       $totalItems = Activity::all();

        // Get Filtered activities
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_date_time'] != NULL)
                array_push($whereConds, array("date_time" => $this->request['filt_date_time']));
            if ($this->request['filt_updated_by'] != NULL)
                array_push($whereConds, array("updated_by" => $this->request['filt_updated_by']));
            if ($this->request['filt_Description'] != NULL)
                array_push($whereConds, array("Description" => $this->request['filt_Description']));
        }

        $filterItems = Activity::where($whereConds)->get();
        return [
            'totalItems' => $totalItems,
            'filterItems' => $filterItems
        ];
    }

    /**
     * Generate employee table items
     */
    private function makeLevelListTblItems($totalItems, $filterItems)
    {
        $iTotalRecords = count($totalItems);
        $iDisplayLength = intval($this->request['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($this->request['start']);
        $sEcho = intval($this->request['draw']);

        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $status_list = array(
            array("success" => "Pending"),
            array("info" => "Closed"),
            array("danger" => "On Hold"),
            array("warning" => "Fraud")
        );

        $idx = 0;
        for ($i = $iDisplayStart; $i < $end; $i++) {
            $status = $status_list[rand(0, 2)];
            $id = ($i + 1);
            $records["data"][] = array(
                $id,
                'Level'.$id,
                'administrator',
                '<a href="javascript:;" class="btn btn-xs btn-c-primary"><i class="fa fa-eye"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-primary"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey"><i class="fa fa-trash"></i></a>'
            );
            $idx++;
        }

        if (isset($this->request['customActionType']) && $this->request['customActionType'] == "group_action") {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        // echo json_encode($records);
        return response()->json($records);
    }

    private function makeRolePermissionTblItems($totalItems, $filterItems)
    {
        $iTotalRecords = count($totalItems);
        $iDisplayLength = intval($this->request['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($this->request['start']);
        $sEcho = intval($this->request['draw']);

        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $status_list = array(
            array("success" => "Pending"),
            array("info" => "Closed"),
            array("danger" => "On Hold"),
            array("warning" => "Fraud")
        );

        $idx = 0;
        for ($i = $iDisplayStart; $i < $end; $i++) {
            $status = $status_list[rand(0, 2)];
            $id = ($i + 1);
            $records["data"][] = array(
                $id,
                'Administator',
                'HR',
                '<a href="javascript:;" class="btn btn-xs btn-c-primary"><i class="fa fa-eye"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-primary"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey"><i class="fa fa-trash"></i></a>'
            );
            $idx++;
        }

        if (isset($this->request['customActionType']) && $this->request['customActionType'] == "group_action") {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        // echo json_encode($records);
        return response()->json($records);
    }

    private function makeModuleSecurityTblItems($totalItems, $filterItems)
    {
        $iTotalRecords = count($totalItems);
        $iDisplayLength = intval($this->request['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($this->request['start']);
        $sEcho = intval($this->request['draw']);

        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $status_list = array(
            array("success" => "Pending"),
            array("info" => "Closed"),
            array("danger" => "On Hold"),
            array("warning" => "Fraud")
        );

        $idx = 0;
        for ($i = $iDisplayStart; $i < $end; $i++) {
            $status = $status_list[rand(0, 2)];
            $id = ($i + 1);
            $records["data"][] = array(
                'HR',
                'All Records',
                'Create Case',
                'None',
                'None',
                'Access to 19 Actions',
                '<a href="javascript:;" class="btn btn-xs btn-c-primary"><i class="fa fa-pencil edit-permission" ></i></a>'
            );
            $idx++;
        }

        if (isset($this->request['customActionType']) && $this->request['customActionType'] == "group_action") {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        // echo json_encode($records);
        return response()->json($records);
    }

    /**
     * Generate employee placement items
     */
    private function makeLevelListActivityItems($totalItems, $filterItems)
    {
        $iTotalRecords = count($totalItems);
        $iDisplayLength = intval($this->request['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($this->request['start']);
        $sEcho = intval($this->request['draw']);

        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $status_list = array(
            array("success" => "Pending"),
            array("info" => "Closed"),
            array("danger" => "On Hold"),
            array("warning" => "Fraud")
        );

        $idx = 0;
        for ($i = $iDisplayStart; $i < $end; $i++) {
            $status = $status_list[rand(0, 2)];
            $id = ($i + 1);
            $records["data"][] = array(
                $filterItems[$idx]->date_time,
                $filterItems[$idx]->updated_by,
                $filterItems[$idx]->description,
            );
            $idx++;
        }

        if (isset($this->request['customActionType']) && $this->request['customActionType'] == "group_action") {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        // echo json_encode($records);
        return response()->json($records);
    }

// ========================== END PRIVATE FUNCTIONS ==========================
}