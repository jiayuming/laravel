<?php

namespace App\Http\Controllers\Admin;

use App\Model\Menus;
use App\Model\Page;
use App\Model\Pagesclass;
use App\Model\Tree;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class MenusController extends Controller
{
    public function index(Request $request)
    {
        if($request->isMethod('post')){
            $tree=Tree::createMenusTree(Menus::all());
            return response()->json($tree);
        }else{
            return view('admin.MenusIndex');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_class=Tree::createLevelTree(Pagesclass::all());
        $class=Tree::createMenusTree(Menus::all());
        $pages=Page::all();
        $info=NULL;
        return view('admin.MenusCreate',compact("class","info","page_class","pages"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->menus_id){

            $menus=Menus::findOrFail($request->menus_id);
            if($menus->update(Input::all())){
                return '保存成功';
            }else{
                return '保存失败';
            }
        }else{
            if(Menus::create(Input::all())){
                return '创建成功';
            }else{
                return '创建失败';
            }
        }
    }

    public function edit($id)
    {
        $page_class=Tree::createLevelTree(Pagesclass::all());
        $class=Tree::createMenusTree(Menus::all());
        $pages=Page::all();
        $info=Menus::find($id);
        return view('admin.MenusCreate',compact("class",'info','page_class','pages'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Menus::where('parent_id',$id)->first()){
            return response()->json(['status'=>0,'msg'=>'该菜单还有子菜单，无法删除']);
        }else{
            if(Menus::findOrFail($id)->delete()){
                return response()->json(['status'=>1,'msg'=>'删除成功']);
            }else{
                return response()->json(['status'=>0,'msg'=>'无法删除']);
            }
        }
    }
}
