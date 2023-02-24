@extends('layouts.sneat')
@section('content')

<form action="{{ route('order.store') }}" method="post">
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4>إضافة عملية بيع</h4>
            <hr>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="stock_id"><h5> اسم المنتج</h5></label>
                    <select name="stock_id" id="stock_id" class="form-control">
                        <option value=""></option>
                    </select>
                </div>
                
                <div class="form-group col-lg-6">
                    <label for="payment_method_id"><h5>  طرق الدفع </h5></label>
                    <select name="payment_method_id"  class="form-control form-control-lg" required>
                        
                        @foreach ($payments as $item)
                        <option value="{{ $item->id }}">{{ $item->method }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mt-3">
                <button type="button" class="btn btn-success btn-lg" id="addItem">اضافة</button>
                </div>
                
            </div>
            
        </div>
    </div>
    
</div>
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body p-0">
           
           
            @csrf
            <table class="table">
                <thead>
                    <th>اسم المنتج</th>
                    <th>الكمية </th>
                    <th>سعر الشراء</th>
                    <th>سعر البيع</th>
                    <th>السعر الكلي</th>
                    <th>#</th>
                </thead>
                <tbody class="item-area">

                </tbody>
            </table>
            <input type="hidden" name="total" id="total">
            <div class="d-flex justify-content-between align-items-center p-3 mt-5">
                <div>
                    <h4>السعر الكلي : <span id="displayTotal"></span></h4>
                </div>
                <div class="px-1">
                    <input type="submit" value="حفظ" id="order-btn" class="btn btn-success">
                </div>
            </div>
            
        </div>
    </div>

</div>
</form>

<script src="{{ asset('sneat/assets/js/pos.js') }}" defer></script>
@endsection

@push('js')
<script>
var price = 0.0;
$('.item-area .subtotal').each(function(index){
    
    price += parseFloat($(this).val());
    
});

$('#total').val(price);
$('#displayTotal').html(price);
console.log(price);
if (price > 0) {
    $('#order-btn').attr('disabled',false);
}else {
    $('#order-btn').attr('disabled','disabled');
}
</script>
@endpush
