<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingApplicationController extends Controller
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
     * Show the Application Settings page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('settings.application.index')->with([
            'randNum' => rand()
        ]);
    }
}
