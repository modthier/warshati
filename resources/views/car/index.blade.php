@extends('layouts.sneat')
@section('content')


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>قائمة احجام المركبات</h4>
                </div>
               
            </div>
            <hr>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th> حجم المركبة </th>
                                <th> نسبة العامل </th>
                                <th>عمليات</th>
                            </tr>
                            <tbody>
                                @forelse ($cars as $car)
                                <tr>
                                    <td>{{ $car->car }}</td>
                                    <td>
                                        @if($car->serviceType)
                                        <table class="table table-bordered">
                                            @foreach($car->serviceType as $head)
                                            <th>{{ $head->type }}</th>
                                            @endforeach

                                           
                                            <tr>
                                                @foreach($car->serviceType as $tr)
                                                <td>{{ $tr->pivot->ratio }}</td>
                                                @endforeach
                                            </tr>
                                            
                                        </table>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex  align-items-center">
                                           <a href="{{ route('cars.edit',$car->id) }}" class="btn btn-success m-2">تعديل</a>   
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
