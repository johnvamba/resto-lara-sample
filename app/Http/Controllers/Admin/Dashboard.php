<?php

namespace App\Http\Controllers\Admin;

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
        $this->middleware('auth:admin');
    }
    
    public function index(Request $request){
    	return view('admin.dashboard');
    }

    public function calendar(Request $request){
        return view('admin.dashboard');
    }

    public function users(Request $request){
        return view('admin.dashboard');
    }
    
    public function settings(Request $request){
        return view('admin.dashboard');
    }
}
