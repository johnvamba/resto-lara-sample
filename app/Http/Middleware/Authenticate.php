<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
            // dd('redirect to login', $request->user(), auth()->guard()->check(), auth()->guard());

        if(strpos($request->route()->getPrefix(), '/admin') == 0 && !$request->user()){
            // dd("wip");
            // if($request->user()->is_admin);
            return route('admin.login');
        }
        return route('login');
    }
}
