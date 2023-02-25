@extends('layouts.sneat')
@section('content')


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="m-0 pb-0">اضافة نوع منصرف</h4>
                </div>
                <div>
                    <a href="{{ route('expenseTypes.index') }}" class="btn btn-danger">
                        <i class="bx bx-arrow-back"></i>
                          رجوع </a>
                </div>
                
            </div>
            <hr>
            <form action="{{ route('expenseTypes.store') }}" method="POST">
                @csrf
                <div class="card-body pt-0">
                        <div class="row">
                            <div class="form-group col-md-12 mb-2">
                                <label for="name" class="form-label">نوع المنصرق</label>
                                <input type="text" name="name" required class="form-control">
                            </div>
                        </div>

                        <button type="submit"  class="next btn btn-success pull-right btn-lg">حفظ</button>
                </div>
               </div>
            </form>
        </div>
    </div>


    
@endsection
