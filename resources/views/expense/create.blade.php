@extends('layouts.sneat')
@section('content')


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="m-0 pb-0">اضافة منصرف</h4>
                </div>
                <div>
                    <a href="{{ route('expense.index') }}" class="btn btn-danger">
                        <i class="bx bx-arrow-back"></i>
                          رجوع </a>
                </div>
                
            </div>
            <hr>
            <form action="{{ route('expense.store') }}" method="POST">
                @csrf
                <div class="card-body pt-0">
                        <div class="row">
                            <div class="form-group col-md-12 mb-2">
                                <label for="expense_type_id" class="form-label">نوع المنصرق</label>
                                <select name="expense_type_id" class="form-control" required>
                                    <option value=""></option>
                                    @foreach ($expenseTypes as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-12 mb-2">
                                <label for="expense_type_id" class="form-label">قيمة المنصرق</label>
                                <input type="number" step="0.1" name="amount" required class="form-control">
                            </div>
                           
                        </div>

                        <button type="submit"  class="next btn btn-success pull-right btn-lg">حفظ</button>
                    
                </div>
               </div>
            </form>
        </div>
    </div>


    
@endsection
