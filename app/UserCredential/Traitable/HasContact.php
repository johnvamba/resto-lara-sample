<?php

namespace App\UserCredential\Traitable;

use Illuminate\Database\Eloquent\Model;
use App\UserCredential\UserContact;

trait HasContact
{
    public function contacts()
    {
    	return $this->hasMany(UserContact::class);
    }
}
