<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\Subscribe;
use App\Models\User;
use App\Models\Employee;
use App\Models\EmployeeActivity;
use App\Models\Role;
use App\Models\Document;

class EmployeeController extends Controller
{
    private $request;

   
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        

        return view('employee.all_employees.employee_index')->with('randNum', rand());
    }


    // Get Employee list
    public function getEmployeeList()
    {
        $ajaxData = $this->getEmployeeListTblData();
        $result = $this->makeEmployeeListTblItems($ajaxData['filterItems'], $ajaxData['role'], $ajaxData['max_id']);
        return $result;
    }

    // Get Employee By ID
    public function getEmployeeByID(Request $request)
    {
        // Check Validation
        $request->validate([
            'id' => ['required']
        ]);

        $employee = Employee::find($request->id);
        $doc = Document::where('employee_id', $request->id)->get();

        return response()->json([
            'result' => 'success',
            'employee' => $employee,
            'doc' => $doc,
        ]);
    }

    // Add Employee
    public function addEmployee(Request $request)
    {
        // Validation TOOD
        $request->validate([
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
            'addr_zipcode'      => ['required']
        ]);

        $employee = Employee::create([
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

        EmployeeActivity::create([
            'employee_id'   =>  $employee->id,   
            'updated_by'    =>  '1',               // session
            'description'   =>  'Create Employee',
        ]);

        $createArray = array();
        if($request->ssn == '1') {
            $createArray = [
                'employee_id'       =>  $employee->id,
                'doc_title_id'      => '0',
                'no'                => $request->ssn_doc['no'],
                'attachment'        => $request->ssn_doc['attachment'],
            ];
            Document::create($createArray);
        }
        if($request->auth == '1') {
            $createArray = [
                'employee_id'       =>  $employee->id,
                'doc_title_id'      => '1',
                'work_auth_id'      => $request->auth_doc['work_auth_id'],
                'no'                => $request->auth_doc['no'],
                'start_date'        => $request->auth_doc['start_date'],
                'expire_date'       => $request->auth_doc['expire_date'],
                'attachment'        => $request->auth_doc['attachment'],
            ];
            Document::create($createArray);
        }
        if($request->state == '1') {
            $createArray = [
                'employee_id'       =>  $employee->id,
                'doc_title_id'      => '2',
                'no'                => $request->state_doc['no'],
                'exp_date'          => $request->state_doc['exp_date'],
                'attachment'        => $request->state_doc['attachment'],
            ];
            Document::create($createArray);
        }
        if($request->passport == '1') {
            $createArray = [
                'employee_id'       =>  $employee->id,
                'doc_title_id'      => '3',
                'no'                => $request->passport_doc['no'],
                'exp_date'          => $request->passport_doc['exp_date'],
                'attachment'        => $request->passport_doc['attachment'],
            ];
            Document::create($createArray);
        }
        if($request->i94 == '1') {
            $createArray = [
                'employee_id'       =>  $employee->id,
                'doc_title_id'      => '4',
                'no'                => $request->i94_doc['no'],
                'exp_date'          => $request->i94_doc['exp_date'],
                'i94_type'          => $request->i94_doc['i94_type'],
                'attachment'        => $request->i94_doc['attachment'],
            ];
            Document::create($createArray);
        }
        if($request->visa == '1') {
            $createArray = [
                'employee_id'       =>  $employee->id,
                'doc_title_id'      => '5',
                'no'                => $request->visa_doc['no'],
                'exp_date'          => $request->visa_doc['exp_date'],
                'attachment'        => $request->visa_doc['attachment'],
            ];
            Document::create($createArray);
        }
        if(count( $request->other_array) ) {
            for($i = 0; $i < count($request->other_array); $i ++) {
                $createArray = [
                    'employee_id'       =>  $employee->id,
                    'doc_title_id'      => '6',
                    'comment'           => $request->other_array[$i]['title'],
                    'no'                => $request->other_array[$i]['no'],
                    'exp_date'          => $request->other_array[$i]['exp_date'],
                    'attachment'        => $request->other_array[$i]['attachment'],
                ];
                Document::create($createArray);
            }
        }

        // Create New User
        $originPwd = $this->parseDate($request->birth) . $request->last_name;
        User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email_address,
            'password' => Hash::make($originPwd),
            'origin_pwd' => $originPwd,
            'employee_id' => $employee->id
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    private function parseDate($date) {
        $timestamp = strtotime($date);
        $newDate = date("m-d-Y", $timestamp);
        return str_replace("-", "", $newDate);
    }

    // Update Employee Info
    public function updateEmployee(Request $request) {
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

            if($request->ssn == '1') {
                $createArray = array();
                $createArray = [
                    'employee_id'       =>  $request->id,
                    'doc_title_id'      => '0',
                    'no'                => $request->ssn_doc['no'],
                    'attachment'        => $request->ssn_doc['attachment'],
                ];
                Document::where('id', $request->ssn_id)
                        ->update($createArray);
            }
            if($request->auth == '1') {
                $createArray = array(); 

                $createArray = [
                    'employee_id'       =>  $request->id,
                    'doc_title_id'      => '1',
                    'work_auth_id'      => $request->auth_doc['work_auth_id'],
                    'no'                => $request->auth_doc['no'],
                    'start_date'        => $request->auth_doc['start_date'],
                    'expire_date'       => $request->auth_doc['expire_date'],
                    'attachment'        => $request->auth_doc['attachment'],
                ];
                Document::where('id', $request->auth_id)
                        ->update($createArray);
            }
            if($request->state == '1') {
                $createArray = array();
                $createArray = [
                    'employee_id'       =>  $request->id,
                    'doc_title_id'      => '2',
                    'no'                => $request->state_doc['no'],
                    'exp_date'          => $request->state_doc['exp_date'],
                    'attachment'        => $request->state_doc['attachment'],
                ];
                Document::where('id', $request->state_id)
                        ->update($createArray);
            }
            if($request->passport == '1') {
                $createArray = array();
                $createArray = [
                    'employee_id'       =>  $request->id,
                    'doc_title_id'      => '3',
                    'no'                => $request->passport_doc['no'],
                    'exp_date'          => $request->passport_doc['exp_date'],
                    'attachment'        => $request->passport_doc['attachment'],
                ];
                Document::where('id', $request->passport_id)
                        ->update($createArray);
            }
            if($request->i94 == '1') {
                $createArray = array();
                $createArray = [
                    'employee_id'       =>  $request->id,
                    'doc_title_id'      => '4',
                    'no'                => $request->i94_doc['no'],
                    'exp_date'          => $request->i94_doc['exp_date'],
                    'i94_type'          => $request->i94_doc['i94_type'],
                    'attachment'        => $request->i94_doc['attachment'],
                ];
                Document::where('id', $request->i94_id)
                        ->update($createArray);
            }
            if($request->visa == '1') {
                $createArray = array();
                $createArray = [
                    'employee_id'       =>  $request->id,
                    'doc_title_id'      => '5',
                    'no'                => $request->visa_doc['no'],
                    'exp_date'          => $request->visa_doc['exp_date'],
                    'attachment'        => $request->visa_doc['attachment'],
                ];
                Document::where('id', $request->visa_id)
                        ->update($createArray);
            }
            if( count( $request->other_array) ) {
                for($i = 0; $i < count( $request->other_array); $i ++) {
                    $createArray = array();
                    $createArray = [
                        'employee_id'       =>  $request->id,
                        'doc_title_id'      => '6',
                        'comment'           => $request->other_array[$i]['title'],
                        'no'                => $request->other_array[$i]['no'],
                        'exp_date'          => $request->other_array[$i]['exp_date'],
                        'attachment'        => $request->other_array[$i]['attachment'],
                    ];
                    
                    Document::where('id', $request->other_ids[$i])
                        ->update($createArray);
                }
            }

            EmployeeActivity::create([
                'employee_id'   =>  $request->id,   
                'updated_by'    =>  '1',               // session
                'description'   =>  'Update Employee',
            ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    // Delete Employee Info
    public function deleteEmployee(Request $request) {
        // Check Validation
        $request->validate([
            'id' => ['required'],
        ]);

        for($i = 0; $i < count($request->id); $i ++) {
            Employee::where('id', $request->id[$i])
                    ->delete();

            User::where('employee_id', $request->id[$i])
                ->delete();

            Document::where('employee_id', $request->id[$i])
                    ->delete();
        }

        for($i = 0; $i < count($request->id); $i ++) {
            EmployeeActivity::create([
                'employee_id'   =>  $request->id[$i],
                'updated_by'    =>  '1',               // session
                'description'   =>  'Delete Employee',
            ]);
        }

        return response()->json([
            'result' => 'success'
        ]);
    }


    // Do Multi action
    public function doMultAction(Request $request)
    {
        // Check Validation
        $request->validate([
            'actionOpt' => ['required'],
            'ids' => ['required']
        ]);

        $actionOpt = $request->actionOpt;
        $ids = $request->ids;
        foreach($ids as $id) {
            $employee = Employee::find($id);
            $email = $employee['email'];
            // $subscriber = Sub::create([
            //     'email' => $email
            // ]);

            // if ($subscriber) {
                Mail::to($email)->send(new Subscribe($email));
            // }
        }

        return response()->json([
            'result' => 'success'
        ]);
    }

    // Employee Activity
    public function getEmpAct()
    {
        // Get Filtered employees
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_act_date_time'] != NULL)
                $whereConds[] = ['act_date_time', 'like', '%' . $this->request['filt_act_date_time'] . '%'];
            if ($this->request['filt_act_updated_by'] != NULL)
                $whereConds[] = ['updated_by', 'like', '%' . $this->request['filt_act_updated_by'] . '%'];
            if ($this->request['filt_act_description'] != NULL)
                $whereConds[] = ['description', 'like', '%' . $this->request['filt_act_description'] . '%'];
        }

        $filterAct = EmployeeActivity::with(['updatedby'])
                                    ->where($whereConds)
                                    ->get();

        $result = $this->makeEmpActivityTblItems($filterAct);
        return $result;
    }

    // Employee Placements
    // public function getAddPlacements()
    // {
    //     $ajaxData = $this->getEmployeeListTblData();
    //     $result = $this->makeEmpPlacementTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
    //     return $result;
    // }


/////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////  Display All Employee List ::: Begin    /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Generate Employee List Filter Condition
     */
    private function getEmployeeListTblData()
    {
        // Get Filtered employees
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_first_name'] != NULL)
                $whereConds[] = ['first_name', 'like', '%' . $this->request['filt_first_name'] . '%'];
            if ($this->request['filt_last_name'] != NULL)
                $whereConds[] = ['last_name', 'like', '%' . $this->request['filt_last_name'] . '%'];
            if ($this->request['filt_phone'] != NULL)
                $whereConds[] = ['phone_num', 'like', '%' . $this->request['filt_phone'] . '%'];
            if ($this->request['filt_email'] != NULL)
                $whereConds[] = ['email_address', 'like', '%' . $this->request['filt_email'] . '%'];
            if ($this->request['filt_category'] != NULL)
                $whereConds[] = ['category', 'like', '%' . $this->request['filt_category'] . '%'];
            if ($this->request['filt_join_date_from'] != NULL)
                $whereConds[] = ['dateofjoining', '>=', $this->request['filt_join_date_from']];
            if ($this->request['filt_join_date_to'] != NULL)
                $whereConds[] = ['dateofjoining', '<=', $this->request['filt_join_date_to']];
            if ($this->request['filt_poc'] != NULL)
                $whereConds[] = ['poc_id', $this->request['filt_poc']];
            if ($this->request['filt_classification'] != NULL)
                $whereConds[] = ['classification', $this->request['filt_classification']];
            if ($this->request['filt_status'] != NULL)
                $whereConds[] = ['status', $this->request['filt_status']];
        }

        $filterEmployees = Employee::select('id', 'first_name', 'last_name', 'phone_num', 'category', 'dateofjoining', 'poc_id', 'status')
                                    ->where($whereConds)
                                    ->get();

        $max_id = Employee::max('id');

        $roles = Role::all();

        return [
            'filterItems' => $filterEmployees,
            'role'        => $roles,
            'max_id'      => $max_id
        ];
    }

    /**
     * Generate Activity Filter Condition
     */
    private function getEmployeeActivityTblData()
    {
        // Get Filtered employees
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_act_date_time'] != NULL)
                $whereConds[] = ['act_date_time', 'like', '%' . $this->request['filt_act_date_time'] . '%'];
            if ($this->request['filt_act_updated_by'] != NULL)
                $whereConds[] = ['updated_by', 'like', '%' . $this->request['filt_act_updated_by'] . '%'];
            if ($this->request['filt_act_description'] != NULL)
                $whereConds[] = ['description', 'like', '%' . $this->request['filt_act_description'] . '%'];
        }

        $filterEmployees = EmployeeActivity::with(['updatedby'])
                                    ->where($whereConds)
                                    ->get();

        
    }

    /**
     * Display Employee List
     */
    private function makeEmployeeListTblItems($filterItems, $role, $max_id)
    {
        $filteredCnt = count($filterItems);
        $iTotalRecords = $filteredCnt;

        $iDisplayLength = intval($this->request['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($this->request['start']);
        $sEcho = intval($this->request['draw']);

        $records = array();
        $empID_array = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $idx = 0;
        for ($i = $iDisplayStart; $i < $end; $i++) {
            $id = ($i + 1);
            // Category
            $category = "";
            if ($filterItems[$i]->category == 0)
                $category = "W2";
            else if ($filterItems[$i]->category == 1)
                $category = "C2C";
            else if ($filterItems[$i]->category == 2)
                $category = "1099";

            $poc = $filterItems[$idx]->poc_id == 0 ? 'Lead Names' : 'etc';

            $records["data"][] = array(
                '<input type="checkbox" name="id" value="' . $filterItems[$idx]->id . '">',
                $id,
                $filterItems[$idx]->first_name,
                $filterItems[$idx]->last_name,
                $filterItems[$idx]->phone_num,
                $category,
                $filterItems[$idx]->dateofjoining,
                $poc,
                $filterItems[$idx]->status ? '<span class="label label-sm label-primary">active</span>' : '<span class="label label-sm label-grey">inactive</span>',
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-emp-view" data-id="'. $filterItems[$idx]->id . '"><i class="fa fa-eye"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-primary btn-emp-edit" data-id="'. $filterItems[$idx]->id . '"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-emp-delete" data-id="'. $filterItems[$idx]->id . '"><i class="fa fa-trash"></i></a>'
            );
            array_push($empID_array, $filterItems[$idx]->id);
            $idx++;
        }

        if (isset($this->request['customActionType']) && $this->request['customActionType'] == "group_action") {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        $records["emp_id"] = $empID_array;
        $records["role"] = $role;
        $records["max_id"] = $max_id;
        $records["curr_date"] = date("Y-m-d"); 

        // echo json_encode($records);
        return response()->json($records);
    }

    private function makeEmpActivityTblItems($filterItems)
    {
        $filteredCnt = count($filterItems);
        $iTotalRecords = $filteredCnt;

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
                date_format($filterItems[$idx]->updated_at, 'Y-m-d H:i:s'),
                $filterItems[$idx]->updatedby->email,
                $filterItems[$idx]->description
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




////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                                     Display All Employee List ::: End                                      //
////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}