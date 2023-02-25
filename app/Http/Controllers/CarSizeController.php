<?php

namespace App\Http\Controllers;

use App\Models\CarSize;
use Illuminate\Http\Request;

class CarSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('car.index')->with('cars',CarSize::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarSize  $carSize
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carSize = CarSize::find($id);
        return view('car.edit')->with('car',$carSize);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarSize  $carSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'car' => 'required',
            'worker_ratio' => 'required'
        ]);
        
        $carSize = CarSize::find($id);

        if($carSize->update(['car' => $request->car ,'worker_ratio' => $request->worker_ratio])){
            return redirect()->route('cars.index')->with('success','تم التحديث بنجاح');
        }else {
            return back()->with('error','حصل خطاء حاول مرة اخري');
        }

    }

   
}
