@extends('layouts.sneat')
@section('content')


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>قائمة انواع الخدمات</h4>
                </div>
                <div>
                    <a href="{{ route('serviceType.create') }}" class="btn btn-primary">
                        <i class="bx bxs-plus-circle"></i>
                         إضافة نوع خدمة </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th> نوع الخدمة </th>
                                <th>عمليات</th>
                            </tr>
                            <tbody>
                                @forelse ($serviceTypes as $serviceType)
                                <tr>
                                    <td>{{ $serviceType->type }}</td>
                                    <td>
                                        <div class="d-flex  align-items-center">
                                           <a href="{{ route('serviceType.edit',$serviceType->id) }}" class="btn btn-success m-2">تعديل</a>
                                           <form id="delete_serviceType_{{ $serviceType->id }}"  action="{{ route('serviceType.destroy',$serviceType->id) }}"
                                            method="post">
                                              @csrf
                                              @method('DELETE')
                                              <button class="btn btn-danger" onclick="event.preventDefault();
                                                  var r = confirm('هل انت متاكد ؟');
                                                  if (r == true) {document.getElementById('delete_serviceType_{{ $serviceType->id }}').submit();}">حذف</button>
                              
                                            </form>   
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <h4 class="text-danger text-center">لا يوجد انواع خدمة حاليا</h4>
                                @endforelse
                                
                                
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
            
        </div>
    </div>


@endsection
