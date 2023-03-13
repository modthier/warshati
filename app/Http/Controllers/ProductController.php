<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index')->with([
            'products' => Product::orderBy('id','desc')->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create')->with('units',Unit::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {
        if(Product::create($request->validated())){
            return back()->with('success','تم حفظ المنتج بنجاح');
        }else {
            return back()->with('error','حصل خطاء حاول مرة اخري');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show')->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit')->with([
            'product' => $product,
            'units' => Unit::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, Product $product)
    {
        if($product->update($request->validated())){
            return back()->with('success','تم تحديث المنتج بنجاح');
        }else {
            return back()->with('error','حصل خطاء حاول مرة اخري');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success','تم حذف المنتج بنجاح');
    }


    public function getProducts(Request $request)
    {
        if($request->search == ''){
        $products = Product::limit(5)->get();
       }else {
        $products = Product::where('name','like',"%".$request->search."%")->get();
       }

       $response = array();

       foreach ($products as $product) {
           $response[] = array(
              'id' => $product->id ,
              'text' => $product->name ,
              'data-quantity' => "{$product->quantity_per_package}"
           );
       }
 
       echo json_encode($response);
    }

    public function search(Request $request)
    {
        $this->validate($request,[
            'q' => 'required'
        ]);

        $results = Product::where('name','like',"%".$request->q."%")->paginate(20);

        return view('product.search')->with('results',$results);
    }
}
