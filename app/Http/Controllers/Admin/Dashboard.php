<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Reservation\Space;
use App\Model\Reservation\ReserveTransaction;

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

    public function reservation(Request $request, Space $space = null){
        return view('admin.reservation', compact('space'));
    }

    public function reserve_transact(Request $request, ReserveTransaction $reserve_transact = null){
        return view('admin.reserve_transact', compact('reserve_transact'));
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
