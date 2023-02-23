@extends('layouts.sneat')
@section('content')

<section class="col-12">
	<h3> بيانات المتجر </h3>
</section>
<section class="col-12 mt-3">
    <div class="card">
        <div class="card-body p-0">
            @if($setting->count() > 0)
            <a href="{{ route('setting.edit',$setting->first()->id ) }}" class="btn btn-primary">تعديل</a>
            </button>
            <div class="row">
                <div class="col-md-9">
                    <table class="table table-hoverd" style="direction: rtl; text-align:right; ">
                        <tr>
                            <td>  اسم المتجر : <h4>  {{ $setting->first()->name }} </h4></td>
                            <td> رقم الهاتف : <h4>  {{ $setting->first()->phone }} </h4></td>
                        </tr>
                        <tr>
                            <td> عنوان التجر <h4>{{ $setting->first()->address }}</h4></td>
                            
                        </tr>
                    </table>
                </div>
                
            
            </div>
            @else 
            <h3 class="text-center text-danger mt-3">لم يتم اضافة بيانات المتجر بعد
            <button id="add-setting" class="btn btn-lg btn-primary text-center">
                <i class="fa fa-plus"></i>
            </button>
             </h3>
            @endif
        </div>
    </div>
</section>

@endsection