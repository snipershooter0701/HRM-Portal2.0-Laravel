<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientConfidential;

class ClientConfidentialController extends Controller
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
     * Get client's confidential info list from model and generate columns for ajax table. (tbl_confidential_old_records)
     */
    public function getTableConfidentialList()
    {
        $recordData = $this->getConfidentialTblRecords();
        $result = $this->maketConfidentialTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Create client's confidential info.
     */
    public function create()
    {
        // Check Validation
        $this->request->validate([
            'client_id' => ['required'],
            'bankname' => ['required'],
            'accounttype' => ['required'],
            'accountnumber' => ['required', 'numeric'],
            'routingnumber' => ['required', 'numeric'],
            'country_id' => ['required'],
            'state_id' => ['required'],
            'city' => ['required'],
            'suite_aptno' => ['required'],
            'street' => ['required'],
            'zipcode' => ['required', 'numeric'],
            'status' => ['required'],
        ]);

        // Update previous active record to inactive.
        $confidentials = ClientConfidential::where([
            ['client_id', '=', $this->request['client_id']],
            ['status', '=', config('constants.STATE_ACTIVE')]
        ])->update([
                'status' => config('constants.STATE_INACTIVE'),
            ]);

        // Create new record
        ClientConfidential::create([
            'client_id' => $this->request['client_id'],
            'bankname' => $this->request['bankname'],
            'accounttype' => $this->request['accounttype'],
            'accountnumber' => $this->request['accountnumber'],
            'routingnumber' => $this->request['routingnumber'],
            'country_id' => $this->request['country_id'],
            'state_id' => $this->request['state_id'],
            'city' => $this->request['city'],
            'suite_aptno' => $this->request['suite_aptno'],
            'street' => $this->request['street'],
            'zipcode' => $this->request['zipcode'],
            'status' => $this->request['status'],
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Update client's confidential info
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

        $client = ClientConfidential::find($this->request['id']);

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
     * Update client's confidential info
     */
    public function delete()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
        ]);

        $client = ClientConfidential::find($this->request['id']);
        $client->delete();

        return response()->json([
            'result' => 'success'
        ]);
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    /**
     * Get client's confidential infos from model.
     */
    private function getConfidentialTblRecords()
    {
        // Params
        $columns = ['', 'bankname', 'accounttype', 'accountnumber', 'routingnumber', 'updated_at', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get client records for filter condition.
        $whereConds = array();
        $whereOwnConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            $whereConds[] = ['status', '=', config('constants.STATE_INACTIVE')];
            $whereOwnConds[] = ['status', '=', config('constants.STATE_INACTIVE')];

            if ($this->request['filt_client_id'] != NULL) {
                $whereConds[] = ['client_id', '=', $this->request['filt_client_id']];
                $whereOwnConds[] = ['client_id', '=', $this->request['filt_client_id']];
            }
            if ($this->request['filt_bankname'] != NULL)
                $whereConds[] = ['bankname', 'like', '%' . $this->request['filt_bankname'] . '%'];
            if ($this->request['filt_account_type'] != NULL)
                $whereConds[] = ['accounttype', 'like', '%' . $this->request['filt_account_type'] . '%'];
            if ($this->request['filt_account_number'] != NULL)
                $whereConds[] = ['accountnumber', 'like', '%' . $this->request['filt_account_number'] . '%'];
            if ($this->request['filt_routing_number'] != NULL)
                $whereConds[] = ['routingnumber', 'like', '%' . $this->request['filt_routing_number'] . '%'];
            if ($this->request['filt_updated_from'] != NULL)
                $whereConds[] = ['updated_at', '>=', $this->request['filt_updated_from']];
            if ($this->request['filt_updated_to'] != NULL)
                $whereConds[] = ['updated_at', '>=', $this->request['filt_updated_to']];
        }

        // All record count
        $totalRecordCnt = count(ClientConfidential::where($whereOwnConds)->get());

        // Filtered records
        $filteredRecords = ClientConfidential::where($whereConds)
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record count
        $filteredCnt = count(ClientConfidential::where($whereConds)->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate client's confidential info list table items
     */
    private function maketConfidentialTblColumns($finalRecords, $totalCnt, $filteredCnt)
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
                $finalRecord->bankname,
                $finalRecord->accounttype,
                $finalRecord->accountnumber,
                $finalRecord->routingnumber,
                $finalRecord->updated_at,
                '<a href="javascript:;" class="btn btn-xs btn-c-grey btn-confidential-delete" data-id="' . $finalRecord->id . '" data-bankname="' . $finalRecord->bankname . '"><i class="fa fa-trash"></i></a>'
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