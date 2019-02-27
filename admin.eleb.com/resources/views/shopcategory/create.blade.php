{{--<!--引入CSS-->--}}
{{--<link rel="stylesheet" type="text/css" href="webuploader/webuploader.css">--}}

{{--<!--引入JS-->--}}
{{--<script type="text/javascript" src="webuploader/webuploader.js"></script>--}}

@extends('layout.app')

@section('content')
    <!--引入CSS-->



<form method="post" action="{{route('shopcategorys.store')}}" enctype="multipart/form-data">
    <div class="container">
        <h1>商品分类</h1><br/>
     @include('layout._error')

       商品名称：<input type="text" name="name" class="form-control" value="{{old('name')}}" >
    </div><br/>


    <div class="container">
        <div id="uploader-demo">
            <!--用来存放item-->
            <input type="hidden" name="img" id="img_val">
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker"  name="img">选择图片</div>
            <img src="" id="img" alt="">
        </div>
    </div><br/>



    <div class="container">
        <input type="radio" id="inlineCheckbox1" value="1" name="status"> 上线

        <input type="radio" id="inlineCheckbox2" value="0" name="status"> 下线
    </div>
        <br/>
    <div class="form-group" style="margin-left: 200px">
        验证码：<input type="text" name="captcha"  class="form-group-sm" value="" >
        <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
    </div>
    {{csrf_field()}}
    <button type="submit" class="btn-primary" style="margin-left:700px">提交</button>
</form>
<script>
    // 初始化Web Uploader
    var uploader = WebUploader.create({

        // 选完文件后，是否自动上传。
        auto: true,

        // swf文件路径
        //swf: BASE_URL + '/js/Uploader.swf',

        // 文件接收服务端。
        server: '/upload',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',

        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        },
        //设置上传请求参数的
        formData:{
            _token:'{{csrf_token()}}'
        },

    });
    uploader.on( 'uploadSuccess', function( file ,r) {
        $('#img_val').val(r.path);
        $('#img').attr('src',r.path).css("width","80px");

    });
</script>
   @stop