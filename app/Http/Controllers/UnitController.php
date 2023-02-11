<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitFormRequest;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('unit.index')->with([
            'units' => Unit::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitFormRequest $request)
    {
        if(Unit::create($request->validated())){
            return back()->with('success','تم حفظ الوحدة بنجاح');
        }else {
            return back()->with('error','حصل خطاء حاول مرة اخري');
        }
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
       
        return view('unit.edit',compact("unit"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $data = ['unit' => $request->unit];
        
        $update = $unit->update($data);
        
        if($update){
            return redirect()->route('unit.index')->with('success','تم تحديث الوحدة بنجاح');
        }else{
            return back()->with('error','حصل خطاء حاول مرة اخري');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        
    }
}
