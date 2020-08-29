<?php

namespace App\Model\Reservation;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    public function transactions()
    {
    	return $this->hasMany(ReserveTransaction::class);
    }
}