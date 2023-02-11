<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('purchase.index')->with([
            'purchases' => Purchase::orderBy('id','desc')->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchase.create');
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
            'products' => 'required',
            'quantity_per_unit-*' => 'required',
            'selling_price-*' => 'required',
            'subtotal-*' => 'required',
            'total' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $quantity = 0;
            foreach ($request->products as $id => $guan) {
                $quantity = $quantity + $guan['quantity'];
            }
           
            $purchase = Purchase::create([
                'total' => $request->total,
                'quantity' => $quantity,
                'supplier' => $request->supplier
            ]);


            foreach ($request->products as $id => $quantity ) {
               $stockExist = Stock::where('product_id',$id)->first();
               if($stockExist){
                    $stockExist->update([
                        'quantity' => $request->input('quantity_per_unit-'.$id) + $stockExist->quantity,
                        'selling_price' => $request->input('selling_price-'.$id),
                        'purchase_price' => $request->input('purchase_price-'.$id),
                    ]);

                    $purchase->stock()->attach($stockExist->id,[
                        'product_id' => $id ,
                        'quantity' => $quantity['quantity'],
                        'quantity_per_unit' => $request->input('quantity_per_unit-'.$id),
                        'subtotal' =>  $request->input('subtotal-'.$id),
                    ]);
                }else {
                    $stock = Stock::create([
                        'product_id' => $id ,
                        'quantity' => $request->input('quantity_per_unit-'.$id),
                        'purchase_price' => $request->input('purchase_price-'.$id),
                        'selling_price' => $request->input('selling_price-'.$id),
                        
                    ]);

                   $purchase->stock()->attach($stock->id,[
                        'product_id' => $id ,
                        'quantity' => $quantity['quantity'],
                        'quantity_per_unit' => $request->input('quantity_per_unit-'.$id),
                        'subtotal' =>  $request->input('subtotal-'.$id),
                  ]);
               }
               
            }

            DB::commit();
            return redirect()->route('purchase.index')->with('success','تم حفظ فاتورة الشراء بنجاح');


        } catch (\Exception $e) {
           DB::rollBack();
           return back()->with('error',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return view('purchase.show')->with('purchase',$purchase);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        return view('purchase.edit')->with('purchase',$purchase);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        $this->validate($request,[
            'products' => 'required',
            'quantity_per_unit-*' => 'required',
            'selling_price-*' => 'required',
            'subtotal-*' => 'required',
            'total' => 'required'
        ]);

         

        foreach ($purchase->stock as $item) {
            $stockExist = Stock::find($item->pivot->stock_id);
            $stockExist->update([
                'quantity' => $stockExist->quantity - $item->pivot->quantity_per_unit,
            ]);
        }
 
         $purchase->stock()->detach();
         $purchase->delete();
        
        DB::beginTransaction();
        try {
            $quantity = 0;
            foreach ($request->products as $id => $guan) {
                $quantity = $quantity + $guan['quantity'];
                
            }
           
            $purchase = Purchase::create([
                'total' => $request->total,
                'quantity' => $quantity,
                'supplier' => $request->supplier
            ]);


            foreach ($request->products as $id => $quantity ) {
               $stockExist = Stock::where('product_id',$id)->first();
               if($stockExist){
                    $stockExist->update([
                        'quantity' => $request->input('quantity_per_unit-'.$id) + $stockExist->quantity,
                        'selling_price' => $request->input('selling_price-'.$id),
                        'purchase_price' => $request->input('purchase_price-'.$id),
                    ]);

                    $purchase->stock()->attach($stockExist->id,[
                        'product_id' => $id ,
                        'quantity' => $quantity['quantity'],
                        'quantity_per_unit' => $request->input('quantity_per_unit-'.$id),
                        'subtotal' =>  $request->input('subtotal-'.$id),
                    ]);
                }else {
                    $stock = Stock::create([
                        'product_id' => $id ,
                        'quantity' => $request->input('quantity_per_unit-'.$id),
                        'purchase_price' => $request->input('purchase_price-'.$id),
                        'selling_price' => $request->input('selling_price-'.$id),
                    ]);

                   $purchase->stock()->attach($stock->id,[
                        'product_id' => $id ,
                        'quantity' => $quantity['quantity'],
                        'quantity_per_unit' => $request->input('quantity_per_unit-'.$id),
                        'subtotal' =>  $request->input('subtotal-'.$id),
                  ]);
               }
               
            }

            DB::commit();
            return redirect()->route('purchase.index')->with('success','تم تحديث فاتورة الشراء بنجاح');


        } catch (\Exception $e) {
           DB::rollBack();
           return back()->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        foreach ($purchase->stock as $item) {
            $stockExist = Stock::find($item->pivot->stock_id);
            $stockExist->update([
                'quantity' => $stockExist->quantity - $item->pivot->quantity_per_unit,
            ]);
        }
 
         $purchase->stock()->detach();
         $purchase->delete();
         return back()->with('success','تم حذف فاتورة المبيعات بنجاح');
    }
}
