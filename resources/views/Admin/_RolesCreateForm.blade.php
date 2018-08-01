
<div class="layui-form-item">
    <label class="layui-form-label">名称</label>
    <div class="layui-input-block">
        <input type="text" name="name" value="{{ $role->name or null }}" lay-verify="required" autocomplete="off"  placeholder="请输入名称" class="layui-input">
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">显示名称</label>
    <div class="layui-input-block">
        <input type="text" name="display_name" value="{{ $role->display_name or null }}" lay-verify="required"  placeholder="请输入显示名称" autocomplete="off" class="layui-input">
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">描述</label>
    <div class="layui-input-block">
        <input type="text" name="description" value="{{ $role->description or null }}" placeholder="请输入描述" autocomplete="off" class="layui-input">
    </div>
</div>