<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>文章添加--35°后台管理模板</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="{{ URL::asset('public/layui/layui/css/layui.css') }}" media="all" />
    <link rel="stylesheet" href="{{ URL::asset('public/font-awesome/css/font-awesome.css') }}" media="all" />
</head>
<body class="childrenBody">
<form class="layui-form" id="submitPagesForm" action="">
    {{ csrf_field() }}
    <div class="layui-row">
        <div class="layui-col-md9">
            <div class="layui-form-item">
                <label class="layui-form-label">文章分类</label>
                <div class="layui-input-block">
                    <select name="class_id" class="layui-input">
                        @foreach($tree as $tr)
                            <option value="{{ $tr->class_id }}">{{ $tr->html }}{{ $tr->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">文章标题</label>
                <div class="layui-input-block">
                    <input type="text" name="title" value="{{ $info->title or null }}" class="layui-input newsName" lay-verify="required" placeholder="请输入文章标题">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">关键字</label>
                <div class="layui-input-block">
                    <input type="text" name="keywords" value="{{ $info->keywords or null }}" class="layui-input" placeholder="请输入文章关键字">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">内容摘要</label>
                <div class="layui-input-block">
                    <textarea name="describe" placeholder="请输入内容摘要" class="layui-textarea">{{ $info->describe or null }}</textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">文章内容</label>
                <div class="layui-input-block">
                    <div id="news_content">
                        {!! $info->content or null !!}
                    </div>
                    <textarea class="layui-hide" name="content" id="content">{{ $info->content or null }}</textarea>
                </div>
            </div>
        </div>
        <div class="layui-col-md3">
            <div class="layui-form-item">
                <label class="layui-form-label">封面图片</label>
                <div class="layui-upload-drag" id="uploadimg" @if(count($info)) @if($info->uploadpic) style="background: url('{{ $info->uploadpic }}') no-repeat;background-size: 100% 100%;" @endif @endif>
                    <i class="fa fa-cloud-upload"></i>
                    <p>点击上传，或将文件拖拽到此处</p>
                </div>
                <input type="hidden" name="uploadpic" id="uploadpic" value="{{ $info->uploadpic or null }}">
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">文章作者</label>
                <div class="layui-input-block">
                    <input type="text" name="author" class="layui-input newsAuthor" lay-verify="required" placeholder="请输入文章作者" value="{{ $info->author or $user->name }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">发布时间</label>
                <div class="layui-input-block">
                    <input type="text" name="create_time" class="layui-input newsTime" lay-verify="required" value="{{ $info->create_time or date('Y-m-d H:i:s',time()) }}">
                </div>
            </div>
        </div>
    </div>
    <div class="layui-row">
        <div class="layui-form-item">
            <div class="layui-input-block">
                <input type="hidden" name="page_id" value="{{ $info->id or null }}">
                <button class="layui-btn" lay-submit="" lay-filter="addNews">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript" src="{{ URL::asset('public/release/wangEditor.min.js') }}"></script>
<script type="text/javascript">
</script>
<script type="text/javascript" src="{{ URL::asset('public/layui/layui/layui.all.js') }}"></script>
<script>
    layui.config({
        base : "public/layui/js/"
    }).use(['form','layer','jquery','laydate','upload'],function(){
        var form = layui.form;
        var layer = parent.layer === undefined ? layui.layer : parent.layer,
            laydate = layui.laydate,
            layupload = layui.upload,
            $ = layui.jquery;


        var E = window.wangEditor;
        var editor = new E('#news_content');
        var $text1 = $('#content');
        editor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $text1.val(html);
        }
        editor.create();
        {{--editor.txt.html('');--}}
        // 初始化 textarea 的值
        $text1.val(editor.txt.html());



        layupload.render({
            elem: '#uploadimg'
            ,data : {'_token' : '{{ csrf_token() }}'}
            ,url: '{{ url('public/upload') }}'
            ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
                layer.load(); //上传loading
            }
            ,done: function(res) {
                layer.closeAll('loading');
                if (res.code == 1) {
                    layer.msg('上传成功');
                    $("#uploadimg").css('background','url({{ URL::asset('public/uploads') }}/'+res.img+') no-repeat');
                    $("#uploadimg").css('background-size','100% 100%');
                    $("#uploadpic").val("{{ URL::asset('public/uploads') }}/"+res.img);
                } else {
                    layer.msg(res.msg);
                }
            }
            ,error: function(index, upload){
                layer.closeAll('loading'); //关闭loading
            }
        });
        laydate.render({
            elem: '.newsTime',
            type:'datetime'
        });
        //监听提交
        form.on('submit(addNews)', function(data){
            var index = layer.msg('提交中，请稍候',{icon: 16,time:false,shade:0.8});
            $.post("{{ url('admin/pages/store') }}", $("#submitPagesForm").serialize(),function (data) {
                layer.close(index);
                layer.msg(data);
                layer.closeAll("iframe");
//                刷新父页面
                parent.location.reload();
            }).error(function (data) {
                layer.close(index);
                layer.msg("保存失败！");
            });
            return false;
        });
    })
</script>
</body>
</html>