<?php

namespace App\Http\Controllers;

use App\Model\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){


        $serch=$request->serch;
        //根据时间进行搜索
        $wheres=[];
        //var_dump($wheres);exit;
       $aa=date('Y-m-d h:i:s');
        //var_dump($aa);exit;
        //根据时间判断
        if($serch==1) $wheres=[['star_time','<',$aa],['end_time','>',$aa]];
        if($serch==2) $wheres[]=['star_time','>',$aa];
        if($serch==3) $wheres[]=['end_time','<',$aa];

       if($serch){
           //判断。如果搜索那个进行时段就显示。并且传值
           $Activitys=Activity::where($wheres)->get();
       }else{
           //如果没搜索就显示总的活动
           $Activitys=Activity::all();
       }
        return view('Activity.index',['Activitys'=>$Activitys,'serch'=>$serch]);
    }

    public function create(){
        return view('Activity.create');
    }

    public function store(Request $request){

        $this->validate($request,
            [
                'title'=>'required',
                'content'=>'required',
                'star_time'=>'required',
                'end_time'=>'required',
            ],[
                'title.required'=>'活动标题没填写',
                'content.required'=>'活动内容必填',
                'star_time.required'=>'开始时间必填',
                'end_time.required'=>'结束时间必填',

            ]);
                Activity::create([
                    'title'=>$request->title,
                    'content'=>$request->input('content'),
                    'star_time'=>$request->star_time,
                    'end_time'=>$request->end_time,

                ]);
                    session()->flash('success','添加成功');
                    return redirect()->route('Activitys.index');


    }
            public  function edit(Activity $Activity){
         $endtime=$Activity->end_time;
         $star_time=$Activity->star_time;
         //把其中的T替换
         $end=str_replace(' ','T',$endtime);
         $star=str_replace(' ','T',$star_time);

         return view('Activity.edit',['Activity'=>$Activity],compact('end','star'));


            }
            public function update(Activity $Activity,Request $request){
                $this->validate($request,
                    [
                        'title'=>'required',
                        'content'=>'required',
                        'star_time'=>'required',
                        'end_time'=>'required',
                    ],[
                        'title.required'=>'活动标题没填写',
                        'content.required'=>'活动内容必填',
                        'star_time.required'=>'开始时间必填',
                        'end_time.required'=>'结束时间必填',

                    ]);
                $Activity->update([
                    'title'=>$request->title,
                    'content'=>$request->input('content'),
                    'star_time'=>$request->star_time,
                    'end_time'=>$request->end_time,
                                   ]);

                session()->flash('success','修改成功');
                return redirect()->route('Activitys.index');

            }

            public function destroy(Activity $Activity){
                $Activity->delete();
                session()->flash('success','删除成功');
                return redirect()->route('Activitys.index');
            }
            public function show(Activity $Activity){

                return view('Activity.show',['Activity'=>$Activity]);
            }

}
