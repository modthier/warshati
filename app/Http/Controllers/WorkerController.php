<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Worker;
use App\Models\WorkerRatio;
use Illuminate\Http\Request;
use App\Http\Requests\WorkerFormRequest;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('worker.index')->with('workers',Worker::orderBy('id','desc')->paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('worker.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkerFormRequest $request)
    {
        $worker = Worker::create($request->validated());
        if($worker){
            return redirect()->route('worker.index')->with('success','تم حفظ العامل بنجاح');
        }else {
            return back()->with('error','حصل خطاء حاول مرة اخري');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        
        $today = WorkerRatio::where('worker_id',$worker->id)->whereDate('created_at',today())->sum('amount');
        $week = WorkerRatio::where('worker_id',$worker->id)->whereBetween('created_at',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->sum('amount');
        $month = WorkerRatio::where('worker_id',$worker->id)->whereBetween('created_at',[Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->sum('amount');
        
        return view('worker.show')->with([
            'worker' => $worker ,
            'today' => $today,
            'week' => $week ,
            'month' => $month
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {
        return view('worker.edit')->with('worker',$worker);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(WorkerFormRequest $request, Worker $worker)
    {
        $worker = $worker->update($request->validated());
        if($worker){
            return redirect()->route('worker.index')->with('success','تم تحديث العامل بنجاح');
        }else {
            return back()->with('error','حصل خطاء حاول مرة اخري');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        $worker->delete();
        return back()->with('success','تم حذف العامل بنجاح');
    }
}
