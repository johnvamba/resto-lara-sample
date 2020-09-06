<?php

namespace App\Model\Reservation;

use Illuminate\Database\Eloquent\Model;
use App\Model\Admin;

class ReserveTransactionHistory extends Model
{
	protected $guarded = [];
	
    public function reserve_transaction()
    {
    	return $this->belongsTo(ReserveTransaction::class);
    }

    public function admin()
    {
    	return $this->belongsTo(Admin::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'admin_id');
    }
}
