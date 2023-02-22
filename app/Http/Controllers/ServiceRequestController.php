<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Worker;
use App\Models\CarSize;
use App\Models\Service;
use App\Models\WorkerRatio;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\ServiceRequest;
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
            'payments' => PaymentMethod::all(),
            'workers' => Worker::all()     
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
            'total' => 'required',
            'payment_method_id' => 'required',
            'worker_id' => 'required',
            'client_id' => 'required',
            'car_id' => 'required'
       ]);

       if($validator->fails()){
            return back()->with('error',$validator->errors());
       }

    //    DB::beginTransaction();
       
    //     try {
          $serviceRequest = ServiceRequest::create([
            'client_id' => $request->client_id,
            'amount' => $request->total,
            'payment_method_id' => $request->payment_method_id,
            'car_size_id' => $request->car_id,
            'worker_id' => $request->worker_id,

        ]);
          foreach ($request->services as $id => $price) {
            $service = Service::findOrFail($id);
            if($service->service_type->has_ratio){
                $car = CarSize::findOrFail($request->car_id);
                $ratio = $price['price'] * ($car->worker_ratio / 100);
                WorkerRatio::create([
                    'service_request_id' => $serviceRequest->id,
                    'service_id' => $id,
                    'amount' => $ratio,
                    'worker_id' => $request->worker_id
                ]);
            }
            $details = ['price' =>  $price['price']];
            $serviceRequest->service()->attach($id,$details);
          }

        //    DB::commit();
        //    return redirect()->route('service_request.show',$serviceRequest->id)->with('success','تم حفظ عملية البيع بنجاح');
        // } catch (Exception $e) {
        //    DB::rollBack();
        //    return back()->with('error','حصل خطاء حاول مرة اخري');
        // }
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
