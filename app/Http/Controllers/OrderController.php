<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Stock;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = new Order();
        $total = $order->whereBetween('created_at',[Carbon::now()->startOfYear(),Carbon::now()->endOfYear()])->sum('total');
        $today = $order->whereDate('created_at',today())->sum('total');
        $week = $order->whereBetween('created_at',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->sum('total');
        $month = $order->whereBetween('created_at',[Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->sum('total');

        $orders = Order::withCount('stock')->orderBy('id','desc')->paginate(20);

        return view('order.index')->with([
            'orders' => $orders ,
            'total' => $total ,
            'today' => $today,
            'week' => $week,
            'month' => $month

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create')->with([
          'payments' => PaymentMethod::all(),
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
            'stocks' => 'array|required',
            'purchase_price-*' => 'required',
            'selling_price-*' => 'required',
            'total' => 'required'
       ]);

       if($validator->fails()){
            return back()->with('error',$validator->getMessageBag());
       }

       $errors = Stock::checkStock($request->stocks);
       if($errors){
         return back()->with('error',$errors);
       }

       DB::beginTransaction();
       
        try {
          if($request->has('service_request_id')){
            $service_request = Order::where('service_request_id',$request->service_request_id)->first();
            if($service_request) {
              $total = $request->total + $service_request->total;
              $service_request->update(['total' => $total]);

              foreach ($request->stocks as $id => $quantity) {
            
                $details = ['quantity' => $quantity['quantity'] ,'selling_price' => $request->input('selling_price-'.$id),
                             'purchase_price' => $request->input('purchase_price-'.$id)];
                $service_request->stock()->attach($id,$details);
                $stock = Stock::findOrFail($id);
    
                $new_stock = $stock->quantity - $quantity['quantity'];
               
               $stock->update([
                 'quantity' => $new_stock
               ]);
              }
            }else {
              $order = Order::create(['total' => $request->total , 'service_request_id' => $request->service_request_id,'user_id' => auth()->user()->id]);
              foreach ($request->stocks as $id => $quantity) {
            
                $details = ['quantity' => $quantity['quantity'] ,'selling_price' => $request->input('selling_price-'.$id),
                             'purchase_price' => $request->input('purchase_price-'.$id)];
                $order->stock()->attach($id,$details);
                $stock = Stock::findOrFail($id);
    
                $new_stock = $stock->quantity - $quantity['quantity'];
               
               $stock->update([
                 'quantity' => $new_stock
               ]);
              }
            }
            
          } // service request id is null
          else  {
           
            $order = Order::create(['total' => $request->total,'payment_method_id' => $request->payment_method_id,'user_id' => auth()->user()->id]);
            foreach ($request->stocks as $id => $quantity) {
            
              $details = ['quantity' => $quantity['quantity'] ,'selling_price' => $request->input('selling_price-'.$id),
                           'purchase_price' => $request->input('purchase_price-'.$id)];
              $order->stock()->attach($id,$details);
              $stock = Stock::findOrFail($id);
  
              $new_stock = $stock->quantity - $quantity['quantity'];
             
             $stock->update([
               'quantity' => $new_stock
             ]);
            }
          }
          
          

           DB::commit();
           if($request->has('service_request_id') && !empty($request->has('service_request_id'))){
            return redirect()->route('service_request.show',$request->service_request_id)->with('success','تم اضافة منتجات للخدمة بنجاح');
           }else {
             return redirect()->route('order.show',$order->id)->with('success','تم حفظ عملية البيع بنجاح');
           }
           
        } catch (Exception $th) {
           DB::rollBack();
           return back()->withErrors($th->getErrors());
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $orderWith = Order::withCount('stock')->where('id',$order->id)->first();
        return view('order.show')->with('order',$orderWith);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('order.edit')->with('order',$order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(),[
            'stocks' => 'array|required',
            'purchase_price-*' => 'required',
            'selling_price-*' => 'required',
            'total' => 'required'
       ]);

       if($validator->fails()){
            return back()->with('error',$validator->getMessageBag());
       }

       foreach ($order->stock as $stock) {
            $new_stock = $stock->quantity + $stock->pivot->quantity;
            $stock->update([
            'quantity' => $new_stock
            ]);
          
       }
       $order->stock()->detach();
       $order->delete();

       $errors = Stock::checkStock($request->stocks);
       if($errors){
         return back()->with('error',$errors);
       }

       DB::beginTransaction();
       
        try {
          $order = Order::create(['total' => $request->total]);
          foreach ($request->stocks as $id => $quantity) {
            
            $details = ['quantity' => $quantity['quantity'] ,'selling_price' => $request->input('selling_price-'.$id),
                         'purchase_price' => $request->input('purchase_price-'.$id)];
            $order->stock()->attach($id,$details);
            $stock = Stock::findOrFail($id);

            $new_stock = $stock->quantity - $quantity['quantity'];
           
           $stock->update([
             'quantity' => $new_stock
           ]);
          }

           DB::commit();
           return redirect()->route('order.show',$order->id)->with('success','تم حفظ عملية البيع بنجاح');
        } catch (Throwable $th) {
           DB::rollBack();
           return back()->with('error','حصل خطاء حاول مرة اخري');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        foreach ($order->stock as $stock) {

          $new_stock = $stock->quantity + $stock->pivot->quantity;
          $stock->update([
             'quantity' => $new_stock
          ]);

        }
        $order->stock()->detach();
        $order->delete();
        return back()->with('success','تم حذف الطلب بنجاح');
    }
}
