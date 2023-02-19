@extends('layouts.sneat')
@section('content')


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>قائمة العملاء</h4>
                </div>
                <div>
                    <a href="{{ route('client.create') }}" class="btn btn-primary">
                        <i class="bx bxs-plus-circle"></i>
                         إضافة عميل </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>اسم العميل</th>
                                <th>رقم الهاتف</th>
                                <th>رقم اللوحة</th>
                                <th>عمليات</th>
                            </tr>
                            <tbody>
                                @forelse ($clients as $client)
                                <tr>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->phone }}</td>
                                    <td>{{ $client->plate_number }}</td>
                                    <td>
                                        <div class="d-flex  align-items-center">
                                           <a href="{{ route('client.edit',$client->id) }}" class="btn btn-success m-2">تعديل</a>
                                           <form id="delete_client_{{ $client->id }}"  action="{{ route('client.destroy',$client->id) }}"
                                            method="post">
                                              @csrf
                                              @method('DELETE')
                                              <button class="btn btn-danger" onclick="event.preventDefault();
                                                  var r = confirm('هل انت متاكد ؟');
                                                  if (r == true) {document.getElementById('delete_client_{{ $client->id }}').submit();}">حذف</button>
                              
                                            </form>   
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <h4 class="text-danger text-center">لا يوجد عملاء حاليا</h4>
                                @endforelse
                                
                                
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
            
        </div>
    </div>


@endsection
