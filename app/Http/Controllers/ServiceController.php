<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::orderBy('id','desc')->paginate(20);
        return view('service.index')->with('services',$services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service.create');
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
            'name' => 'required'
        ]);

        $serivce = Service::create(['name' => $request->name]);
        if($serivce){
            return back()->with('success','تم حفظ الخدمة بنجاح');
        }else {
            return back()->with('error','حصل خطاء حاول مرة اخري');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('service.edit')->with('service',$service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);

        
        if($service->update(['name' => $request->name])){
            return back()->with('success','تم تحديث الخدمة بنجاح');
        }else {
            return back()->with('error','حصل خطاء حاول مرة اخري');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success','تم حذف الخدمة بنجاح');
    }


    public function getService(Request $request)
    {
        $response = array();

       
        if($request->search == ''){
            $services = Service::orderBy('id','desc')->limit(5)->get();
        }else {
            $services = Service::where('name','like',"%".$request->search."%")->get();

        }

        foreach ($services as $service) {
            $response[] = array(
               'id' => $service->id ,
               'text' => $service->name
            );
        }

        echo json_encode($response);
    }
}
