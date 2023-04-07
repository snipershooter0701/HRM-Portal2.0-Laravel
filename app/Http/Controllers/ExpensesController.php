<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\ExpenseBill;

class ExpensesController extends Controller
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
     * Show the employee page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('expenses.index')->with('randNum', rand());
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get expenses
     * 
     * @return $expenses
     */
    public function getExpensesList(Request $request)
    {
        $ajaxData = $this->getExpenseTblData($request);
        $result = $this->makeExpenseTblItems($ajaxData['filterItems'], $ajaxData['employees']);
        return $result;
    }

    /**
     * Get expense activities
     */
    public function getExpenseAct()
    {
        // $ajaxData = $this->getExpenseTblData();
        $result = $this->makeExpenseActivityTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }

    /**
     * Get add expenses
     */
    public function getAddExpenses(Request $request)
    {
        // Validation TOOD
        $request->validate([
            'cate'            => ['required'],
            'type'            => ['required'],
            'emp'             => ['required'],
            'bill_record'     => ['required']
        ]);

        Expense::create([
            'category'        =>  $request->cate,
            'type'            =>  $request->type,
            'employee_id'     =>  $request->emp,
        ]);

        $expense_id = Expense::select('id')
                            ->where('employee_id', $request->emp)
                            ->latest()
                            ->first();
       
        for($i = 0; $i < count($request->bill_record); $i++) {
            ExpenseBill::create([
                'expense_id'    =>  $expense_id->id,
                'date'          =>  $request->bill_record[$i]['date'],
                'details'       =>  $request->bill_record[$i]['details'],
                'amount'        =>  $request->bill_record[$i]['amount'],
                'attachment'    =>  $request->bill_record[$i]['attachment']
            ]);
        }

        return response()->json([
            'result' => 'success'
        ]);
    }

    // Get Expense By ID
    public function getExpenseById(Request $request)
    {
        // Check Validation
        $request->validate([
            'id' => ['required']
        ]);

        $employee = Expense::with(['employee', 'expensebill'])
                            ->get();

        return response()->json([
            'result' => 'success',
            'employee' => $employee
        ]);
    }

    // Update Employee Info
    public function updateExpenses(Request $request) {
        // Validation TOOD
        $request->validate([
            'id'                => ['required'],
            'first_name'        => ['required'],
            'last_name'         => ['required'],
            'title'             => ['required'],
            'email_address'     => ['required'],
            'phone_num'         => ['required'],
            'birth'             => ['required'],
            'join_date'         => ['required'],
            'gender'            => ['required'],
            'employment_type'   => ['required'],
            'category'          => ['required'],
            'employee_type'     => ['required'],
            'employee_status'   => ['required'],
            'role'              => ['required'],
            'poc'               => ['required'],
            'classification'    => ['required'],
            'per_pay'           => ['required'],
            'per_change_hrs'    => ['required'],
            'per_change_pay'    => ['required'],
            'rate_pay'          => ['required'],
            'rate_change_hrs'   => ['required'],
            'rate_change_pay'   => ['required'],
            'addr_street'       => ['required'],
            'addr_apt'          => ['required'],
            'addr_city'         => ['required'],
            'addr_state'        => ['required'],
            'addr_country'      => ['required'],
            'addr_zipcode'      => ['required'],
            'pay_standard_time' => ['required'],
            'pay_over_time'     => ['required'],
            'pay_double_time'   => ['required'],
            'pay_scale'         => ['required']
        ]);

        Employee::where('id', $request->id)
                ->update([
                    'first_name'        =>  $request->first_name,
                    'middle_name'       =>  $request->middle_name,
                    'last_name'         =>  $request->last_name,
                    'title'             =>  $request->title,
                    'email'             =>  $request->email_address,
                    'phone_num'         =>  $request->phone_num,
                    'dateofbirth'       =>  $request->birth,
                    'dateofjoining'     =>  $request->join_date,
                    'gender'            =>  $request->gender,
                    'employment_type'   =>  $request->employment_type,
                    'category'          =>  $request->category,
                    'employee_type'     =>  $request->employee_type,
                    'status'            =>  $request->employee_status,
                    'role_id'           =>  $request->role,
                    'poc_id'            =>  $request->poc,
                    'classification'    =>  $request->classification,
                    'pay_percent_value' =>  $request->per_pay,
                    'pay_percent_hrs'   =>  $request->per_change_hrs,
                    'pay_percent_to'    =>  $request->per_change_pay,
                    'pay_rate_value'    =>  $request->rate_pay,
                    'pay_rate_hrs'      =>  $request->rate_change_hrs,
                    'pay_rate_to'       =>  $request->rate_change_pay,
                    'street'            =>  $request->addr_street,
                    'suite_aptno'       =>  $request->addr_apt,
                    'city_town'         =>  $request->addr_city,
                    'state_id'          =>  $request->addr_state,
                    'country_id'        =>  $request->addr_country,
                    'zipcode'           =>  $request->addr_zipcode,
                    'pay_scale'         =>  $request->pay_scale,
                    'pay_standard_time' =>  $request->pay_standard_time,
                    'pay_over_time'     =>  $request->pay_over_time,
                    'pay_double_time'   =>  $request->pay_double_time,
                    'status_end_date'   =>  $request->employee_status_date,
                    'department_id'     =>  $request->deparment,
                ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    // Delete Employee Info
    public function delExpenses(Request $request) {
        // Check Validation
        $request->validate([
            'id' => ['required'],
        ]);

        Employee::where('id', $request->id)
                ->delete();

        return response()->json([
            'result' => 'success'
        ]);
    }
    // =========================== END PUBLIC FUNCTIONS ===========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    /**
     * Generate 
     */
    private function getExpenseTblData($request)
    {
        $whereConds = array();
        if ($request['action'] != NULL && $request['action'] == "filter") {
            if ($request['filt_expenses_category'] != NULL)
                $whereConds[] = ['category', $request['filt_expenses_category']];
            if ($request['filt_employee'] != NULL)
                $whereConds[] = ['employee_id', $this->request['filt_employee']];
            if ($request['filt_amount'] != NULL)
                $whereConds[] = ['amount', $this->request['filt_amount']];
            if ($request['filt_expense_type'] != NULL)
                $whereConds[] = ['type', $this->request['filt_expense_type']];
        }

        $expenseItems = Expense::with(['employee', 'expensebill'])
                                ->where($whereConds)
                                ->get();

        $employees = Employee::select('id', 'first_name', 'last_name')
                            ->get();

        return [
            'filterItems' => $expenseItems,
            'employees' => $employees
        ];
    }

    /**
     * Generate expense table items
     */
    private function makeExpenseTblItems($filterItems, $employees)
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
        $total = 0;
        for ($i = $iDisplayStart; $i < $end; $i++) {
            $id = ($i + 1);
            $amount = 0;

            // Total amount
            for($j = 0; $j < count($filterItems[$idx]->expensebill); $j ++) {
                $amount += Intval($filterItems[$idx]->expensebill[$j]->amount);
            }

            $records["data"][] = array(
                $id,
                '<input type="checkbox" name="id[]" value="' . $id . '">',
                $filterItems[$idx]->category == 0 ? '<span class="label label-sm label-primary">Employee Expense</span>' : '<span class="label label-sm label-grey">Company Expense</span>',
                $filterItems[$idx]->employee->first_name . $filterItems[$idx]->employee->last_name,
                $filterItems[$idx]->category == 0 ? '<span class="color-light-green">$'.$amount.'</span>' : '<span class="color-primary">$'.$amount.'</span>',
                $filterItems[$idx]->type == 0 ? '<span class="label label-sm label-primary">Advance</span>' : '<span class="label label-sm label-grey">Service(s)</span>',
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-expense-view" data-id="'.$filterItems[$idx]->id.'"><i class="fa fa-eye"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-primary btn-expense-edit" data-id="'.$filterItems[$idx]->id.'"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-expense-del" data-id="'.$filterItems[$idx]->id.'"><i class="fa fa-trash"></i></a>'
            );
            $total += $amount;
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
        $records["total"] = $total;

        // echo json_encode($records);
        return response()->json($records);
    }

    /**
     * Generate expense activity table items
     */
    private function makeExpenseActivityTblItems($totalItems, $filterItems)
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
                "03/01/2023 16:05:02",
                "test@test.com",
                "The quick brown dog jumped over the lazy fox. The quick brown dog jumped over the lazy fox. "
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
     * Generate add expenses table items
     */
    private function makeAddExpenseTblItems($totalItems, $filterItems)
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
        $id = 0;
        for ($i = $iDisplayStart; $i < 1; $i++) {
            $id = ($i + 1);
            $records["data"][] = array(
                $id,
                '<div class="form-body">
                    <div class="form-group margin-bottom-cancel">
                        <div class="input-group date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                            <input type="text" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>',
                '<div class="form-body">
                    <div class="form-group margin-bottom-cancel">
                        <input type="text" class="form-control">
                    </div>
                </div>',
                '<div class="form-body">
                    <div class="form-group margin-bottom-cancel">
                        <input type="text" class="form-control" placeholder="0.00">
                    </div>
                </div>',
                '<div class="form-body">
                    <div class="form-group margin-bottom-cancel">
                        <input type="file" class="form-control">
                    </div>
                </div>',
                '<a href="javascript:;" class="btn btn-xs btn-c-grey"><i class="fa fa-trash"></i></a>'
            );
            $idx++;
        }
        
        $records["data"][] = array(
            '',
            '<b>Total</b>',
            '',
            '<b>$0.00</b>',
            '',
            ''
        );

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