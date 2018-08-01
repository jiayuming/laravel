<?php

namespace App\Http\Controllers\Admin;

use App\Model\Page;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PageController extends Controller
{

    public function index(Request $request)
    {
        if($request->isMethod('post')){
            $list=Page::where(
                function ($query) use($request){
                    if($request->keywords){
                        $query->where('title','like','%'.$request->keywords.'%');
                    }
                })->paginate(10);
            return $list;
        }else{
            return view('admin.PageIndex');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=Auth::user();
        $info=null;
        return view('admin.PageCreate',compact('user','info'));
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
            $page=Page::findOrFail($request->page_id);
            if($page->update(Input::all())){
                return '保存成功';
            }else{
                return '保存失败';
            }
        }else{
            if(Page::create(Input::all())){
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
        $info=Page::findOrFail($id);
        return view('admin.PageCreate',compact('info'));
    }

    public function allDelete(Request $request)
    {
        if(Page::whereIn('id',$request->ids)->delete()){
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
        if(Page::findOrFail($id)->delete()){
            return response()->json(['status'=>1,'msg'=>'删除成功']);
        }else{
            return response()->json(['status'=>0,'msg'=>'该分类还有子类，无法删除']);
        }
    }
}
