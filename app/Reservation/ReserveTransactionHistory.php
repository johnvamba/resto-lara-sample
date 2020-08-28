<?php

namespace App\Reservation;

use Illuminate\Database\Eloquent\Model;

class ReserveTransactionHistory extends Model
{
    public function reserve_transaction()
    {
    	return $this->belongsTo(ReserveTransaction::class);
    }
}
