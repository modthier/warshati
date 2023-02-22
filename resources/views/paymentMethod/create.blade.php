@extends('layouts.sneat')
@section('content')


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="m-0 pb-0">اضافة طريقة دفع</h4>
                </div>
                <div>
                    <a href="{{ route('payment.index') }}" class="btn btn-danger">
                        <i class="bx bx-arrow-back"></i>
                          رجوع </a>
                </div>
                
            </div>
            <hr>
            <form action="{{ route('payment.store') }}" id="numbering-form" method="POST">
                @csrf
                <div class="card-body pt-0">
                        <div class="row">
                            <div class="form-group col-md-12  mb-2">
                                <label for="location" class="form-label">طريقة الدفع</label>
                                <input type="text" name="method" class="form-control form-control-lg" required>
                            </div>

                            <div class="form-group col-md-12  mb-2">
                                <label for="payment_type" class="form-label">نوع الدفع</label>
                                <select name="payment_type[]" id="payment_type" multiple="multiple" class="form-control form-control-lg">
                                    <option value=""></option>
                                    @foreach ($types as $item)
                                        <option value="{{ $item->id }}">{{ $item->type }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>

                        </div>
                        <button type="submit"  
                        class="next btn btn-success pull-right btn-lg mt-3">حفظ</button>
                </div>
            </div>
            </form>
        </div>
    </div>


    
@endsection

@push('js')
<script>
    $('#payment_type').select2();
</script>    
@endpush


