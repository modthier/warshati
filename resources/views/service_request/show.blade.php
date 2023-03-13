@extends('layouts.sneat')
@section('content')
    <div class="col-lg-12">
    <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>تفاصيل طلب الخدمات</h4>
                </div>
                <div>
                    <a href="{{ route('service_request.index') }}" class="btn btn-danger"> رجوع </a>
                    <button id="btn-print" class="btn btn-primary">طباعة الايصال</button>
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
                                
                            </tr>
                            <tbody>
                               
                                <tr>
                                    <td>{{ $service->id }}</td>
                                    <td>{{ $service->client->name }}</td>
                                    <td>{{ $service->car->car }}</td>
                                    <td>{{ $service->worker->name }}</td>
                                    <td>{{ number_format($service->amount,2) }}</td>
                                  
                                </tr>
                              
                                
                                
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>

            
        </div>
    </div>

    <div class="col-lg-8 mt-3">
        <div class="card mb-3">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>اسم الخدمة</th>
                        <th> سعر الخدمة </th>
                    </thead>
                    <tbody>
                        @foreach ($service->service as $item)
                          <tr>
                            <td>{{ $item->name }}</td>
                             <td>{{ number_format($item->pivot->price,2) }}</td>
                             
                          </tr>  
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>

        @if($service->order)
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>اسم المنتج</th>
                        <th>سعر الشراء </th>
                        <th>سعرالبيع</th>
                        <th>الكمية</th>
                        <th>صافي الربح</th>
                        <th>المجموع</th>
                    </thead>
                    <tbody>
                        @foreach ($service->order->stock as $stock)
                          <tr>
                             <td>{{ $stock->product->name }}</td>
                             <td>{{ number_format( $stock->pivot->purchase_price,2) }}</td>
                             <td>{{ number_format( $stock->pivot->selling_price,2) }}</td>
                             <td>{{  $stock->pivot->quantity }}</td>
                             <td>{{ number_format(($stock->pivot->selling_price * $stock->pivot->quantity ) - ($stock->pivot->purchase_price * $stock->pivot->quantity),2) }}</td>
                             <td>{{ number_format( $stock->pivot->selling_price * $stock->pivot->quantity,2) }}</td>
                          </tr>  
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
        @endif

        
    </div>


    <div class="col-lg-4 mt-3">
        <div class="card">
            <div class="card-body">
                <div id="invoice-POS">
    
        
        
                    <div id="bot" class="mt-3" style="direction: rtl;">
                    <div class="mb-3">
                          <h3 style="text-align:center; color:#000000; font-weight:bolder;"> {{ $setting->first()->name }} </h3>
                          <table border="1" class="table table-sm table_invoice">
                             
                                  <thead style="border:1px solid black;">
                                      <th style=" color: #000000; font-weight:bolder; font-size:20px;" class="table_invoice"> الخدمة  </th>
                                      <th style=" color: #000000; font-weight:bolder; font-size:20px;" class="table_invoice"> السعر </th>
                                  </thead>
              
                                  <tbody style="border:1px solid black;">
                                      
                                      @foreach($service->service as $item)
                                      <tr>
                                          <td>{{ $item->name }}</td>
                                          <td>{{ $item->pivot->price }}</td>
                                      </tr>
                                      @endforeach
                                     
                                  </tbody>
              
                             
              
                          </table>
                          
                      </div><!--End Table-->
                      <div class="p-2" style="background-color: #eee; text-align: right;">
                             <h5 style=" color:#000000; font-weight: bolder;">المجموع   : {{ number_format($service->amount,2) }}</h5>
                        </div>
                        @if($service->order)
                        <div>
                         
                            <table class="table table-sm table_invoice">
                               
                                    <thead>
                                        <th style=" color: #000000;" class="table_invoice"> المنتج  </th>
                                        <th style=" color: #000000;" class="table_invoice">  الكمية   </th>
                                        <th style=" color: #000000;" class="table_invoice"> المجموع  </th>
                                    </thead>
                
                                    <tbody>
                                        
                                        @foreach($service->order->stock as $stock)
                                        <tr>
                                            <td>{{ $stock->product->name }}</td>
                                            <td>{{ $stock->pivot->quantity }}</td>
                                            <td>{{ number_format($stock->pivot->selling_price * $stock->pivot->quantity,2) }}</td>
                                        </tr>
                                        @endforeach
                                       
                                    </tbody>
                
                               
                
                            </table>
                            
                        </div><!--End Table-->
                
                        <div class="p-2" style="background-color: #eee; text-align: right;">
                             <h5 style=" color:#000000; font-weight: bolder;">المجموع   : {{ number_format($service->order->total,2) }}</h5>
                        </div>
                       
                        <div>
                            <table class="table table-borderless table_invoice table-sm" style="text-align: right;" dir="rtl">
                                <tr>
                                    <td>رقم الفاتورة   : {{ $service->order->id }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td> اسم المستخدم  : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>التاريخ  : {{ $service->order->created_at }}</td>
                                    <td></td>
                                </tr>
                            </table>
                            @endif
                            <div>
                                <h5 class="text-center mt-3" style="color:#000000; font-weight: bolder;">المجموع الكلي : @if($service->order) {{ number_format($service->amount + $service->order->total,2) }} @else {{ number_format($service->amount,2) }} @endif</h5>
                            </div>
                        </div>
                                  
                
                     </div><!--End InvoiceBot-->
                  </div><!--End Invoice-->
            </div>
        </div>
    </div>
@endsection
