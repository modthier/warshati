@extends('layouts.sneat')
@section('content')


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>قائمة الخدمات</h4>
                </div>
                <div>
                    <a href="{{ route('service_request.create') }}" class="btn btn-primary">  <i class="bx bxs-plus-circle mx-2"></i> طلب خدمة</a>
                    <a href="{{ route('service.create') }}" class="btn btn-primary">
                        <i class="bx bxs-plus-circle mx-2"></i>
                         إضافة خدمة </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>اسم الخدمة</th>
                                <th>نوع الخدمة</th>
                                <th>عمليات</th>
                            </tr>
                            <tbody>
                                @forelse ($services as $service)
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>@if($service->service_type){{ $service->service_type->type }}@endif</td>
                                    <td>
                                        <div class="d-flex  align-items-center">
                                           <a href="{{ route('service.edit',$service->id) }}" class="btn btn-success m-2">تعديل</a>
                                           <form id="delete_service_{{ $service->id }}"  action="{{ route('service.destroy',$service->id) }}"
                                            method="post">
                                              @csrf
                                              @method('DELETE')
                                              <button class="btn btn-danger" onclick="event.preventDefault();
                                                  var r = confirm('هل انت متاكد ؟');
                                                  if (r == true) {document.getElementById('delete_service_{{ $service->id }}').submit();}">حذف</button>
                              
                                            </form>   
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <h4 class="text-danger text-center">لا يوجد وحدات حاليا</h4>
                                @endforelse
                                
                                
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
            
        </div>
    </div>


@endsection
