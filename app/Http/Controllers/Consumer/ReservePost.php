<?php

namespace App\Http\Controllers\Consumer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservePost extends Controller
{
    public function __invoke(Request $request){
    	dd($request->all());
    }
}
