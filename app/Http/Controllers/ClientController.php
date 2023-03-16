<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
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
     * Show the client page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('client.index')->with('randNum', rand());
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get clients
     * 
     * @return $Clients
     */
    public function getClients()
    {
        $ajaxData = $this->getClientTblData();
        $result = $this->makeClientTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }

    /**
     * Get Client's business info
     */
    public function setBusinessInfo()
    {
        $ajaxData = $this->getClientTblData();
        $result = $this->makeEmpPlacementTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    /**
     * Generate 
     */
    private function getClientTblData()
    {
        // Get total clients
        $totalClients = Client::all();

        // Get Filtered clients
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_business_name'] != NULL)
                array_push($whereConds, array("business_name" => $this->request['filt_business_name']));
            if ($this->request['filt_last_name'] != NULL)
                array_push($whereConds, array("email" => $this->request['filt_email']));
            if ($this->request['filt_phone'] != NULL)
                array_push($whereConds, array("contact_num" => $this->request['filt_contact_number']));
            if ($this->request['filt_email'] != NULL)
                array_push($whereConds, array("net_terms" => $this->request['filt_net_terms']));
            if ($this->request['filt_category'] != NULL)
                array_push($whereConds, array("status" => $this->request['filt_status']));
            if ($this->request['filt_join_date_from'] != NULL)
                array_push($whereConds, array("active_placements >=" => $this->request['filt_active_placements']));
        }
        $filterClients = client::where($whereConds)->get();

        return [
            'totalItems' => $totalClients,
            'filterItems' => $filterClients
        ];
    }

    /**
     * Generate employee table items
     * 
     * @return $Employee List
     */
    private function makeClientTblItems($totalItems, $filterItems)
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
                $filterItems[$idx]->business_name,
                $filterItems[$idx]->email,
                $filterItems[$idx]->contact_num,
                $filterItems[$idx]->net_terms,
                $filterItems[$idx]->status ? '<span class="label label-sm label-active">Active</span>' : '<span class="label label-sm label-inactive">InActive</span>',
                $filterItems[$idx]->active_placements,
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
     * Generate employee placement items
     * 
     * @return $Employee List
     */
    private function makeEmpPlacementTblItems($totalItems, $filterItems)
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
                $filterItems[$idx]->first_name,
                $filterItems[$idx]->last_name,
                $filterItems[$idx]->phone_number,
                $filterItems[$idx]->category,
                $filterItems[$idx]->date_of_joining,
                $filterItems[$idx]->poc,
                $filterItems[$idx]->classification ? '<span class="label-active-noborder">Billable</span>' : '<span class="label-inactive-noborder">Non-Billable</span>',
                "AFAAAFAF"
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