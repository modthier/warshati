@extends('layouts.sneat')
@section('content')

<form action="{{ route('service_request.store') }}" method="post">
@csrf
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4>إضافة  خدمة</h4>
            <hr>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-lg-4">
                    <label for="service_id"><h5> اسم الخدمة</h5></label>
                    <select name="service_id" id="service_id" class="form-control">
                        <option value=""></option>
                    </select>
                </div>

                <div class="form-group col-lg-4">
                    <label for="client_id"><h5> اسم العميل</h5></label>
                    <div class="d-flex justify-content-center">
                       
                            <select name="client_id" id="client_id" class="form-control sharp-edges-select" required>
                                <option value=""></option>
                            </select>
                            <button class="btn btn-primary sharp-edges-button" id="add_client"><i class="bx bxs-plus-circle"></i></button>
                        
                    </div>
                    
                </div>
                <div class="form-group col-lg-4">
                    <label for="car_id"><h5>  حجم المركبة </h5></label>
                    <select name="car_id" id="car_id" class="form-control form-control-lg" required>
                        <option value=""></option>
                        @foreach ($carSizes as $item)
                        <option value="{{ $item->id }}">{{ $item->car }}</option>
                        @endforeach
                    </select>
                </div>

                
                <div class="mt-3">
                    <button type="button" class="btn btn-success btn-lg" id="addItem">اضافة</button>
                </div>
            </div>

            <hr class="mt-3">
            <div class="row">
                
                    <table class="table">
                        <thead>
                            <th>اسم الخدمة</th>
                            <th>سعر الخدمة</th>
                            <th>#</th>
                        </thead>
                        <tbody class="service-area">
        
                        </tbody>
                    </table>
                    <input type="hidden" name="total" id="serviceTotal">
                    <div class="d-flex justify-content-between align-items-center p-3 mt-5">
                        <div>
                            <h4>السعر الكلي : <span id="serviceDisplayTotal"></span></h4>
                        </div>
                        <div class="px-1">
                            <input type="submit" value="حفظ" id="order-btn" class="btn btn-success">
                        </div>
                    </div>
                
            </div>
            
        </div>
    </div>
    
</div>

</form>


@endsection

@push('js')
<script>
    calc();

    $('#service_id').select2({
    width: "100%",
     ajax : {
        url: "/service/getService",
        type : "get" ,
        dataType : "json",
        data : function (params) {
           return {
              search : params.term
           };
        } ,
        processResults: function (response) {
         
          return{
            results : response
          };
        },
        cache: false
      }
  });

  $('#client_id').select2({
    width: "100%",
     ajax : {
        url: "/client/getClients",
        type : "get" ,
        dataType : "json",
        data : function (params) {
           return {
              search : params.term
           };
        } ,
        processResults: function (response) {
         
          return{
            results : response
          };
        },
        cache: false
      }
  });
 
 $('#addItem').on('click',function(e){
 
  e.preventDefault();
  var service_id = $('#service_id').val();
  var name = $('#service_id').find(':selected').text();
 
 
  if(service_id){
 
 
  var html = `
      <tr>
          <td>${name}</td>
          <td><input type="number" class='price form-control'  id="price-${service_id}"
              data-id="${service_id}" 
              class="form-control price">
          </td>
          <td>
              <button type="button" data-id="${service_id}"
                class="btn btn-danger delete-service">
                <i class="bx bxs-trash"></i>
              </button>
          </td>    
           
      </tr>
    `;
 
    
    if($('#price-'+service_id).length == 0){
       
       $('.service-area').append(html);
       $('#price-'+service_id).focus();
      
    }
 
   }
 
   calc();
 
    
 });
 
 
 
 $('body').on('click','.delete-service',function(e){
 
  e.preventDefault();		
  $(this).closest('tr').remove();
  calc();
 
 });
 
 
 $('body').on('change','.price',function(e){
 
    var id = $(this).data('id');
    var price = parseFloat($(this).val());
    $('#subtotal-'+id).val(price);
 
    calc();
 });
 
 
 function calc(){
    var price = 0.0;
     $('.service-area .price').each(function(index){
         
         price += parseFloat($(this).val());
         
     });
 
     $('#serviceTotal').val(price);
     $('#serviceDisplayTotal').html(price);
 
     if (price > 0) {
         $('#service-btn').attr('disabled',false);
     }else {
         $('#service-btn').attr('disabled','disabled');
     }
 }

</script>
@endpush