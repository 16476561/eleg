<?php

namespace App\Http\Controllers;

use App\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

                public function index(){
                    $orders=Order::where('shop_id',auth()->user()->shop_id)->paginate(4);
                   //dd($orders);
            return view('order.index',['orders'=>$orders]);
    }
                public function show(Request $request,Order $order){
                    return view('order.show',['order'=>$order]);
                }

                //发货
            public function success(Request $request,Order $order){
                DB::update("update orders set status=1 where id=$order->id");
                session()->flash('success','发货成功');
                return redirect()->route('Orders.index');
            }
                //取消
            public function cancel(Order $order){
                DB::update("update orders set status=0 where id=$order->id");
                session()->flash('success','取消发货');
                return redirect()->route('Orders.index');
            }

            public function statistics(){
                  return view('Orders.statistics');
            }


    }
