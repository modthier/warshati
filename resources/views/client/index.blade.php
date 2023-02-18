@extends('layouts.sneat')
@section('content')


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>قائمة القطيع</h4>
                </div>
                <div>
                    <a href="{{ route('unit.create') }}" class="btn btn-primary">
                        <i class="bx bxs-plus-circle"></i>
                         إضافة وحدة </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>اسم الوحدة</th>
                                <th>عمليات</th>
                            </tr>
                            <tbody>
                                @forelse ($units as $unit)
                                <tr>
                                    <td>{{ $unit->unit }}</td>
                                    <td>
                                        <div class="d-flex  align-items-center">
                                           <a href="{{ route('unit.edit',$unit->id) }}" class="btn btn-success m-2">تعديل</a>
                                           <form id="delete_unit_{{ $unit->id }}"  action="{{ route('unit.destroy',$unit->id) }}"
                                            method="post">
                                              @csrf
                                              @method('DELETE')
                                              <button class="btn btn-danger" onclick="event.preventDefault();
                                                  var r = confirm('هل انت متاكد ؟');
                                                  if (r == true) {document.getElementById('delete_unit_{{ $unit->id }}').submit();}">حذف</button>
                              
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
