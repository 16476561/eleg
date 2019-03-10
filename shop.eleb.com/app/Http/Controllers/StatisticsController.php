<?php

namespace App\Http\Controllers;

use App\Model\Menus;
use App\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    //查看一周前订单统计
    public function index()
    {
        // 第一种方案
//        //获取前一周的时间
//        $time = time();
//        $arr=[];
//        $one = 24*60*60;
//        for($i = 1;$i<=7;$i++) {
//           $date=date("Y-m-d" , $time - $one * $i);
//           //echo $date;
//           //计算出订单前7天每天的数量
//            $orders=Order::where('shop_id',Auth::user()->shop_id)->where("created_at","like","%$date%")->count();
//           //保存数据
//            $arr+=[$date=>$orders];
//        }
//        return view('statistics.index',['arr'=>$arr]);

        //第二种方案
        $shop_id=Auth::user()->shop_id;
        $time_start=date('Y-m-d 00:00:00',strtotime('-6 day'));
        $time_end=date('Y-m-d 23:59:59');
        //group by date(created_at)根据时间分组
        $sql="select date(created_at) as date,count(*) as total from orders where created_at >= '{$time_start}' and created_at <='{$time_end}' and shop_id={$shop_id} group by date(created_at)";
        //var_dump($sql);exit;
        //执行SQL语句
        $rows=DB::select($sql);
        //var_dump($rows);exit;
        //构造7天的统计
        $result=[];
        for ($i=0;$i<7;$i++){
            $result[date('Y-m-d',strtotime("-{$i} day"))]=0;
        }
        //dd($rows);
        //var_dump($result);exit;
        foreach ($rows as $row ){
            $result[$row->date]=$row->total;
            //var_dump($rows);exit;
        }
        //dd($result);
        return view('statistics.index',['result'=>$result]);
    }



    public   function   index1(){
        //获取前三个月数据
        $time = time();
        $arr=[];
        $month = 30*24*60*60;
        for($i = 0;$i<3;$i++) {

            $date=date("Y-m", $time - $month * $i);
            //echo $date;
            //计算出订单前3个月的数量
            $orders=Order::where("created_at","like","%$date%")->where('shop_id',Auth::user()->shop_id)->count();
            //var_dump($orders);
            $arr +=[$date=>$orders];
        }
        return view('statistics.show',['arr'=>$arr]);
    }


    //商户端最近一周菜品销量统计
    public function sale()
    {
        $shop_id = 1;//Auth::user()->shop_id;
        $time_start = date('Y-m-d 00:00:00',strtotime('-6 day'));
        $time_end = date('Y-m-d 23:59:59');

        //每个菜每一天的销量
        //菜名 日期  销量
        //回锅肉 2019-03-05  21
        //回锅肉 2019-03-03  11
        //土豆丝 2019-03-05  10
        //土豆丝 2019-03-01  11
        //order_details  orders


        $sql = "SELECT
	DATE(orders.created_at) AS date,order_details.goods_id,
	SUM(order_details.amount) AS total
FROM
	order_details
JOIN orders ON order_details.order_id = orders.id
WHERE
	 orders.created_at >= '{$time_start}' AND orders.created_at <= '{$time_end}'
AND shop_id = {$shop_id}
GROUP BY
	DATE(orders.created_at),order_details.goods_id";




        $rows = DB::select($sql);
        //dd($rows);
        //$rows = [
        // ['date'=>'','total'=>''],[]
        //];
        //构造7天统计格式
        $result = [];
        //获取当前商家的菜品列表
        $menus = Menus::where('shop_id',$shop_id)->select(['goods_id','goods_name'])->get();
        $keyed = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => $item['goods_name']];
        });
        $keyed2 = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => 0];
        });
        $menus = $keyed->all();
        //dd($menus);
        $week=[];
        for ($i=0;$i<7;$i++){
            $week[] = date('Y-m-d',strtotime("-{$i} day"));
        }
        foreach ($menus as $id=>$name){
            foreach ($week as $day){
                $result[$id][$day] = 0;
            }
        }
        /**/
        //dd($result);
        foreach ($rows as $row){
            $result[$row->goods_id][$row->date]=$row->total;
        }


        //dd($rows);
        $series = [];
        foreach ($result as $id=>$data){
            $serie = [
                'name'=> $menus[$id],
                'type'=>'line',
                //'stack'=> '销量',
                'data'=>array_values($data)
            ];
            $series[] = $serie;
        }
        /* [
                 {
                     name:'回锅肉',
                     type:'line',
                     stack: '总量',
                     data:[120, 132, 101, 134, 90, 230, 210]
                 },
                 {
                     name:'联盟广告',
                     type:'line',
                     stack: '总量',
                     data:[220, 182, 191, 234, 290, 330, 310]
                 },
                 {
                     name:'视频广告',
                     type:'line',
                     stack: '总量',
                     data:[150, 232, 201, 154, 190, 330, 410]
                 },
                 {
                     name:'直接访问',
                     type:'line',
                     stack: '总量',
                     data:[320, 332, 301, 334, 390, 330, 320]
                 },
                 {
                     name:'搜索引擎',
                     type:'line',
                     stack: '总量',
                     data:[820, 932, 901, 934, 1290, 1330, 1320]
                 }
             ]*/

        return view('Statistics.sale',compact('result','menus','week','series'));

    }


}