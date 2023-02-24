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
    public function edit(CarSize $carSize)
    {
        return view('car.edit')->with('car',$carSize);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarSize  $carSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarSize $carSize)
    {
        //
    }

   
}
