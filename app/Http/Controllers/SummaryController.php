<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Expense;
use App\Models\Purchase;
use App\Models\WorkerRatio;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;

class SummaryController extends Controller
{
    public function index()
    {
        $totalOrder = Order::whereBetween('created_at',[Carbon::now()->startOfYear(),Carbon::now()->endOfYear()])->sum('total');
        $totalPurchase = Purchase::whereBetween('created_at',[Carbon::now()->startOfYear(),Carbon::now()->endOfYear()])->sum('total');
        $totalExpense = Expense::whereBetween('created_at',[Carbon::now()->startOfYear(),Carbon::now()->endOfYear()])->sum('amount');
        $totalServiceRequest = ServiceRequest::whereBetween('created_at',[Carbon::now()->startOfYear(),Carbon::now()->endOfYear()])->sum('amount');
        $totalWorkerRatio = WorkerRatio::whereBetween('created_at',[Carbon::now()->startOfYear(),Carbon::now()->endOfYear()])->sum('amount');

        return view('summary.index')->with([
            'totalOrder' => $totalOrder,
            'totalPurchase' => $totalPurchase,
            'totalExpense' => $totalExpense,
            'totalServiceRequest' => $totalServiceRequest,
            'totalWorkerRatio' => $totalWorkerRatio,

        ]);
    }


    public function search(Request $request)
    {
        if ($request->has('date_from') and $request->has('date_to')) {
            $totalOrder = Order::whereRaw('Date(created_at) between ? and ?',[$request->date_from,$request->date_to])->sum('total');
            $totalPurchase = Purchase::whereRaw('Date(created_at) between ? and ?',[$request->date_from,$request->date_to])->sum('total');
            $totalExpense = Expense::whereRaw('Date(created_at) between ? and ?',[$request->date_from,$request->date_to])->sum('amount');
            $totalServiceRequest = ServiceRequest::whereRaw('Date(created_at) between ? and ?',[$request->date_from,$request->date_to])->sum('amount');
            $totalWorkerRatio = WorkerRatio::whereRaw('Date(created_at) between ? and ?',[$request->date_from,$request->date_to])->sum('amount');
        }else {
            $totalOrder = 0;
            $totalPurchase = 0;
            $totalExpense = 0;
            $totalServiceRequest = 0;
            $totalWorkerRatio = 0;
        }

        return view('summary.search')->with([
            'totalOrder' => $totalOrder,
            'totalPurchase' => $totalPurchase,
            'totalExpense' => $totalExpense,
            'totalServiceRequest' => $totalServiceRequest,
            'totalWorkerRatio' => $totalWorkerRatio,

        ]);
    }
    
}
