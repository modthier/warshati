@extends('layouts.sneat')
@section('content')

<div class="col-md-6 col-xl-3">
<div class="card bg-primary text-white mb-3">
    <div class="card-header">مجموع  المشتريات   في الشهر</div>
    <div class="card-body">
    <h5 class="card-title text-white">{{ number_format($month_purchase,2) }} جنيه</h5>
    
    </div>
</div>
</div>

<div class="col-md-6 col-xl-3">
<div class="card bg-primary text-white mb-3">
    <div class="card-header">مجموع  المخزون الحالي</div>
    <div class="card-body">
    <h5 class="card-title text-white">{{ number_format($stock_total->total,2) }} جنيه</h5>
    
    </div>
</div>
</div>


<div class="col-md-6 col-xl-3">
<div class="card bg-primary text-white mb-3">
    <div class="card-header">مجموع المبيعات   في الشهر</div>
    <div class="card-body">
    <h5 class="card-title text-white">{{ number_format($month_order,2) }} جنيه</h5>
    
    </div>
</div>
</div>


<div class="col-md-6 col-xl-3">
<div class="card bg-primary text-white mb-3">
    <div class="card-header"> مجموع الخدمات في الشهر </div>
    <div class="card-body">
    <h5 class="card-title text-white">{{ number_format($month_service,2) }} جنيه</h5>
    
    </div>
</div>
</div>

<div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>اخر المبيعات</h4>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-focus">
                        <thead class="table-info">
                            <tr>
                                <th>#الرقم المرجعي للطلب</th>
                                <th> اسم المستخدم </th>
                                <th>الكمية المباعة</th>
                                <th> السعر الكلي </th>
                                <th> التاريخ </th>
                                <th> عمليات </th>
                               

                            </tr>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td><a href="{{ route('order.show',$order->id) }}" class="btn btn-primary">#{{ $order->id }}</a></td>
                                    <td></td>
                                    <td>{{ $order->stock_count }}</td>
                                    <td>{{ number_format($order->total,2) }} جنيه</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <a href="{{ route('order.edit',$order->id) }}" class="btn btn-warning">تعديل</a>
                                        
                                    </td>
                                    
                                </tr>
                            @empty
                                <h4 class="text-danger text-center">لا يوجد  مبيعات حاليا</h4>
                            @endforelse


                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
            
        </div>
    </div>

@endsection
