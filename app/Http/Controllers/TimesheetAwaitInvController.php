<?php

namespace App\Http\Controllers;

use App\Models\ClientPlacement;
use App\Models\Timesheet;
use App\Models\TimesheetDue;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\AwaitingInvoice;
use App\Models\Employee;
use App\Models\JobTire;

class TimesheetAwaitInvController extends Controller
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
        // Check all placements and add awaiting invoices.
        $awaitPlacements = ClientPlacement::where([
            ['job_status', '=', config('constants.STATE_ACTIVE')],
            ['job_end_date', '<=', date("Y-m-d")]
        ])->get();
        foreach ($awaitPlacements as $awaitPlacement) {
            $awaitInv = AwaitingInvoice::where([
                ['placement_id', '=', $awaitPlacement->id]
            ])->first();

            if ($awaitInv == null) {
                $dueTimesheets = TimesheetDue::where([
                    ['placement_id', '=', $awaitPlacement->id]
                ])->get();
                if (count($dueTimesheets) == 0) {
                    $timesheetTotHours = Timesheet::where([
                        ['placement_id', '=', $awaitPlacement->id],
                        ['status', '=', config('constants.TIMESHEET_STATUS_APPROVED')]
                    ])->sum('total_billable_hours');
                    $timesheets = Timesheet::where([
                        ['placement_id', '=', $awaitPlacement->id],
                        ['status', '=', config('constants.TIMESHEET_STATUS_APPROVED')]
                    ])->orderBy('created_at', 'DESC')->get();

                    AwaitingInvoice::create([
                        'employee_id' => $awaitPlacement->employee_id,
                        'client_id' => $awaitPlacement->client_id,
                        'placement_id' => $awaitPlacement->id,
                        'invoice_frequency' => $awaitPlacement->invoice_frequency,
                        'invoice_from' => $timesheets[0]->date_from,
                        'invoice_to' => $timesheets[count($timesheets) - 1]->date_to,
                        'total_hours' => round($timesheetTotHours / 60)
                    ]);
                }
            }
        }


        $employees = Employee::all();
        $jobTires = JobTire::all();

        return view('timesheets.awaiting_invoices.index')->with([
            'randNum' => rand(),
            'employees' => $employees,
            'jobTires' => $jobTires
        ]);
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get await invoices
     */
    public function getAwaitInvoices()
    {
        $recordData = $this->getAwaitInvoiceRecords();
        $result = $this->makeAwaitInvoices($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================

    /**
     * Get awaiting invoice records from DB.
     */
    private function getAwaitInvoiceRecords()
    {
        // Params
        $columns = ['', 'employee_id', 'client_id', 'invoice_frequency', 'invoice_from', 'total_hours', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get client records for filter condition.
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_inv_period_from'] != NULL)
                $whereConds[] = ['date_from', '>=', $this->request['filt_inv_period_from']];
            if ($this->request['filt_inv_period_to'] != NULL)
                $whereConds[] = ['date_to', '<=', $this->request['filt_inv_period_to']];
            if ($this->request['filt_inv_frequency'] != NULL)
                $whereConds[] = ['invoice_frequency', '=', $this->request['filt_inv_frequency']];
            if ($this->request['filt_total_hours_from'] != NULL)
                $whereConds[] = ['total_hours', '>=', $this->request['filt_total_hours_from']];
            if ($this->request['filt_total_hours_to'] != NULL)
                $whereConds[] = ['total_hours', '<=', $this->request['filt_total_hours_to']];
        }

        // All record count
        $totalRecordCnt = count(AwaitingInvoice::all());

        // Filtered records
        $filteredRecords = AwaitingInvoice::with([
            'client',
            'employee'
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
            AwaitingInvoice::with([
                'client',
                'employee',
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
     * Generate await invoice table items.
     */
    private function makeAwaitInvoices($finalRecords, $totalCnt, $filteredCnt)
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

            // Invoice Frequency
            $invFrequency = "";
            if ($finalRecord->invoice_frequency == config('constants.INVOICE_FREQUENCY_WEEKLY')) {
                $invFrequency = "Weekly";
            } else if ($finalRecord->invoice_frequency == config('constants.INVOICE_FREQUENCY_BYWEEKLY')) {
                $invFrequency = "By-Weekly";
            } else if ($finalRecord->invoice_frequency == config('constants.INVOICE_FREQUENCY_MONTHLY')) {
                $invFrequency = "Monthly";
            } else if ($finalRecord->invoice_frequency == config('constants.INVOICE_FREQUENCY_QUARTERLY')) {
                $invFrequency = "Quarterly";
            }

            $records["data"][] = array(
                $idx,
                $employeeName,
                $clientName,
                $invFrequency,
                $finalRecord->invoice_from . ' ~ ' . $finalRecord->invoice_to,
                $finalRecord->total_hours,
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-await-inv-show" data-id="' . $finalRecord->id . '"*><i class="fa fa-eye"></i></a>'
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