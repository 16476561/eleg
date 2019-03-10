<?php

namespace App\Http\Controllers;

use App\Model\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){
        $keyword=$request->keyword;
        if($keyword){
            $members=Member::where('username','like',"%$keyword%")->paginate(1);
        }else{
            $members=Member::paginate(1);
        }

        return view('Member.index',['members'=>$members,'keyword'=>$keyword]);
    }
    public function show(Member $member){
        return view('Member.show',['member'=>$member]);
    }
    //启动
    public function success(Member $member){
        DB::update("update members set status=1 where id=$member->id");
        session()->flash('success','启动成功');
        return redirect()->route('Members.index');
    }
    //禁用
    public function cancel(Member $member){
        DB::update("update members set status=0 where id=$member->id");
        session()->flash('success','禁用成功');
        return redirect()->route('Members.index');
    }
}
