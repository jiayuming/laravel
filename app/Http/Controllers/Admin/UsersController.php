<?php

namespace App\Http\Controllers\Admin;

use App\Model\Role;
use App\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->isMethod('post')){
            return response()->json(User::get());
        }else {
//            dd($request->route()->getAction());
            return view('admin.UsersIndex');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles =Role::all();
        $user = NULL;
        return view('admin.UsersCreate',compact('roles','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->userid) {
            $user=User::findOrFail($request->userid);
            $user->name= $request->name;
            $user->email = $request->email;
            $user->status = $request->status;
            $user->password = bcrypt($request->password);
            $user->save();

            if($request->roles){
                $user->roles()->sync($request->roles);
            }else{
                $user->roles()->detach();
            }

            return '保存成功';
        }else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'status' => $request->status,
                'password' => bcrypt($request->password),
            ]);
            if($request->roles){
                $user->roles()->sync($request->roles);
            }else{
                $user->roles()->detach();
            }
            if ($user) {
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
        $roles=Role::all();
        $user=User::with("roles.perms")->find($id);
        return view('admin.UsersCreate',compact('user','roles'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        if($user){
            $user->delete();
            return '删除成功';
        }else{
            return '无效用户';
        }
    }
}
