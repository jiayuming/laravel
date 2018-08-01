<?php

namespace App\Http\Controllers\Admin;

use App\Model\Pages;
use App\Model\Pagesclass;
use App\Model\Tree;
use function foo\func;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PagesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->isMethod('post')){
            $list=Pages::leftJoin('pages_class','pages.class_id','=','pages_class.class_id')->where(
                function ($query) use($request){
                    if($request->keywords){
                        $query->where('pages.title','like','%'.$request->keywords.'%');
                    }
                    if($request->staticClass){
                        $query->where('pages.class_id','=',$request->staticClass);
                    }
                })->paginate(10);
            return $list;
        }else{
            $classList=Tree::createLevelTree(Pagesclass::all());
            return view('admin.PagesIndex',compact('classList'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tree=Tree::createLevelTree(Pagesclass::all());
        $user=Auth::user();
        $info=null;
        return view('admin.PagesCreate',compact('tree','user','info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->page_id){
            $page=Pages::findOrFail($request->page_id);
            if($page->update(Input::all())){
                return '保存成功';
            }else{
                return '保存失败';
            }
        }else{
            if(Pages::create(Input::all())){
                return '创建成功';
            }else{
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
        $tree=Tree::createLevelTree(Pagesclass::all());
        $info=Pages::findOrFail($id);
        return view('admin.PagesCreate',compact('info','tree'));
    }

    public function allDelete(Request $request)
    {
       if(Pages::whereIn('id',$request->ids)->delete()){
           return response()->json(['status'=>1]);
       }else{
           return response()->json(['status'=>0]);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Pages::findOrFail($id)->delete()){
            return response()->json(['status'=>1,'msg'=>'删除成功']);
        }else{
            return response()->json(['status'=>0,'msg'=>'该分类还有子类，无法删除']);
        }
    }
}
