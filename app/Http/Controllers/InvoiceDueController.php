<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\DueInvoice;
use App\Models\DueInvoiceActivity;
use App\Models\Client;
use App\Models\Employee;

class InvoiceDueController extends Controller
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
     * Show the due invoices page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('invoices.due_inv.index')->with([
            'randNum' => rand()
        ]);
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get due invoices
     */
    public function getInvoices()
    {
        $recordData = $this->getInvoiceRecords();
        $result = $this->makeInvoiceTblItems($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Get due invoice activities
     */
    public function getInvoiceActs()
    {
        $recordData = $this->getInviceActTableList();
        $result = $this->makeInvoiceActTblItems($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Delete Invoice
     */
    public function delete()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
        ]);

        $invoice = DueInvoice::find($this->request['id']);
        $invoice->delete();

        // Create Invoice Activity
        $employee = Employee::find($invoice->employee_id);
        $client = Client::find($invoice->client_id);
        $description = "Deleted due invoice (Client: " . $client['email'] . ", Employee: " . $employee['email'] . ", Invoice Date: " . $invoice['invoice_date'] . ")";
        DueInvoiceActivity::create([
            'due_invoice_id' => $invoice['id'],
            'updated_by' => Auth::user()->employee->id,
            'description' => $description
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    /**
     * Generate 
     */
    private function getInvoiceRecords()
    {
        // Params
        $columns = ['', '', 'employee_id', 'invoice_date', 'invoice_due_date', 'invoiced_amount', 'received_amount', '', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get client records for filter condition.
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_inv_date_from'] != NULL)
                $whereConds[] = ['invoice_date', '>=', $this->request['filt_inv_date_from']];
            if ($this->request['filt_inv_date_to'] != NULL)
                $whereConds[] = ['invoice_date', '<=', $this->request['filt_inv_date_to']];
            if ($this->request['filt_inv_due_date_from'] != NULL)
                $whereConds[] = ['invoice_due_date', '>=', $this->request['filt_inv_due_date_from']];
            if ($this->request['filt_inv_due_date_to'] != NULL)
                $whereConds[] = ['invoice_due_date', '<=', $this->request['filt_inv_due_date_to']];
            if ($this->request['filt_inv_amount_from'] != NULL)
                $whereConds[] = ['invoiced_amount', '>=', $this->request['filt_inv_amount_from']];
            if ($this->request['filt_inv_amount_to'] != NULL)
                $whereConds[] = ['invoiced_amount', '<=', $this->request['filt_inv_amount_to']];
            if ($this->request['filt_rec_amount_from'] != NULL)
                $whereConds[] = ['received_amount', '>=', $this->request['filt_rec_amount_from']];
            if ($this->request['filt_rec_amount_to'] != NULL)
                $whereConds[] = ['received_amount', '<=', $this->request['filt_rec_amount_to']];
            // if ($this->request['filt_pastdue_from'] != NULL)
            //     $whereConds[] = ['received_amount', '>=', $this->request['filt_pastdue_from']];
            // if ($this->request['filt_pastdue_to'] != NULL)
            //     $whereConds[] = ['received_amount', '<=', $this->request['filt_pastdue_to']];
        }

        // All record count
        $totalRecordCnt = count(DueInvoice::all());

        // Filtered records
        $filteredRecords = DueInvoice::with([
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
            DueInvoice::with([
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
     * Generate invoice table items
     */
    private function makeInvoiceTblItems($finalRecords, $totalCnt, $filteredCnt)
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
            $employeeEmail = ($finalRecord->employee != null) ? ($finalRecord->employee->email) : '';
            $clientEmail = ($finalRecord->client != null) ? ($finalRecord->client->email) : '';

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $finalRecord->id . '">',
                $idx,
                $employeeEmail,
                $clientEmail,
                $finalRecord->invoice_date,
                $finalRecord->invoice_due_date,
                $finalRecord->invoiced_amount,
                $finalRecord->received_amount,
                '10 days',
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-invoice-view" data-id="' . $finalRecord->id . '"*><i class="fa fa-eye"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-primary btn-invoice-edit" data-id="' . $finalRecord->id . '"*><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-invoice-delete" data-id="' . $finalRecord->id . '"*><i class="fa fa-trash"></i></a>'
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
     * Get invice activity list from model.
     */
    private function getInviceActTableList()
    {
        // Params
        $columns = ['', 'created_at', '', 'description'];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['lengh'];

        // Get filter condition.t
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_act_date_from'] != NULL)
                $whereConds[] = ['created_at', '>=', $this->request['filt_act_date_from']];
            if ($this->request['filt_act_date_to'] != NULL)
                $whereConds[] = ['created_at', '<=', $this->request['filt_act_date_to']];
            if ($this->request['filt_act_description'] != NULL)
                $whereConds[] = ['description', 'like', '%' . $this->request['filt_act_description'] . '%'];
        }

        // All record count
        $totalRecordCnt = DueInvoiceActivity::count();

        // Filtered records
        $filteredRecords = DueInvoiceActivity::with([
            'updatedBy'
        ])->where($whereConds)
            ->whereHas('updatedBy', function (Builder $query) {
                if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
                    if ($this->request['filt_act_updatedby'] != NULL)
                        $query->where('email', 'like', '%' . $this->request['filt_act_updatedby'] . '%');
                }
            })
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record cnt
        $filteredCnt = count(DueInvoiceActivity::where($whereConds)->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate role activity list table items
     */
    private function makeInvoiceActTblItems($finalRecords, $totalCnt, $filteredCnt)
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
            $records["data"][] = array(
                $idx,
                $finalRecord->created_at,
                ($finalRecord->updatedBy) ? $finalRecord->updatedBy->email : '',
                $finalRecord->description
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