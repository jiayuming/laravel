<?php

namespace App\Http\Controllers\Admin;

use App\Model\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PermissionsController extends BaseController
{
    public function index(Request $request)
    {
        if($request->isMethod('post')){
            return response()->json(Permission::all());
        }else{
            return view('admin.PermsIndex');
        }
    }

    public function create()
    {
        return view('admin.PermsCreate');
    }

    public function store(Request $request)
    {

        if($request->permid) {
            $perm=Permission::findOrFail($request->permid);
            $perm->name= $request->name;
            $perm->display_name = $request->display_name;
            $perm->description = $request->description;
            if ($perm->save()) {
                return '保存成功';
            } else {
                return '保存失败';
            }
        }else{
            $perm=Permission::create([
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description' => $request->description
            ]);
            if ($perm) {
                return '创建成功';
            } else {
                return '创建失败';
            }

        }
    }

    public function edit($id)
    {
        $perm=Permission::find($id);
        return view('admin.PermsCreate',compact('perm'));
    }

    public function destroy($id)
    {
        $perm=Permission::find($id);
        if($perm){
            $perm->delete();
            return '删除成功';
        }else{
            return '无效权限';
        }
    }
}
