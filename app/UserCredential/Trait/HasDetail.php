<?php

namespace App\UserCredential\Trait;

use Illuminate\Database\Eloquent\Model;
use App\UserCredential\UserDetail;

trait HasDetail
{
    public function detail()
    {
    	return $this->hasOne(UserDetail::class);
    }

    public function getFullNameAttribute($sequence = 'fl'){
    	$this->loadMissing('detail');

    	$detail = optional($this->detail);

    	switch ($sequence) {
    		case 'lf':
		    	return $detail->last_name . ', ' . $detail->first_name;
    		case 'fm-l':
    			return $detail->first_name . ' ' 
    				. ( $detail->middle_name ? $detail->middle_name . "-" : '') 
    				. $detail->last_name;
    		default:
    			return $detail->first_name . ' ' . $detail->last_name;
    	}
    }
}
