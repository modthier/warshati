<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceTypeFormRequest;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('serviceType.index')->with('serviceTypes',serviceType::all());
    }

    public function create()
    {
        return view('serviceType.create');
    }

    
    public function store(ServiceTypeFormRequest $request)
    {
        if(ServiceType::create($request->validated())){
            return redirect()->route('serviceType.index')->with('success','تم حفظ نوع الخدمة');
        }else {
            return back();
        }
    }

   
    public function show(ServiceType $serviceType)
    {
        return view('serviceType.show')->with('serviceType',$serviceType);
    }

    
    public function edit(ServiceType $serviceType)
    {
        return view('serviceType.edit')->with('serviceType',$serviceType);
    }

    
    public function update(Request $request, ServiceType $serviceType)
    {
        if($serviceType->update($request->validated())){
            return redirect()->route('serviceType.index')->with('success','تم تحديث نوع الخدمة');
        }else {
            return back();
        }
    }

   
    public function destroy(ServiceType $serviceType)
    {
        //
    }
}
