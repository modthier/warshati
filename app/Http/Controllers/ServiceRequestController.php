<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\CarSize;
use App\Models\PaymentMethod;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           
        return view('service_request.create')->with([
            'carSizes' => CarSize::all(),  
            'payments' => PaymentMethod::all()       
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'services' => 'array|required',
            'price-*' => 'required',
            'serviceTotal' => 'required'
       ]);

       if($validator->fails()){
            return back()->with('error',$validator->getMessageBag());
       }

       DB::beginTransaction();
       
        try {
          $serviceRequest = ServiceRequest::create(['clinet_id' => $request->client_id,'amount' => $request->total]);
          foreach ($request->services as $id) {
            
            $details = ['price' =>  $request->input('price-'.$id),
                         'car_size_id' => $request->input('car_size-'.$id)];
            $serviceRequest->service()->attach($id,$details);
          }

           DB::commit();
           return redirect()->route('order.show',$serviceRequest->id)->with('success','تم حفظ عملية البيع بنجاح');
        } catch (Exception $th) {
           DB::rollBack();
           return back()->with('error','حصل خطاء حاول مرة اخري');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceRequest $serviceRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceRequest $serviceRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceRequest $serviceRequest)
    {
        //
    }
}
