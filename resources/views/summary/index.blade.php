@extends('layouts.sneat')
@section('content')


    <div class="col-lg-12 mb-3">
        <div class="card">
            <div class="card-body">
                <div>
                    <h4>  تقرير الارباح و الخسائر (السنة الحالية) </h4>
                </div>
               
            </div>    
        </div>
    </div>

    <div class="row mb-3">
       <div class="col-lg-4">
        <div class="card">
                <div class="card-header">
                    <div>
                        <h4> مجموع مبيعات    </h4>
                    </div>
                
                </div> 
                <div class="card-body">
                    <div>
                        <h2> {{ number_format($totalOrder,2) }} </h2>
                    </div>
                
              </div>          
        </div>       
      </div>

      <div class="col-lg-4">
        <div class="card">
                <div class="card-header">
                    <div>
                        <h4> مجموع مشتريات    </h4>
                    </div>
                
                </div> 
                <div class="card-body">
                    <div>
                        <h2> {{ number_format($totalPurchase,2) }} </h2>
                    </div>
                
              </div>          
        </div>       
      </div>

      <div class="col-lg-4">
        <div class="card @if($netProfit > 0) bg-success @else bg-danger @endif text-white">
                <div class="card-header">
                    <div>
                        <h4> مجموع صافي الربح    </h4>
                    </div>
                
                </div> 
                <div class="card-body">
                    <div>
                        <h2> {{ number_format($netProfit,2) }} </h2>
                    </div>
                
              </div>          
        </div>       
      </div>


    </div>


@endsection
