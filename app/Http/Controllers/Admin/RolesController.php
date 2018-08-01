<?php

namespace App\Http\Controllers\Admin;

use App\Model\Permission;
use App\Model\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RolesController extends BaseController
{
    public function index(Request $request)
    {
        if($request->isMethod('post')){
            return response()->json(Role::with('perms')->get());
        }else{
            return view('admin.RolesIndex');
        }
    }

    public function create()
    {
        $perms=Permission::all();
        return view('admin.RolesCreate',compact('perms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->roleid) {
            $role= Role::findOrFail($request->roleid);
            if($role->name!='admin'){
                $role->name = $request->name;
            }
            $role->display_name = $request->display_name;
            $role->description = $request->description;

            $role->save();
            if($request->perm) {
                $role->savePermissions($request->perm);
            }
            return '保存成功';
        }else{
            $role=Role::create([
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description' => $request->description
            ]);

            if($request->perm){
                $role->attachPermissions($request->perm);
            }
            if ($role) {
                return '创建成功';
            } else {
                return '创建失败';
            }

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role=Role::find($id);
        $perms=Permission::all();
        return view('admin.RolesEdit',compact('perms','role'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role=Role::findOrFail($id);
        if($role->name!='admin'){
            $role->delete();
            return '删除成功';
        }else{
            return '系统角色不允许删除';
        }
    }
}
