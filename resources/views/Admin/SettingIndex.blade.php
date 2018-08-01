<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>网站信息--35°后台管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="{{ URL::asset('public/layui/layui/css/layui.css') }}" media="all" />
    <style type="text/css">
        .layui-form-item .layui-inline{ width:33.333%; float:left; margin-right:0; }
        @media(max-width:1240px){
            .layui-form-item .layui-inline{ width:100%; float:none; }
        }
    </style>
</head>
<body class="childrenBody">

<form class="layui-form" action="" id="submitSettingForm">
    {{ csrf_field() }}
    <div class="layui-form-item">
        <label class="layui-form-label">网站公告</label>
        <div class="layui-input-block">
            <textarea name="notice" cols="30" rows="4" class="layui-textarea">{{ $setting->notice or null }}</textarea>
        </div>
    </div>


    <div class="layui-form-item">
        <label class="layui-form-label">网站标题</label>
        <div class="layui-input-block">
            <input type="text" name="title" value="{{ $setting->title or null }}" lay-verify="required" autocomplete="off"  placeholder="请输入网站标题" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">关键词</label>
        <div class="layui-input-block">
            <textarea name="keywords" cols="30" rows="3" class="layui-textarea">{{ $setting->keywords or null }}</textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">描述</label>
        <div class="layui-input-block">
            <textarea name="description" cols="30" rows="4" class="layui-textarea">{{ $setting->description or null }}</textarea>
        </div>
    </div>
    <input type="hidden" name="permid" value="{{ $setting->id or null }}">

    <div class="layui-form-item">
        <label class="layui-form-label">备案信息</label>
        <div class="layui-input-inline">
            <input type="text" name="site_icp" value="{{ $setting->site_icp or null }}" lay-verify="required" autocomplete="off"  placeholder="请输入备案信息" class="layui-input">
        </div>
        <label class="layui-form-label">统计代码</label>
        <div class="layui-input-inline">
            <textarea name="site_tongji" cols="30" rows="4" class="layui-textarea">{{ $setting->site_tongji or null }}</textarea>
        </div>
        <label class="layui-form-label">版权信息</label>
        <div class="layui-input-inline">
            <textarea name="site_copyright" cols="30" rows="4" class="layui-textarea">{{ $setting->site_copyright or null }}</textarea>
        </div>
    </div>


    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="submitSetting">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>


<script type="text/javascript" src="{{ URL::asset('public/layui/layui/layui.js') }}"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.config({
        base : "public/layui/js/"
    }).use(['form','layer','jquery'], function(){
        var $ = layui.jquery;
        var form = layui.form();
        var layer = parent.layer === undefined ? layui.layer : parent.layer;

        //监听提交
        form.on('submit(submitSetting)', function(data){
            var index = layer.msg('提交中，请稍候',{icon: 16,time:false,shade:0.8});
            $.post("{{ url('admin/setting/store') }}", $("#submitSettingForm").serialize(),function (data) {
                layer.close(index);
                layer.msg(data);
                layer.closeAll("iframe");
                //刷新父页面
//                parent.location.reload();
            }).error(function (data) {
                layer.close(index);
                layer.msg("保存失败！");
            });
            return false;
        });


    });
</script>
</body>
</html>