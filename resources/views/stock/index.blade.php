@extends('layouts.sneat')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>قائمة المخزون</h4>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-focus">
                        <thead class="table-info">
                            <tr>
                                <th>اسم المنتج</th>
                                <th>اقل وحدة للبيع</th>
                                <th>الكمية بالوحدة</th>
                                <th>سعر الشراء للوحدة</th>
                                <th>سعر البيع للوحدة</th>
                                <th> مجموع المتوفر حاليا بسعر الشراء</th>
                               

                            </tr>
                        <tbody>
                            @forelse ($stocks as $stock)
                                <tr>
                                    <td>{{ $stock->product->name }}</td>
                                    <td>{{ $stock->product->unit->unit }}</td>
                                    <td>{{ $stock->quantity }}</td>
                                    <td>{{ $stock->purchase_price }}</td>
                                    <td>{{ $stock->selling_price }}</td>
                                    <td>{{ number_format($stock->purchase_price * $stock->quantity ) }}</td>
                                    
                                </tr>
                            @empty
                                <h4 class="text-danger text-center">لا يوجد  منتجات في المخزون حاليا</h4>
                            @endforelse


                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $stocks->links() }}
            </div>
        </div>
    </div>
@endsection
