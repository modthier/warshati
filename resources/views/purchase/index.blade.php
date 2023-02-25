@extends('layouts.sneat')
@section('content')

<div class="col-md-6 col-xl-3">
<div class="card bg-primary text-white mb-3">
    <div class="card-header">مجموع مشتريات اليوم</div>
    <div class="card-body">
    <h5 class="card-title text-white">{{ number_format($today,2) }} جنيه</h5>
    
    </div>
</div>
</div>


<div class="col-md-6 col-xl-3">
<div class="card bg-primary text-white mb-3">
    <div class="card-header">مجموع مشتريات الاسبوع</div>
    <div class="card-body">
    <h5 class="card-title text-white">{{ number_format($week,2) }} جنيه</h5>
    
    </div>
</div>
</div>


<div class="col-md-6 col-xl-3">
<div class="card bg-primary text-white mb-3">
    <div class="card-header">مجموع مشتريات الشهر</div>
    <div class="card-body">
    <h5 class="card-title text-white">{{ number_format($month,2) }} جنيه</h5>
    
    </div>
</div>
</div>

<div class="col-md-6 col-xl-3">
<div class="card bg-primary text-white mb-3">
    <div class="card-header">مجموع مشتريات السنة الحالية</div>
    <div class="card-body">
    <h5 class="card-title text-white">{{ number_format($total,2) }} جنيه</h5>
    
    </div>
</div>
</div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>قائمة المشتريات</h4>
                </div>
                <div>
                    <a href="{{ route('purchase.create') }}" class="btn btn-primary">
                        <i class="bx bxs-plus-circle"></i>
                        
                         إضافة فاتورة مشتريات </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-lg">
                        <thead>
                            <tr>
                                <th>مجموع الفاتورة</th>
                                <th>مجموع المنتجات</th>
                                <th>اسم المورد/التاجر</th>
                                <th>عمليات</th>
                            </tr>
                            <tbody>
                                @forelse ($purchases as $purchase)
                                <tr>
                                    <td>{{ number_format($purchase->total,2) }} جنيه</td>
                                    <td>{{ $purchase->quantity }}</td>
                                    <td>{{ $purchase->supplier }}</td>
                                    <td>
                                        <div class="d-flex  align-items-center">
                                           <a href="{{ route('purchase.show',$purchase->id) }}" class="btn btn-primary m-2">تفاصيل</a>
                                           <a href="{{ route('purchase.edit',$purchase->id) }}" class="btn btn-success m-2">تعديل</a>
                                           <form id="delete_purchase_{{ $purchase->id }}"  action="{{ route('purchase.destroy',$purchase->id) }}"
                                            method="post">
                                              @csrf
                                              @method('DELETE')
                                              <button class="btn btn-danger m-2" onclick="event.preventDefault();
                                                  var r = confirm('هل انت متاكد ؟');
                                                  if (r == true) {document.getElementById('delete_purchase_{{ $purchase->id }}').submit();}">حذف</button>
                              
                                            </form>   
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <h4 class="text-danger text-center">لا يوجد مشتريات حاليا</h4>
                                @endforelse
                                
                                
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $purchases->links() }}
            </div>
        </div>
    </div>


@endsection
