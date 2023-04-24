<?php

namespace App\Http\Controllers;

use App\Models\ClientPlacement;
use App\Models\TimesheetDue;
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
     * Create client's timesheet.
     */
    public function create()
    {
        // Check Validation
        $this->request->validate([
            'employee_id' => ['required'],
            'job_tire_id' => ['required'],
            'date_from' => ['required'],
            'date_to' => ['required'],
            'attachment' => ['required', 'mimes:pdf,csv,txt,png,jpg,jpeg,docx', 'max:2048'],
            'report' => ['required'],
        ]);

        // Upload File
        $attachment = $this->request->file('attachment')->store('public/timesheets');
        $attachment = str_replace("public/", "storage/", $attachment);

        // Get Params
        $dueId = $this->request['due_id'];
        $employeeId = $this->request['employee_id'];
        $jobTireId = $this->request['job_tire_id'];
        $dateFrom = $this->request['date_from'];
        $dateTo = $this->request['date_to'];
        $report = $this->request['report'];
        $standardMon = $this->request['standard_mon'];
        $standardTue = $this->request['standard_tue'];
        $standardWed = $this->request['standard_wed'];
        $standardThu = $this->request['standard_thu'];
        $standardFri = $this->request['standard_fri'];
        $standardSat = $this->request['standard_sat'];
        $standardSun = $this->request['standard_sun'];
        $overTime = $this->request['over_time'];
        $overMon = $this->request['over_mon'];
        $overTue = $this->request['over_tue'];
        $overWed = $this->request['over_wed'];
        $overThu = $this->request['over_thu'];
        $overFri = $this->request['over_fri'];
        $overSat = $this->request['over_sat'];
        $overSun = $this->request['over_sun'];
        $doubleTime = $this->request['double_time'];
        $doubleMon = $this->request['double_mon'];
        $doubleTue = $this->request['double_tue'];
        $doubleWed = $this->request['double_wed'];
        $doubleThu = $this->request['double_thu'];
        $doubleFri = $this->request['double_fri'];
        $doubleSat = $this->request['double_sat'];
        $doubleSun = $this->request['double_sun'];
        $totalBillHours = $standardMon + $standardTue + $standardWed + $standardThu + $standardFri + $standardSat + $standardSun +
            $overMon + $overTue + $overWed + $overThu + $overFri + $overSat + $overSun +
            $doubleMon + $doubleTue + $doubleWed + $doubleThu + $doubleFri + $doubleSat + $doubleSun;

        $clietPlacement = ClientPlacement::where([
            ['employee_id', '=', $employeeId],
            ['job_tire_id', '=', $jobTireId],
            ['job_status', '=', config('constants.STATE_ACTIVE')]
        ])->first();

        // Create new record
        Timesheet::create([
            'employee_id' => $employeeId,
            'client_id' => $clietPlacement->client_id,
            'placement_id' => $clietPlacement->id,
            'job_tire_id' => $jobTireId,
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'attachment' => $attachment,
            'report' => $report,
            'submitted_on' => date('Y-m-d'),
            'total_billable_hours' => $totalBillHours,
            'standard_mon' => $standardMon,
            'standard_tue' => $standardTue,
            'standard_wed' => $standardWed,
            'standard_thu' => $standardThu,
            'standard_fri' => $standardFri,
            'standard_sat' => $standardSat,
            'standard_sun' => $standardSun,
            'over_time' => $overTime,
            'over_mon' => $overMon,
            'over_tue' => $overTue,
            'over_wed' => $overWed,
            'over_thu' => $overThu,
            'over_fri' => $overFri,
            'over_sat' => $overSat,
            'over_sun' => $overSun,
            'double_time' => $doubleTime,
            'double_mon' => $doubleMon,
            'double_tue' => $doubleTue,
            'double_wed' => $doubleWed,
            'double_thu' => $doubleThu,
            'double_fri' => $doubleFri,
            'double_sat' => $doubleSat,
            'double_sun' => $doubleSun
        ]);

        if ($dueId != null) {
            $dueTimesheet = TimesheetDue::find($dueId);
            $dueTimesheet->delete();
        }

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Update client's timesheet.
     */
    public function update()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
            'employee_id' => ['required'],
            'job_tire_id' => ['required'],
            'date_from' => ['required'],
            'date_to' => ['required'],
            // 'attachment' => ['required', 'mimes:pdf,csv,txt,png,jpg,jpeg,docx', 'max:2048'],
            'report' => ['required'],
        ]);

        // Upload File
        $isAttachment = $this->request['is_attachment'];
        if ($isAttachment > 0) {
            $attachment = $this->request->file('attachment')->store('public/timesheets');
            $attachment = str_replace("public/", "storage/", $attachment);
        }

        // // Get Params
        $id = $this->request['id'];
        $employeeId = $this->request['employee_id'];
        $jobTireId = $this->request['job_tire_id'];
        $dateFrom = $this->request['date_from'];
        $dateTo = $this->request['date_to'];
        $report = $this->request['report'];
        $standardMon = $this->request['standard_mon'];
        $standardTue = $this->request['standard_tue'];
        $standardWed = $this->request['standard_wed'];
        $standardThu = $this->request['standard_thu'];
        $standardFri = $this->request['standard_fri'];
        $standardSat = $this->request['standard_sat'];
        $standardSun = $this->request['standard_sun'];
        $overTime = $this->request['over_time'];
        $overMon = $this->request['over_mon'];
        $overTue = $this->request['over_tue'];
        $overWed = $this->request['over_wed'];
        $overThu = $this->request['over_thu'];
        $overFri = $this->request['over_fri'];
        $overSat = $this->request['over_sat'];
        $overSun = $this->request['over_sun'];
        $doubleTime = $this->request['double_time'];
        $doubleMon = $this->request['double_mon'];
        $doubleTue = $this->request['double_tue'];
        $doubleWed = $this->request['double_wed'];
        $doubleThu = $this->request['double_thu'];
        $doubleFri = $this->request['double_fri'];
        $doubleSat = $this->request['double_sat'];
        $doubleSun = $this->request['double_sun'];
        $totalBillHours = $standardMon + $standardTue + $standardWed + $standardThu + $standardFri + $standardSat + $standardSun +
            $overMon + $overTue + $overWed + $overThu + $overFri + $overSat + $overSun +
            $doubleMon + $doubleTue + $doubleWed + $doubleThu + $doubleFri + $doubleSat + $doubleSun;

        $clietPlacement = ClientPlacement::where([
            ['employee_id', '=', $employeeId],
            ['job_tire_id', '=', $jobTireId],
            ['job_status', '=', config('constants.STATE_ACTIVE')]
        ])->first();

        // Update record
        $timesheet = Timesheet::find($id);
        $timesheet->update([
            'employee_id' => $employeeId,
            'client_id' => $clietPlacement->client_id,
            'placement_id' => $clietPlacement->id,
            'job_tire_id' => $jobTireId,
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'report' => $report,
            'submitted_on' => date('Y-m-d'),
            'total_billable_hours' => $totalBillHours,
            'standard_mon' => $standardMon,
            'standard_tue' => $standardTue,
            'standard_wed' => $standardWed,
            'standard_thu' => $standardThu,
            'standard_fri' => $standardFri,
            'standard_sat' => $standardSat,
            'standard_sun' => $standardSun,
            'over_time' => $overTime,
            'over_mon' => $overMon,
            'over_tue' => $overTue,
            'over_wed' => $overWed,
            'over_thu' => $overThu,
            'over_fri' => $overFri,
            'over_sat' => $overSat,
            'over_sun' => $overSun,
            'double_time' => $doubleTime,
            'double_mon' => $doubleMon,
            'double_tue' => $doubleTue,
            'double_wed' => $doubleWed,
            'double_thu' => $doubleThu,
            'double_fri' => $doubleFri,
            'double_sat' => $doubleSat,
            'double_sun' => $doubleSun
        ]);
        if ($isAttachment > 0) {
            $timesheet->update([
                'attachment' => $attachment
            ]);
        }

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

    /**
     * Approve timesheet.
     */
    public function approve()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
        ]);

        // Params
        $id = $this->request['id'];

        // Delete timesheet.
        $timesheet = Timesheet::find($id);
        $timesheet->update([
            'status' => config('constants.TIMESHEET_STATUS_APPROVED')
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Reject timesheet.
     */
    public function reject()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
        ]);

        // Params
        $id = $this->request['id'];

        // Delete timesheet.
        $timesheet = Timesheet::find($id);
        $timesheet->update([
            'status' => config('constants.TIMESHEET_STATUS_REJECTED')
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Get placements by employee id
     */
    public function getPlacementsByEmpId()
    {
        // Check Validation
        $this->request->validate([
            'employeeId' => ['required'],
        ]);

        // Get Params
        $employeeId = $this->request['employeeId'];

        // 
        $clientPlacements = ClientPlacement::with([
            'jobTire'
        ])->where([
                ['employee_id', '=', $employeeId],
                ['job_status', '=', config('constants.STATE_ACTIVE')]
            ])->get();

        return response()->json([
            'result' => 'success',
            'placements' => $clientPlacements
        ]);
    }

    /**
     * Get timesheet
     */
    public function getTimesheetById()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
        ]);

        // Get params
        $id = $this->request['id'];

        $timesheet = Timesheet::find($id);

        return response()->json([
            'result' => 'success',
            'timesheet' => $timesheet
        ]);
    }

    /**
     * Do multi action.
     */
    public function doMultAction()
    {
        // Check Validation
        $this->request->validate([
            'action' => ['required'],
            'ids' => ['required'],
        ]);

        // Get params
        $action = $this->request['action'];
        $ids = $this->request['ids'];

        if ($action == "delete") {
            foreach ($ids as $id) {
                $timesheet = Timesheet::find($id);
                $timesheet->delete();
            }
        }

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
        $columns = ['', '', 'employee_id', 'client_id', 'date_from', 'total_billable_hours', 'status', 'submitted_on', '', ''];
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
            }
            if ($this->request['filt_bill_hours_from'] != NULL)
                $whereConds[] = ['total_billable_hours', '>=', ($this->request['filt_bill_hours_from'] * 60)];
            if ($this->request['filt_bill_hours_to'] != NULL)
                $whereConds[] = ['total_billable_hours', '<=', ($this->request['filt_bill_hours_to'] * 60)];
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
            // Employee
            $employeeName = ($finalRecord->employee != null) ? ($finalRecord->employee->email) : '';

            // Client
            $clientName = ($finalRecord->client != null) ? ($finalRecord->client->email) : '';

            // Date Range
            $dateRange = $finalRecord->date_from . ' ~ ' . $finalRecord->date_to;

            // Total billable hours
            $totBillHours = $this->parseMinutesToHr($finalRecord->total_billable_hours);

            // Status
            if ($finalRecord->status == config('constants.TIMESHEET_STATUS_REQESTED'))
                $status = '<span class="label label-sm label-primary">Request</span>';
            else if ($finalRecord->status == config('constants.TIMESHEET_STATUS_APPROVED'))
                $status = '<span class="label label-sm label-info">Approve</span>';
            else
                $status = '<span class="label label-sm label-grey">Rejected</span>';

            // Attachment
            $attachBtn = '<a href="' . url($finalRecord['attachment']) . '" class="btn btn-xs btn-c-primary btn-timesheet-view" data-id="' . $finalRecord->id . '"><i class="fa fa-download"></i></a>';

            // Action
            $actionBtn = '';
            $actionBtn .= '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-timesheet-edit" data-id="' . $finalRecord->id . '"><i class="fa fa-pencil"></i></a>';
            if ($finalRecord->status == config('constants.TIMESHEET_STATUS_REQESTED')) {
                $actionBtn .= '<a href="javascript:;" class="btn btn-xs btn-c-info btn-timesheet-approve" data-id="' . $finalRecord->id . '"><i class="fa fa-thumbs-o-up"></i></a>';
                $actionBtn .= '<a href="javascript:;" class="btn btn-xs btn-c-grey btn-timesheet-reject" data-id="' . $finalRecord->id . '"*><i class="fa fa-thumbs-o-down"></i></a>';
            }
            $actionBtn .= '<a href="javascript:;" class="btn btn-xs btn-c-grey btn-timesheet-delete" data-id="' . $finalRecord->id . '"><i class="fa fa-trash"></i></a>';

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $finalRecord->id . '">',
                $idx,
                $employeeName,
                $clientName,
                $dateRange,
                $totBillHours,
                $status,
                $finalRecord->submitted_on,
                $attachBtn,
                $actionBtn
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
     * Parse minutes to hour style (08:00)
     */
    private function parseMinutesToHr($minutes)
    {
        $hr = floor($minutes / 60);
        $min = $minutes % 60;

        return $hr . ':' . $min;
    }
// ========================== END PRIVATE FUNCTIONS ==========================
}