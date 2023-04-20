<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\ClientPayment;
use App\Models\ClientPaymentActivity;

class InvoiceCliPayController extends Controller
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
        return view('invoices.client_pay.index')->with([
            'randNum' => rand(),
            'clients' => $clients
        ]);
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get pay list from model and generate columns for ajax table. (tbl_client_pays)
     */
    public function getPayments()
    {
        $recordData = $this->getPayTableList();
        $result = $this->makePayTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Get pay activity list from model and generate columns for ajax table. (tbl_pay_activities)
     */
    public function getPaymentActs()
    {
        $recordData = $this->getPayActTableList();
        $result = $this->makePayActTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Create Client Payment
     */
    public function create()
    {
        // Check Validation
        $this->request->validate([
            'client_id' => ['required'],
            'payment_received_date' => ['required'],
            'amount_received' => ['required', 'numeric'],
            'bank_id' => ['required'],
            'pay_method_id' => ['required'],
            'comments' => ['required'],
            'attachment' => ['required'],
        ]);

        // Create new record
        $clientPayment = ClientPayment::create([
            'client_id' => $this->request['client_id'],
            'payment_received_date' => $this->request['payment_received_date'],
            'amount_due' => '0',
            'amount_received' => $this->request['amount_received'],
            'bank_id' => $this->request['bank_id'],
            'pay_method_id' => $this->request['pay_method_id'],
            'comments' => $this->request['comments'],
            'attachment' => $this->request['attachment'],
        ]);

        // Create new activity.
        $client = Client::find($clientPayment->client_id);
        $description = "Created new payment (Client: " . $client['email'] . ", Received Amount: " . $clientPayment['amount_received'] . ")";
        ClientPaymentActivity::create([
            'client_payment_id' => $clientPayment->id,
            'updated_by' => Auth::user()->employee->id,
            'description' => $description
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Delete Payment
     */
    public function delete()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required']
        ]);

        // Delete
        $clientPayment = clientPayment::find($this->request['id']);
        $clientPayment->delete();

        // Create new activity.
        $client = Client::find($clientPayment['client_id']);
        $description = "Deleted payment (Client: " . $client['email'] . ", Received Amount: " . $clientPayment['name'] . ")";
        clientPaymentActivity::create([
            'client_payment_id' => $clientPayment['id'],
            'updated_by' => Auth::user()->employee->id,
            'description' => $description
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    private function getPayTableList()
    {
        // Params
        $columns = ['', '', 'client_id', '', '', '', '', '', 'amount_received', '', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get filter condition.
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_pay_date_from'] != NULL)
                $whereConds[] = ['payment_received_date', '>=', $this->request['filt_pay_date_from']];
            if ($this->request['filt_pay_date_to'] != NULL)
                $whereConds[] = ['payment_received_date', '<=', $this->request['filt_pay_date_to']];
            if ($this->request['filt_receve_due_from'] != NULL)
                $whereConds[] = ['due_received', '>=', $this->request['filt_receve_due_from']];
            if ($this->request['filt_receve_due_to'] != NULL)
                $whereConds[] = ['due_received', '<=', $this->request['filt_receve_due_to']];
            if ($this->request['filt_receve_amount_from'] != NULL)
                $whereConds[] = ['amount_received', '>=', $this->request['filt_receve_amount_from']];
            if ($this->request['filt_receve_amount_to'] != NULL)
                $whereConds[] = ['amount_received', '<=', $this->request['filt_receve_amount_to']];
        }

        // All record count
        $totalRecordCnt = ClientPayment::count();

        // Filtered records
        $filteredRecords = ClientPayment::with([
            'client'
        ])->where($whereConds)
            ->whereHas('client', function (Builder $query) {
                if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
                    if ($this->request['filt_client'] != NULL)
                        $query->where('id', $this->request['filt_client']);
                }
            })
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record cnt
        $filteredCnt = count(ClientPayment::with([
            'client'
        ])->where($whereConds)
            ->whereHas('client', function (Builder $query) {
                if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
                    if ($this->request['filt_client'] != NULL)
                        $query->where('id', $this->request['filt_client']);
                }
            })
            ->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    private function makePayTblColumns($finalRecords, $totalCnt, $filteredCnt)
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
            $clientEmail = $finalRecord->client ? $finalRecord->client->email : '';
            $paymentMethod = $finalRecord->pay_method_id == '1' ? 'Pay Method 1' : 'Pay Method 2';
            $bank = $finalRecord->bank_id == '1' ? 'Bank 1' : 'Bank 2';


            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $finalRecord->id . '">',
                $idx,
                $clientEmail,
                "Invoice " . $finalRecord->id,
                $finalRecord->payment_received_date,
                $paymentMethod,
                $finalRecord->amount_due,
                $finalRecord->amount_received,
                $bank,
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-pay-edit" data-id="' . $finalRecord->id . '"  data-name="' . $finalRecord->name . '" data-department="' . $finalRecord->department_id . '"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-pay-delete" data-id="' . $finalRecord->id . '" data-name="' . $finalRecord->name . '"><i class="fa fa-trash"></i></a>'
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
     * Get role activity list from model.
     */
    private function getPayActTableList()
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
        $totalRecordCnt = ClientPaymentActivity::count();

        // Filtered records
        $filteredRecords = ClientPaymentActivity::with([
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
        $filteredCnt = count(ClientPaymentActivity::where($whereConds)->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate role activity list table items
     */
    private function makePayActTblColumns($finalRecords, $totalCnt, $filteredCnt)
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