<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request) 
    {
    	$validator = Validator::make($request->all(), [
    		'name' => 'required',
    		'email'	=> 'required',
    		'password' => 'required',
    		'c_password' => 'required|same:password',
    	]);

    	if($validator->fails())
    	{
    		return response()->json(['error' => $validator->errors()], 401);
    	}

    	$input = $request->only(['name', 'password', 'email']);
    	$input['password'] = bcrypt($input['password']);
    	$user = User::firstOrCreate($input);
    	$success['token'] = $user->createToken('App')->accessToken;

    	return response()
    		->json(['success' => $success], 200);
    }

    public function login(Request $request)
    {
    	if( Auth:: attempt([
    		'email' => $request->get('email'),
    		'password' => $request->get('password')])
    	)
    	{
    		$success['token'] = Auth::user()->createToken('App')->accessToken;
    		return response()->json([
    			'success' => $success,
    			200
    		]);
    	} else {
    		return response()->json([
    			'error' => 'Unauthorized',
    			401
    		]);
    	}
    }

    public function getUser() 
    {
    	$user = Auth::user();
    	return response()->json([
    		'success' => $user,
    		200
    	]);
    }
}
