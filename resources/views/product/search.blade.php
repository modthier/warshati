@extends('layouts.sneat')
@section('content')

    <div class="col-lg-12 mb-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4> ابحث في المنتجات </h4>
                <div>
                    <a href="{{ route('product.index') }}" class="btn btn-danger">
                         رجوع
                    </a>
                </div>
            </div>  
            <div class="card-body">
                <form action="{{ route('product.search') }}" method="get">
                    <div class="row mb-3">
                        <div class="form-group col-lg-12">
                            <input type="search" name="q" class="form-control" required>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success" value="بحث">
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4> نتيجة البحث </h4>
                </div>
                <div>
                    <a href="{{ route('product.create') }}" class="btn btn-primary">
                        <i class="bx bxs-plus-circle"></i>
                        
                         إضافة منتج </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>اسم المنتج</th>
                                <th>اقل وحدة للبيع</th>
                                <th>الباركود</th>
                                <th>عدد الوحدات في العبوة</th>
                                <th>لديه مخزون</th>
                                <th>عمليات</th>
                            </tr>
                            <tbody>
                                @forelse ($results as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->unit->unit }}</td>
                                    <td>{{ $product->barcode }}</td>
                                    <td>{{ $product->quantity_per_package }}</td>
                                    <td>
                                        @if($product->stock->count() > 0)
                                            نعم
                                        @else
                                            لا
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex  align-items-center">
                                           <a href="{{ route('product.edit',$product->id) }}" class="btn btn-success m-2">تعديل</a>
                                           @if($product->stock->count() == 0)
                                           <form id="delete_product_{{ $product->id }}"  action="{{ route('product.destroy',$product->id) }}"
                                            method="post">
                                              @csrf
                                              @method('DELETE')
                                              <button class="btn btn-danger" onclick="event.preventDefault();
                                                  var r = confirm('هل انت متاكد ؟');
                                                  if (r == true) {document.getElementById('delete_product_{{ $product->id }}').submit();}">حذف</button>
                              
                                            </form>   
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <h4 class="text-danger text-center">لا يوجد منتجات حاليا</h4>
                                @endforelse
                                
                                
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $results->withQueryString()->links() }}
            </div>
        </div>
    </div>


@endsection
