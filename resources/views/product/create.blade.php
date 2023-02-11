@extends('layouts.sneat')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="m-0 pb-0">اضافة منتج</h4>
                </div>

            </div>
            <hr>
            <form action="{{ route('product.store') }}" method="POST">
                @csrf
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label for="name" class="form-label"><h5>اسم المنتج</h5></label>
                            <input type="text" name="name" class="form-control form-control-lg" required>
                        </div>

                        <div class="form-group col-md-6  mb-2">
                            <label for="location" class="form-label"><h5>اقل وحدة للبيع </h5> </label>
                            <select name="unit_id" class="form-control form-control-lg" required>
                                <option value=""></option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->unit }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6  mb-2">
                            <label for="total_weight" class="form-label"> <h5>باركود</h5> </label>
                            <input type="text" name="barcode" class="form-control form-control-lg">
                        </div>

                        <div class="form-group col-md-6  mb-2">
                            <label for="quantity" class="form-label"><h5>عدد الوحدات في العبوة </h5></label>
                            <input type="number" name="quantity_per_package" class="form-control form-control-lg" required>
                        </div>

                    </div>

                    <button type="submit" class="next btn btn-success pull-right btn-lg">حفظ</button>

                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
