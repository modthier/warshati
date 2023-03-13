$('#product_id').select2({
   width: "100%",
    ajax : {
       url: "/product/getProduct",
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
 }).on('select2:select', function (e) {
   var data = e.params.data;  
                 
   $(this).children('[value="'+data['id']+'"]').attr(
      {
       'data-quantity':data["data-quantity"]
      }
   );
});


$('#addItem').on('click',function(e){

 e.preventDefault();
 var product_id = $('#product_id').val();
 var name = $('#product_id').find(':selected').text();
 var quantity_per_unit = $('#product_id').find(':selected').data('quantity');
 
 if(product_id){


 var html = `
     <tr>
         <td>${name}</td>
         <td><input type="number" step="0.01" min="0" value=""  placeholder="الكمية المشتراه" name="products[${product_id}][quantity]" 
             data-id="${product_id}"  
             data-units="${quantity_per_unit}"
             id="quantity-${product_id}" 
             class="form-control quantity">
         </td>
         <td><input type="number" step="0.01" min="0" value=""  placeholder="الكمية بالوحدة" id="quantity_per_unit-${product_id}"
             name="quantity_per_unit-${product_id}" 
             class="form-control quantity_per_unit">
         </td>

         <td><input type="number" step="0.01" min="0" value=""  placeholder="سعر البيع للوحدة"  name="selling_price-${product_id}" 
            class="form-control selling_price">
         </td>

         <td><input type="number" step="0.01" min="0" value=""  placeholder="سعر الشراء للوحدة" id="purchase_price-${product_id}"  
            name="purchase_price-${product_id}" 
            class="form-control purchase_price">
         </td>

         <td><input type="number" step="0.01" name="subtotal-${product_id}"  data-id="${product_id}" data-units="${quantity_per_unit}" class="form-control subtotal" id="subtotal-${product_id}" value="0"></td>
         <td><button type="button" data-id="${product_id}" class="btn btn-danger delete-product"><i class="bx bxs-trash"></button></td>
         
     </tr>
   `;

   
   if($('#quantity-'+product_id).length == 0){
      
      $('.item-area').append(html);
      calc();
   }
}

   
});



$('body').on('click','.delete-product',function(e){

 e.preventDefault();		
 var id = $(this).data('stock-id');

 $(this).closest('tr').remove();
 calc();

});


$('body').on('change','.quantity',function(e){

   var id = $(this).data('id');
   var units = $(this).data('units');
   var quantity = $("#quantity-"+id).val();
   $('#quantity_per_unit-'+id).val(parseInt(quantity * units));
  
});

$('body').on('change','.subtotal',function(e){
   var id = $(this).data('id');
   var units = $(this).data('units');
   var quantity = $("#quantity-"+id).val();
   var purchase_price = purchase_price_calculate($(this).val(),quantity,units);
   $('#purchase_price-'+id).val(purchase_price);
   calc();
  
});

function calc(){
   var price = 0.0;
	$('.item-area .subtotal').each(function(index){
		
		price += parseFloat($(this).val());
		
	});

	$('#total').val(price);
	$('#displayTotal').html(price);

	if (price > 0) {
		$('#order-btn').attr('disabled',false);
	}else {
		$('#order-btn').attr('disabled','disabled');
	}
}

function purchase_price_calculate (subtotal,quantity,units) { 
   var purchase_price = (parseFloat(subtotal) / parseFloat(quantity)) / parseFloat(units);
   return purchase_price;
 }