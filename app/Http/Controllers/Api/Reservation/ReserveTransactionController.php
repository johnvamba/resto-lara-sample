<?php

namespace App\Http\Controllers\Api\Reservation;

use App\Model\Reservation\ReserveTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Reservation\ReserveTransactionResource;

class ReserveTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rt = ReserveTransaction::orderBy('space_id', 'desc');

        if($request->get('latest'))
            $rt->latest();

        return ReserveTransactionResource::collection($rt->paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Reservation\ReserveTransaction  $reserve_transact
     * @return \Illuminate\Http\Response
     */
    public function show(ReserveTransaction $reserve_transact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Reservation\ReserveTransaction  $reserve_transact
     * @return \Illuminate\Http\Response
     */
    public function edit(ReserveTransaction $reserve_transact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Reservation\ReserveTransaction  $reserve_transact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReserveTransaction $reserve_transact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Reservation\ReserveTransaction  $reserve_transact
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReserveTransaction $reserve_transact)
    {
        //
    }
}
