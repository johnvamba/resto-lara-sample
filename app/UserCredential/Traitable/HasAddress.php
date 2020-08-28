<?php

namespace App\UserCredential\Traitable;

use Illuminate\Database\Eloquent\Model;
use App\UserCredential\UserAddress;

trait HasAddress
{
    public function addresses()
    {
    	return $this->hasMany(UserAddress::class);
    }
}
