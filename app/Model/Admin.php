<?php

namespace App\Model;

use App\User;

class Admin extends User
{
	protected $table = 'users';

    public static function boot()
    {
    	parent::boot();
    	static::addGlobalScope('is-admin', function($query){
    		$query->where('type', 'admin');
    	});

    	static::creating(function($model){
    		$model->type = 'admin';
    	});
    }
}
