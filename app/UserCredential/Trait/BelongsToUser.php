<?php

namespace App\UserCredential\Trait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

trait BelongsToUser
{
    //If you want non-authenticable user class, modify function on details.
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
