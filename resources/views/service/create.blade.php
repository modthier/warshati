@extends('layouts.sneat')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>إضافة خدمة </h4>
                </div>
                <div>
                   <a href="{{ route('service.index') }}" class="btn btn-danger">رجوع</a>
                </div>
            </div>
            <hr>
            <form action="{{ route('service.store') }}" method="POST">
                @csrf
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label for="name" class="form-label"><h5>اسم الخدمة</h5></label>
                            <input type="text" name="name" class="form-control form-control-lg" required>
                        </div>

                    </div>

                    <button type="submit" class="next btn btn-success pull-right btn-lg">حفظ</button>

                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
