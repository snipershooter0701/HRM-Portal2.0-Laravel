<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientContact;

class ClientContactController extends Controller
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

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================

    /**
     * Get client's contact info list from model and generate columns for ajax table. (tbl_contact_infos)
     */
    public function getTableContactInfoList()
    {
        $recordData = $this->getContactInfoTblRecords();
        $result = $this->makeContactInfoTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Get contact information by id.
     */
    public function getContactById()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
        ]);

        $contact = ClientContact::find($this->request['id']);

        return response()->json([
            'result' => 'success',
            'contact' => $contact
        ]);
    }

    /**
     * Create client's contact info.
     */
    public function create()
    {
        // Check Validation
        $this->request->validate([
            'client_id' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
        ]);

        ClientContact::create([
            'client_id' => $this->request['client_id'],
            'first_name' => $this->request['first_name'],
            'last_name' => $this->request['last_name'],
            'email' => $this->request['email'],
            'phone' => $this->request['phone'],
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Update client's contact info
     */
    public function update()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'phone' => ['required', 'numeric'],
        ]);

        $client = ClientContact::find($this->request['id']);

        $client->update([
            'first_name' => $this->request['first_name'],
            'last_name' => $this->request['last_name'],
            'email' => $this->request['email'],
            'phone' => $this->request['phone']
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Update client's contact info
     */
    public function delete()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
        ]);

        $client = ClientContact::find($this->request['id']);
        $client->delete();

        return response()->json([
            'result' => 'success'
        ]);
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================

    /**
     * Get client's contact infos from model.
     */
    private function getContactInfoTblRecords()
    {
        // Params
        $columns = ['', '', 'first_name', 'last_name', 'email', 'phone', '', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get client records for filter condition.
        $whereConds = array();
        $whereOwnConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_client_id'] != NULL) {
                $whereConds[] = ['client_id', '=', $this->request['filt_client_id']];
                $whereOwnConds[] = ['client_id', '=', $this->request['filt_client_id']];
            }
            if ($this->request['filt_firstname'] != NULL)
                $whereConds[] = ['first_name', 'like', '%' . $this->request['filt_firstname'] . '%'];
            if ($this->request['filt_lastname'] != NULL)
                $whereConds[] = ['last_name', 'like', '%' . $this->request['filt_lastname'] . '%'];
            if ($this->request['filt_email'] != NULL)
                $whereConds[] = ['email', 'like', '%' . $this->request['filt_email'] . '%'];
            if ($this->request['filt_phone'] != NULL)
                $whereConds[] = ['phone', 'like', '%' . $this->request['filt_phone'] . '%'];
        }

        // All record count
        $totalRecordCnt = count(ClientContact::where($whereOwnConds)->get());

        // Filtered records
        $filteredRecords = ClientContact::where($whereConds)
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record count
        $filteredCnt = count(ClientContact::where($whereConds)->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate client's contact info list table items
     */
    private function makeContactInfoTblColumns($finalRecords, $totalCnt, $filteredCnt)
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
                '<input type="checkbox" name="id[]" value="' . $finalRecord->id . '">',
                $idx,
                $finalRecord->first_name,
                $finalRecord->last_name,
                $finalRecord->email,
                $finalRecord->phone,
                '<div class="form-group>
                    <div class="input-group">
                        <label><input type="checkbox" class="icheck"> Add email to CC list </label>
                        <label><input type="checkbox" checked class="icheck"> Primary Contact </label>
                        <label><input type="checkbox" class="icheck"> Primary accounts email </label>
                    </div>
                </div>',
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-contactinfo-edit" data-id="' . $finalRecord->id . '"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-contactinfo-delete" data-id="' . $finalRecord->id . '" data-email="' . $finalRecord->email . '"><i class="fa fa-trash"></i></a>'
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