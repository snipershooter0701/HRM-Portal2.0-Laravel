<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Ticket;
use App\Models\Ticketchat;
use App\Models\Department;

class TicketController extends Controller
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
        return view('tickets.ticket_index')->with('randNum', rand());
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get tickets
     * 
     * @return $tickets
     */
    public function getTicketList()
    {
        $ajaxData = $this->getTicketListTblData();
        $result = $this->makeTicketListTblItems($ajaxData['filterItems'], $ajaxData['employees'], $ajaxData['departments']);
        return $result;
    }

    public function getTicketById(Request $request)
    {
        // Check Validation
        $request->validate([
            'id' => ['required']
        ]);

        $ticket = Ticket::with(['employee', 'assigned'])
                        ->where('id', $request->id)
                        ->get();

        return response()->json([
            'result' => 'success',
            'ticket' => $ticket
        ]);
    }

    public function addTicket(Request $request)
    {
        $request->validate([
            'emp_id'        => ['required'],
            'department_id' => ['required'],
            'subject'       => ['required'],
            'attachment'    => ['required'],
            'details'       => ['required'],
        ]);

        Ticket::create([
            'employee_id'       =>  $request->emp_id,
            'department_id'     =>  $request->department_id,
            'subject'           =>  $request->subject,
            'attachment'        =>  $request->attachment,
            'details'           =>  $request->details,
            'status'            =>  config('constants.TICKET_STATUS_REQUESTED'),
            'assigned_id'       =>  '1',
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    public function updateTicket(Request $request)
    {
        $request->validate([
            'id'            => ['required'],
            'emp_id'        => ['required'],
            'department_id' => ['required'],
            'subject'       => ['required'],
            'attachment'    => ['required'],
            'details'       => ['required'],
        ]);

        Ticket::where('id', $request->id)
                ->update([
                    'employee_id'       =>  $request->emp_id,
                    'department_id'     =>  $request->department_id,
                    'subject'           =>  $request->subject,
                    'attachment'        =>  $request->attachment,
                    'details'           =>  $request->details,
                    'status'            =>  config('constants.TICKET_STATUS_REQUESTED'),
                    'assigned_id'       =>  '1',
                ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    public function delTicket(Request $request)
    {
        // Check Validation
        $request->validate([
            'id' => ['required'],
        ]);

        Ticket::where('id', $request->id)
                ->delete();

        // Ticketchat::where('ticket_id', $request->id)
        //         ->delete();

        return response()->json([
            'result' => 'success'
        ]);
    }

    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    /**
     * Generate 
     */
    private function getTicketListTblData()
    {
        // Get Filtered employees
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_emp_name'] != NULL)
                array_push($whereConds, array("employee_id" => $this->request['filt_emp_name']));
            if ($this->request['filt_subject'] != NULL)
                array_push($whereConds, array("subject" => $this->request['filt_subject']));
            if ($this->request['filt_department'] != NULL)
                array_push($whereConds, array("department" => $this->request['filt_department']));
            if ($this->request['filt_assign'] != NULL)
                array_push($whereConds, array("assigned_id" => $this->request['filt_assign']));
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
        $filterTickets= Ticket::with(['employee', 'assigned', 'department'])
                                ->where($whereConds)
                                ->get();

        $employees = Employee::select('id', 'first_name', 'last_name')
                                ->get();

        $departments = Department::select('id', 'name')
                                ->get();

        return [
            'filterItems' => $filterTickets,
            'employees' => $employees,
            'departments' => $departments
        ];
    }

    /**
     * Generate invoice table items
     */
    private function makeTicketListTblItems($filterItems, $employees, $departments)
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
                $filterItems[$idx]->subject,
                $filterItems[$idx]->department->name,
                $filterItems[$idx]->assigned->first_name . $filterItems[$idx]->assigned->last_name,
                $filterItems[$idx]->created_on,
                $filterItems[$idx]->closed_on,
                $filterItems[$idx]->status ? '<span class="label label-sm label-primary">Active</span>' : '<span class="label label-sm label-grey">Inactive</span>',
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-ticket-view" data-id="'.$filterItems[$idx]->id.'"><i class="fa fa-eye"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-primary btn-ticket-update" data-id="'.$filterItems[$idx]->id.'"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-ticket-del" data-id="'.$filterItems[$idx]->id.'"><i class="fa fa-trash"></i></a>'
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
        $records["employees"] = $employees;
        $records["departments"] = $departments;

        // echo json_encode($records);
        return response()->json($records);
    }

// ========================== END PRIVATE FUNCTIONS ==========================
}