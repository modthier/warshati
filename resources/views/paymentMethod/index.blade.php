@extends('layouts.sneat')
@section('content')


<div class="col-lg-12">
    <div class="card">
        <div class="card-header mb-0 d-flex justify-content-between align-items-center">
            <h5 class="pt-3 px-3">قائمة طرق الدفع</h5>
            <div>
                <a href="{{ route('payment.create') }}" class="btn btn-primary">
                    <i class="bx bxs-plus-circle"></i>
                     إضافة طريقة دفع </a>
            </div>
        </div>
        <hr>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>طريقة الدفع</th>
                        <th>#</th>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr>
                                <td>{{ $payment->method }}</td>
                                <td>
                                    <a href="" class="btn btn-warning">تعديل</a>
                                </td>
                            </tr>
                        @empty
                        <h4 class="text-center text-danger m-3">لا يوجد طريقة دفع</h4>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection