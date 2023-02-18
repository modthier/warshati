@extends('layouts.sneat')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4>إضافة  خدمة</h4>
            <hr>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-lg-8">
                    <label for="service_id"><h5> اسم الخدمة</h5></label>
                    <select name="service_id" id="service_id" class="form-control">
                        <option value=""></option>
                    </select>
                </div>
                <div class="col-lg-2 d-flex align-items-end mx-1">
                    <button type="button" class="btn btn-success btn-lg" id="addItem">اضافة</button>
                </div>
            </div>

            <hr class="mt-3">
            <div class="row">
                
                    <table class="table">
                        <thead>
                            <th>اسم الخدمة</th>
                            <th>سعر الخدمة</th>
                            <th>#</th>
                        </thead>
                        <tbody class="service-area">
        
                        </tbody>
                    </table>
                    <input type="hidden" name="total" id="serviceTotal">
                    <div class="d-flex justify-content-between align-items-center p-3 mt-5">
                        <div>
                            <h4>السعر الكلي : <span id="serviceDisplayTotal"></span></h4>
                        </div>
                        <div class="px-1">
                            <input type="submit" value="حفظ" id="order-btn" class="btn btn-success">
                        </div>
                    </div>
                
            </div>
            
        </div>
    </div>
    
</div>


<script src="{{ asset('sneat/assets/js/service_request.js') }}" defer></script>
@endsection

@push('js')
<script>
var price = 0.0;
$('.service-area .price').each(function(index){
    
    price += parseFloat($(this).val());
    
});

$('#serviceTotal').val(price);
$('#serviceDisplayTotal').html(price);

if (price > 0) {
    $('#service-btn').attr('disabled',false);
}else {
    $('#service-btn').attr('disabled','disabled');
}
</script>
@endpush