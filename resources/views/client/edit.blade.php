@extends('layouts.sneat')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="m-0 pb-0">تحديث عميل</h4>
                </div>

            </div>
            <hr>
            <form action="{{ route('client.update',$client->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body pt-0">
                    <div class="row">

                        <div class="form-group col-md-6 mb-2">
                            <label for="name" class="form-label"><h5>اسم العميل</h5></label>
                            <input type="text" name="name" class="form-control form-control-lg"
                            value="{{ $client->name }}" required>
                        </div>

                        <div class="form-group col-md-6 mb-2">
                            <label for="phone" class="form-label"><h5> رقم الهاتف </h5></label>
                            <input type="text" name="phone" class="form-control form-control-lg"
                            value="{{ $client->phone }}" required>
                        </div>

                        <div class="form-group col-md-6 mb-2">
                            <label for="plate_number" class="form-label"><h5> رقم اللوحة </h5></label>
                            <input type="text" name="plate_number" class="form-control form-control-lg"
                            value="{{ $client->plate_number }}" required>
                        </div>

                    </div>

                    <button type="submit" class="next btn btn-success pull-right btn-lg">تحديث</button>

                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
