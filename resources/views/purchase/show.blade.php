@extends('layouts.sneat')
@section('content')


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>تفاصيل الفاتورة</h4>
                </div>
                <div>
                    <a href="{{ route('purchase.index') }}" class="btn btn-primary">
                        <i class="bx bxs-plus-circle"></i>
                        
                         رجوع</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>مجموع الفاتورة</th>
                                <th>مجموع المنتجات</th>
                                <th>اسم المورد/التاجر</th>
                            </tr>
                            <tbody>
                                <tr>
                                    <td>{{ number_format($purchase->total,2) }} جنيه</td>
                                    <td>{{ $purchase->quantity }}</td>
                                    <td>{{ $purchase->supplier }}</td>
                                </tr>    
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12 mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>تفاصيل المنتحات</h4>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>اسم المنتج</th>
                                <th>الوحدة</th>
                                <th>الكمية المشتراه</th>
                                <th>الكمية بالوحدة</th>
                                <th>سعر الشراء للوحدة</th>
                                <th>السعر الكلي</th>
                                
                            </tr>
                            <tbody>
                                @foreach ($purchase->stock as $item)
                                <tr>
                                   <td>{{ $item->product->name }}</td>
                                   <td>{{ $item->product->unit->unit }}</td>
                                   <td>{{ $item->pivot->quantity }}</td>
                                   <td>{{ $item->pivot->quantity_per_unit }}</td>
                                   <td>{{ number_format($item->pivot->subtotal/$item->pivot->quantity_per_unit) }}</td>
                                   <td>{{ number_format($item->pivot->subtotal,2)  }} جنيه</td>
                                </tr>    
                                @endforeach
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
