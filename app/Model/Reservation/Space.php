<?php

namespace App\Model\Reservation;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
	protected $guarded = [];
	
    public function transactions()
    {
    	return $this->hasMany(ReserveTransaction::class);
    }

    public function recent_transaction()
    {
    	return $this->hasOne(ReserveTransaction::class)->latest();
    }

    // public function resolveRouteBinding($value)
    // {
    //     return $this->where('id', $value)->first() ?? new static;
    // }
}
