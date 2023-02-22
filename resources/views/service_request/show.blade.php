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
        <div class="card">
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
    </div>


    <div class="col-lg-4 mt-3">
        <div class="card">
            <div class="card-body">
                <div id="invoice-POS">
    
        
        
                    <div id="bot" class="mt-3" style="direction: rtl;">
                
                        <div>
                            <table class="table table-sm table_invoice">
                               
                                    <thead>
                                        <th style=" color: #000000;" class="table_invoice"> المنتج  </th>
                                        <th style=" color: #000000;" class="table_invoice">  الكمية   </th>
                                        <th style=" color: #000000;" class="table_invoice"> المجموع  </th>
                                    </thead>
                
                                    <tbody>
                                       
                                    </tbody>
                
                               
                
                            </table>
                        </div><!--End Table-->
                
                        <div class="p-2" style="background-color: #eee; text-align: right;">
                             <h5 style=" color:#000000; font-weight: bolder;">المجموع   : </h5>
                        </div>
                
                        <div>
                            <table class="table table-borderless table_invoice table-sm" style="text-align: right;" dir="rtl">
                                <tr>
                                    <td>رقم الفاتورة   :</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td> اسم المستخدم  :</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>التاريخ  :</td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                                  
                
                     </div><!--End InvoiceBot-->
                  </div><!--End Invoice-->
            </div>
        </div>
    </div>
@endsection
