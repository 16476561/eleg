<?php

namespace App\Http\Controllers;

use App\Model\EventMember;
use Illuminate\Http\Request;

class EventMemberController extends Controller
{
    //
    public function show($id){

        $mes=EventMember::where('events_id',$id)->get();
        return view('events.show',compact('mes'));
    }
}
