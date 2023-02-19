<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('serviceType.index')->with('serviceTypes',serviceType::all());
    }

    public function create()
    {
        return view('serviceType.create');
    }

    
    public function store(Request $request)
    {
        //
    }

   
    public function show(ServiceType $serviceType)
    {
        //
    }

    
    public function edit(ServiceType $serviceType)
    {
        //
    }

    
    public function update(Request $request, ServiceType $serviceType)
    {
        //
    }

   
    public function destroy(ServiceType $serviceType)
    {
        //
    }
}
