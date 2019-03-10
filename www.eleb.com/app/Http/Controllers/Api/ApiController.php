<?php

namespace App\Http\Controllers\Api;

use App\Model\Member;
use App\Model\MenuCategory;
use App\Model\Menus;
use App\Model\shop;
use App\user;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Qcloud\Sms\SmsSingleSender;
class ApiController extends Controller
{
    //商家接口
    public function business_list(Request $request)
    {


        $keyword = $request->keyword;
        //判断状态，为1显示和搜索，不为1就不能显示和搜索
        if ($keyword) {
            $shops = Shop::where('status', 1)->where('shop_name', 'like', "%$keyword%")->get();
        } else {
            $shops = Shop::where('status', 1)->get();
        }
        return $shops;
    }

    //指定商家接口
    public function appoint(Request $request)
    {
        //当前登陆用户的ID等于点击的ID
        $shop = Shop::where('id', $request->id)->get();
        //商品分类的ID等于点击的ID
        $MenuCategories = MenuCategory::where('shop_id', $request->id)->get();
        // dd($MenuCategories);
        //遍历
        foreach ($MenuCategories as $MenuCategory) {
            //菜品分类的ID等于文档里面的分类 = 所属分类的ID
            $MenuCategory['goods_list'] = Menus::where('category_id', $MenuCategory->id)->get();

        }
        //商家里面文档的分类=自己写的分类
        $shop['commodity'] = $MenuCategories;
        return $shop;
    }


                         //注册接口
    public function reg(Request $request)
    {
        //开始Redis
        $redis = new \Redis();
        //连接数据库
        $redis->connect('127.0.0.1');
        //判断：如果得到的验证码 ==Redis里面手机发送的验证码，就注册成功
        if ($request->sms == $redis->get($request->tel)) {
            //自定义验证
            $validator = Validator::make($request->all(), [
                'username' => 'required|numeric|unique:members,username',
                'password' => 'required',
                'tel' => 'required|numeric'
            ], [
                'username.required' => '用户名必填',
                'password.required' => '密码错误',
                'tel.required' => '电话必填',
                'tel.numeric' => '电话为整数',
                //'tel.digits_between11,11'=>'电话只能为11为',
                'username.numeric' => '账号为整数',
               'username.unique' => '账号已存在',
            ]);
            //判断返回数据
            if ($validator->fails()) {
                return ['status' => 'false', "message"=>$validator->errors()->all()];
            }
           // dd('ok');
            $members = Member::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'tel' => $request->tel,
                'rememberToken' => '',
                'status'=>1,
            ]);
            return ["status" => "true",
                     "message" => "注册成功"
            ];
             }else{
            return ["status"=>"false",
                    "message"=>"注册失败，验证码错误",
                ];
        }
    }

            //登陆接口
    public function login(Request $request)
    {

        if (Auth::attempt([
            'username' => $request->name,
            'password' => $request->password,
            'status'=>1,
        ], $request->has('remember'))){
      return [
            "status"=>"true",
            "message"=>"登录成功",
            "user_id"=>auth()->user()->id,
            "username"=>auth()->user()->username,
      ];
    } else {
            //禁用账号
            $members=Member::where('username',$request->username)->first();
            if($members && $members->status==0);
        }
        return ['status'=>'false',
                'message'=>'账号密码错误或已被禁用'
        ];
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

