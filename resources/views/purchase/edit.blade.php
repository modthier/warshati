@extends('layouts.sneat')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4>تحديث عملية شراء</h4>
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
                <div class="col-lg-2 d-flex align-items-end mx-5">
                    <button type="button" class="btn btn-success btn-lg" id="addItem">اضافة</button>
                </div>
            </div>
            
        </div>
    </div>
    
</div>
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body p-0">
            <form action="{{ route('purchase.update',$purchase->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-lg-12 px-5 pt-3 pb-3">
                    <label for=""> <h5>اسم المورد/التاجر</h5> </label>
                    <input type="text" value="{{ $purchase->supplier }}" name="supplier" class="form-control">
                </div>
            </div>
            
            <table class="table">
                <thead>
                    <th>اسم المنتج</th>
                    <th>الكمية المشتراه</th>
                    <th>الكمية بالوحدة</th>
                    <th>سعر البيع للوحدة</th>
                    <th>السعر الكلي</th>
                    <th>#</th>
                </thead>
                <tbody class="item-area">
                    @foreach ($purchase->stock as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td><input type="number" step="0.1" min="0" value="{{ $item->pivot->quantity}}"  placeholder="الكمية المشتراه" 
                                name="products[{{$item->product->id}}][quantity]" 
                                data-id="{{$item->product->id}}"  
                                data-units="{{$item->product->quantity_per_package}}"
                                id="quantity-{{$item->product->id}}" 
                                class="form-control quantity">
                            </td>
                            <td><input type="number" step="0.1" min="0" value="{{ $item->pivot->quantity_per_unit }}"  placeholder="الكمية بالوحدة" 
                                id="quantity_per_unit-{{$item->product->id}}"  name="quantity_per_unit-{{$item->product->id}}" 
                                class="form-control quantity_per_unit">
                            </td>
                            <td><input type="number" step="0.1" min="0" value="{{ $item->selling_price }}"  placeholder="سعر البيع للوحدة"  
                                name="selling_price-{{$item->product->id}}" 
                                class="form-control selling_price">
                            </td>
                            <td><input type="number" step="0.1" name="subtotal-{{$item->product->id}}" value="{{$item->pivot->subtotal}}" class="form-control subtotal" 
                                id="subtotal-{{$item->product->id}}" value="0"></td>
                            <td><button type="button" data-id="{{$item->product->id}}" class="btn btn-danger delete-product"><i class="bx bxs-trash"></button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <input type="hidden" name="total" id="total" value="{{ $purchase->total }}">
            <div class="d-flex justify-content-between align-items-center p-3 mt-5">
                <div>
                    <h4>السعر الكلي : <span id="displayTotal">{{ $purchase->total }}</span></h4>
                </div>
                <div class="px-1">
                    <input type="submit" value="تحديث" id="order-btn" class="btn btn-success">
                </div>
            </div>
            </form>
        </div>
    </div>

</div>

<script src="{{ asset('sneat/assets/js/order.js') }}" defer></script>
@endsection

