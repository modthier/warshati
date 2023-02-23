@extends('layouts.sneat')
@section('content')


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>قائمة العمال</h4>
                </div>
                <div>
                    <a href="{{ route('worker.create') }}" class="btn btn-primary">
                        <i class="bx bxs-plus-circle"></i>
                         إضافة عامل </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>اسم العامل</th>
                                <th> رقم الهاتف </th>
                                <th> العنوان </th>
                                <th>عمليات</th>
                            </tr>
                            <tbody>
                                @forelse ($workers as $worker)
                                <tr>
                                    <td>{{ $worker->name }}</td>
                                    <td>{{ $worker->phone }}</td>
                                    <td>{{ $worker->address }}</td>
                                    <td>
                                        <div class="d-flex  align-items-center">
                                           <a href="{{ route('worker.edit',$worker->id) }}" class="btn btn-success m-2">تعديل</a>
                                           <form id="delete_worker_{{ $worker->id }}"  action="{{ route('worker.destroy',$worker->id) }}"
                                            method="post">
                                              @csrf
                                              @method('DELETE')
                                              <button class="btn btn-danger" onclick="event.preventDefault();
                                                  var r = confirm('هل انت متاكد ؟');
                                                  if (r == true) {document.getElementById('delete_worker_{{ $worker->id }}').submit();}">حذف</button>
                              
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
