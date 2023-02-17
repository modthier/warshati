@extends('layouts.sneat')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>تفاصيل المبيعات</h4>
                </div>
                <div>
                   <a href="{{ route('order.index') }}" class="btn btn-danger">رجوع</a>
                   <button id="btn-print" class="btn btn-primary">طباعة الايصال</button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-focus">
                        <thead class="table-info">
                            <tr>
                                <th>#الرقم المرجعي للطلب</th>
                                <th> اسم المستخدم </th>
                                <th>الكمية المباعة</th>
                                <th> السعر الكلي </th>
                                <th> التاريخ </th>
                                <th> عمليات </th>
                               

                            </tr>
                        <tbody>
                           
                                <tr>
                                    <td><a href="{{ route('order.show',$order->id) }}" class="btn btn-primary">#{{ $order->id }}</a></td>
                                    <td></td>
                                    <td>{{ $order->stock_count }}</td>
                                    <td>{{ number_format($order->total,2) }} جنيه</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <a href="{{ route('order.edit',$order->id) }}" class="btn btn-warning">تعديل</a>
                                    </td>
                                    
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
                        <th>اسم المنتج</th>
                        <th>سعر الشراء </th>
                        <th>سعرالبيع</th>
                        <th>الكمية</th>
                        <th>صافي الربح</th>
                        <th>المجموع</th>
                    </thead>
                    <tbody>
                        @foreach ($order->stock as $stock)
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
                                        @foreach($order->stock as $stock)
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
                             <h5 style=" color:#000000; font-weight: bolder;">المجموع   : {{ number_format($order->total,2) }}  جنيه </h5>
                        </div>
                
                        <div>
                            <table class="table table-borderless table_invoice table-sm" style="text-align: right;" dir="rtl">
                                <tr>
                                    <td>رقم الفاتورة   :</td>
                                    <td>{{ $order->id }}</td>
                                </tr>
                                <tr>
                                    <td> اسم المستخدم  :</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>التاريخ  :</td>
                                    <td>{{ $order->created_at }}</td>
                                </tr>
                            </table>
                        </div>
                                  
                
                     </div><!--End InvoiceBot-->
                  </div><!--End Invoice-->
            </div>
        </div>
    </div>
@endsection
