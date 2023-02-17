<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Throwable;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order.index')->with([
            'orders' => Order::withCount('stock')->orderBy('id','desc')->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create');
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
            $order->stock()->detach();
            $order->delete();
       }

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
        $order->stock()->detach();
        $order->delete();
        return back()->with('success','تم حذف الطلب بنجاح');
    }
}
