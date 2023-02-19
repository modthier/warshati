<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceType;
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
        return view('service.create')->with('serviceTypes',ServiceType::all());
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
            'service_type_id' => 'required|exists:service_types,id'
        ]);

        $serivce = Service::create(['name' => $request->name , 'service_type_id' => $request->service_type_id]);
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
        return view('service.edit')->with([
            'service' => $service,
            'serviceTypes' => ServiceType::all()
        ]
            
        );
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
            'name' => 'required',
            'service_type_id' => 'required|exists:service_types,id'
        ]);

        
        if($service->update(['name' => $request->name , 'service_type_id' => $request->service_type_id])){
            return back()->with('success','تم تحديث الخدمة بنجاح');
        }else {
            return back()->with('error','حصل خطاء حاول مرة اخري');
        }
    }

   
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
