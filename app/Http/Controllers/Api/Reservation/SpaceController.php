<?php

namespace App\Http\Controllers\Api\Reservation;

use App\Model\Reservation\Space;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Reservation\ReserveResource;
use App\Http\Resources\Reservation\ReserveTransactionResource;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ReserveResource::collection(Space::latest()->paginate(10));
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
     * @param  \App\Model\Reservation\Space  $space
     * @return \Illuminate\Http\Response
     */
    public function show(Space $space)
    {
        // $space->load('transactions.histories');
        // return new ReserveResource($space);
        $transactions = $space->transactions()
            ->latest();
            // ->with(['histories' => function($histories){
            //     $histories->latest();
            // }]);
    
        return ReserveTransactionResource::collection($transactions->paginate(20));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Reservation\Space  $space
     * @return \Illuminate\Http\Response
     */
    public function edit(Space $space)
    {
        return new ReserveResource($space);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Reservation\Space  $space
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Space $space)
    {
        
        return new ReserveResource($space);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Reservation\Space  $space
     * @return \Illuminate\Http\Response
     */
    public function destroy(Space $space)
    {
        //
    }
}
