<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Folder;
use App\Models\SharedDocument;
use App\Models\Document;

class DocumentationOrgController extends Controller
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
        return view('documentation.organization.org_index')->with('randNum', rand());
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    // My all doc list
    public function getAllDocList()
    {
        $ajaxData = $this->getAllDocListTblData();
        $result = $this->makeAllDocListTblItems($ajaxData['filterItems']);
        return $result;
    }

    // My Folder List
    public function getMyDocList()
    {
        $ajaxData = $this->getMyDocListTblData();
        $result = $this->makeMyDocListTblItems($ajaxData['filterItems']);
        return $result;
    }

    // create folder
    public function createMyDoc(Request $request)
    {   
        // Validation TOOD
        $request->validate([
            'folder_name'   => ['required']
        ]);

        Folder::create([
            'name'          =>  $request->folder_name,
            'employee_id'   =>  32,
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    public function shareMyDoc(Request $request)
    {
        // Validation TOOD
        $request->validate([
            'id'   => ['required']
        ]);

        $emp_id = Employee::where('email', $request->email)->get()->toArray();
        
        if(!count($emp_id)) {
            return response()->json([
                'result' => 'error'
            ]);
        }

        SharedDocument::create([
            'folder_id'     =>  $request->id,
            'receiver_id'   =>  $emp_id[0]['id'],
            'share_id'      =>  '32',
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    public function getShareDocList()
    {
        $ajaxData = $this->getShareDocListTblData();
        $result = $this->makeShareDocListTblItems($ajaxData['filterItems']);
        return $result;
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    // All Doc List
    private function getAllDocListTblData()
    {
        // filter
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_title'] != NULL)
                $whereConds[] = ['title', 'like', '%' . $this->request['filt_title'] . '%'];
        }

        $filterItems = Document::where($whereConds)
                            ->where('employee_id', '32')     // session value
                            ->get();

        return [
            'filterItems' => $filterItems
        ];
    }

    // show All Doc List
    private function makeAllDocListTblItems($filterItems)
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
                $title,
                $filterItems[$idx]->comment,
                $filterItems[$idx]->exp_date,
                $filterItems[$idx]->modified_by,
                $filterItems[$idx]->modified_on,
                $filterItems[$idx]->status ? '<span class="label label-sm label-primary">Active</span>' : '<span class="label label-sm label-grey">Inactive</span>',
                $filterItems[$idx]->attachment,
                '<a href="javascript:;" class="btn btn-xs btn-c-primary" data-id="'.$filterItems[$idx]->id.'"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey" data-id="'.$filterItems[$idx]->id.'"><i class="fa fa-trash"></i></a>'
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

    // my doc list
    private function getMyDocListTblData()
    {
        // filter
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_folder_name'] != NULL)
                array_push($whereConds, array("folder_name" => $this->request['filt_folder_name']));
        }
        $filterItems = Folder::where($whereConds)
                            ->where('employee_id', '32')
                            ->get();

        return [
            'filterItems' => $filterItems
        ];
    }

    // show my doc list 
    private function makeMyDocListTblItems($filterItems)
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
            $id = ($i + 1);
            $records["data"][] = array(
                $id,
                $filterItems[$idx]->name,
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-share" data-id="'.$filterItems[$idx]->id.'"><i class="fa fa-share-alt"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-primary btn-plus" data-id="'.$filterItems[$idx]->id.'"><i class="fa fa-plus"></i></a>'
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

    private function getShareDocListTblData()
    {
        // filter
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_folder_name'] != NULL)
                $whereConds[] = ['folder_name', 'like', '%' . $this->request['filt_folder_name'] . '%'];
            if ($this->request['filt_share_to'] != NULL)
                $whereConds[] = ['receiver_id', 'like', '%' . $this->request['filt_share_to'] . '%'];
        }
        $filterItems = SharedDocument::with(['folder', 'employee'])
                                    ->where($whereConds)
                                    ->where('share_id', '32')
                                    ->get();

        return [
            'filterItems' => $filterItems
        ];
    }

    // show share doc list
    private function makeShareDocListTblItems($filterItems)
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
            $id = ($i + 1);
            $records["data"][] = array(
                $id,
                $filterItems[$idx]->folder->name,
                $filterItems[$idx]->employee->email,
                '<a href="javascript:;" class="btn btn-xs btn-c-primary"><i class="fa fa-pencil"></i></a>
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