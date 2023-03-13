@extends('layouts.sneat')
@section('content')
<div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>بيانات المخزون</h4>
                </div>
                <div>
                   <a href="{{ route('stock.index') }}" class="btn btn-danger">رجوع</a>
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
                           
                                <tr>
                                    <td>{{ $stock->product->name }}</td>
                                    <td>{{ $stock->product->unit->unit }}</td>
                                    <td>{{ $stock->quantity }}</td>
                                    <td>{{ $stock->purchase_price }}</td>
                                    <td>{{ $stock->selling_price }}</td>
                                    <td>{{ number_format($stock->purchase_price * $stock->quantity ) }}</td>
                                    
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
                    <h4 class="m-0 pb-0"> تغيير سعر البيع</h4>
                </div>

            </div>
            <hr>
            <form action="{{ route('stock.updatePrice',$stock->id) }}" method="POST">
                @csrf
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label for="selling_price" class="form-label"><h5> سعر البيع الجديد  </h5></label>
                            <input type="number" name="selling_price" class="form-control form-control-lg" required>
                        </div>

                    </div>

                    <button type="submit" class="next btn btn-success pull-right btn-lg">تحديث</button>

                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
