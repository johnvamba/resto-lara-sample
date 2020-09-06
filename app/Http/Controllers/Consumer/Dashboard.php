<?php

namespace App\Http\Controllers\Consumer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Reservation\Space;
use App\Model\Reservation\ReserveTransaction;
use App\Model\Reservation\ReserveTransactionHistory;

use App\Http\Resources\Reservation\ReserveTransactionResource;

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
        // dd(auth()->user()->tokens);
    	return view('public.dashboard');
    }

    public function histories(Request $request){
        $transactions = ReserveTransaction::where('client_id', auth()->user()->id)
            ->latest()
            ->with('space', 'histories');

        // dd($transactions->get());
        return view('public.histories')
            ->with(['transactions' => ReserveTransactionResource::collection($transactions->paginate(20))]);
    }

    public function settings(Request $request)
    {
        return view('public.dashboard');
    }
}
