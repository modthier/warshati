@extends('layouts.sneat')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4>إضافة عملية بيع</h4>
            <hr>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-lg-8">
                    <label for="stock_id"><h5> اسم المنتج</h5></label>
                    <select name="stock_id" id="stock_id" class="form-control">
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
            <form action="{{ route('order.update',$order->id) }}" method="post">
            @csrf
            @method('PUT')
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
                    @foreach ($order->stock as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td><input type="number" step="0.1" min="1" value="1" name="stocks[{{ $item->id }}][quantity]" 
                            data-id="{{ $item->id }}"  
                            id="quantity-{{ $item->id }}"
                            data-avl="{{ $item->quantity }}"
                            class="form-control quantity">
                        </td>
                         <td><input type="number" readonly value="{{ $item->pivot->purchase_price }}" id="purchase_price-{{ $item->id }}"
                            data-id="{{ $item->id }}" 
                            name="purchase_price-{{ $item->id }}"
                            class="form-control purchase_price">
                        </td>
                        <td><input type="number" step="0.1" value="{{ $item->pivot->selling_price }}" id="price-{{ $item->id }}"
                            data-id="{{ $item->id }}" 
                            name="selling_price-{{ $item->id }}"
                            class="form-control price">
                        </td>
                        <td><input type="number" step="0.1" name="subtotal-{{ $item->id }}" value="{{ $item->pivot->selling_price * $item->pivot->quantity }}" class="form-control subtotal" id="subtotal-{{ $item->id }}" value="0"></td>
                        <td><button type="button" data-id="{{ $item->id }}" class="btn btn-danger delete-stock"><i class="bx bxs-trash"></button></td>
                        
                    </tr>
                    @endforeach
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

<script src="{{ asset('sneat/assets/js/pos.js') }}" defer></script>
@endsection
