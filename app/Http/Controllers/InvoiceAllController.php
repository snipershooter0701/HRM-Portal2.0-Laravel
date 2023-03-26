<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class InvoiceAllController extends Controller
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
     * Show the all invoices page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('invoices.all-inv.index')->with('randNum', rand());
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get invoices
     * 
     * @return $invoices
     */
    public function getInvoices()
    {
        $ajaxData = $this->getInvoiceTblData();
        $result = $this->makeInvoiceTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }

    /**
     * Get Service Summaries
     * 
     * @return $summaries
     */
    public function getSvcSmrys()
    {
        $ajaxData = $this->getInvoiceTblData();
        $result = $this->makeSvcSmryTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }

    /**
     * Get Notes & Totals
     * 
     * @return $notes
     */
    public function getNoteTotals()
    {
        $ajaxData = $this->getInvoiceTblData();
        $result = $this->makeNoteTotalTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    /**
     * Generate 
     */
    private function getInvoiceTblData()
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
     * Generate invoice table items
     */
    private function makeInvoiceTblItems($totalItems, $filterItems)
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

        $idx = 0;
        for ($i = $iDisplayStart; $i < $end; $i++) {
            $id = ($i + 1);
            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $id . '">',
                $id,
                'Makarov',
                'Tareq',
                '03/07/2023',
                '03/07/2023',
                '$1900',
                '$1900',
                '5',
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
     * Generate service summary table items
     */
    private function makeSvcSmryTblItems($totalItems, $filterItems)
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

        $idx = 0;
        for ($i = $iDisplayStart; $i < $end; $i++) {
            $id = ($i + 1);
            $records["data"][] = array(
                $id,
                'Summary',
                'The quick brown dog jumped over the lazy fox.',
                '5',
                '90',
                '$1900',
                '<a href="javascript:;"><i class="fa fa-download icon-md color-primary"></i></a>',
                '<a href="javascript:;" class="btn btn-xs btn-c-grey"><i class="fa fa-trash"></i></a>'
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
     * Generate notes&total table items
     */
    private function makeNoteTotalTblItems($totalItems, $filterItems)
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

        $idx = 0;
        for ($i = $iDisplayStart; $i < 7; $i++) {
            $id = ($i + 1);
            $records["data"][] = array(
                'Anthony',
                '123456789',
                '03/01/2023~03/31/2023',
                '2500',
                '2000',
                '500',
                'cheue'
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