<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserSignup;

class NotificationController extends Controller
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
     * Get Notifications.
     */
    public function getNotifications()
    {
        $user = Auth::user();

        $notifications = UserSignup::where([
            ['is_watched', config('constants.USER_SIGNUP_NOT_WATECHED')]
        ])->get();

        return response()->json([
            'result' => 'success',
            'notifications' => $notifications
        ]);
    }
// ========================== END PUBLIC FUNCTIONS ==========================

// ========================== BEGIN PRIVATE FUNCTIONS ==========================
// ========================== END PRIVATE FUNCTIONS ==========================
}