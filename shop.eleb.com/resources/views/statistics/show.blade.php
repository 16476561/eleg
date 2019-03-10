<script src="https://cdn.bootcss.com/echarts/4.1.0-release/echarts.min.js"></script>
@extends('layout.app')
@section('content')
    <style>
        p{font-size: 20px; text-align: center}
    </style>
    <h1>三个月订单统计：</h1>


    <table class="table table-bordered">

        <tr>
            @foreach($arr as $aa=>$vv)
            <th>{{$aa}}</th>
            @endforeach
        </tr>
        <tr>
            @foreach($arr as $aa=>$vv)
                <td>{{$vv}}</td>
            @endforeach
            </tr>
    </table>
    <div id="main" style="width: 500px;height:400px;"></div>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '销量走势图'
            },
            tooltip: {},
            legend: {
                data:['销量']
            },
            xAxis: {
                data:{!!json_encode(array_keys( $arr )) !!}
            },
            yAxis: {},
            series: [{
                name: '三个月销量走势图',
                type: 'bar',
                data:{!! json_encode(array_values( $arr )) !!}
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
    @stop
<body>



