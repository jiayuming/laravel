<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>35°后台登陆</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/css/style.css') }}" tppabs="css/style.css" />
    <style>
        body{height:100%;background:#16a085;overflow:hidden;}
        canvas{z-index:-1;position:absolute;}
    </style>
    <script src="{{ URL::asset('public/js/jquery.js') }}"></script>
    <script src="{{ URL::asset('public/js/verificationNumbers.js') }}" tppabs="js/verificationNumbers.js"></script>
    <script src="{{ URL::asset('public/js/Particleground.js') }}" tppabs="js/Particleground.js"></script>
    <script>
        $(document).ready(function() {
            //粒子背景特效
            $('body').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });
            //验证码
//            createCode();
            //测试提交，对接程序删除即可
            $(".submit_btn").click(function(){
                if($("input[name='username']").val()==''){
                    showError("用户名不能为空");
                    $("input[name='username']").focus();
                    return false;
                }
                if($("input[name='password']").val()==''){
                    showError('密码不能为空');
                    $("input[name='password']").focus();
                    return false;
                }
                if($("input[name='email']").val()==''){
                    showError('密码不能为空');
                    $("input[name='password']").focus();
                    return false;
                }
                $.ajax({
                    type: "post",
                    url: '{{ url('admin/login') }}',
                    data: $('#loginForm').serialize(),
                    dataType: "json",
                    success: function(data) {
                        if(data.status==1) {
                            window.location.href = "{{ url('admin') }}";
                        }else{
                            showError(data.msg)
                        }

                    },
                    error : function(xhr,textStatus,errorThrown){
                        showError("出现错误"+textStatus+"|"+errorThrown);
                    }
                });
            });
        });
        function showError(msg) {
            $('.error').html(msg);
            $('.error').fadeIn();
            setTimeout("$('.error').fadeOut();",2000);
        }
    </script>
</head>
<body>
<div class="error"></div>
<dl class="admin_login">
    <dt>
        <strong>站点后台管理系统</strong>
        <em>Management System</em>
    </dt>
    <form id="loginForm">
     {!! csrf_field() !!}
    <dd class="user_icon">
        <input type="text" name="username" placeholder="账号" class="login_txtbx"/>
    </dd>
    <dd class="pwd_icon">
        <input type="password" name="password" placeholder="密码" class="login_txtbx"/>
    </dd>
    <dd class="email_icon">
        <input type="email" name="email" placeholder="邮箱" class="login_txtbx"/>
    </dd>
        {{--<dd class="val_icon">--}}
        {{--<div class="checkcode">--}}
        {{--<input type="text" id="J_codetext" placeholder="验证码" maxlength="4" class="login_txtbx">--}}
        {{--<canvas class="J_codeimg" id="myCanvas" onclick="createCode()">对不起，您的浏览器不支持canvas，请下载最新版浏览器!</canvas>--}}
        {{--</div>--}}
        {{--<input type="button" value="验证码核验" class="ver_btn" onClick="validate();">--}}
        {{--</dd>--}}
    <dd>
        <input type="button" value="立即登陆" class="submit_btn"/>
    </dd>
    </form>
</dl>
</body>
</html>
