<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Currency;
use App\Models\Timezone;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class SettingNewCompanyController extends Controller
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
     * Show the New Company Settings page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currencies = Currency::all();
        $timezones = Timezone::all();

        return view('settings.new_company.index')->with([
            'randNum' => rand(),
            'currencies' => $currencies,
            'timezones' => $timezones
        ]);
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    /**
     * Get company list from model and generate columns for ajax table. (tbl_company)
     */
    public function getCompanyList()
    {
        $recordData = $this->getCompanyTableList();
        $result = $this->makeCompanyTblColumns($recordData['filteredRecords'], $recordData['totalCnt'], $recordData['filteredCnt']);
        return $result;
    }

    /**
     * Get company information by id.
     */
    public function getCompanyById()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
        ]);

        $id = $this->request['id'];
        $company = Company::find($id);

        return response()->json([
            'result' => 'success',
            'company' => $company
        ]);
    }

    /**
     * Create new company.
     */
    public function create()
    {
        // Check Validation
        $this->request->validate([
            'title' => ['required'],
            'email' => ['required'],
            // 'address' => ['required'],
            // 'phone' => ['required'],
            // 'favicon' => ['required'],
            // 'logo' => ['required'],
            'currency_id' => ['required'],
            'timezone_id' => ['required'],
            'alignment' => ['required'],
            'footer_text' => ['required']
        ]);

        // Create new record
        $company = Company::create([
            'title' => $this->request['title'],
            'email' => $this->request['email'],
            'address' => $this->request['address'],
            'phone' => $this->request['phone'],
            'favicon' => $this->request['favicon'],
            'logo' => $this->request['logo'],
            'currency_id' => $this->request['currency_id'],
            'timezone_id' => $this->request['timezone_id'],
            'alignment' => $this->request['alignment'],
            'footer_text' => $this->request['footer_text']
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Update new company.
     */
    public function update()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required'],
            'title' => ['required'],
            'email' => ['required'],
            // 'address' => ['required'],
            // 'phone' => ['required'],
            // 'favicon' => ['required'],
            // 'logo' => ['required'],
            'currency_id' => ['required'],
            'timezone_id' => ['required'],
            'alignment' => ['required'],
            'footer_text' => ['required']
        ]);

        // Update
        $role = Company::find($this->request['id']);
        $role->update([
            'title' => $this->request['title'],
            'email' => $this->request['email'],
            'address' => $this->request['address'],
            'phone' => $this->request['phone'],
            'favicon' => $this->request['favicon'],
            'logo' => $this->request['logo'],
            'currency_id' => $this->request['currency_id'],
            'timezone_id' => $this->request['timezone_id'],
            'alignment' => $this->request['alignment'],
            'footer_text' => $this->request['footer_text']
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * Delete company.
     */
    public function delete()
    {
        // Check Validation
        $this->request->validate([
            'id' => ['required']
        ]);

        // Delete
        $role = Company::find($this->request['id']);
        $role->delete();

        return response()->json([
            'result' => 'success'
        ]);
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
    /**
     * Get company list from model.
     */
    private function getCompanyTableList()
    {
        // Params
        $columns = ['', '', 'title', 'email', 'currency_id', 'timezone_id', 'alignment', ''];
        $sortColumn = $columns[$this->request['order'][0]['column']];
        $sortType = $this->request['order'][0]['dir'];
        $start = $this->request['start'];
        $length = $this->request['length'];

        // Get filter condition.
        $whereConds = array();
        if ($this->request['action'] != NULL && $this->request['action'] == "filter") {
            if ($this->request['filt_title'] != NULL)
                $whereConds[] = ['title', 'like', '%' . $this->request['filt_title'] . '%'];
            if ($this->request['filt_email'] != NULL)
                $whereConds[] = ['email', 'like', '%' . $this->request['filt_email'] . '%'];
            if ($this->request['filt_currency'] != NULL)
                $whereConds[] = ['currency_id', '=', $this->request['filt_currency']];
            if ($this->request['filt_timezone'] != NULL)
                $whereConds[] = ['timezone_id', '=', $this->request['filt_timezone']];
            if ($this->request['filt_alignment'] != NULL)
                $whereConds[] = ['alignment', '=', $this->request['filt_alignment']];
        }

        // All record count
        $totalRecordCnt = Company::count();

        // Filtered records
        $filteredRecords = Company::with([
            'currency',
            'timezone'
        ])->where($whereConds)
            ->get()
            ->sortBy([[$sortColumn, $sortType]])
            ->skip($start)
            ->take($length);

        // Filtered record cnt
        $filteredCnt = count(Company::where($whereConds)->get());

        return [
            'totalCnt' => $totalRecordCnt,
            'filteredCnt' => $filteredCnt,
            'filteredRecords' => $filteredRecords
        ];
    }

    /**
     * Generate company list table items
     */
    private function makeCompanyTblColumns($finalRecords, $totalCnt, $filteredCnt)
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
                '<input type="checkbox" name="id[]" value="' . $finalRecord->id . '">',
                $idx,
                $finalRecord->title,
                $finalRecord->email,
                $finalRecord->currency ? $finalRecord->currency->name : '',
                $finalRecord->timezone ? $finalRecord->timezone->code : '',
                $finalRecord->alignment == config('constants.COMPANY_ALIGNMENT_LEFTTORIGHT') ? 'Left To Right' : 'Right To Left.',
                '<a href="javascript:;" class="btn btn-xs btn-c-primary btn-company-edit" data-id="' . $finalRecord->id . '" ><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-c-grey btn-company-delete" data-id="' . $finalRecord->id . '" data-title="' . $finalRecord->title . '"><i class="fa fa-trash"></i></a>'
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