<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Import\Importer;
use App\Model\Lotto;
use App\Model\Digits;

use Redis;


class TestController extends Controller
{
    //
	public function test(){
        // $redis =Redis::connection();
        // dd($redis->ping());
    	// dd(Digits::
    	// 	// where('drawn','<=', 20)
    	// 	orderBy('drawn','desc')
    	// 	->take(10)
    	// 	->get()
    	// 	->map(function($o){
    	// 	return $o->digit;
    	// }));

    	// dd(Lotto::where('won', '>=',1)->get());
	}
}
