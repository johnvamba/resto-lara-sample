<?php

namespace App\UserCredential\Trait;

use Illuminate\Database\Eloquent\Model;
use App\UserCredential\UserContact;

trait HasContact
{
    public function contacts()
    {
    	return $this->hasMany(UserContact::class);
    }
}
