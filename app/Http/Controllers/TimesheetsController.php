<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Timesheet;
use App\Models\Employee;
use App\Models\JobTire;

/**
 * Timesheets -> All Timesheets
 */
class TimesheetsController extends Controller
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
        $employees = Employee::all();
        $jobTires = JobTire::all();

        return view('timesheets.all_timesheets.index')->with([
            'randNum' => rand(),
            'employees' => $employees,
            'jobTires' => $jobTires
        ]);
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get all timesheets.
     */
    public function getAllTimesheets()
    {
        $recordData = $this->getAllTimesheetRecords();
        $result = $this->makeAllTimesheets($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Create client's placement.
     */
    public function create()
    {
        // Check Validation
        $this->request->validate([
            'employee_id' => ['required'],
            'job_tire_id' => ['required'],
            'date_from' => ['required'],
            'date_to' => ['required'],
            'attachment' => ['required'],
            'report' => ['required']
        ]);

        // Create new record
        Timesheet::create([
            'employee_id' => $this->request['employee_id'],
            'client_id' => 1,
            'placement_id' => 1,
            'job_tire_id' => $this->request['job_tire_id'],
            'date_from' => $this->request['date_from'],
            'date_to' => $this->request['date_to'],
            'attachment' => $this->request['attachment'],
            'report' => $this->request['report'],
            'submitted_on' => "2023-03-03",
            'total_billable_hours' => "120:00",
            'standard_mon' => $this->request['standard_mon'],
            'standard_tue' => $this->request['standard_tue'],
            'standard_wed' => $this->request['standard_wed'],
            'standard_thu' => $this->request['standard_thu'],
            'standard_fri' => $this->request['standard_fri'],
            'standard_sat' => $this->request['standard_sat'],
            'standard_sun' => $this->request['standard_sun'],
            'over_time' => $this->request['over_time'],
            'over_mon' => $this->request['over_mon'],
            'over_tue' => $this->request['over_tue'],
            'over_wed' => $this->request['over_wed'],
            'over_thu' => $this->request['over_thu'],
            'over_fri' => $this->request['over_fri'],
            'over_sat' => $this->request['over_sat'],
            'over_sun' => $this->request['over_sun'],
            'double_time' => $this->request['double_time'],
            'double_mon' => $this->request['double_mon'],
            'double_tue' => $this->request['double_tue'],
            'double_wed' => $this->request['double_wed'],
            'double_thu' => $this->request['double_thu'],
            'double_fri' => $this->request['double_fri'],
            'double_sat' => $this->request['double_sat'],
            'double_sun' => $this->request['double_sun']
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Delete timesheet.
     */
    public function delete()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
        ]);

        // Delete timesheet.
        $timesheet = Timesheet::find($this->request['id']);
        $timesheet->delete();

        return response()->json([
            'result' => 'success'
        ]);
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    /**
     * Get all timesheets records from DB.
     */
    private function getAllTimesheetRecords()
    {
        // Params
        $columns = ['', 'employee_id', 'client_id', '', '', 'status', '', 'submitted_on', '', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get client records for filter condition.
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_date_range'] != NULL) {
                if ($this->request['filt_date_range'] == config('constants.DATE_RANGE_ALL')) {

                } else if ($this->request['filt_date_range'] == config('constants.DATE_RANGE_CUR_WEEK')) {

                } else if ($this->request['filt_date_range'] == config('constants.DATE_RANGE_LAST_WEEK')) {

                } else if ($this->request['filt_date_range'] == config('constants.DATE_RANGE_CUR_MTH')) {

                } else if ($this->request['filt_date_range'] == config('constants.DATE_RANGE_LAST_MTH')) {

                } else if ($this->request['filt_date_range'] == config('constants.DATE_RANGE_LAST_3_MTH')) {

                } else if ($this->request['filt_date_range'] == config('constants.DATE_RANGE_LAST_6_MTH')) {

                } else if ($this->request['filt_date_range'] == config('constants.DATE_RANGE_CUSTOM')) {

                }
                $whereConds[] = ['job_tire_id', '=', $this->request['filt_job_tire']];
            }
            if ($this->request['filt_bill_hours'] != NULL)
                $whereConds[] = ['net_terms', '=', $this->request['filt_bill_hours']];
            if ($this->request['filt_status'] != NULL)
                $whereConds[] = ['status', '=', $this->request['filt_status']];
            if ($this->request['filt_submitted_on_from'] != NULL)
                $whereConds[] = ['submitted_on', '>=', $this->request['filt_submitted_on_from']];
            if ($this->request['filt_submitted_on_to'] != NULL)
                $whereConds[] = ['submitted_on', '<=', $this->request['filt_submitted_on_to']];
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
     * Generate timesheet table items
     */
    private function makeAllTimesheets($finalRecords, $totalCnt, $filteredCnt)
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
            if ($finalRecord->status == config('constants.TIMESHEET_STATUS_REQESTED'))
                $status = '<span class="label label-sm label-primary">Submitted</span>';
            else if ($finalRecord->status == config('constants.TIMESHEET_STATUS_APPROVED'))
                $status = '<span class="label label-sm label-info">Approve</span>';
            else
                $status = '<span class="label label-sm label-grey">Rejected</span>';

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $finalRecord->id . '">',
                $idx,
                $employeeName,
                $clientName,
                $finalRecord->date_from . '~' . $finalRecord->date_to,
                $finalRecord->total_billable_hours,
                $status,
                $finalRecord->submitted_on,
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-timesheet-view" data-id="' . $finalRecord->id . '"*><i class="fa fa-eye"></i></a>',
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-timesheet-edit" data-id="' . $finalRecord->id . '"*><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-info btn-timesheet-active" data-id="' . $finalRecord->id . '"*><i class="fa fa-thumbs-o-up"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-danger btn-timesheet-inactive" data-id="' . $finalRecord->id . '"*><i class="fa fa-thumbs-o-down"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-timesheet-delete" data-id="' . $finalRecord->id . '"*><i class="fa fa-trash"></i></a>'
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