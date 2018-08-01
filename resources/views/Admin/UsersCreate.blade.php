<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户添加--35°后台管理</title>
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
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-block">
            <input type="text" name="name" value="{{ $user->name or null }}" lay-verify="required" autocomplete="off"  placeholder="请输入用户名" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">邮箱</label>
        <div class="layui-input-block">
            <input type="text" name="email" value="{{ $user->email or null }}" lay-verify="email" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-block">
            <input type="password" name="password" lay-verify="required|pwd" autocomplete="off" id="password"  placeholder="请输入密码" class="layui-input pwd">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">确认密码</label>
        <div class="layui-input-block">
            <input type="password" name="" lay-verify="required|confirmPwd" autocomplete="off"  placeholder="请确认密码" class="layui-input pwd">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
            <select name="status" lay-verify="required">
                <option value="1">开启</option>
                <option value="0">锁定</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">角色</label>
        <div class="layui-input-block">
            @foreach($roles as $role)
                <input type="checkbox" @if(count($user)) @if($user->hasRole($role->name)) checked="checked" @endif @endif value="{{ $role->id }}" name="roles[]" id="roles[]" title="{{ $role->display_name or $role->name }}">
            @endforeach
        </div>
    </div>

    <input type="hidden" name="userid" value="{{ $user->id or null }}">

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
        //验证规则
        form.verify({
            pwd: [/(.+){6,12}$/, '密码必须6到12位']
            ,
            confirmPwd : function(value, item){
                if(!new RegExp($("#password").val()).test(value)){
                    return "两次输入密码不一致，请重新输入！";
                }
            }
        });

        //监听提交
        form.on('submit(submitUser)', function(data){
            var index = layer.msg('提交中，请稍候',{icon: 16,time:false,shade:0.8});
            $.post("{{ url('admin/users/store') }}", $("#submitUserForm").serialize(),function (data) {
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