@extends('layouts.sneat')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="m-0 pb-0"> اضافة نوع الخدمة </h4>
                </div>

            </div>
            <hr>
            <form action="{{ route('serviceType.store') }}" method="POST">
                @csrf
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label for="type" class="form-label"><h5> نوع الخدمة </h5></label>
                            <input type="text" name="type" class="form-control form-control-lg" required>
                        </div>

                        <div class="form-group col-lg-6 mb-2">
                            <label for="has_ratio" class="form-label"> <h5>تعمل بنظام النسبة </h5></label>
                            <select name="has_ratio"  class="form-control form-control-lg" id="" required>
                                <option value="1">نعم</option>
                                <option value="0">لا</option>
                            </select>
                        </div>

                    </div>

                    <button type="submit" class="next btn btn-success pull-right btn-lg">حفظ</button>

                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
