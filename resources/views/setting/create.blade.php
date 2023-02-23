@extends('layouts.sneat')
@section('content')


<div class="col-lg-12">
<div class="card">
    <div class="card-header">
        <h4> اضافة معلومات الورشة </h4>
    </div>
    <div class="card-body">
    <form action="{{ route('setting.store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-6 form-group">
            <label for="name">اسم المتجر</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="col-lg-6 form-group">
            <label for="address">عنوان المتجر</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="col-lg-6 form-group">
            <label for="phone">رقم الهاتف</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        
        <div class="col-lg-12 form-group mt-3">
            <input type="submit" value="حفظ" class="btn btn-primary">
        </div>
    </div>

</form>
    </div>
</div>
</div>
@endsection