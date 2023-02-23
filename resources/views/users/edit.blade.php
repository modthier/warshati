@extends('layouts.sneat')
@section('content')

<section class="col-lg-12">
      <div class="card">
        <form method="POST" action="{{ route('users.update',$user->id) }}">
            {{ csrf_field() }} 
            {{ method_field('PUT') }}
            <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                 <div class="form-group">
                 	<label for="name">اسم المستخدم</label>
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  </div>
              </div>

                <
            </div>

            
            </div><!-- end of card-body -->

            <div class="card-footer">
                
                    <button type="submit" class="btn btn-primary">
                        تحديث
                    </button>
                
            </div>

         

        </form>
         
      </div>
      </section> 
@endsection
