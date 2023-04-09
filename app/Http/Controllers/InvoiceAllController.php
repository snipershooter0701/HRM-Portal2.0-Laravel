<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Invoice;
use App\Models\Client;
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
        $clients = Client::all();
        $employees = Employee::all();
        return view('invoices.all-inv.index')->with([
            'randNum' => rand(),
            'clients' => $clients,
            'employees' => $employees,
        ]);
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get invoices
     * 
     * @return $invoices
     */
    public function getInvoices()
    {
        $recordData = $this->getInvoiceRecords();
        $result = $this->makeInvoiceTblItems($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Get Service Summaries
     * 
     * @return $summaries
     */
    public function getSvcSmrys()
    {
        $recordData = $this->getSvcSmryRecords();
        $result = $this->makeSvcSmryTblItems($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Get Notes & Totals
     * 
     * @return $notes
     */
    public function getNoteTotals()
    {
        $recordData = $this->getInvoiceTblData();
        $result = $this->makeNoteTotalTblItems($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Creat Invoice
     */
    public function create()
    {
        // Check Validation
        $this->request->validate([
            'employee_id' => ['required'],
            'client_id' => ['required'],
            'invoice_date' => ['required'],
            'invoice_due_date' => ['required'],
            'invoice_frequency' => ['required'],
            'net_terms' => ['required', 'numeric'],
            'include_po_attach' => ['required'],
            'invoice_recipient' => ['required'],
            // 'invoice_cc_emails' => ['required'],
            // 'invoice_bcc_emails' => ['required'],
            // 'notes' => ['required'],
            // 'statement_memo' => ['required'],
            // 'attachment' => ['required'],
            // 'payable_to' => ['required'],
            // 'additional_info' => ['required'],
        ]);

        Invoice::create([
            'employee_id' => $this->request['employee_id'],
            'client_id' => $this->request['client_id'],
            'invoice_date' => $this->request['invoice_date'],
            'invoice_due_date' => $this->request['invoice_due_date'],
            'invoiced_amount' => 0,
            'received_amount' => 0,
            'invoice_frequency' => $this->request['invoice_frequency'],
            'net_terms' => $this->request['net_terms'],
            'include_po_attach' => $this->request['include_po_attach'],
            'invoice_recipient' => $this->request['invoice_recipient'],
            'invoice_cc_emails' => $this->request['invoice_cc_emails'],
            'invoice_bcc_emails' => $this->request['invoice_bcc_emails'],
            'notes' => $this->request['notes'],
            'statement_memo' => $this->request['statement_memo'],
            'attachment' => $this->request['attachment'],
            'payable_to' => $this->request['payable_to'],
            'additional_info' => $this->request['additional_info'],
        ]);

        return response()->json([
            'result' => 'success'
        ]);
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

        // Params
        $id = $this->request['id'];

        $invoice = Invoice::find($id);
        $invoice->delete();
        
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
        $columns = ['', 'employee_id', 'client_id', 'invoice_frequency', 'invoice_from', 'total_hours', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get client records for filter condition.
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_inv_date_from'] != NULL)
                $whereConds[] = ['invoice_date', '<=', $this->request['filt_inv_date_from']];
            if ($this->request['filt_inv_date_to'] != NULL)
                $whereConds[] = ['invoice_date', '>=', $this->request['filt_inv_date_to']];
            if ($this->request['filt_inv_due_date_from'] != NULL)
                $whereConds[] = ['invoice_due_date', '<=', $this->request['filt_inv_due_date_from']];
            if ($this->request['filt_inv_due_date_to'] != NULL)
                $whereConds[] = ['invoice_due_date', '>=', $this->request['filt_inv_due_date_to']];
            if ($this->request['filt_inv_amount_from'] != NULL)
                $whereConds[] = ['invoiced_amount', '<=', $this->request['filt_inv_amount_from']];
            if ($this->request['filt_inv_amount_to'] != NULL)
                $whereConds[] = ['invoiced_amount', '>=', $this->request['filt_inv_amount_to']];
            if ($this->request['filt_rec_amount_from'] != NULL)
                $whereConds[] = ['received_amount', '<=', $this->request['filt_rec_amount_from']];
            if ($this->request['filt_rec_amount_to'] != NULL)
                $whereConds[] = ['received_amount', '>=', $this->request['filt_rec_amount_to']];
            // if ($this->request['filt_pastdue_from'] != NULL)
            //     $whereConds[] = ['received_amount', '<=', $this->request['filt_pastdue_from']];
            // if ($this->request['filt_pastdue_to'] != NULL)
            //     $whereConds[] = ['received_amount', '>=', $this->request['filt_pastdue_to']];
        }

        // All record count
        $totalRecordCnt = count(Invoice::all());

        // Filtered records
        $filteredRecords = Invoice::with([
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
            Invoice::with([
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
            $employeeName = ($finalRecord->employee != null) ? ($finalRecord->employee->email) : '';
            $clientName = ($finalRecord->client != null) ? ($finalRecord->client->email) : '';

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $finalRecord->id . '">',
                $idx,
                $employeeName,
                $clientName,
                $finalRecord->invoice_date,
                $finalRecord->invoice_due_date,
                $finalRecord->invoiced_amount,
                $finalRecord->received_amount,
                '10',
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-invoice-edit" data-id="' . $finalRecord->id . '"*><i class="fa fa-pencil"></i></a>
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
     * Get Service Smary table items.
     */
    private function getSvcSmryRecords()
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
            if ($this->request['filt_inv_date_from'] != NULL)
                $whereConds[] = ['invoice_date', '<=', $this->request['filt_inv_date_from']];
            if ($this->request['filt_inv_date_to'] != NULL)
                $whereConds[] = ['invoice_date', '>=', $this->request['filt_inv_date_to']];
            if ($this->request['filt_inv_due_date_from'] != NULL)
                $whereConds[] = ['invoice_due_date', '<=', $this->request['filt_inv_due_date_from']];
            if ($this->request['filt_inv_due_date_to'] != NULL)
                $whereConds[] = ['invoice_due_date', '>=', $this->request['filt_inv_due_date_to']];
            if ($this->request['filt_inv_amount_from'] != NULL)
                $whereConds[] = ['invoiced_amount', '<=', $this->request['filt_inv_amount_from']];
            if ($this->request['filt_inv_amount_to'] != NULL)
                $whereConds[] = ['invoiced_amount', '>=', $this->request['filt_inv_amount_to']];
            if ($this->request['filt_rec_amount_from'] != NULL)
                $whereConds[] = ['received_amount', '<=', $this->request['filt_rec_amount_from']];
            if ($this->request['filt_rec_amount_to'] != NULL)
                $whereConds[] = ['received_amount', '>=', $this->request['filt_rec_amount_to']];
            // if ($this->request['filt_pastdue_from'] != NULL)
            //     $whereConds[] = ['received_amount', '<=', $this->request['filt_pastdue_from']];
            // if ($this->request['filt_pastdue_to'] != NULL)
            //     $whereConds[] = ['received_amount', '>=', $this->request['filt_pastdue_to']];
        }

        // All record count
        $totalRecordCnt = count(Invoice::all());

        // Filtered records
        $filteredRecords = Invoice::with([
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
            Invoice::with([
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