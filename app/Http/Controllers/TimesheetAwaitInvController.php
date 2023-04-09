<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\AwaitingInvoice;

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
            if ($this->request['filt_monthweek'] != NULL)
                $whereConds[] = ['date_from', '<=', $this->request['filt_monthweek']];
            if ($this->request['filt_monthweek'] != NULL)
                $whereConds[] = ['date_to', '>=', $this->request['filt_monthweek']];
            if ($this->request['filt_placement_id'] != NULL)
                $whereConds[] = ['status', '=', $this->request['filt_placement_id']];
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
            $employeeName = ($finalRecord->employee != null) ? ($finalRecord->employee->email) : '';
            $clientName = ($finalRecord->client != null) ? ($finalRecord->client->email) : '';

            $records["data"][] = array(
                $idx,
                $employeeName,
                $clientName,
                $finalRecord->invoice_frequency,
                $finalRecord->invoice_from . ' ~ ' . $finalRecord->invoice_to,
                $finalRecord->total_hours,
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-placement-show" data-id="' . $finalRecord->id . '"*><i class="fa fa-eye"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-primary btn-placement-edit" data-id="' . $finalRecord->id . '"*><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-placement-delete" data-id="' . $finalRecord->id . '"*><i class="fa fa-trash"></i></a>'
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