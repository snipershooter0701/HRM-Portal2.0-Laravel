<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class DocumentationGroupController extends Controller
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
     * Show the documentation page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('documentation.group.group_index')->with('randNum', rand());
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get organization documentations
     * 
     * @return $documentations
     */
    public function getOrgDocs()
    {
        $ajaxData = $this->getEmployeeTblData();
        $result = $this->makeOrgDocTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }

    /**
     * Get employee documentations
     * 
     * @return $documentations
     */
    public function getEmpDocs()
    {
        $ajaxData = $this->getEmployeeTblData();
        $result = $this->makeEmpDocTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }

    /**
     * Get expiring documentations
     * 
     * @return $documentations
     */
    public function getExpDocs()
    {
        $ajaxData = $this->getEmployeeTblData();
        $result = $this->makeExpDocTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }

    /**
     * Get expiring documentations
     * 
     * @return $documentations
     */
    public function getGroupDocs()
    {
        $ajaxData = $this->getEmployeeTblData();
        $result = $this->makeGroupDocTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    /**
     * Generate 
     */
    private function getEmployeeTblData()
    {
        // Get total employees
        $totalEmployees = Employee::all();

        // Get Filtered employees
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_first_name'] != NULL)
                array_push($whereConds, array("first_name" => $this->request['filt_first_name']));
            if ($this->request['filt_last_name'] != NULL)
                array_push($whereConds, array("last_name" => $this->request['filt_last_name']));
            if ($this->request['filt_phone'] != NULL)
                array_push($whereConds, array("phone_number" => $this->request['filt_phone']));
            if ($this->request['filt_email'] != NULL)
                array_push($whereConds, array("email_address" => $this->request['filt_email']));
            if ($this->request['filt_category'] != NULL)
                array_push($whereConds, array("category" => $this->request['filt_category']));
            if ($this->request['filt_join_date_from'] != NULL)
                array_push($whereConds, array("date_of_joining >=" => $this->request['filt_join_date_from']));
            if ($this->request['filt_join_date_to'] != NULL)
                array_push($whereConds, array("date_of_joining <=" => $this->request['filt_join_date_to']));
            if ($this->request['filt_poc'] != NULL)
                array_push($whereConds, array("poc" => $this->request['filt_poc']));
            if ($this->request['filt_classification'] != NULL)
                array_push($whereConds, array("classification" => $this->request['filt_classification']));
            if ($this->request['filt_status'] != NULL)
                array_push($whereConds, array("employee_status" => $this->request['filt_status']));
        }
        $filterEmployees = Employee::where($whereConds)->get();

        return [
            'totalItems' => $totalEmployees,
            'filterItems' => $filterEmployees
        ];
    }

    /**
     * Generate organization document table items
     */
    private function makeOrgDocTblItems($totalItems, $filterItems)
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
                '<input type="checkbox" name="id[]" value="' . $id . '">',
                $id,
                "Other document",
                "Old - SSN1",
                "2022-03-02",
                "Anthony",
                "2022-03-01",
                (rand() % 2 == 0) ? '<span class="label label-sm label-primary">Active</span>' : '<span class="label label-sm label-grey">Inactive</span>',
                '<a href="javascript:;"><i class="fa fa-download icon-md color-primary"></i></a>',
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

    /**
     * Generate employee document table items
     */
    private function makeEmpDocTblItems($totalItems, $filterItems)
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
                '<input type="checkbox" name="id[]" value="' . $id . '">',
                $id,
                "Anthony",
                "Other Documents",
                "OLD SSN-1",
                "2023-03-21",
                "Anthony",
                "2023-03-21",
                '<a href="javascript:;"><i class="fa fa-download icon-md color-primary"></i></a>',
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

    /**
     * Generate expiring document table items
     */
    private function makeExpDocTblItems($totalItems, $filterItems)
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
                '<input type="checkbox" name="id[]" value="' . $id . '">',
                $id,
                "Tareq",
                "Other",
                "Old Visa1",
                "2023-03-02",
                '<a href="javascript:;"><i class="fa fa-download icon-md color-primary"></i></a>',
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

    /**
     * Generate group document table items
     */
    private function makeGroupDocTblItems($totalItems, $filterItems)
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
                '<input type="checkbox" name="id[]" value="' . $id . '">',
                $id,
                "Tareq",
                '<a href="javascript:;"><i class="fa fa-eye icon-md color-primary"></i></a>',
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
// ========================== END PRIVATE FUNCTIONS ==========================
}