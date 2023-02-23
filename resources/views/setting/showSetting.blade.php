@extends('layouts.app')

@section('content')
    
    <section class="col-lg-4 mb-3">
        <a href="{{ route('admin.paymentType.index') }}">
        <div class="card bg-white text-dark box-shadow">
            <div class="card-body main-boxes">
                
                <div class="section-name">
                      طرق الدفع
                </div>
               
            </div>
        </div>
         </a>
    </section>   



    <section class="col-lg-4 mb-3">
        <a href="{{ route('admin.setting.index') }}"  {{-- class="btn-link disabled" aria-disabled="true" --}}>
        <div class="card bg-white text-dark box-shadow">
            <div class="card-body main-boxes">
               
                <div class="section-name">
                    بيانات المتجر
                </div>
                
            </div>
        </div>
        </a>
    </section>   


       


@endsection
