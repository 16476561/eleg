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
use Qcloud\Sms\SmsSingleSender;

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
        //得到地址ID
        $addres = Address::find($request->address_id);
        //得到购物车的ID
        $cart = Cart::where('user_id', auth()->user()->id)->first();
        //dd($cart);
        //得到商品的ID
        $shop = Menus::where('goods_id', $cart->goods_id)->get()->first();
        //购物车和商品链表查询，里面的值相等
        $goods_list = DB::table('carts')->leftjoin('menuses', 'carts.goods_id', '=', 'menuses.goods_id')
            ->select('carts.goods_id', 'menuses.goods_name', 'menuses.goods_img', 'carts.amount', 'menuses.goods_price')
            ->where('carts.user_id', auth()->user()->id)
            ->get();
        $money = 0;
        //遍历
        foreach ($goods_list as $goods) {
            $money += $goods->goods_price * $goods->amount;
        }
        $data = [
            'user_id' => auth()->user()->id,
            'shop_id' => $shop->shop_id,
            'sn' => uniqid(),
            'province' => $addres->provence,
            'city' => $addres->city,
            'area' => $addres->area,
            'county' => 0,
            'address' => $addres->detail_address,
            'tel' => $addres->tel,
            'name' => $addres->name,
            'total' => $money,
            'status' => 0,
            'out_trade_no' => uniqid(),

        ];

        //dd($data);
        //开启事务
        DB::beginTransaction();

            $order = Order::create($data);
            foreach ($goods_list as $goods) {
                        $data1 = [
                    'order_id' => $order->id,
                    'goods_id' => $goods->goods_id,
                    'amount' => $goods->amount,
                    'goods_name' => $goods->goods_name,
                    'goods_img' => $goods->goods_img,
                    'goods_price' => $goods->goods_price,
                ];
                OrderDetail::create($data1);
                DB::table('carts')->where('user_id', Auth::user()->id)->delete();
            }

        if ($data && $data1) {
            DB::commit();
            $redis = new \Redis();
            $redis->connect('127.0.0.1');
            $sms = mt_rand(1000, 9999);
            //设置验证码过期时间
            $redis->set($order->tel, $sms, 100);
            // 短信应用SDK AppID
            $appid = 1400189773; // 1400开头

            // 短信应用SDK AppKey
            $appkey = "c501c4a6e9c714fb74b318115f9065bc";

            // 需要发送短信的手机号码
            $phoneNumbers =18280313220;
            //var_dump($phoneNumbers);exit;
            // 短信模板ID，需要在短信应用中申请
            $templateId = 285161;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请

            $smsSign = "吴磊的美好的一天"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`

            try {
                $ssender = new SmsSingleSender($appid, $appkey);
                $params = [$sms, 5];
                $result = $ssender->sendWithParam("86", $phoneNumbers, $templateId,
                    $params, $smsSign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
                $rsp = json_decode($result);

            } catch (\Exception $e) {
                echo var_dump($e);
            }
            return ['status' => 'true', 'message' => '添加成功', 'order_id' => $order->id];
        } else {
            DB::rollBack();
            return ['status' => 'false', 'message' => '添加失败'];
        }
    }





                //获取订单列表接口
    public  function order(Request $request){
        //定义一个空数组
        $data=[];
        //读取order数据表
       $order_id=Order::where('id','=',$request->id)->get()->first();
      //dd($order_id);
        //把其中的显示地址等于order中的地址
        $data['order_address']=$order_id->province.$order_id->city.$order_id->county.$order_id->address;
        //查看商家列表
       // dd($data);
        $shops=Shop::find($order_id->shop_id);
           //dd($shops);
        //查看订单商品表
        //return $shops;
        $orderDeta=OrderDetail::where('order_id',$order_id->id)->get();
       // dd($orderDeta);
        //把data中的[]数据自定义=订单表中的数据
        $data['order_code']=$order_id->sn;
        //(string)显示时间的时候加上才能显示页面
        $data['order_birth_time']=(string)$order_id->created_at;
        $data['shop_id']=$shops->shop_id;
        $data['shop_name']=$shops->shop_name;
        $data['shop_img']=$shops->shop_img;
        //判断订单表是否支付
        switch ($order_id['order_status']){
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
    public function list()
    {
            //商品的ID等于登陆的ID
        $orders = Order::where('user_id',auth()->user()->id)->get();
//        return $orders;

        foreach ($orders as $order){
            switch ($order['order_status']) {
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
            $detail = OrderDetail::where('order_id',$order->id)->get();
            $order['goods_list'] =$detail;
            $goods = Menus::where('goods_id',$detail[0]->goods_id)->first();
            $shop = Shop::where('id',$goods->shop_id)->first();
            $order['shop_name'] = $shop->shop_name;
            $order['shop_img'] = $shop->shop_img;
            $order['order_address']=$order->provence.$order->city.$order->area.$order->detail_address;
        }
        return $orders;


//        $data = [];
//        //获取订单信息
//        $orders = Order::select('id', 'sn as order_code', 'created_at as order_birth_time', 'status as order_status', 'shop_id', 'total as order_price', 'province', 'city', 'county', 'address')
//            ->where('user_id', 17)
//            ->get()
//            ->toArray();
//
//        //获取订单商品信息
//        foreach ($orders as $order) {
//            //获取详细地址
//            $order['order_address'] = $order['province'] . $order['city'] . $order['county'] . $order['address'];
//           //dd($order);
//            //删除多余的数据
//            //return $order['order_address'];
//           // unset($order['province'],$order['city'],$order['county'],$order['address']);
//            //替换订单状态
//            switch ($order['order_status']) {
//                case -1:
//                    $order['order_status'] = '已取消';
//                    break;
//                case 0:
//                    $order['order_status'] = '待支付';
//                    break;
//                case 1:
//                    $order['order_status'] = '待发货';
//                    break;
//                case 2:
//                    $order['order_status'] = '待确认';
//                    break;
//                case 3:
//                    $order['order_status'] = '完成';
//                    break;
//            }
//            //查询商品详细信息
//            $order['goods_list'] = OrderDetail::select('goods_id', 'goods_name', 'goods_img', 'amount', 'goods_price')->where('order_id','=', $order['id'])->get()->toArray();
//          //dd($order['shop_id']);
//            //查询商家信息
//                $shops = Shop::select('shop_name','shop_img')->find($order['shop_id'])->toArray();
//
//
//
//        // dd($shops);
//            //将订单信息与商家信息合并
//            $data[] = array_merge( $shops,$order);
//            return $data;
//
//        }     //  return $data;



    }

            //短信验证
    public function  sms(Request $request){

        //开启redis
        $redis=new \Redis();
        $redis->connect('127.0.0.1');
        $sms=mt_rand(1000,9999);
        //设置验证码过期时间
        $redis->set($request->tel,$sms,100);
        // 短信应用SDK AppID
        $appid = 1400189773; // 1400开头

// 短信应用SDK AppKey
        $appkey = "c501c4a6e9c714fb74b318115f9065bc";

// 需要发送短信的手机号码
        $phoneNumbers =$request->tel;
        //var_dump($phoneNumbers);exit;
// 短信模板ID，需要在短信应用中申请
        $templateId = 285161;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请

        $smsSign = "吴磊的美好的一天"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`

        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $params = [$sms,5];
            $result = $ssender->sendWithParam("86", $phoneNumbers, $templateId,
                $params, $smsSign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
            $rsp = json_decode($result);

        }
        catch(\Exception $e) {
            echo var_dump($e);
        }
        return[
            "status"=> "true",
            "message"=> "获取短信验证码成功"
        ] ;
    }

}


