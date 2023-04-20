<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('settings.new_company.index')->with([
            'randNum' => rand()
        ]);
    }
}