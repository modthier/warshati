@extends('layouts.sneat')
@section('content')


 <section class="col-lg-12">
    <div class="card">    
      <form action="{{ route('user.resetPassword',$user->id) }}" method="post">
        {{ csrf_field() }} 
        <div class="card-body">
          <div class="row">
              

               <div class="col-sm-12">
                  <div class="form-group">
                      <label>كلمة المرور الجديدة</label>
                      <input type="password" name="password" 
                        class="form-control" required>
                  </div>
              </div>

               <div class="col-sm-12">
                  <div class="form-group">
                      <label>تاكيد كلمة المرور</label>
                      <input type="password" name="confirm_password" 
                        class="form-control" required>
                  </div>
              </div>


          </div>
        </div>
         <div class="card-footer">
          
              <input type="submit" value="اعادة تعيين كلمة المرور" class="btn btn-primary btn-lg">
          
         </div>
      </form>
           

    </div>
</section>

@endsection
