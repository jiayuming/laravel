<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>文章管理--35°后台管理</title>
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
        <div class="layui-input-inline">
            <input type="text" value="" placeholder="请输入关键字" class="layui-input search_input">
        </div>
        <a class="layui-btn search_btn">查询</a>
    </div>
    <div class="layui-inline">
        <a class="layui-btn layui-btn-normal PagesAdd_btn">添加文章</a>
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
            <col width="20%">
            <col width="10%">
            <col width="10%">
            <col width="100px">
            <col width="200px">
        </colgroup>
        <thead>
        <tr>
            <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" id="allChoose"></th>
            <th>标题</th>
            <th>分类</th>
            <th>封面图片</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody class="users_content"></tbody>
    </table>
</div>
<div id="page"></div>
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
        var dataCount=0;
        var current_page=0;
        $.post("{{ url('admin/page') }}?page=1",{'_token':'{{ csrf_token() }}'}, function(data){
            usersData = data.data;
            dataCount = data.total;
            current_page = data.current_page;
            //执行加载数据的方法
            usersList();
            usersList();
        })
        var staticKeyword='';
        function getContent(mypage,pagekeywords) {
            if(staticKeyword){
                pagekeywords=staticKeyword;
            }
            $.post("{{ url('admin/page') }}?page="+mypage,{'_token':'{{ csrf_token() }}','keywords':pagekeywords}, function(data){
                usersData = data.data;
                dataCount = data.total;
                current_page = data.current_page;
                //执行加载数据的方法
                usersList();
            });

        }


        //批量删除
        $(".batchDel").click(function(){
            var $checkbox = $('.news_list tbody input[type="checkbox"][name="checked"]');
            var checkID = [];
            $('.news_list tbody input[type="checkbox"][name="checked"]:checked').each(function(i){//把所有被选中的复选框的值存入数组
                checkID[i] =$(this).parents("tr").find(".pages_del").attr("data-id");
            });
            if($checkbox.is(":checked")){
                layer.confirm('确定删除选中的信息？',{icon:3, title:'提示信息'},function(index){
                    var index = layer.msg('删除中，请稍候',{icon: 16,time:false,shade:0.8});
                        //删除数据

                    $.post("{{ url('admin/page/allDelete') }}",{'_token':'{{ csrf_token() }}','ids':checkID}, function(data){
                        $('.news_list thead input[type="checkbox"]').prop("checked",false);
                        form.render();
                        if(data.status==1){
                            layer.close(index);
                            layer.msg("删除成功");
                            setTimeout("window.location.reload()",1000);
                        }else{
                            layer.close(index);
                            layer.msg("删除失败");
                        }
                    });
                })
            }else{
                layer.msg("请选择需要删除的文章");
            }
        })
        //添加角色
        $(".PagesAdd_btn").click(function(){
            var index = layui.layer.open({
                title : "添加页面",
                type : 2,
                content : "{{ url('admin/page/add') }}",
                success : function(layero, index){
                    layui.layer.tips('点击此处返回页面列表', '.layui-layer-setwin .layui-layer-close', {
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
        $("body").on("click",".pages_edit",function(){  //编辑
            var _this = $(this);
            var index = layui.layer.open({
                title : "修改页面信息",
                type : 2,
                content : "{{ url('admin/page/edit') }}/"+_this.attr("data-id"),
                success : function(layero, index){
                    layui.layer.tips('点击此处返回页面列表', '.layui-layer-setwin .layui-layer-close', {
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

        $("body").on("click",".pages_del",function(){  //删除
            var _this = $(this);
            layer.confirm('确定删除此页面？',{icon:3, title:'提示信息'},function(index){
                $.post('{{ url("admin/page/destroy") }}/'+_this.attr("data-id"),{'_token':'{{ csrf_token() }}'},function (data) {
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

        $("body").on("click",'.search_btn',function () {
            staticKeyword=$(".search_input").val();
            staticClass=$(".search_class").find("option:selected").val();
            getContent(1,$(".search_input").val(),$(".search_class").find("option:selected").val());
        })
        function usersList(){
            //渲染数据
            function renderDate(data){
                var dataHtml = '';
                currData = usersData;
                if(currData.length != 0){
                    for(var i=0;i<currData.length;i++) {
                        dataHtml += '<tr>'
                            + '<td><input type="checkbox" name="checked" lay-skin="primary" lay-filter="choose"></td>'
                            + '<td>' + currData[i].title + '</td>'
                            + '<td>' + currData[i].name + '</td>';
                        if(currData[i].uploadpic){
                            dataHtml +='<td><img src="' + currData[i].uploadpic + '" height="40"></td>';
                        }else{
                            dataHtml +='<td class="layui-word-aux">NO PIC</td>';
                        }
                        dataHtml += '<td>' + currData[i].create_time + '</td>'
                            + '<td>';
                        if (currData[i].name!='admin'){
                            dataHtml += '<a class="layui-btn layui-btn-mini pages_edit" data-id="' + data[i].id + '"><i class="fa fa-pencil-square-o"></i> 编辑</a>'
                                + '<a class="layui-btn layui-btn-danger layui-btn-mini pages_del" data-id="' + data[i].id + '"><i class="layui-icon">&#xe640;</i> 删除</a>';
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
                pages : Math.ceil(dataCount/nums),
                curr : current_page,
                jump : function(obj,first){
                    $(".users_content").html(renderDate(usersData));
                    $('.users_list thead input[type="checkbox"]').prop("checked",false);
                    form.render();
                    if(!first){ //点击跳页触发函数自身，并传递当前页：obj.curr
                        getContent(obj.curr);
                    }
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