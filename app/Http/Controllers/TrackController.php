<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackController extends Controller
{
    
    public function track(Request $request)
    {

        $result = null;

        if($request->ticket){

            $result = DB::table('complaints')
                        ->where('ticket_number',$request->ticket)
                        ->first();

        }

        return view('pages.track',compact('result'));

    }
}