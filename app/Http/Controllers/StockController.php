<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stock.index')->with('stocks',Stock::orderBy('id','desc')->paginate());
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }


    public function getStock(Request $request)
    {
        $response = array();
        
        if($request->search == ''){
            $stocks = Stock::where('quantity','>', 0)->orderBy('id','desc')->limit(5)->get();
        }else {
            $stocks = Stock::where('quantity','>', 0)->whereHas('product', function ($query) use ($request) {
                $query->where('name','like',"%".$request->search."%");
            })->get();

        }

        foreach ($stocks as $stock) {
            $response[] = array(
               'id' => $stock->id ,
               'text' => $stock->product->name ,
               'data-quantity' => "{$stock->quantity}",
               'data-selling_price' => "{$stock->selling_price}",
               'data-purchase_price' => "{$stock->purchase_price}",

            );
        }

        echo json_encode($response);
    }


    public function showChangPrice(Stock $stock)
    {
        return view('stock.changePrice')->with('stock',$stock);
    }


    public function updatePrice(Request $request,Stock $stock)
    {
        $this->validate($request,[
            'selling_price' => 'required'
        ]);


       if($stock->update(['selling_price' => $request->selling_price])){
            return back()->with('success','تم تحديث سعر الشراء بنجاح');
       }else {
            return back()->with('error','حصل خطاء حاول مرة اخري');
       }
    }
}
