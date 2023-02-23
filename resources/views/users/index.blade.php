@extends('layouts.sneat')
@section('content')

 <section class="col-lg-12">
    <div class="card">
        <div class="card-header">
          <div class="card-title">
             <a href="{{ route('users.create') }}" class="btn btn-primary">اضافة مستخدم</a>
          </div>
         
        </div>
        <div class="card-body table-responsive p-0">

            <table class="table table-hover">
                <thead>
                    <th style="width: 10px;">#</th>
                    <th>اسم المستخدم</th>
                    <th>البريد الالكتروني</th>
                    <th>الصلاحية</th>
                    <th>عمليات</th>
                </thead>

                <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>                    
                    <td>

                      <a href="{{ route('users.edit',$user->id) }}" class="btn btn-success btn-sm float-left ml-1">تحديث</a>
                       <a href="{{ route('user.resetPasswordForm',$user->id) }}" class="btn btn-sm btn-primary float-left  mr-1">
                        اعادة تعيين كلمة المرور
                      </a>
                      
                     


                    </td>
                  </tr>
                  @endforeach
                </tbody>
            </table>

        </div>

        



    </div>
</section>

@endsection
