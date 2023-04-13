<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Document;

class DocumentationEmpController extends Controller
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
        return view('documentation.employee.emp_index')->with('randNum', rand());
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get organization documentations
     * 
     * @return $documentations
     */
    public function getEmpDocList()
    {
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
        $filterItems = Document::with(['employee'])
                                    ->where($whereConds)
                                    ->get();

        $result = $this->makeEmpDocListTblItems($filterItems);
        return $result;
    }

    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================

    private function makeEmpDocListTblItems($filterItems)
    {
        $iTotalRecords = count($filterItems);
        $iDisplayLength = intval($this->request['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($this->request['start']);
        $sEcho = intval($this->request['draw']);

        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $idx = 0;
        for ($i = $iDisplayStart; $i < $end; $i++) {

            if($filterItems[$idx]->doc_title_id == 0) $title = 'SSN';
            else if($filterItems[$idx]->doc_title_id == 1) $title = 'Work Authorization';
            else if($filterItems[$idx]->doc_title_id == 2) $title = 'State ID/Drive License';
            else if($filterItems[$idx]->doc_title_id == 3) $title = 'Passport';
            else if($filterItems[$idx]->doc_title_id == 4) $title = 'I-94';
            else if($filterItems[$idx]->doc_title_id == 5) $title = 'Visa';
            else if($filterItems[$idx]->doc_title_id == 6) $title = 'Other';

            $id = ($i + 1);
            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $id . '">',
                $id,
                $filterItems[$idx]->employee->first_name . $filterItems[$idx]->employee->last_name,
                $title,
                $filterItems[$idx]->comment,
                $filterItems[$idx]->exp_date,
                $filterItems[$idx]->modified_by,
                $filterItems[$idx]->modified_on,
                $filterItems[$idx]->Attachment,
                // '<a href="javascript:;"><i class="fa fa-download icon-md color-primary"></i></a>',
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