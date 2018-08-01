<?php

namespace App\Http\Controllers\Admin;

use App\Model\Pages;
use App\Model\Pagesclass;
use App\Model\Tree;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesclassController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->isMethod('post')){
            $tree=Tree::createLevelTree(Pagesclass::all());
            return response()->json($tree);
        }else{
            return view('admin.PagesclassIndex');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class=Tree::createLevelTree(Pagesclass::all());
        $info=NULL;
        return view('admin.PagesclassCreate',compact("class","info"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->class_id){

            $pagesclass=Pagesclass::findOrFail($request->class_id);
            $pagesclass->name= $request->name;
            $pagesclass->parent_id = $request->parent_id;
            if($pagesclass->save()){
                return '保存成功';
            }else{
                return '保存失败';
            }
        }else{
            $pagesclass=Pagesclass::create([
                'name'=>$request->name,
                'parent_id'=>$request->parent_id
            ]);
            if($pagesclass){
                return '创建成功';
            }else{
                return '创建失败';
            }
        }
    }

    public function edit($id)
    {
        $class=Pagesclass::all();
        $info=Pagesclass::find($id);
        return view('admin.PagesclassCreate',compact("class",'info'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Pagesclass::where('parent_id',$id)->first()){
            return response()->json(['status'=>0,'msg'=>'该分类还有子类，无法删除']);
        }else{
            if(Pages::where('class_id',$id)->first()){
                return response()->json(['status'=>0,'msg'=>'该分类还有文章，无法删除']);
            }else{
                if(Pagesclass::findOrFail($id)->delete()){
                    return response()->json(['status'=>1,'msg'=>'删除成功']);
                }else{
                    return response()->json(['status'=>0,'msg'=>'该分类还有子类，无法删除']);
                }
            }
        }
    }
}
