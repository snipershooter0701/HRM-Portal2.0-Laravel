<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.index')->with('randNum', rand());
    }

    public function genEmailPwd(Request $request)
    {
        $endkey = $request->encKey;
        $ciphering = "AES-128-CTR";
        $encryption_iv = '1234567891011121';
        $options = 0;
        $encryption_key = "GeeksforGeeks";
        $decryption = openssl_decrypt ($endkey, $ciphering, $encryption_key, $options, $encryption_iv);
        
        return response()->json([
            'result' => 'success',
            'decryption' => $decryption,
        ]);
    }
}