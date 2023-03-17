<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Placement;
use App\Models\Activity;
use App\Models\Invoice;
use App\Models\Document;

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
        $result = $this->makeClientTblItems($ajaxData['totalItems'], $ajaxData['filterItems'], 'displayClients');
        return $result;
    }

    /**
     * Get Placements info
     */
    public function getPlacements()
    {
        $ajaxData = $this->getPlacementTblData();
        $result = $this->makeClientTblItems($ajaxData['totalItems'], $ajaxData['filterItems'], 'displayPlacements');
        return $result;
    }

    /**
     * Get Activities info
     */
    public function getActivities()
    {
        $ajaxData = $this->getActivityTblData();
        $result = $this->makeClientTblItems($ajaxData['totalItems'], $ajaxData['filterItems'], 'displayActivities');
        return $result;
    }

    /**
     * Get Invoices info
     */
    public function getInvoices()
    {
        $ajaxData = $this->getInvoiceTblData();
        $result = $this->makeClientTblItems($ajaxData['totalItems'], $ajaxData['filterItems'], 'displayInvoices');
        return $result;
    }

    /**
     * Get Documents info
     */
    public function getDocuments()
    {
        $ajaxData = $this->getDocumentTblData();
        $result = $this->makeClientTblItems($ajaxData['totalItems'], $ajaxData['filterItems'], 'displayDocuments');
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
        $totalItems = Client::all();

        // Get Filtered clients
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_business_name'] != NULL)
                array_push($whereConds, array("business_name" => $this->request['filt_business_name']));
            if ($this->request['filt_email'] != NULL)
                array_push($whereConds, array("email" => $this->request['filt_email']));
            if ($this->request['filt_contact_num'] != NULL)
                array_push($whereConds, array("contact_num" => $this->request['filt_contact_num']));
            if ($this->request['filt_net_terms'] != NULL)
                array_push($whereConds, array("net_terms" => $this->request['filt_net_terms']));
            if ($this->request['filt_status'] != NULL)
                array_push($whereConds, array("status" => $this->request['filt_status']));
            if ($this->request['filt_active_placements'] != NULL)
                array_push($whereConds, array("active_placements >=" => $this->request['filt_active_placements']));
        }
        $filterItems = client::where($whereConds)->get();

        return [
            'totalItems' => $totalItems,
            'filterItems' => $filterItems
        ];
    }

    /**
     * Generate 
     */
    private function getPlacementTblData()
    {
        // Get total placements
        $totalItems = Placement::all();

        // Get Filtered placements
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_employee_name'] != NULL)
                array_push($whereConds, array("employee_name" => $this->request['filt_employee_name']));
            if ($this->request['filt_job_tire'] != NULL)
                array_push($whereConds, array("job_tire" => $this->request['filt_job_tire']));
            if ($this->request['filt_job_status'] != NULL)
                array_push($whereConds, array("job_status" => $this->request['filt_job_status']));
            if ($this->request['filt_start_date'] != NULL)
                array_push($whereConds, array("start_date" => $this->request['filt_start_date']));
            if ($this->request['filt_end_date'] != NULL)
                array_push($whereConds, array("end_date" => $this->request['filt_end_date']));
            if ($this->request['filt_po_attachment'] != NULL)
                array_push($whereConds, array("po_attachment >=" => $this->request['filt_po_attachment']));
        }
        $filterItems = placement::where($whereConds)->get();

        return [
            'totalItems' => $totalItems,
            'filterItems' => $filterItems
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
     * Generate
     */
    private function getInvoiceTblData()
    {
        // Get total Activity
        $totalItems = Invoice::all();

        // Get Filtered activities
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_employee_name'] != NULL)
                array_push($whereConds, array("employee_name" => $this->request['filt_employee_name']));
            if ($this->request['filt_invoice_date'] != NULL)
                array_push($whereConds, array("invoice_date" => $this->request['filt_invoice_date']));
            if ($this->request['filt_invoice_due_date'] != NULL)
                array_push($whereConds, array("invoice_due_date" => $this->request['filt_invoice_due_date']));
            if ($this->request['filt_status'] != NULL)
                array_push($whereConds, array("status" => $this->request['filt_status']));
        }

        $filterItems = Invoice::where($whereConds)->get();
        return [
            'totalItems' => $totalItems,
            'filterItems' => $filterItems
        ];
    }

    /**
     * Generate
     */
    private function getDocumentTblData()
    {
        // Get total Activity
        $totalItems = Document::all();

        // Get Filtered activities
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_title'] != NULL)
                array_push($whereConds, array("title" => $this->request['filt_title']));
            if ($this->request['filt_document_type'] != NULL)
                array_push($whereConds, array("document_type" => $this->request['filt_document_type']));
            if ($this->request['filt_employee'] != NULL)
                array_push($whereConds, array("employee" => $this->request['filt_employee']));
            if ($this->request['filt_status'] != NULL)
                array_push($whereConds, array("status" => $this->request['filt_status']));
            if ($this->request['filt_except_date'] != NULL)
                array_push($whereConds, array("except_date" => $this->request['filt_except_date']));
        }

        $filterItems = Document::where($whereConds)->get();
        return [
            'totalItems' => $totalItems,
            'filterItems' => $filterItems
        ];
    }




    /**
     * Generate employee table items
     * 
     * @return $Employee List
     */
    private function makeClientTblItems($totalItems, $filterItems, $pageID)
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
        if($pageID == 'displayClients') {
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
        } else if($pageID == 'displayPlacements') {
            for ($i = $iDisplayStart; $i < $end; $i++) {
                $status = $status_list[rand(0, 2)];
                $id = ($i + 1);
                $records["data"][] = array(
                    '<input type="checkbox" name="id[]" value="' . $id . '">',
                    $id,
                    $filterItems[$idx]->employee_name,
                    $filterItems[$idx]->job_tire,
                    $filterItems[$idx]->job_status ? '<span class="label label-sm label-active">Active</span>' : '<span class="label label-sm label-inactive">InActive</span>',
                    $filterItems[$idx]->start_date,
                    $filterItems[$idx]->end_date,
                    $filterItems[$idx]->po_attachment,
                    '<a href="javascript:;" class="btn btn-xs btn-c-primary"><i class="fa fa-eye"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-c-primary"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-c-grey"><i class="fa fa-trash"></i></a>'
                );
                $idx++;
            }
        } else if($pageID == 'displayActivities') {
            for ($i = $iDisplayStart; $i < $end; $i++) {
                $status = $status_list[rand(0, 2)];
                $id = ($i + 1);
                $records["data"][] = array(
                    $filterItems[$idx]->date_time,
                    $filterItems[$idx]->updated_by,
                    $filterItems[$idx]->descrition,
                );
                $idx++;
            }
        } else if($pageID == 'displayInvoices') {
            for ($i = $iDisplayStart; $i < $end; $i++) {
                $status = $status_list[rand(0, 2)];
                $id = ($i + 1);
                $records["data"][] = array(
                    '<input type="checkbox" name="id[]" value="' . $id . '">',
                    $id,
                    $filterItems[$idx]->employee_name,
                    $filterItems[$idx]->invoice_date,
                    $filterItems[$idx]->invoice_due_date,
                    $filterItems[$idx]->status ? '<span class="label label-sm label-active">Invoiced</span>' : '<span class="label label-sm label-inactive">Rejected</span>',
                    '<a href="javascript:;" class="btn btn-xs btn-c-primary"><i class="fa fa-eye"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-c-primary"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-c-grey"><i class="fa fa-trash"></i></a>'
                );
                $idx++;
            }
        } else if($pageID == 'displayDocuments') {
            for ($i = $iDisplayStart; $i < $end; $i++) {
                $status = $status_list[rand(0, 2)];
                $id = ($i + 1);
                $records["data"][] = array(
                    '<input type="checkbox" name="id[]" value="' . $id . '">',
                    $id,
                    $filterItems[$idx]->title,
                    $filterItems[$idx]->document_type,
                    $filterItems[$idx]->employee,
                    $filterItems[$idx]->status ? '<span class="label label-sm label-active">Invoiced</span>' : '<span class="label label-sm label-inactive">Rejected</span>',
                    $filterItems[$idx]->except_date,
                    '<a href="javascript:;" class="btn btn-xs btn-c-primary"><i class="fa fa-eye"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-c-primary"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-c-grey"><i class="fa fa-trash"></i></a>'
                );
                $idx++;
            }
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