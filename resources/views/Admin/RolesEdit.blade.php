<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>角色添加--35°后台管理</title>
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

<form class="layui-form" action="" id="submitUserForm">
    {{ csrf_field() }}
    @include('admin._RolesCreateForm')
    <div class="layui-form-item">
        <label class="layui-form-label">权限</label>
        <div class="layui-input-block">
            @foreach($perms as $perm)
                <input type="checkbox" @if($role->hasPermission($perm->name)) checked="checked" @endif value="{{ $perm->id }}" name="perm[]" id="perm[]" title="{{ $perm->display_name or $perm->name }}">
            @endforeach
        </div>
    </div>

    <input type="hidden" name="roleid" value="{{ $role->id or null }}">

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="submitUser">立即提交</button>
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
        form.on('submit(submitUser)', function(data){
            var index = layer.msg('提交中，请稍候',{icon: 16,time:false,shade:0.8});
            $.post("{{ url('admin/roles/store') }}", $("#submitUserForm").serialize(),function (data) {
                layer.close(index);
                layer.msg(data);
                layer.closeAll("iframe");
                //刷新父页面
                parent.location.reload();
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