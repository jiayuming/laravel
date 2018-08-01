<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>菜单管理--35°后台管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="{{ URL::asset('public/layui/layui/css/layui.css') }}" media="all" />
    <link rel="stylesheet" href="{{ URL::asset('public/font-awesome/css/font-awesome.css') }}" media="all" />
    <link rel="stylesheet" href="{{ URL::asset('public/layui/css/user.css') }}" media="all" />
</head>
<body class="childrenBody">
<blockquote class="layui-elem-quote news_search">
    <div class="layui-inline">
        <a class="layui-btn layui-btn-normal menusAdd_btn">添加菜单</a>
    </div>
    <div class="layui-inline">
        <div class="layui-form-mid layui-word-aux">　</div>
    </div>
</blockquote>
<div class="layui-form news_list">
    <table class="layui-table">
        <colgroup>
            <col width="50%">
            <col width="100px">
            <col width="200px">
        </colgroup>
        <thead>
        <tr>
            <th>分类名称</th>
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
        $.post("{{ url('admin/menus') }}",{'_token':csrftoken}, function(data){
            usersData = data;
            //执行加载数据的方法
            usersList();
        })

        //添加角色
        $(".menusAdd_btn").click(function(){
            var index = layui.layer.open({
                title : "添加菜单",
                type : 2,
                content : "{{ url('admin/menus/add') }}",
                success : function(layero, index){
                    layui.layer.tips('点击此处返回菜单列表', '.layui-layer-setwin .layui-layer-close', {
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

        //操作
        $("body").on("click",".menus_edit",function(){  //编辑
            var _this = $(this);
            var index = layui.layer.open({
                title : "修改菜单信息",
                type : 2,
                content : "{{ url('admin/menus/edit') }}/"+_this.attr("data-id"),
                success : function(layero, index){
                    layui.layer.tips('点击此处返回菜单列表', '.layui-layer-setwin .layui-layer-close', {
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

        $("body").on("click",".menus_del",function(){  //删除
            var _this = $(this);
            layer.confirm('确定删除此菜单？',{icon:3, title:'提示信息'},function(index){
                $.post('{{ url("admin/menus/destroy") }}/'+_this.attr("data-id"),{'_token':csrftoken},function (data) {
                    if(data.status==1){
                        layer.msg(data.msg);
                        layer.close(index);
                        _this.parents("tr").remove();
                    }else{
                        layer.msg(data.msg);
                        layer.close(index);
                    }
                }).error(function () {
                    layer.msg('出现错误！');
                    layer.close(index);
                });
            });
        })

        function usersList(){
            //渲染数据
            function renderDate(data){
                var dataHtml = '';
                currData = usersData;
                if(currData.length != 0){
                    for(var i=0;i<currData.length;i++) {
                        if (currData[i].status == 1) {
                            currData[i].status = '启用';
                        } else {
                            currData[i].status = '停用';
                        }
                        dataHtml += '<tr>'
                            + '<td class="layui-tab">' + currData[i].html + currData[i].name + '</td>'
                            + '<td>' + formatTime(currData[i].created_at) + '</td>'
                            + '<td>'
                            + '<a class="layui-btn layui-btn-mini menus_edit" data-id="' + currData[i].id + '"><i class="fa fa-pencil-square-o"></i> 编辑</a>'
                            + '<a class="layui-btn layui-btn-danger layui-btn-mini menus_del" data-id="' + currData[i].id + '"><i class="layui-icon">&#xe640;</i> 删除</a>'
                            + '</td>'
                            +'</tr>';
                    }
                }else{
                    dataHtml = '<tr><td colspan="8">暂无数据</td></tr>';
                }
                return dataHtml;
            }
            $(".users_content").html(renderDate(usersData));
            form.render();
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