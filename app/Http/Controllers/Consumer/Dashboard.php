<?php

namespace App\Http\Controllers\Consumer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Dashboard extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
    	return view('public.dashboard');
    }

    public function histories(Request $request){
        return view('public.histories');
    }

    public function settings(Request $request)
    {
        return view('public.dashboard');
    }
}
