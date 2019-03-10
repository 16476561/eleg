<?php

namespace App\Http\Controllers;

use App\Model\Nav;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class NavController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $navs =Nav::paginate(5);
       $parents=Nav::where('pid',0)->get();
       return view('nav.index',['navs'=>$navs,'parents'=>$parents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions=Permission::all();
        $navs=Nav::where('pid',0)->get();
        return view('nav.create',['permissions'=>$permissions,'navs'=>$navs]);

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
           'url'=>'required',
           'permission_id'=>'required',
       ],[
           'name.required'=>'导航名字必填',
           'url.required'=>'地址必填',
           'permission_id.required'=>'权限必填',
       ]);
            Nav::create([
                'name'=>$request->name,
                'url'=>$request->url,
                'pid'=>$request->pid,
                'permission_id'=>$request->permission_id
            ]);
         session()->flash('success','添加成功');
         return redirect()->route('navs.index');



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
    public function edit(Nav $nav)
    {
        //
        $permissions=Permission::all();
        $pids=Nav::where('pid',0)->get();
        return view('nav.edit',['nav'=>$nav,'permissions'=>$permissions,'pids'=>$pids]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Nav $nav)
    {
        //
        $this->validate($request,[
            'name'=>'required',
            'url'=>'required',
            'permission_id'=>'required',
        ],[
            'name.required'=>'导航名字必填',
            'url.required'=>'地址必填',
            'permission_id.required'=>'权限必填',
        ]);
       $nav->update([
            'name'=>$request->name,
            'url'=>$request->url,
            'pid'=>$request->pid,
            'permission_id'=>$request->permission_id
        ]);
//        $nav->syncPermissions($request->permission_id);
        session()->flash('success','修改成功');
        return redirect()->route('navs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
