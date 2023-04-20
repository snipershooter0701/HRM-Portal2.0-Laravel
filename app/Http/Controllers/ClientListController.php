<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Client;
use App\Models\ClientActivity;
use App\Models\ClientConfidential;
use App\Models\ClientPlacementDoctype;
use App\Models\Employee;
use App\Models\JobTire;

class ClientListController extends Controller
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
     * Show the client list page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients = Client::all();
        $clientPlacementDoctypes = ClientPlacementDoctype::all();
        $employees = Employee::all();
        $jobTires = JobTire::all();
        $docTypes = ClientPlacementDoctype::all();

        return view('client.client_list.index')->with([
            'randNum' => rand(),
            'clients' => $clients,
            'clientPlacementDoctypes' => $clientPlacementDoctypes,
            'employees' => $employees,
            'jobTires' => $jobTires,
            'docTypes' => $docTypes
        ]);
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get client list from model and generate columns for ajax table. (tbl_client_list)
     */
    public function getTableClientList()
    {
        $recordData = $this->getClientTblRecords();
        $result = $this->makeClientTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Get client's activity list from model and generate columns for ajax table. (tbl_client_list_activities)
     */
    public function getTableClientActsList()
    {
        $recordData = $this->getClientActsTblRecords();
        $result = $this->makeClientActsTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Get client by id
     */
    public function getClientById()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
        ]);

        // Params
        $id = $this->request['id'];

        $client = Client::find($id);
        $confidential = ClientConfidential::where([
            ['client_id', '=', $this->request['id']],
            ['status', '=', config('constants.STATE_ACTIVE')]
        ])->get()->first();

        return response()->json([
            'result' => 'success',
            'client' => $client,
            'confidential' => $confidential
        ]);
    }

    /**
     * Create client business info.
     */
    public function createBusinessInfo()
    {
        // Check Validation
        $this->request->validate([
            'business_name' => ['required'],
            'contact_number' => ['required'],
            'federal_id' => ['required'],
            'email' => ['required'],
            // 'website' => ['required'],
            'inv_country_id' => ['required'],
            'inv_state_id' => ['required'],
            'inv_city' => ['required'],
            'inv_street' => ['required'],
            'inv_suite_aptno' => ['required'],
            'inv_zipcode' => ['required'],
            'addr_country_id' => ['required'],
            'addr_state_id' => ['required'],
            'addr_city' => ['required'],
            'addr_street' => ['required'],
            'addr_suite_aptno' => ['required'],
            'addr_zipcode' => ['required'],
        ]);

        Client::create([
            'email' => $this->request['email'],
            'business_name' => $this->request['business_name'],
            'contact_number' => $this->request['contact_number'],
            'federal_id' => $this->request['federal_id'],
            'website' => $this->request['website'],
            'inv_country_id' => $this->request['inv_country_id'],
            'inv_state_id' => $this->request['inv_state_id'],
            'inv_city' => $this->request['inv_city'],
            'inv_suite_aptno' => $this->request['inv_suite_aptno'],
            'inv_street' => $this->request['inv_street'],
            'inv_zipcode' => $this->request['inv_zipcode'],
            'addr_country_id' => $this->request['addr_country_id'],
            'addr_state_id' => $this->request['addr_state_id'],
            'addr_city' => $this->request['addr_city'],
            'addr_suite_aptno' => $this->request['addr_suite_aptno'],
            'addr_street' => $this->request['addr_street'],
            'addr_zipcode' => $this->request['addr_zipcode'],
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Update client business info.
     */
    public function updateBusinessInfoById()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
            'business_name' => ['required'],
            'contact_number' => ['required'],
            'federal_id' => ['required'],
            'email' => ['required'],
            // 'website' => ['required'],
            'inv_country_id' => ['required'],
            'inv_state_id' => ['required'],
            'inv_city' => ['required'],
            'inv_street' => ['required'],
            'inv_suite_aptno' => ['required'],
            'inv_zipcode' => ['required'],
            'addr_country_id' => ['required'],
            'addr_state_id' => ['required'],
            'addr_city' => ['required'],
            'addr_street' => ['required'],
            'addr_suite_aptno' => ['required'],
            'addr_zipcode' => ['required'],
        ]);

        $client = Client::find($this->request['id']);

        $client->update([
            'email' => $this->request['email'],
            'business_name' => $this->request['business_name'],
            'contact_number' => $this->request['contact_number'],
            'federal_id' => $this->request['federal_id'],
            'website' => $this->request['website'],
            'inv_country_id' => $this->request['inv_country_id'],
            'inv_state_id' => $this->request['inv_state_id'],
            'inv_city' => $this->request['inv_city'],
            'inv_suite_aptno' => $this->request['inv_suite_aptno'],
            'inv_street' => $this->request['inv_street'],
            'inv_zipcode' => $this->request['inv_zipcode'],
            'addr_country_id' => $this->request['addr_country_id'],
            'addr_state_id' => $this->request['addr_state_id'],
            'addr_city' => $this->request['addr_city'],
            'addr_suite_aptno' => $this->request['addr_suite_aptno'],
            'addr_street' => $this->request['addr_street'],
            'addr_zipcode' => $this->request['addr_zipcode'],
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Delete client.
     */
    public function delete()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
        ]);

        // Params
        $id = $this->request['id'];

        $client = Client::find($id);
        $client->delete();

        return response()->json([
            'result' => 'success'
        ]);
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    /**
     * Get client list from model.
     */
    private function getClientTblRecords()
    {
        // Params
        $columns = ['', '', 'business_name', 'email', 'contact_number', '', '', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // All client count
        $totalRecordCnt = Client::count();

        // Get client records for filter condition.
        $whereConds = array();
        $placementCntFrom = 0;
        $placementCntTo = 0;
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_business_name'] != NULL)
                $whereConds[] = ['business_name', 'like', '%' . $this->request['filt_business_name'] . '%'];
            if ($this->request['filt_email'] != NULL)
                $whereConds[] = ['email', 'like', '%' . $this->request['filt_email'] . '%'];
            if ($this->request['filt_contact_number'] != NULL)
                $whereConds[] = ['contact_number', 'like', '%' . $this->request['filt_contact_number'] . '%'];
            if ($this->request['filt_status'] != NULL) {
                if ($this->request['filt_status'] == config('constants.STATE_ACTIVE'))
                    $placementCntFrom = 1;
                else
                    $placementCntFrom = 0;
            }
            if ($this->request['filt_placements_from'] != NULL && $this->request['filt_placements_from'] > $placementCntFrom) {
                $placementCntFrom = $this->request['filt_placements_from'];
            }
            if ($this->request['filt_placements_to'] != NULL)
                $placementCntTo = $this->request['filt_placements_to'];
        }

        $filteredRecords = Client::with([
            'activePlacements'
        ])->where($whereConds)
            ->whereHas('activePlacements', function (Builder $query) {
            }, '>=', $placementCntFrom)
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);
        // ->toArray();

        // var_dump($filteredRecords);
        // exit;

        $filteredCnt = count(Client::where($whereConds)->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate client list table items
     */
    private function makeClientTblColumns($finalRecords, $totalCnt, $filteredCnt)
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
                $finalRecord->business_name,
                $finalRecord->email,
                $finalRecord->contact_number,
                count($finalRecord->activePlacements) > 0 ? '<span class="label label-sm label-primary">Active</span>' : '<span class="label label-sm label-grey">Inactive</span>',
                count($finalRecord->activePlacements),
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-view"><i class="fa fa-eye"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-primary btn-client-edit" data-id="' . $finalRecord->id . '"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-client-delete" data-id="' . $finalRecord->id . '" data-email="' . $finalRecord->email . '"><i class="fa fa-trash"></i></a>'
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
     * Get client's activities from model
     */
    private function getClientActsTblRecords()
    {
        // Params
        $columns = ['', 'created_at', 'client_id', 'description'];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // All client count
        $totalRecordCnt = ClientActivity::count();

        // Get client records for filter condition.
        $whereConds = array();
        $whereClientConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_act_date_from'] != NULL)
                $whereConds[] = ['created_at', '>=', $this->request['filt_act_date_from']];
            if ($this->request['filt_act_date_to'] != NULL)
                $whereConds[] = ['created_at', '<=', $this->request['filt_act_date_to']];
            // if ($this->request['filt_act_updatedby'] !=  like', '%' . $this->request['filt_act_updatedby'] . '%'];
            if ($this->request['filt_act_description'] != NULL)
                $whereConds[] = ['description', 'like', '%' . $this->request['filt_act_description'] . '%'];
        }

        $filteredRecords = ClientActivity::with([
            'client'
        ])->where($whereConds)
            ->whereRelation('client', 'email', 'like', '%' . $this->request['filt_act_updatedby'] . '%')
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        $filteredCnt = count(ClientActivity::with([
            'client'
        ])->where($whereConds)
            ->whereRelation('client', 'email', 'like', '%' . $this->request['filt_act_updatedby'] . '%')
            ->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate client's activity list table items
     */
    private function makeClientActsTblColumns($finalRecords, $totalCnt, $filteredCnt)
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
                $finalRecord->client->email,
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