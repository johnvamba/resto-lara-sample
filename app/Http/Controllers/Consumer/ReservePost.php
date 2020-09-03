<?php

namespace App\Http\Controllers\Consumer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Reservation\Space;
use App\Model\Reservation\ReserveTransaction;
use App\Model\Reservation\ReserveTransactionHistory;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class ReservePost extends Controller
{
    public function __invoke(Request $request){
    	DB::beginTransaction();

    	try 
    	{
	    	// dd($request->all());
	    	if(!$user = auth()->user())
	    		throw new \Exception("No user requesting");

	    	//Validator Here.. if need another request class if needed
	    	$this->validateEntry($request);

	    	$space = new Space($request->get('reserve') ?? []);
	    	$date = Carbon::parse($request->get('date'));
	    	// Initiate Reservations
	    	$transaction = new ReserveTransaction([
	    		'client_id'		=> $user->id,
	    		'client_type' 	=> get_class($user),
	    		'reserved_at' 	=> $date,
	    		'persons' 		=> $request->get('persons') ?? 1,
	    		'request'		=> $request->get('request'),
	    		'status' 		=> 'pending'
	    	]);
	    	//Date checker on confirmed dates here
	    	if($space->exists && !$this->checkBookingCollisions($space, $date)){
	    		$transaction->space_id = $space->id;
	    	}

	    	if(!$transaction->save())
	    		throw new \Exception("Error saving request");
	    		
	    	DB::commit();
	    	return response()->json('Reservation added!', 200);
    	} catch (\Exception $e) {
    		DB::rollback();
    		return response()->json($e->getMessage(), 400);
    	}
	}

    protected function validateEntry(Request $request){
    	$request->validate([
    		'date' => 'required',
    		'persons' => 'required|int'
    	]);
    }

    protected function checkBookingCollisions(Space $space, Carbon $date){
    	//Collision logic here
    	return false;
    }
}
