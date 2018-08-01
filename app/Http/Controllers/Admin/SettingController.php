<?php

namespace App\Http\Controllers\Admin;

use App\Model\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting=Setting::first();
        return view('admin.SettingIndex',compact('setting'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $setting=Setting::first();
        if($setting){
            if($setting->update(Input::all())){
                return '保存成功';
            }else{
                return '保存失败';
            }
        }else{
            if(Setting::create(Input::all())){
                return '创建成功';
            }else{
                return '创建失败';
            }
        }
//        $setting->title = $request->title;
//        $setting->keywords = $request->keywords;
//        $setting->description = $request->description;
//        $setting->site_icp = $request->site_icp;
//        $setting->site_tongji = $request->site_tongji;
//        $setting->site_copyright = $request->site_copyright;
//        if($setting->save()){
//        }else{
//        }
    }
}
