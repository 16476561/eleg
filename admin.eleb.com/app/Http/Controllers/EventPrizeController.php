<?php

namespace App\Http\Controllers;

use App\Model\Event;
use App\Model\EventPrize;
use Illuminate\Http\Request;

class EventPrizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $eventprizes=EventPrize::all();
        return view('eventprize.index',['eventprizes'=>$eventprizes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $events=Event::all();
        return view('eventprize.create',['events'=>$events]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'name'=>'required',
            'events_id'=>'required',
            'description'=>'required',

        ],[
            'name.required'=>'奖品必填',
            'events_id.required'=>'商品类别必选',
            'description.required'=>'奖品详情必填',
        ]);

        EventPrize::create([
            'name'=>$request->name,
            'events_id'=>$request->events_id,
            'description'=>$request->description,
            'member_id'=>0,
        ]);
        session()->flash('success','添加成功');
        return redirect()->route('eventprizes.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EventPrize $eventprize)
    {
        //
        $events=Event::all();
        return view('eventprize.edit',['eventprize'=>$eventprize,'events'=>$events]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventPrize $eventprize)
    {

        //
        $this->validate($request,[
            'name'=>'required',
            'events_id'=>'required',
            'description'=>'required',

        ],[
            'name.required'=>'奖品必填',
            'events_id.required'=>'商品类别必选',
            'description.required'=>'奖品详情必填',
        ]);

       $eventprize->update([
            'name'=>$request->name,
            'events_id'=>$request->events_id,
            'description'=>$request->description,
            'member_id'=>0,
        ]);
        session()->flash('success','修改成功');
        return redirect()->route('eventprizes.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventPrize $eventprize)
    {
        //
        $eventprize->delete();
        session()->flash('success','删除成功');
        return redirect()->route('eventprizes.index');
    }
}
