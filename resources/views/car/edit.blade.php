@extends('layouts.sneat')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="m-0 pb-0"> تحديث بيانات المركبة </h4>
                </div>

            </div>
            <hr>
            <form action="{{ route('cars.update',$car->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label for="car" class="form-label"><h5> حجم المركبة </h5></label>
                            <input type="text" name="car" value="{{ $car->car }}" class="form-control form-control-lg" required>
                        </div>

                        <div class="form-group col-md-6 mb-2">
                            <label for="worker_ratio" class="form-label"><h5> نسبة العامل  </h5></label>
                            <input type="text" name="worker_ratio" value="{{ $car->worker_ratio }}" class="form-control form-control-lg" required>
                        </div>

                    </div>

                    <button type="submit" class="next btn btn-success pull-right btn-lg">تحديث</button>

                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
