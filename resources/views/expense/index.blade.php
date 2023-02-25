@extends('layouts.sneat')
@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>قائمة المنصرفات</h4>
                </div>
                <div>
                    <a href="{{ route('expense.create') }}" class="btn btn-primary">
                        <i class="bx bxs-plus-circle"></i>
                         إضافة منصرف </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>نوع المنصرف</th>
                                <th>قيمة المنصرف</th>
                                <th>عمليات</th>
                            </tr>
                            <tbody>
                                @forelse ($expenses as $expense)
                                <tr>
                                    <td>{{ $expense->expenceType->expense }}</td>
                                    <td>{{ $expense->amount }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('expense.edit',$expense->id) }}" class="btn btn-primary btn-sm mx-1"><i class="bx bx-edit"></i></a>
                                            
                                            
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <h4 class="text-danger text-center">لا يوجد منصرفات حاليا</h4>
                                @endforelse
                                
                                
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
