@extends('layouts.sneat')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="m-0 pb-0">تحديث عامل</h4>
                </div>

            </div>
            <hr>
            <form action="{{ route('worker.update',$worker->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="form-group col-md-6 mb-2">
                            <label for="name" class="form-label"><h5>اسم العامل</h5></label>
                            <input type="text" name="name" class="form-control form-control-lg"
                            value="{{ $worker->name }}" required>
                        </div>

                        <div class="form-group col-md-6 mb-2">
                            <label for="phone" class="form-label"><h5> رقم الهاتف  </h5></label>
                            <input type="text" name="phone" class="form-control form-control-lg" 
                            value="{{ $worker->phone }}" required>
                        </div>

                        <div class="form-group col-md-6 mb-2">
                            <label for="address" class="form-label"><h5>  العنوان  </h5></label>
                            <input type="text" name="address" class="form-control form-control-lg"
                            value="{{ $worker->address }}" required>
                        </div>

                    </div>

                    <button type="submit" class="next btn btn-success pull-right btn-lg">تحديث</button>

                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
