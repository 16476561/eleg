<?php

namespace App\Http\Controllers;

use App\Model\Event;
use App\Model\EventMember;
use App\Model\EventPrize;
use GuzzleHttp\Psr7\Rfc7230;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $events=Event::all();
        return view('event.index',['events'=>$events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request,
            [
                'title'=>'required',
                'content'=>'required',
                'signup_start'=>'required',
                'signup_end'=>'required',
                'prize_date'=>'required',
                'signup_num'=>'required',

            ],[
                'title.required'=>'活动名称必填',
                'content.required'=>'活动详情必填',
                'signup_start.required'=>'活动报名开始时间必填',
                'signup_end.required'=>'活动报名结束时间必填',
                'prize_date.required'=>'活动开奖时间必填',
                'signup_num.required'=>'活动报名人数限制必填',

            ]);
               Event::create([
                   'title'=>$request->title,
                   'content'=>$request->input('content'),
                   'signup_start'=>$request->signup_start,
                   'signup_end'=>$request->signup_end,
                   'prize_date'=>$request->prize_date,
                   'signup_num'=>$request->signup_num,
                   'is_prize'=>0,
               ]);

                    session()->flash('success','添加成功');
                    return redirect()->route('events.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //

        return view('event.show',['event'=>$event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
        $signup_start=$event->signup_start;
        $signup_end=$event->signup_end;
        //把其中的T替换
        $star=str_replace(' ','T',$signup_start);
        $end=str_replace(' ','T',$signup_end);
        return view('event.edit',['event'=>$event],compact('star','end'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Event $event)
    {
        //
        $this->validate($request,
            [
                'title'=>'required',
                'content'=>'required',
                'signup_start'=>'required',
                'signup_end'=>'required',
                'prize_date'=>'required',
                'signup_num'=>'required',

            ],[
                'title.required'=>'活动名称必填',
                'content.required'=>'活动详情必填',
                'signup_start.required'=>'活动报名开始时间必填',
                'signup_end.required'=>'活动报名结束时间必填',
                'prize_date.required'=>'活动开奖时间必填',
                'signup_num.required'=>'活动报名人数限制必填',

            ]);
       $event->update([
            'title'=>$request->title,
            'content'=>$request->input('content'),
            'signup_start'=>$request->signup_start,
            'signup_end'=>$request->signup_end,
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>0,
        ]);

        session()->flash('success','修改成功');
        return redirect()->route('events.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
        $event->delete();
        session()->flash('success','删除成功');
        return redirect()->route('events.index');
    }

    //开奖
     public function kj($id){
         DB::beginTransaction();
         try{
             $eps = EventPrize::where('events_id', $id)->get()->toarray();
             $ems = EventMember::where('events_id', $id)->get()->toArray();
             $user = [];
             $ids = [];
             $et=Event::find($id);


             if (count($eps)==0){
                 return redirect()->route('events.index')->with('danger','没有设置奖品');
             }
             if (count($ems)<2){
                 return redirect()->route('events.index')->with('danger','没有人报名,或者至少两人才能开奖');
             }
             foreach ($ems as $em => $v) {
                 $user[] = $v['member_id'];

             }
             $bs = array_rand($user, 2);

             foreach ($bs as $l) {
                 $ids[] = $user[$l];
             }
             for ($i=0; $i <count($eps); $i++) {
                 EventPrize::where('id', $eps[$i]['id'])->update(['member_id' => $ids[$i]??'0']);

             }
             $event=Event::find($id);
             $event->is_prize=1;
             $event->save();
             DB::commit();

             return redirect()->route('events.index')->with('success','开奖成功');
         }catch(QueryException $exception){
            DB::rollBack();
         }
     }

     //查看中间名单
     public function md($id){

             $eps=EventPrize::where('events_id',$id)->get();
//          var_dump($eps);exit;
             return view('eventprize.show',compact('eps'));


     }
}
