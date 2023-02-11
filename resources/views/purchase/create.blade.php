@extends('layouts.sneat')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4>إضافة عملية شراء</h4>
            <hr>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-lg-8">
                    <label for="product_id"><h5> اسم المنتج</h5></label>
                    <select name="product_id" id="product_id" class="form-control">
                        <option value=""></option>
                    </select>
                </div>
                <div class="col-lg-2 d-flex align-items-end mx-1">
                    <button type="button" class="btn btn-success btn-lg" id="addItem">اضافة</button>
                </div>
            </div>
            
        </div>
    </div>
    
</div>
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body p-0">
            <form action="{{ route('purchase.store') }}" method="post">
            <div class="row">
                <div class="form-group col-lg-12 px-5 pt-3 pb-3">
                    <label for=""> <h5>اسم المورد/التاجر</h5> </label>
                    <input type="text" name="supplier" class="form-control">
                </div>
            </div>
            @csrf
            <table class="table">
                <thead>
                    <th>اسم المنتج</th>
                    <th>الكمية المشتراه</th>
                    <th>الكمية بالوحدة</th>
                    <th>سعر البيع للوحدة</th>
                    <th>سعر الشراء للوحدة</th>
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
            </form>
        </div>
    </div>

</div>

<script src="{{ asset('sneat/assets/js/order.js') }}" defer></script>
@endsection
