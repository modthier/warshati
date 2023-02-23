<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first()->get();
        
        return view('setting.index')->with([
            'setting' =>  $setting 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);

        $setting = new Setting;
        $setting->name = $request->name;
        $setting->address = $request->address;
        $setting->phone = $request->phone;
        $setting->save();


        if($setting){
           
            return redirect()->route('setting.index')->with('success','تم حفظ بيانات المتجر بنجاح');
        }else {
            return redirect()->route('setting.create')->with('error','حصل خطاء حاول مرة اخري');
        }
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('setting.edit')->with('setting',$setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $this->validate($request,[
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);

        if($setting->update($request->only(['name','address','phone']))){
            
            return redirect()->route('setting.index')->with('success','تم تحديث بيانات المتجر بنجاح');
        }else {
            return redirect()->route('setting.create')->with('error','حصل خطاء حاول مرة اخري');
        }
    }

    public function showSetting()
    {
        return view('setting.showSetting');
    }
}
