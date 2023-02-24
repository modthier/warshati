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
                <div class="form-group col-lg-6">
                    <label for="service_id"><h5> اسم الخدمة</h5></label>
                    <select name="service_id" id="service_id" class="form-control">
                        <option value=""></option>
                    </select>
                </div>

                <div class="form-group col-lg-6">
                    <label for="client_id"><h5> اسم العميل</h5></label>
                    <div class="d-flex justify-content-center">
                       
                            <select name="client_id" id="client_id" class="form-control sharp-edges-select" required>
                                <option value=""></option>
                            </select>
                            <button class="btn btn-primary sharp-edges-button" id="add_client"><i class="bx bxs-plus-circle"></i></button>
                        
                    </div>
                    
            </div>
                <div class="form-group col-lg-6 mt-3">
                    <label for="car_id"><h5>  حجم المركبة </h5></label>
                    <select name="car_id" id="car_id" class="form-control form-control-lg" required>
                        <option value=""></option>
                        @foreach ($carSizes as $item)
                        <option value="{{ $item->id }}">{{ $item->car }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-lg-6 mt-3">
                    <label for="payment_method_id"><h5>  طرق الدفع </h5></label>
                    <select name="payment_method_id"  class="form-control form-control-lg" required>
                        <option value=""></option>
                        @foreach ($payments as $item)
                        <option value="{{ $item->id }}">{{ $item->method }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-lg-6 mt-3">
                    <label for="worker_id"><h5> حدد العامل </h5></label>
                    <select name="worker_id"  class="form-control form-control-lg" required>
                        <option value=""></option>
                        @foreach ($workers as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                            <input type="submit" value="حفظ" id="service-btn" class="btn btn-success">
                        </div>
                    </div>
                
            </div>
            
        </div>
    </div>
    
</div>

</form>


<div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <div id="alert"></div>
              <form action="{{ route('client.store') }}" id="myForm" method="POST">
                @csrf
                <div class="card-body pt-0">
                    <div class="row">

                        <div class="form-group col-md-12 mb-2">
                            <label for="name" class="form-label"><h5>اسم العميل</h5></label>
                            <input type="text" name="name" class="form-control form-control-lg" required>
                        </div>

                        <div class="form-group col-md-12 mb-2">
                            <label for="phone" class="form-label"><h5> رقم الهاتف </h5></label>
                            <input type="text" name="phone" class="form-control form-control-lg" required>
                        </div>

                        <div class="form-group col-md-12 mb-2">
                            <label for="plate_number" class="form-label"><h5> رقم اللوحة </h5></label>
                            <input type="text" name="plate_number" class="form-control form-control-lg"
                             required>
                        </div>

                    </div>

                    <button type="submit" class="next btn btn-success pull-right btn-lg">حفظ</button>

                </div>
        </div>
        </form>
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                  اغلاق
                </button>
                
              </div>
            </div>
          </div>
        </div>

      </div>


@endsection

@push('js')
<script>
    calc();
    $('#add_client').on('click',function(){
        $('#modalCenter').modal('show');
    });


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

  $("#myForm").on("submit", function(event){
    event.preventDefault();
        $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
        }
        });
            var formValues= $(this).serialize();
    
            
            $.ajax({
                url : '{{ route('client.storeAjax') }}',
                type : 'post',
                data : formValues,
                success:function(result){
                    $('#alert').html(result);
                    $('#myForm').trigger("reset");
                }
            });
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
          <td><input type="number" class='price form-control' name="services[${service_id}][price]"  id="price-${service_id}"
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