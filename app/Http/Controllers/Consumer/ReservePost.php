<?php

namespace App\Http\Controllers\Consumer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Reservation\Space;
use App\Model\Reservation\ReservationTransaction;
use App\Model\Reservation\ReservationTransactionHistory;

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
	    		throw new Exception("No user requesting");

	    	//Validator Here.. if need another request class if needed
	    	$this->validateEntry($request);

	    	$space = new Space($request->get('reserve') ?? []);
	    	$date = Carbon::parse($request->get('date'));

	    	$transaction = ReservationTransaction::create([

	    	]);
	    	//Date checker on confirmed dates here
	    	if($space->exists && $this->checkBookingCollisions($space, $date)){

	    	}
	    	DB::commit();
    	} catch (\Exception $e) {
    		DB::rollback();
    		return response()->withError($e->GetMessage());
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
