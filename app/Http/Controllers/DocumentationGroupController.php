<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Group;
use App\Models\Document;

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

    public function getGroupList(Request $request)
    {
        $whereConds = array();
        if ($request['action'] != NULL && $request['action'] == "filter") {
            if ($request['filt_emp'] != NULL)
                $whereConds[] = ['employee_id', $request['filt_emp']];
        }

        $group_doc = Document::with(['employee'])->get();
        $group = Group::all();

        $result = $this->makeGroupListTblItems($group_doc, $group);
        return $result;
    }
  
    public function createGroup(Request $request)
    {
        $request->validate([
            'group_name' => ['required'],
            'doc_title_id'  => ['required'],
        ]);

        Group::create([
            'name'          => $request->group_name,
            'doc_title_id'  => $request->doc_title_id,
        ]);

        $group = Group::all();

        return response()->json([
            'result' => 'success',
            'group'  => $group
        ]);
    }

    public function getSearchGroupList(Request $request) {
        $group_doc = Document::with(['employee'])
                            ->where('doc_title_id', $request->id)
                            ->get();

        $result = $this->makeSearchGroupListTblItems($group_doc);
        return $result;
    }

    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================

    private function makeGroupListTblItems($filterItems, $group)
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
                '<input type="checkbox" name="id[]" value="' . $id . '">',
                $id,
                $filterItems[$idx]->employee->first_name . $filterItems[$idx]->employee->last_name,
                '<a href="javascript:;" data-id="'.$filterItems[$idx]->id.'"><i class="fa fa-download icon-md color-primary"></i></a>',
                '<a href="javascript:;" class="btn btn-xs btn-c-primary" data-id="'.$filterItems[$idx]->id.'"><i class="fa fa-eye"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-primary" data-id="'.$filterItems[$idx]->id.'"><i class="fa fa-pencil"></i></a>
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
        $records["group"] = $group;

        // echo json_encode($records);
        return response()->json($records);
    }

    private function makeSearchGroupListTblItems($filterItems)
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
                '<input type="checkbox" name="id[]" value="' . $id . '">',
                $id,
                $filterItems[$idx]->employee->first_name . $filterItems[$idx]->employee->last_name,
                '<a href="javascript:;" data-id="'.$filterItems[$idx]->id.'"><i class="fa fa-download icon-md color-primary"></i></a>',
                '<a href="javascript:;" class="btn btn-xs btn-c-primary" data-id="'.$filterItems[$idx]->id.'"><i class="fa fa-eye"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-primary" data-id="'.$filterItems[$idx]->id.'"><i class="fa fa-pencil"></i></a>
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
// ========================== END PRIVATE FUNCTIONS ==========================
}