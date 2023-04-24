<?php

namespace App\Http\Controllers;

use App\Models\ClientPlacement;
use App\Models\TimesheetDue;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Timesheet;
use App\Models\Employee;
use App\Models\JobTire;

class TimesheetDueController extends Controller
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
     * Show the timesheets page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Check all placements and timesheets, then create or delete the due timesheets.
        $placements = ClientPlacement::where([
            ['job_status', '=', config('constants.STATE_ACTIVE')]
        ])->get();

        $curDate = date("Y-m-d");
        if ($this->isWeekend($curDate)) {
            $dateFrom = date('Y-m-d', $this->lastMonday($curDate));
            $dateTo = date("Y-m-d", strtotime("+6 day", $this->lastMonday($curDate)));

            foreach ($placements as $placement) {
                // Check the timesheet for this placement is already committed.
                $timesheet = Timesheet::where([
                    ['employee_id', '=', $placement->employee_id],
                    ['job_tire_id', '=', $placement->job_tire_id],
                    ['client_id', '=', $placement->client_id],
                    ['date_from', '=', $dateFrom],
                    ['date_to', '=', $dateTo]
                ])->first();

                $dueTimesheet = TimesheetDue::where([
                    ['employee_id', '=', $placement->employee_id],
                    ['job_tire_id', '=', $placement->job_tire_id],
                    ['client_id', '=', $placement->client_id],
                    ['date_from', '=', $dateFrom],
                    ['date_to', '=', $dateTo]
                ])->first();

                if ($timesheet == null && $dueTimesheet == null) {
                    TimesheetDue::create([
                        'employee_id' => $placement->employee_id,
                        'client_id' => $placement->client_id,
                        'placement_id' => $placement->id,
                        'job_tire_id' => $placement->job_tire_id,
                        'date_from' => $dateFrom,
                        'date_to' => $dateTo
                    ]);
                }
            }
        }

        $employees = Employee::all();
        $jobTires = JobTire::all();

        return view('timesheets.due_timesheets.index')->with([
            'randNum' => rand(),
            'employees' => $employees,
            'jobTires' => $jobTires
        ]);
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get due timesheets
     */
    public function getDueTimesheets()
    {
        $recordData = $this->getDueTimesheetRecords();
        $result = $this->makeDueTimesheets($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Get due timesheet by id.
     */
    public function getDuetTimesheetById()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
        ]);

        // Get params
        $id = $this->request['id'];

        $timesheet = TimesheetDue::find($id);

        return response()->json([
            'result' => 'success',
            'timesheet' => $timesheet
        ]);
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================

    /**
     * Get all timesheets records from DB.
     */
    private function getDueTimesheetRecords()
    {
        // Params
        $columns = ['', 'employee_id', 'date_from', 'placement_id', 'job_tire_id', 'client_id', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get client records for filter condition.
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_monthweek_from'] != NULL)
                $whereConds[] = ['date_from', '>=', $this->request['filt_monthweek_from']];
            if ($this->request['filt_monthweek_to'] != NULL)
                $whereConds[] = ['date_to', '<=', $this->request['filt_monthweek_to']];
            if ($this->request['filt_placement_id'] != NULL)
                $whereConds[] = ['placement_id', '=', $this->request['filt_placement_id']];
            if ($this->request['filt_jobtire'] != NULL)
                $whereConds[] = ['job_tire_id', '=', $this->request['filt_jobtire']];
        }

        // All record count
        $totalRecordCnt = count(TimesheetDue::all());

        // Filtered records
        $filteredRecords = TimesheetDue::with([
            'client',
            'employee',
            'jobtire'
        ])->where($whereConds)
            ->whereHas('employee', function (Builder $query) {
                if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
                    if ($this->request['filt_employee'] != NULL)
                        $query->where('email', 'like', '%' . $this->request['filt_employee'] . '%');
                }
            })
            ->whereHas('client', function (Builder $query) {
                if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
                    if ($this->request['filt_client'] != NULL)
                        $query->where('email', 'like', '%' . $this->request['filt_client'] . '%');
                }
            })
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record count
        $filteredCnt = count(
            TimesheetDue::with([
                'client',
                'employee',
                'jobtire'
            ])->where($whereConds)
                ->whereHas('employee', function (Builder $query) {
                    if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
                        if ($this->request['filt_employee'] != NULL)
                            $query->where('email', 'like', '%' . $this->request['filt_employee'] . '%');
                    }
                })
                ->whereHas('client', function (Builder $query) {
                    if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
                        if ($this->request['filt_client'] != NULL)
                            $query->where('email', 'like', '%' . $this->request['filt_client'] . '%');
                    }
                })
                ->get()
        );

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate employee table items
     */
    private function makeDueTimesheets($finalRecords, $totalCnt, $filteredCnt)
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
            $employeeName = ($finalRecord->employee != null) ? ($finalRecord->employee->email) : '';
            $clientName = ($finalRecord->client != null) ? ($finalRecord->client->email) : '';
            $jobTire = ($finalRecord->jobtire != null) ? ($finalRecord->jobtire->name) : '';
            if ($finalRecord->status == config('constants.TIMESHEET_STATUS_REQESTED'))
                $status = '<span class="label label-sm label-primary">Submitted</span>';
            else if ($finalRecord->status == config('constants.TIMESHEET_STATUS_APPROVED'))
                $status = '<span class="label label-sm label-info">Approve</span>';
            else
                $status = '<span class="label label-sm label-grey">Rejected</span>';

            $records["data"][] = array(
                $idx,
                $employeeName,
                $finalRecord->date_from . ' ~ ' . $finalRecord->date_to,
                $finalRecord->placement_id,
                $jobTire,
                $clientName,
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-timesheet-submit" data-id="' . $finalRecord->id . '"*><i class="fa fa-paper-plane"></i></a>'
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
     * Get the monday
     */
    public function lastMonday($date)
    {
        if (!is_numeric($date))
            $date = strtotime($date);
        if (date('w', $date) == 1)
            return $date;
        else
            return strtotime(
                'last monday',
                $date
            );
    }

    /**
     * Check the day is wekend.
     */
    public function isWeekend($date)
    {
        $date = strtotime($date);
        $date = date("l", $date);
        $date = strtolower($date);
        if ($date == "saturday" || $date == "sunday") {
            return true;
        } else {
            return false;
        }
    }
// ========================== END PRIVATE FUNCTIONS ==========================
}