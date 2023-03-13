<?php

namespace App\Http\Controllers;

use App\Models\CarSize;
use App\Models\ServiceType;
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
        return view('car.edit')->with([
            'car' => $carSize ,
            'serviceType' => ServiceType::all()
        ]);
    }

  
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'car' => 'required',
            'ratio-*' => 'required'
        ]);
        
        $carSize = CarSize::find($id);
        $serviceType = ServiceType::all();
        $carSize->serviceType()->detach();
        foreach ($serviceType as $key => $item) {
            $carSize->serviceType()->attach($item->id,['ratio' => $request->input('ration-'.$item->id)]);
        }
        

        if($carSize->update(['car' => $request->car])){
            return redirect()->route('cars.index')->with('success','تم التحديث بنجاح');
        }else {
            return back()->with('error','حصل خطاء حاول مرة اخري');
        }

    }

   
}
