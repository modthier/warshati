@extends('layouts.sneat')
@section('content')
<section class="col-lg-12">
  
            <div class="card">
               

                
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="card-body">
                        <div class="row">
	                        <div class="col-md-6">
	                           <div class="form-group">
	                           	<label for="name">اسم المستخدم</label>
	                            <input id="name" type="text" class="form-control form-control-lg mb-3 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

	                            @error('name')
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                            @enderror
	                            </div>
	                        </div>

	                         <div class="col-md-6">
	                         	<div class="form-group">
	                                <label for="email">البريد الالكتروني</label>
	                                <input id="email" type="email" class="form-control form-control-lg mb-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

	                                @error('email')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
                                </div>
                            </div>
                        </div>
                        

                        <div class="row">

                        	<div class="col-md-6">
                        		<div class="form-group">
	                        		 <label for="password">كلمة المرور</label>

	                        		  <input id="password" type="password" class="form-control form-control-lg mb-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

	                                @error('password')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
                                </div>
                        	</div>

                        	<div class="col-md-6">
                        		<div class="form-group">
                        			 <label for="password-confirm">تاكيد كلمة المرور</label>

                        			 <input id="password-confirm" type="password" class="form-control form-control-lg mb-3" name="password_confirmation" required autocomplete="new-password">
                        		</div>
                        	</div>
                        </div>

                        <div class="row">
                        	<div class="col-md-6">
                        		<div class="form-group">
                        			<label>الصلاحية</label>
                        			<select name="role_id" class="form-control form-control-lg">
                        				<option></option>
                        				@foreach ($roles as $role)
                        					<option value="{{$role->id}}">{{$role->name}}</option>
                        				@endforeach
                        			</select>
                        		</div>
                        	</div>
                        </div>

                        
                        </div><!-- end of card-body -->

                        <div class="card-footer">
                            
                                <button type="submit" class="btn btn-primary">
                                   حفظ
                                </button>
                            
                        </div>

                     

                    </form>
               
            </div>
      </section> 
@endsection
