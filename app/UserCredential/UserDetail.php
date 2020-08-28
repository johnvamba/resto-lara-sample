<?php

namespace App\UserCredential;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use App\UserCredential\BelongsToUser;

class UserDetail extends Model
{
	use BelongsToUser;

    protected $fillable = [
		'first_name',
		'middle_name',
		'last_name',
		'suffix',
		'civil_status',
		'phone'
    ];
}
