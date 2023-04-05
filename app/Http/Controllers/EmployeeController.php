<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeRequest;
use App\Models\EmployeeActivity;
use App\Models\Document;

class EmployeeController extends Controller
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
        return view('employee.index')->with('randNum', rand());
    }



                                                    ////////////////////////////////////////////////////////////////////
                                                    ////////////////////////////////////////////////////////////////////
                                                    /////////                                                 //////////
                                                    /////////              All Employees Infomation           //////////
                                                    /////////                                                 //////////
                                                    ////////////////////////////////////////////////////////////////////
                                                    ////////////////////////////////////////////////////////////////////


    // Get Employee list
    public function getEmployeeList()
    {
        $ajaxData = $this->getEmployeeListTblData();
        $result = $this->makeEmployeeListTblItems($ajaxData['filterItems']);
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

        return response()->json([
            'result' => 'success',
            'employee' => $employee
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
            'addr_zipcode'      => ['required'],
            'pay_standard_time' => ['required'],
            'pay_over_time'     => ['required'],
            'pay_double_time'   => ['required'],
            'pay_scale'         => ['required']
        ]);

        Employee::create([
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

    // Update Employee Info
    public function updateEmployeeInfo(Request $request) {
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
    public function deleteEmployeeInfo(Request $request) {
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

    // Employee Activity
    public function getEmpActivity()
    {
        $ajaxData = $this->getEmployeeActivityTblData();
        $result = $this->makeEmpActivityTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }

    // Employee Placements
    public function getAddPlacements()
    {
        $ajaxData = $this->getEmployeeListTblData();
        $result = $this->makeEmpPlacementTblItems($ajaxData['totalItems'], $ajaxData['filterItems']);
        return $result;
    }


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

        return [
            'filterItems' => $filterEmployees
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

        $filterEmployees = EmployeeActivity::select('id', 'first_name', 'last_name', 'phone_num', 'category', 'dateofjoining', 'poc_id', 'status')
                                    ->where($whereConds)
                                    ->get();

        return [
            'filterItems' => $filterEmployees
        ];
    }

    /**
     * Display Employee List
     */
    private function makeEmployeeListTblItems($filterItems)
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
                '<input type="checkbox" name="id[]" value="' . $id . '">',
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

        // echo json_encode($records);
        return response()->json($records);
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                                     Display All Employee List ::: End                                      //
////////////////////////////////////////////////////////////////////////////////////////////////////////////////



                                ///////////////////////////////////////////
                                ///                                     ///
                                ///          All Request Details        ///
                                ///                                     ///
                                ///////////////////////////////////////////


    // Get Request Details List
    public function getRequestDetailsList()
    {
        $ajaxData = $this->getRequestDetailsTblData();
        $result = $this->makeRequestDetailsTblItems($ajaxData['filterItems']);
        return $result;
    }

    // Get Request By ID
    public function getRequestDetailsById(Request $request)
    {
        // Check Validation
        $request->validate([
            'id' => ['required'],
            'emp_id' => ['required'],
        ]);

        $details = EmployeeRequest::find($request->id);
        $doc = Document::where('employee_id', $request->emp_id)->get();

        return response()->json([
            'result' => 'success',
            'details' => $details,
            'doc' => $doc
        ]);
    }

    // Add Request Details
    public function addRequestDetails(Request $request)
    {

        // Validation TOOD
        $request->validate([
            'employee_id'           => ['required'],
            'comment'               => ['required'],
        ]);

        EmployeeRequest::create([
            'employee_id'        =>  $request->employee_id,
            'ssn'                =>  $request->ssn,
            'work_auth'          =>  $request->auth,
            'state'              =>  $request->state,
            'passport'           =>  $request->passport,
            'i94'                =>  $request->i94,
            'visa'               =>  $request->visa,
            'other_document'     =>  $request->other,
            'requested_on'       =>  date('d/m/y'),
            'requested_by_id'    =>  $request->requested_by_id,
            'comment'            =>  $request->comment
        ]);

        $createArray = array();
        if($request->ssn == '1' || $request->ssn == '2') {
            $createArray = [
                'employee_id'       =>  $request->employee_id,
                'doc_title_id'      => 0,
                'no'                => $request->ssn_doc['no'],
                'attachment'        => $request->ssn_doc['attachment'],
            ];
            Document::create($createArray);
        }
        
        if($request->auth == 1 || $request->auth == 2) {
            $createArray = [
                'employee_id'       =>  $request->employee_id,
                'doc_title_id'      => '1',
                'work_auth_id'      => $request->auth_doc['work_auth_id'],
                'no'                => $request->auth_doc['no'],
                'start_date'        => $request->auth_doc['start_date'],
                'expire_date'       => $request->auth_doc['expire_date'],
                'attachment'        => $request->auth_doc['attachment'],
            ];
            Document::create($createArray);
        }
        
        if($request->state == 1 || $request->state == 2) {
            $createArray = [
                'employee_id'       =>  $request->employee_id,
                'doc_title_id'      => '2',
                'no'                => $request->state_doc['no'],
                'exp_date'          => $request->state_doc['exp_date'],
                'attachment'        => $request->state_doc['attachment'],
            ];
            Document::create($createArray);
        }
        if($request->passport == 1 || $request->passport == 2) {
            $createArray = [
                'employee_id'       =>  $request->employee_id,
                'doc_title_id'      => '3',
                'no'                => $request->passport_doc['no'],
                'exp_date'          => $request->passport_doc['exp_date'],
                'attachment'        => $request->passport_doc['attachment'],
            ];
            Document::create($createArray);
        }
        if($request->i94 == 1 || $request->i94 == 2) {
            $createArray = [
                'employee_id'       =>  $request->employee_id,
                'doc_title_id'      => '4',
                'no'                => $request->i94_doc['no'],
                'exp_date'          => $request->i94_doc['exp_date'],
                'i94_type'          => $request->i94_doc['i94_type'],
                'attachment'        => $request->i94_doc['attachment'],
            ];
            Document::create($createArray);
        }
        if($request->visa_doc == 1 || $request->visa_doc == 2) {
            $createArray = [
                'employee_id'       =>  $request->employee_id,
                'doc_title_id'      => '5',
                'no'                => $request->visa_doc['no'],
                'exp_date'          => $request->visa_doc['exp_date'],
                'attachment'        => $request->visa_doc['attachment'],
            ];
            Document::create($createArray);
        }
        if($request->other_doc == 1 || $request->other_doc == 2) {
            $createArray = [
                'employee_id'       =>  $request->employee_id,
                'doc_title_id'      => '6',
                'comment'           => $request->other_doc['comment'],
                'no'                => $request->other_doc['no'],
                'exp_date'          => $request->other_doc['exp_date'],
                'other_type'        => $request->other_doc['other_type'],
                'attachment'        => $request->other_doc['attachment'],
            ];
            Document::create($createArray);
        }
        
        return response()->json([
            'result' => 'success'
        ]);
    }
    
    // Update Request Details
    public function updateRequestDetails(Request $request) {

         // Validation TOOD
         $request->validate([
            'id'           => ['required'],
            'emp_id'       => ['required'],
            'employee_id'  => ['required'],
            'comment'      => ['required'],
        ]);

        // $createArray = array();
        // if($request->ssn == '1' || $request->ssn == '2') {
        //     $createArray = [
        //         'employee_id'       =>  $request->employee_id,
        //         'no'                => $request->ssn_doc['no'],
        //         'attachment'        => $request->ssn_doc['attachment'],
        //     ];
        //     Document::where('employee_id', $request->emp_id)
        //             ->where('doc_title_id', '0')
        //             ->update($createArray);
        // }
        
        // if($request->auth == 1 || $request->auth == 2) {
        //     $createArray = [
        //         'employee_id'       =>  $request->employee_id,
        //         'work_auth_id'      => $request->auth_doc['work_auth_id'],
        //         'no'                => $request->auth_doc['no'],
        //         'start_date'        => $request->auth_doc['start_date'],
        //         'expire_date'       => $request->auth_doc['expire_date'],
        //         'attachment'        => $request->auth_doc['attachment'],
        //     ];
        //     Document::where('employee_id', $request->emp_id)
        //             ->where('doc_title_id', '1')
        //             ->update($createArray);
        // }
        
        // if($request->state == 1 || $request->state == 2) {
        //     $createArray = [
        //         'employee_id'       =>  $request->employee_id,
        //         'no'                => $request->state_doc['no'],
        //         'exp_date'          => $request->state_doc['exp_date'],
        //         'attachment'        => $request->state_doc['attachment'],
        //     ];
        //     Document::where('employee_id', $request->emp_id)
        //             ->where('doc_title_id', '2')
        //             ->update($createArray);
        // }
        // if($request->passport == 1 || $request->passport == 2) {
        //     $createArray = [
        //         'employee_id'       =>  $request->employee_id,
        //         'no'                => $request->passport_doc['no'],
        //         'exp_date'          => $request->passport_doc['exp_date'],
        //         'attachment'        => $request->passport_doc['attachment'],
        //     ];
        //     Document::where('employee_id', $request->emp_id)
        //             ->where('doc_title_id', '3')
        //             ->update($createArray);
        // }
        // if($request->i94 == 1 || $request->i94 == 2) {
        //     $createArray = [
        //         'employee_id'       =>  $request->employee_id,
        //         'no'                => $request->i94_doc['no'],
        //         'exp_date'          => $request->i94_doc['exp_date'],
        //         'i94_type'          => $request->i94_doc['i94_type'],
        //         'attachment'        => $request->i94_doc['attachment'],
        //     ];
        //     Document::where('employee_id', $request->emp_id)
        //             ->where('doc_title_id', '4')
        //             ->update($createArray);
        // }
        // if($request->visa_doc == 1 || $request->visa_doc == 2) {
        //     $createArray = [
        //         'employee_id'       =>  $request->employee_id,
        //         'no'                => $request->visa_doc['no'],
        //         'exp_date'          => $request->visa_doc['exp_date'],
        //         'attachment'        => $request->visa_doc['attachment'],
        //     ];
        //     Document::where('employee_id', $request->emp_id)
        //             ->where('doc_title_id', '5')
        //             ->update($createArray);
        // }
        // if($request->other_doc == 1 || $request->other_doc == 2) {
        //     $createArray = [
        //         'employee_id'       =>  $request->employee_id,
        //         'comment'           => $request->other_doc['comment'],
        //         'no'                => $request->other_doc['no'],
        //         'exp_date'          => $request->other_doc['exp_date'],
        //         'other_type'        => $request->other_doc['other_type'],
        //         'attachment'        => $request->other_doc['attachment'],
        //     ];
        //     Document::where('employee_id', $request->emp_id)
        //             ->where('doc_title_id', '6')
        //             ->update($createArray);
        // }

        EmployeeRequest::where('id', $request->id)
                        ->update([
                            'employee_id'        =>  $request->employee_id,
                            'ssn'                =>  $request->ssn,
                            'work_auth'          =>  $request->auth,
                            'state'              =>  $request->state,
                            'passport'           =>  $request->passport,
                            'i94'                =>  $request->i94,
                            'visa'               =>  $request->visa,
                            'other_document'     =>  $request->other,
                            'requested_on'       =>  date('d/m/y'),
                            'requested_by_id'    =>  $request->requested_by_id,
                            'comment'            =>  $request->comment
                        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    // Delete Request Details
    public function deleteRequestDetails(Request $request) {
        // Check Validation
        $request->validate([
            'id' => ['required'],
        ]);

        EmployeeRequest::where('id', $request->id)
                        ->delete();

        return response()->json([
            'result' => 'success'
        ]);
    }



    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////   Display Request Details ::: Begin  //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////

   
    private function makeEmpPlacementTblItems($totalItems, $filterItems)
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

        $status_list = array(
            array("success" => "Pending"),
            array("info" => "Closed"),
            array("danger" => "On Hold"),
            array("warning" => "Fraud")
        );

        $idx = 0;
        for ($i = $iDisplayStart; $i < $end; $i++) {
            $status = $status_list[rand(0, 2)];
            $id = ($i + 1);
            $records["data"][] = array(
                $id,
                $filterItems[$idx]->first_name,
                'acstive',
                '2023-01-01',
                '2023-03-23',
                '1',
                $filterItems[$idx]->classification ? '<span class="label-active-noborder">Billable</span>' : '<span class="label-inactive-noborder">Non-Billable</span>',
                "Jo Tire" . $idx
            );
            $idx++;
        }

        $records["data"][] = array(
            '',
            '',
            '',
            '',
            'Total Billable Hours',
            '48',
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
    
    public function makeAddHisTblItems($totalItems, $filterItems)
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

        $status_list = array(
            array("success" => "Pending"),
            array("info" => "Closed"),
            array("danger" => "On Hold"),
            array("warning" => "Fraud")
        );

        $idx = 1;
        for ($i = $iDisplayStart; $i < $end; $i++) {
            $status = $status_list[rand(0, 2)];
            $id = ($i + 1);
            $records["data"][] = array(
                $idx,
                "03/01/2023 16:05:02",
                "test@test.com",
                "Description" . $idx
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
     * Generate request detail items
     */
    private function makeRequestDetailItems($totalItems, $filterItems)
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

        $status_list = array(
            array("success" => "Pending"),
            array("info" => "Closed"),
            array("danger" => "On Hold"),
            array("warning" => "Fraud")
        );

        $idx = 1;
        for ($i = $iDisplayStart; $i < $end; $i++) {
            $status = $status_list[rand(0, 2)];
            $id = ($i + 1);

            $reqstatus = "";
            $status = rand();
            if ($status % 3 == 0) {
                $reqstatus = '<span class="label label-sm label-primary">Request</span>';
            } else if ($status % 3 == 1) {
                $reqstatus = '<span class="label label-sm label-info">Approved</span>';
            } else {
                $reqstatus = '<span class="label label-sm label-grey">Rejected</span>';
            }

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $id . '">',
                $idx,
                "RQA0001245",
                "Makarov",
                "03/05/2023",
                "03/15/2023",
                "Makarov",
                "Makarov",
                "W4",
                $reqstatus,
                '<a href="javascript:;" class="btn btn-xs btn-c-primary"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey"><i class="fa fa-trash"></i></a>'
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


    // Generate Request Details Filter Condition
    private function getRequestDetailsTblData() {
        // Get Filtered Request Details
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_request_id'] != NULL)
                $whereConds[] = ['id', 'like', '%' . $this->request['filt_request_id'] . '%'];
            if ($this->request['filt_emp_name'] != NULL)
                $whereConds[] = ['employee_id', 'like', '%' . $this->request['filt_emp_name'] . '%'];
            if ($this->request['filt_requested_from'] != NULL)
                $whereConds[] = ['requested_on', '>=', $this->request['filt_requested_from']];
            if ($this->request['filt_requested_to'] != NULL)
                $whereConds[] = ['requested_on', '<=', $this->request['filt_requested_to']];
            if ($this->request['filt_responsed_from'] != NULL)
                $whereConds[] = ['responsed_on', '<=', $this->request['filt_responsed_from']];
            if ($this->request['filt_responsed_to'] != NULL)
                $whereConds[] = ['responsed_on', '<=', $this->request['filt_responsed_to']];
            if ($this->request['filt_requested_by'] != NULL)
                $whereConds[] = ['requested_by', 'like', '%' . $this->request['filt_requested_by'] . '%'];
            if ($this->request['filt_approver'] != NULL)
                $whereConds[] = ['approver_id', 'like', '%' . $this->request['filt_approver'] . '%'];
            if ($this->request['filt_request_status'] != NULL)
                $whereConds[] = ['status', $this->request['filt_request_status']];
        }

        $filterEmployees = EmployeeRequest::with(['employee'])
                                        ->with(['requested_by'])
                        // ->where($whereConds)
                        // ->whereRelation('employee', 'email', '=', 'pij@outlook.com')
                                        ->get();
                        // ->toArray();

        return [
            'filterItems' => $filterEmployees
        ];
    }

    // Display Request Details List
    private function makeRequestDetailsTblItems($filterItems)
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
        $btn_type = "";
        for ($i = $iDisplayStart; $i < $end; $i++) {
            $id = ($i + 1);

            if($filterItems[$idx]->status == 0) {
                $btn_type = '<span class="label label-sm label-primary">Request</span>';
            } else if($filterItems[$idx]->status == 1) {
                $btn_type = '<span class="label label-sm label-danger">Responsed</span>';
            } else if($filterItems[$idx]->status == 2) {
                $btn_type = '<span class="label label-sm label-info">Approved</span>';
            } else {
                $btn_type = '<span class="label label-sm label-grey">Rejected</span>';
            }

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $id . '">',
                $id,
                'RQA' . $filterItems[$idx]->id,
                $filterItems[$idx]->employee->first_name . $filterItems[$idx]->employee->last_name,
                $filterItems[$idx]->requested_on ? $filterItems[$idx]->requested_on : 'ㅡ',
                $filterItems[$idx]->responsed_on ? $filterItems[$idx]->responsed_on : 'ㅡ',
                $filterItems[$idx]->requested_by->first_name . $filterItems[$idx]->requested_by->last_name,
                $filterItems[$idx]->approved_by ? $filterItems[$idx]->approved_by : 'ㅡ',
                $btn_type,
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-req-edit" data-id="'. $filterItems[$idx]->id . '" data-emp-id="'. $filterItems[$idx]->employee_id . '"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-req-delete" data-id="'. $filterItems[$idx]->id . '" data-emp-id="'. $filterItems[$idx]->employee_id . '"><i class="fa fa-trash"></i></a>'
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


    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////   Display Request Details ::: End    //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
}