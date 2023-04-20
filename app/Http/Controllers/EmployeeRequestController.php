<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeRequest;
use App\Models\Document;

class EmployeeRequestController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        return view('employee.all_request_details.request_index')->with('randNum', rand());
    }



    // Get Request Details List
    public function getRequestDetailsList()
    {
        $ajaxData = $this->getRequestDetailsTblData();
        $result = $this->makeRequestDetailsTblItems($ajaxData['filterItems'], $ajaxData['employees']);
        return $result;
    }

    // Get Request By ID
    public function getRequestDetailsByID(Request $request)
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

        // $createArray = array();
        // if($request->ssn == '1' || $request->ssn == '2') {
        //     $createArray = [
        //         'employee_id'       =>  $request->employee_id,
        //         'doc_title_id'      => 0,
        //         'no'                => $request->ssn_doc['no'],
        //         'attachment'        => $request->ssn_doc['attachment'],
        //     ];
        //     Document::create($createArray);
        // }
        
        // if($request->auth == 1 || $request->auth == 2) {
        //     $createArray = [
        //         'employee_id'       =>  $request->employee_id,
        //         'doc_title_id'      => '1',
        //         'work_auth_id'      => $request->auth_doc['work_auth_id'],
        //         'no'                => $request->auth_doc['no'],
        //         'start_date'        => $request->auth_doc['start_date'],
        //         'expire_date'       => $request->auth_doc['expire_date'],
        //         'attachment'        => $request->auth_doc['attachment'],
        //     ];
        //     Document::create($createArray);
        // }
        
        // if($request->state == 1 || $request->state == 2) {
        //     $createArray = [
        //         'employee_id'       =>  $request->employee_id,
        //         'doc_title_id'      => '2',
        //         'no'                => $request->state_doc['no'],
        //         'exp_date'          => $request->state_doc['exp_date'],
        //         'attachment'        => $request->state_doc['attachment'],
        //     ];
        //     Document::create($createArray);
        // }
        // if($request->passport == 1 || $request->passport == 2) {
        //     $createArray = [
        //         'employee_id'       =>  $request->employee_id,
        //         'doc_title_id'      => '3',
        //         'no'                => $request->passport_doc['no'],
        //         'exp_date'          => $request->passport_doc['exp_date'],
        //         'attachment'        => $request->passport_doc['attachment'],
        //     ];
        //     Document::create($createArray);
        // }
        // if($request->i94 == 1 || $request->i94 == 2) {
        //     $createArray = [
        //         'employee_id'       =>  $request->employee_id,
        //         'doc_title_id'      => '4',
        //         'no'                => $request->i94_doc['no'],
        //         'exp_date'          => $request->i94_doc['exp_date'],
        //         'i94_type'          => $request->i94_doc['i94_type'],
        //         'attachment'        => $request->i94_doc['attachment'],
        //     ];
        //     Document::create($createArray);
        // }
        // if($request->visa_doc == 1 || $request->visa_doc == 2) {
        //     $createArray = [
        //         'employee_id'       =>  $request->employee_id,
        //         'doc_title_id'      => '5',
        //         'no'                => $request->visa_doc['no'],
        //         'exp_date'          => $request->visa_doc['exp_date'],
        //         'attachment'        => $request->visa_doc['attachment'],
        //     ];
        //     Document::create($createArray);
        // }
        // if($request->other_doc == 1 || $request->other_doc == 2) {
        //     $createArray = [
        //         'employee_id'       =>  $request->employee_id,
        //         'doc_title_id'      => '6',
        //         'comment'           => $request->other_doc['comment'],
        //         'no'                => $request->other_doc['no'],
        //         'exp_date'          => $request->other_doc['exp_date'],
        //         'other_type'        => $request->other_doc['other_type'],
        //         'attachment'        => $request->other_doc['attachment'],
        //     ];
        //     Document::create($createArray);
        // }
        
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

        for($i = 0; $i < count($request->id); $i ++) {
            EmployeeRequest::where('id', $request->id[$i])
                            ->delete();
        }

        return response()->json([
            'result' => 'success'
        ]);
    }



    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////   Display Request Details ::: Begin  //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////

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

        $employees = Employee::select('id', 'first_name', 'last_name', 'phone_num', 'category', 'dateofjoining', 'poc_id', 'status')
                                    ->where($whereConds)
                                    ->get();

        $filterEmployees = EmployeeRequest::with(['employee'])
                                        ->with(['requested_by'])
                        // ->where($whereConds)
                        // ->whereRelation('employee', 'email', '=', 'pij@outlook.com')
                                        ->get();
                        // ->toArray();

        return [
            'filterItems' => $filterEmployees,
            'employees' => $employees,
        ];
    }

    // Display Request Details List
    private function makeRequestDetailsTblItems($filterItems, $employees)
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
                '<input type="checkbox" name="id" value="' . $filterItems[$idx]->id . '">',
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
        $records["employees"] = $employees;

        // echo json_encode($records);
        return response()->json($records);
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////   Display Request Details ::: End    //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
}