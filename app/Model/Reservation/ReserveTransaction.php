<?php

namespace App\Model\Reservation;

use Illuminate\Database\Eloquent\Model;

class ReserveTransaction extends Model
{
    protected $guarded = [];

    protected $casts = [
        'reserved_at' => 'datetime'
    ];
    
    public function space()
    {
    	return $this->belongsTo(Space::class);
    }

    public function histories()
    {
    	return $this->hasMany(ReserveTransactionHistory::class);
    }

    public function client()
    {
    	return $this->morphTo();
    }

    public function recent_history()
    {
        return $this->hasOne(ReserveTransactionHistory::class);
    }
}
