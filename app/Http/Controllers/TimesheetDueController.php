<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Timesheet;
use App\Models\Employee;

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
            if ($this->request['filt_monthweek'] != NULL)
                $whereConds[] = ['date_from', '<=', $this->request['filt_monthweek']];
            if ($this->request['filt_monthweek'] != NULL)
                $whereConds[] = ['date_to', '>=', $this->request['filt_monthweek']];
            if ($this->request['filt_placement_id'] != NULL)
                $whereConds[] = ['status', '=', $this->request['filt_placement_id']];
        }

        // All record count
        $totalRecordCnt = count(Timesheet::all());

        // Filtered records
        $filteredRecords = Timesheet::with([
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
            Timesheet::with([
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
// ========================== END PRIVATE FUNCTIONS ==========================
}