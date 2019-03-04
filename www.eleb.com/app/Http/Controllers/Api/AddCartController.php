<?php

namespace App\Http\Controllers\Api;

use App\Model\Address;
use App\Model\Cart;
use App\Model\Member;
use App\Model\Menus;
use App\Model\order;
use App\Model\OrderDetail;
use App\Model\Shop;
use App\Model\user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddCartController extends Controller
{               //添加购物车

    public function keep(Request $request)
    {
        $goodsList = $request->goodsList;
        $goodsCount = $request->goodsCount;
        for ($i = 0; $i < count($request->goodsCount); $i++) {
            $ab = Cart::create([
                'user_id' => Auth::user()->id,
                'goods_id' => $request->goodsList[$i],
                'amount' => $request->goodsCount[$i]
            ]);

        }
        if ($ab) {
            return ["status" => "true",
                "message" => "添加成功"];
        } else {
            return ["status" => "false",
                "message" => "添加失败"];
        }
    }


    //获取商家数据接口
    public function cart()
    {
        //商家数据的接口==登陆后的ID
        $cate = Cart::where('user_id', '=', auth()->user()->id)->get();
        //先用个变量表示商品价格，先等于0
        $totalCost = 0;
        foreach ($cate as $goods) {
            //查看商品ID
            $date = Menus::where('goods_id', $goods->goods_id)->get()->first();
            //定义一个数据保存商品名字+图片+价格
            $goods['goods_name'] = $date->goods_name;
            $goods['goods_img'] = $date->goods_img;
            $goods['goods_price'] = $date->goods_price;
            //计算出商品总价
            $totalCost += $goods->amount * $goods->goods_price;
        }
        //返回数据生成接口
        $arr['goods_list'] = $cate;
        $arr['totalCost'] = $totalCost;
        //dd($arr);
        return $arr;

    }


    //添加订单列表
    public function addOrder(Request $request)
    {
        //查看购物车里面的User_id 等于 登陆ID

        $cart = Cart::where('user_id', auth()->user()->id)->get();
        //dd($cart);
        //查看收获地址
        $addresss = Address::where('id', '=', $request->address_id)->get()->first();
        //查看商品ID
       // dd($addresss);
        $goods_id = $cart[0]['goods_id'];
        $menus = Menus::where('goods_id', '=', $goods_id)->get();
        //商家ID=商品的ID
        $shop_id = $menus[0]['shop_id'];
        //设置金额
        $total = 0;
        foreach ($cart as $aa) {
            //查看商品的ID
            $date = Menus::where('goods_id', $aa->goods_id)->get()->first();
            //定义一个价格等于商品的里面的价格
            $aa['goods_price'] = $date->goods_price;

            $create = [
                'user_id' =>auth()->user()->id,
                'shop_id' => $date->shop_id,
                'sn' => uniqid(),
                'province' => $addresss->provence,
                'city' => $addresss->city,
                'county' => $addresss->area,
                'address' => $addresss->detail_address,
                'tel' => $addresss->tel,
                'name' => $addresss->name,
                'total' => $total += $aa->amount * $aa->goods_price,
                'status' => 1,
                'out_trade_no' => uniqid(),
            ];
        }
        //开启事务
        DB::beginTransaction();
            try {
                $order = Order::create($create);
                foreach ($cart as $goods) {
                        $goods['goods_name'] = $date->goods_name;
                        $goods['goods_img'] = $date->goods_img;

                        $create1 = [
                        'order_id' => $order->id,
                        'goods_id' => $goods->goods_id,
                        'amount' => $goods->amount,
                        'goods_name' => $goods->goods_name,
                        'goods_img' => $goods->goods_img,
                        'goods_price' => $goods->goods_price,
                    ];
                    OrderDetail::create($create1);
                    DB::table('carts')->where('user_id', Auth::user()->id)->delete();
                }
                //执行事务
                DB::commit();
                return ['status' => 'true', 'message' => '添加成功', 'order_id' => $order->id];
            } catch (\Exception $e){
                //回滚
                DB::rollBack();
                return ['status' => 'false', 'message' => '添加失败'];
            }

}
                //获取订单列表接口
    public  function order(Request $request){
        //定义一个空数组
        $data=[];
        //读取order数据表
        $order=Order::where('id',$request->id)->first();
        //把其中的显示地址等于order中的地址
        $data['order_address']=$order->province.$order->city.$order->county.$order->address;
        //查看商家列表
        $shops=Shop::find($order->shop_id);
        //查看订单商品表
        $orderDeta=OrderDetail::where('order_id',$order->id)->get();
        //把data中的[]数据自定义=订单表中的数据
        $data['order_code']=$order->sn;
        $data['order_birth_time']=$order->created_at->toArray()['formatted'];
        $data['shop_id']=$shops->shop_id;
        $data['shop_name']=$shops->shop_name;
        $data['shop_img']=$shops->shop_img;
        //判断订单表是否支付
        switch ($order['order_status']){
            case -1:
                $order['order_status'] = '已取消';
                break;
            case 0:
                $order['order_status'] = '待支付';
                break;
            case 1:
                $order['order_status'] = '待发货';
                break;
            case 2:
                $order['order_status'] = '待确认';
                break;
            case 3:
                $order['order_status'] = '完成';
                break;
        }

        foreach ($orderDeta as $orderDet)
                //循环订单商品（goods_list是前台传过来的数据。直接循环就可以返回）
            $data['goods_list'][]=[
                'goods_id'=>$orderDet->id,
                'goods_name'=>$orderDet->goods_name,
                'goods_img'=>$orderDet->goods_img,
                'amount'=>$orderDet->amount,
                'goods_price'=>$orderDet->goods_price,
            ];
        return $data;

    }

                //获取订单显示页面接口
    public function list(){
        $data = [];
        //获取订单信息
        $orders = Order::select('id','sn as order_code','created_at as order_birth_time','status as order_status','shop_id','total as order_price','province','city','county','address')
            ->where('user_id',Auth::user()->id)
            ->get()
            ->toArray();
       // return $orders;
        //获取订单商品信息
        foreach ($orders as $order){
            //获取详细地址
            //return $order;
            $order['order_address'] = $order['province'].$order['city'].$order['county'].$order['address'];
            //删除多余的数据
            //return $order['order_address'];
            //unset($order['province'],$order['city'],$order['county'],$order['address']);
            //替换订单状态
            switch ($order['order_status']){
                case -1:
                    $order['order_status'] = '已取消';
                    break;
                case 0:
                    $order['order_status'] = '待支付';
                    break;
                case 1:
                    $order['order_status'] = '待发货';
                    break;
                case 2:
                    $order['order_status'] = '待确认';
                    break;
                case 3:
                    $order['order_status'] = '完成';
                    break;
            }
            //查询商品详细信息
            $order['goods_list'] =OrderDetail::select('goods_id','goods_name','goods_img','amount','goods_price')->where('order_id',$order['id'])->get()->toArray();
            //查询商家信息

            $shops = Shop::select('shop_name','shop_img')->find($order['shop_id'])->toArray();

            //将订单信息与商家信息合并
            $data[] = array_merge($order,$shops);

        }
        //返回数据
        return $data;

    }

}


