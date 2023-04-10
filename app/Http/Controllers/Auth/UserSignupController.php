<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSignup;

class UserSignupController extends Controller
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
     * Register new signup request.
     */
    public function signup()
    {
        // Check Validation
        $this->request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'phone_no' => ['required']
        ]);

        // Create new record
        $role = UserSignup::create([
            'first_name' => $this->request['first_name'],
            'last_name' => $this->request['last_name'],
            'email' => $this->request['email'],
            'phone_no' => $this->request['phone_no'],
            'poc' => $this->request['poc']
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }
// ========================== END PUBLIC FUNCTIONS ==========================

// ========================== BEGIN PRIVATE FUNCTIONS ==========================
// ========================== END PRIVATE FUNCTIONS ==========================
}