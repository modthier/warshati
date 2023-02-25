<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $orders = Order::withCount('stock')->orderBy('id','desc')->limit(10)->get();
        $services = ServiceRequest::orderBy('id','desc')->limit(10)->get();

        $month_purchase =  Purchase::whereBetween('created_at',[Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->sum('total');
        $stock_total =  Stock::select(DB::raw('sum(purchase_price * quantity) as total'))->where('quantity','>',0)->first();
        $month_order = Order::whereBetween('created_at',[Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->sum('total');
        $month_service = ServiceRequest::whereBetween('created_at',[Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->sum('amount');


        return view('main')->with([
            'orders' => $orders,
            'services' => $services,
            'month_purchase' => $month_purchase,
            'stock_total' => $stock_total,
            'month_order' => $month_order,
            'month_service' => $month_service
        ]);
    }
}
