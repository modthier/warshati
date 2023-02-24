@extends('layouts.sneat')
@section('content')


<div class="col-md-6 col-xl-4">
<div class="card bg-primary text-white mb-3">
    <div class="card-header">مجموع عمولة اليوم</div>
    <div class="card-body">
    <h5 class="card-title text-white">{{ number_format($today,2) }} جنيه</h5>
    
    </div>
</div>
</div>


<div class="col-md-6 col-xl-4">
<div class="card bg-primary text-white mb-3">
    <div class="card-header">مجموع عمولة الاسبوع</div>
    <div class="card-body">
    <h5 class="card-title text-white">{{ number_format($week,2) }} جنيه</h5>
    
    </div>
</div>
</div>


<div class="col-md-6 col-xl-4">
<div class="card bg-primary text-white mb-3">
    <div class="card-header">مجموع عمولة الشهر</div>
    <div class="card-body">
    <h5 class="card-title text-white">{{ number_format($month,2) }} جنيه</h5>
    
    </div>
</div>
</div>


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>بيانات العامل</h4>
                </div>
                <div>
                    <a href="{{ route('worker.index') }}" class="btn btn-danger">
                       
                         رجوع</a>
                </div>
            </div>
            <hr>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>اسم العامل</th>
                                <th> رقم الهاتف </th>
                                <th> العنوان </th>
                                
                            </tr>
                            <tbody>
                               
                                <tr>
                                    <td>{{ $worker->name }}</td>
                                    <td>{{ $worker->phone }}</td>
                                    <td>{{ $worker->address }}</td>
                                </tr>
                               
                                
                                
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
            
        </div>
    </div>

    <div class="col-lg-12 mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>بيانات العمولة</h4>
                </div>
                
            </div>
            <hr>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>الرقم المرجعي </th>
                                <th> اسم الخدمة  </th>
                                <th> العمولة </th>
                                
                            </tr>
                            <tbody>
                                @forelse($worker->ratio as $item)
                                <tr>
                                    <td><a href="{{ route('service_request.show',$item->serviceRequest->id) }}" class="btn btn-primary">{{ $item->serviceRequest->id }}</a></td>
                                    <td>{{ $item->service->name }}</td>
                                    <td>{{ $item->amount }}</td>
                                </tr>
                               @empty
                                <h4 class="text-danger text-center"> لا يوجد عمولات حاليا </h4>
                               @endforelse
                                
                                
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
            
        </div>
    </div>


@endsection
