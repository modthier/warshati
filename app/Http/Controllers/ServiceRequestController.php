<?php

namespace App\Http\Controllers;

use App\Models\Ratio;
use Exception;
use App\Models\Order;
use App\Models\Worker;
use App\Models\CarSize;
use App\Models\Service;
use App\Models\WorkerRatio;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service_requests = ServiceRequest::orderBy('id','desc')->paginate(20);
        $today_service = ServiceRequest::whereDate('created_at',today())->sum('amount');
        $week_service = ServiceRequest::whereBetween('created_at',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->sum('amount');
        $month_service = ServiceRequest::whereBetween('created_at',[Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->sum('amount');
        return view('service_request.index')->with([
            'service_requests' => $service_requests,
            'today_service' => $today_service,
            'week_service' => $week_service,
            'month_service' => $month_service,
        ]);
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

       DB::beginTransaction();
       
        try {
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
                $car = Ratio::where('service_type_id',$service->service_type_id)->where('car_size_id',$request->car_id)->first();
                $ratio = $price['price'] * ($car->ratio / 100);
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

           DB::commit();
           return redirect()->route('service_request.show',$serviceRequest->id)->with('success','تم حفظ الخدمة بنجاح');
        } catch (Exception $e) {
           DB::rollBack();
           return back()->withErrors($e->getMessage());
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
        return view('service_request.show')->with([
            'service' => $serviceRequest,
            'setting' => \App\Models\Setting::all()
        ]);
    }

    
    public function edit(ServiceRequest $serviceRequest)
    {
        //
    }

   
    public function update(Request $request, ServiceRequest $serviceRequest)
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
       
        if($serviceRequest->order){
            $order = Order::find($serviceRequest->order->id);
            $order->stock()->detach();
            $order->delete();
        }
        $serviceRequest->workerRatio->delete();
        $serviceRequest->delete();

        DB::beginTransaction();
       
        try {
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

           DB::commit();
           return redirect()->route('service_request.show',$serviceRequest->id)->with('success','تم حفظ الخدمة بنجاح');
        } catch (Exception $e) {
           DB::rollBack();
           return back()->with('error','حصل خطاء حاول مرة اخري');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceRequest $serviceRequest)
    {
        if($serviceRequest->order){
            $order = Order::find($serviceRequest->order->id);
            foreach ($order->stock as $stock) {

                $new_stock = $stock->quantity + $stock->pivot->quantity;
                $stock->update([
                   'quantity' => $new_stock
                ]);
      
            }
              $order->stock()->detach();
              $order->delete();
        }
        $serviceRequest->workerRatio()->delete();
        $serviceRequest->delete();
        return back()->with('success','تم حذف الخدمة بنجاح');
    }


    public function addProduct(ServiceRequest $serviceRequest)
    {
        return view('service_request.addProduct')->with('serviceRequest',$serviceRequest);
    }


   
    
}
