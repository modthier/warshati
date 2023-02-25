@extends('layouts.sneat')
@section('content')

<div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>قائمة انواع المنصرفات</h4>
                </div>
                <div>
                    <a href="{{ route('expenseTypes.create') }}" class="btn btn-primary">
                        <i class="bx bxs-plus-circle"></i>
                         إضافة نوع منصرف </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>نوع المنصرف</th>
                                <th>عمليات</th>
                            </tr>
                            <tbody>
                                @forelse ($types as $expense)
                                <tr>
                                    <td>{{ $expense->name }}</td>
                                   
                                    <td>
                                        <div>
                                            <a href="{{ route('expenseTypes.edit',$expense->id) }}" class="btn btn-primary btn-sm mx-1">تعديل</a>
                                            
                                            
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <h4 class="text-danger text-center">لا يوجد انواع منصرفات حاليا</h4>
                                @endforelse
                                
                                
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection