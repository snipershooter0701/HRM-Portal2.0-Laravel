<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingInvoiceController extends Controller
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
     * Show the Invoice Settings page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('settings.invoice.index')->with([
            'randNum' => rand()
        ]);
    }
}