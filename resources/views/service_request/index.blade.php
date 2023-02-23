@extends('layouts.sneat')
@section('content')


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>قائمة طلبات الخدمات</h4>
                </div>
                <div>
                    <a href="{{ route('service_request.create') }}" class="btn btn-primary">  <i class="bx bxs-plus-circle mx-2"></i> طلب خدمة</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم العميل</th>
                                <th>حجم المركبة</th>
                                <th>اسم العامل</th>
                                <th>المبلغ الكلي</th>
                                <th>عمليات</th>
                            </tr>
                            <tbody>
                                @forelse ($service_requests as $service)
                                <tr>
                                    <td>{{ $service->id }}</td>
                                    <td>{{ $service->client->name }}</td>
                                    <td>{{ $service->car->car }}</td>
                                    <td>{{ $service->worker->name }}</td>
                                    <td>{{ number_format($service->amount,2) }}</td>
                                    <td>
                                        <div class="d-flex  align-items-center">
                                        
                                           <a href="{{ route('service_request.show',$service->id) }}" class="btn btn-primary m-2">تفاصيل</a>
                                           <a href="{{ route('service_request.edit',$service->id) }}" class="btn btn-success m-2">تعديل</a>
                                           <a href="{{ route('serviceRequest.addProduct',$service->id) }}" class="btn btn-warning m-2">اضافة منتجات</a>
                                           <form id="delete_service_request_{{ $service->id }}"  action="{{ route('service_request.destroy',$service->id) }}"
                                            method="post">
                                              @csrf
                                              @method('DELETE')
                                              <button class="btn btn-danger" onclick="event.preventDefault();
                                                  var r = confirm('هل انت متاكد ؟');
                                                  if (r == true) {document.getElementById('delete_service_request_{{ $service->id }}').submit();}">حذف</button>
                              
                                            </form>   
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <h4 class="text-danger text-center">لا يوجد طلبات خدمة حاليا</h4>
                                @endforelse
                                
                                
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                {{ $service_requests->links() }}
            </div>
            
        </div>
    </div>


@endsection
