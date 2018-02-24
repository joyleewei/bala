<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>个人资料--layphp后台管理模板</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="icon" href="/favicon.ico">
        <link rel="stylesheet" href="{{asset('/layui/css/layui.css')}}" media="all" />
        <script type="text/javascript" src="{{ asset('/layui/layui.js') }}"></script>
    </head>
    <body class="childrenBody">
        <button type="button" class="layui-btn" id="test1">
            <i class="layui-icon">&#xe67c;</i>上传图片
        </button>

        <script>
            layui.use('upload', function(){
            var upload = layui.upload;
            var token = '{{csrf_token()}}';
            //执行实例
            var uploadInst = upload.render({
                elem: '#test1' //绑定元素
                ,url: '{{ route('topics.upload_image') }}' //上传接口
                ,data:{'_token':token}
                ,done: function(res){

                }
                ,error: function(){
                  //请求异常回调
                }
                });
            });
        </script>
    </body>
</html>