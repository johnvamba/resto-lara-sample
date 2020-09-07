<?php

namespace App\Http\Controllers\Api\Reservation;

use App\Model\Reservation\ReserveTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Reservation\ReserveTransactionResource;
use App\Http\Resources\Reservation\ReserveHistoryResource;

class ReserveTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rt = ReserveTransaction::orderBy('space_id', 'desc')
            ->with('space');

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
        $histories = $reserve_transact->histories()->latest();

        return ReserveHistoryResource::collection($histories->get());
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

    public function approve(ReserveTransaction $reserve_transact)
    {
        if(!$reserve_transact->exists)
            throw new Exception("Missing transaction");
            
        $reserve_transact->update([
            'status' => 'approved'
        ]);

        $reserve_transact->histories()
            ->create([
                'status' => 'approved',
                'comments' => 'Reservation has been approved'
            ]);

        return new ReserveTransactionResource($reserve_transact);        
    }

    public function confirmed(ReserveTransaction $reserve_transact)
    {
        if(!$reserve_transact->exists)
            throw new Exception("Missing transaction");
        
        if($reserve_transact->status == 'cancelled')
            throw new Exception("Reservation was cancelled");

        if($reserve_transact->status != 'approved')
            throw new Exception("Reservation wasn't approved");

        $reserve_transact->update([
            'status' => 'confirmed'
        ]);

        $reserve_transact->histories()
            ->create([
                'status' => 'confirmed',
                'comments' => 'Reservation has been confirmed'
            ]);

        return new ReserveTransactionResource($reserve_transact);
    }

    public function occupied(ReserveTransaction $reserve_transact)
    {
        if(!$reserve_transact->exists)
            throw new Exception("Missing transaction");

        if($reserve_transact->status == 'cancelled')
            throw new Exception("Reservation was cancelled");

        if($reserve_transact->status != 'confirmed')
            throw new Exception("Reservation wasn't confirmed");
            
        $reserve_transact->update([
            'status' => 'occupied'
        ]);

        $reserve_transact->histories()
            ->create([
                'status' => 'occupied',
                'comments' => 'Reservation has been occupied'
            ]);

        return new ReserveTransactionResource($reserve_transact);
    }

    public function cancel(ReserveTransaction $reserve_transact)
    {
        if(!$reserve_transact->exists)
            throw new Exception("Missing transaction");
            
        $reserve_transact->update([
            'status' => 'cancelled'
        ]);

        $reserve_transact->histories()
            ->create([
                'status' => 'cancelled',
                'comments' => 'Reservation has been cancelled'
            ]);

        return new ReserveTransactionResource($reserve_transact);
    }
}
