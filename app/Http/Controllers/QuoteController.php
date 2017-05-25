<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function get()
    {
    	$type = request()->input('type');
    	$amount = request()->input('amount');
    	$id = request()->input('id');
    	$cb = request()->input('callback');
    	$first = !$amount && !$id && $type != 'rand';
    	
    	if ( $amount && $id )
    		return response()->json(['error' => 'Cannot use ID param with Amount']);

    	if ( $type && $id )
    		return response()->json(['error' => 'Cannot use ID param with Type']);
    	

    	if ( $amount && !$type )
    		$quotes = Quote::limit(intval($amount));

    	if ( $amount && $type )    	
    		$quotes = Quote::inRandomOrder()->limit(intval($amount))->get();
    	
    	if ( $type == 'rand' && !$amount)
    		$quotes = Quote::inRandomOrder()->first();

    	if ( $id ) 
    		$quotes = Quote::find(intval($id));

			// if ( $cb )
			// 	return response()->json($quotes)->withCallback($cb);
			// 	// $quotes->withCallback($cb);

			if ( $first ) $quotes = Quote::first();

			return $type == 'rand' || $first || $id ? $quotes : $quotes->get();    	
    }
}
