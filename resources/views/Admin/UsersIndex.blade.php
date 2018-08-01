<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户管理--35°后台管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="{{ URL::asset('public/layui/layui/css/layui.css') }}" media="all" />
    <link rel="stylesheet" href="{{ URL::asset('public/layui/css/font_eolqem241z66flxr.css') }}" media="all" />
    <link rel="stylesheet" href="{{ URL::asset('public/layui/css/user.css') }}" media="all" />
</head>
<body class="childrenBody">
<blockquote class="layui-elem-quote news_search">
    <div class="layui-inline">
        <div class="layui-input-inline">
            <input type="text" value="" placeholder="请输入关键字" class="layui-input search_input">
        </div>
        <a class="layui-btn search_btn">查询</a>
    </div>
    <div class="layui-inline">
        <a class="layui-btn layui-btn-normal usersAdd_btn">添加用户</a>
    </div>
    <div class="layui-inline">
        <a class="layui-btn layui-btn-danger batchDel">批量删除</a>
    </div>
    <div class="layui-inline">
        <div class="layui-form-mid layui-word-aux">　</div>
    </div>
</blockquote>
<div class="layui-form news_list">
    <table class="layui-table">
        <colgroup>
            <col width="50">
            <col width="18%">
            <col width="18%">
            <col width="12%">
            <col width="15%">
        </colgroup>
        <thead>
        <tr>
            <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" id="allChoose"></th>
            <th>登录名</th>
            <th>邮箱</th>
            <th>会员状态</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody class="users_content"></tbody>
    </table>
</div>
<div id="page"></div>
<script>
    var csrftoken='{{ csrf_token() }}';
</script>
<script type="text/javascript" src="{{ URL::asset('public/layui/layui/layui.js') }}"></script>
<script>
    layui.config({
        base : "public/layui/js/"
    }).use(['form','layer','jquery','laypage'],function(){
        var form = layui.form(),
            layer = parent.layer === undefined ? layui.layer : parent.layer,
            laypage = layui.laypage,
            $ = layui.jquery;
        //加载页面数据
        var usersData = '';
        $.post("",{'_token':csrftoken}, function(data){
            usersData = data;
            //执行加载数据的方法
            usersList();
        })

        //查询
        $(".search_btn").click(function(){
            var userArray = [];
            if($(".search_input").val() != ''){
                var index = layer.msg('查询中，请稍候',{icon: 16,time:false,shade:0.8});
                setTimeout(function(){
                    $.ajax({
                        url : "../../json/usersList.json",
                        type : "get",
                        dataType : "json",
                        success : function(data){
                            if(window.sessionStorage.getItem("addUsers")){
                                var addUsers = window.sessionStorage.getItem("addUsers");
                                usersData = JSON.parse(addUsers).concat(data);
                            }else{
                                usersData = data;
                            }
                            for(var i=0;i<usersData.length;i++){
                                var usersStr = usersData[i];
                                var selectStr = $(".search_input").val();
                                function changeStr(data){
                                    var dataStr = '';
                                    var showNum = data.split(eval("/"+selectStr+"/ig")).length - 1;
                                    if(showNum > 1){
                                        for (var j=0;j<showNum;j++) {
                                            dataStr += data.split(eval("/"+selectStr+"/ig"))[j] + "<i style='color:#03c339;font-weight:bold;'>" + selectStr + "</i>";
                                        }
                                        dataStr += data.split(eval("/"+selectStr+"/ig"))[showNum];
                                        return dataStr;
                                    }else{
                                        dataStr = data.split(eval("/"+selectStr+"/ig"))[0] + "<i style='color:#03c339;font-weight:bold;'>" + selectStr + "</i>" + data.split(eval("/"+selectStr+"/ig"))[1];
                                        return dataStr;
                                    }
                                }
                                //用户名
                                if(usersStr.userName.indexOf(selectStr) > -1){
                                    usersStr["userName"] = changeStr(usersStr.userName);
                                }
                                //用户邮箱
                                if(usersStr.userEmail.indexOf(selectStr) > -1){
                                    usersStr["userEmail"] = changeStr(usersStr.userEmail);
                                }
                                //性别
                                if(usersStr.userSex.indexOf(selectStr) > -1){
                                    usersStr["userSex"] = changeStr(usersStr.userSex);
                                }
                                //会员等级
                                if(usersStr.userGrade.indexOf(selectStr) > -1){
                                    usersStr["userGrade"] = changeStr(usersStr.userGrade);
                                }
                                if(usersStr.userName.indexOf(selectStr)>-1 || usersStr.userEmail.indexOf(selectStr)>-1 || usersStr.userSex.indexOf(selectStr)>-1 || usersStr.userGrade.indexOf(selectStr)>-1){
                                    userArray.push(usersStr);
                                }
                            }
                            usersData = userArray;
                            usersList(usersData);
                        }
                    })

                    layer.close(index);
                },2000);
            }else{
                layer.msg("请输入需要查询的内容");
            }
        })

        //添加会员
        $(".usersAdd_btn").click(function(){
            var index = layui.layer.open({
                title : "添加用户",
                type : 2,
                content : "users/add",
                success : function(layero, index){
                    layui.layer.tips('点击此处返回用户列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                }
            })
            //改变窗口大小时，重置弹窗的高度，防止超出可视区域（如F12调出debug的操作）
            $(window).resize(function(){
                layui.layer.full(index);
            })
            layui.layer.full(index);
        })

        //全选
        form.on('checkbox(allChoose)', function(data){
            var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
            child.each(function(index, item){
                item.checked = data.elem.checked;
            });
            form.render('checkbox');
        });

        //通过判断文章是否全部选中来确定全选按钮是否选中
        form.on("checkbox(choose)",function(data){
            var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
            var childChecked = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"]):checked')
            if(childChecked.length == child.length){
                $(data.elem).parents('table').find('thead input#allChoose').get(0).checked = true;
            }else{
                $(data.elem).parents('table').find('thead input#allChoose').get(0).checked = false;
            }
            form.render('checkbox');
        })

        //操作
        $("body").on("click",".users_edit",function(){  //编辑
            var _this = $(this);
            var index = layui.layer.open({
                title : "修改用户信息",
                type : 2,
                content : "{{ url('admin/users/edit') }}/"+_this.attr("data-id"),
                success : function(layero, index){
                    layui.layer.tips('点击此处返回用户列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                }
            })
            //改变窗口大小时，重置弹窗的高度，防止超出可视区域（如F12调出debug的操作）
            $(window).resize(function(){
                layui.layer.full(index);
            })
            layui.layer.full(index);
        })

        $("body").on("click",".users_del",function(){  //删除
            var _this = $(this);
            layer.confirm('确定删除此用户？',{icon:3, title:'提示信息'},function(index){
                $.post('{{ url("admin/users/destroy") }}/'+_this.attr("data-id"),{'_token':csrftoken},function (data) {
                    layer.msg(data);
                    layer.close(index);
                    _this.parents("tr").remove();
                }).error(function () {
                    layer.msg('出现错误！');
                    layer.close(index);
                });
            });
        })

        function usersList(){
            //渲染数据
            function renderDate(data,curr){
                var dataHtml = '';
                currData = usersData.concat().splice(curr*nums-nums, nums);
                if(currData.length != 0){
                    for(var i=0;i<currData.length;i++) {
                        if (currData[i].status == 1) {
                            currData[i].status = '启用';
                        } else {
                            currData[i].status = '停用';
                        }
                        dataHtml += '<tr>'
                            + '<td><input type="checkbox" name="checked" lay-skin="primary" lay-filter="choose"></td>'
                            + '<td>' + currData[i].name + '</td>'
                            + '<td>' + currData[i].email + '</td>'
                            + '<td>' + currData[i].status + '</td>'
                            + '<td>' + formatTime(currData[i].created_at) + '</td>'
                            + '<td>';
                        if (currData[i].name!='admin'){
                            dataHtml += '<a class="layui-btn layui-btn-mini users_edit" data-id="' + data[i].id + '"><i class="iconfont icon-edit"></i> 编辑</a>'
                                + '<a class="layui-btn layui-btn-danger layui-btn-mini users_del" data-id="' + data[i].id + '"><i class="layui-icon">&#xe640;</i> 删除</a>';
                        }
                        dataHtml +=  '</td>'
                            +'</tr>';
                    }
                }else{
                    dataHtml = '<tr><td colspan="8">暂无数据</td></tr>';
                }
                return dataHtml;
            }

            //分页
            var nums = 10; //每页出现的数据量
            laypage({
                cont : "page",
                pages : Math.ceil(usersData.length/nums),
                jump : function(obj){
                    $(".users_content").html(renderDate(usersData,obj.curr));
                    $('.users_list thead input[type="checkbox"]').prop("checked",false);
                    form.render();
                }
            })
        }

    });

    //格式化时间
    function formatTime(obj){
        var _time =  new Date(obj);
        var year = _time.getFullYear();
        var month = _time.getMonth()+1<10 ? "0"+(_time.getMonth()+1) : _time.getMonth()+1;
        var day = _time.getDate()<10 ? "0"+_time.getDate() : _time.getDate();
        var hour = _time.getHours()<10 ? "0"+_time.getHours() : _time.getHours();
        var minute = _time.getMinutes()<10 ? "0"+_time.getMinutes() : _time.getMinutes();
        return year+"-"+month+"-"+day+" "+hour+":"+minute;
    }
</script>
</body>
</html>