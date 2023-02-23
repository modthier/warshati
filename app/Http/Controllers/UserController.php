<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class UserController extends Controller
{
    

    public function index()
    {
    	$users = User::get();
    	return view('users.index')->with('users',$users);
    }


    
    public function create()
    {
        $roles = Role::all();
        return view('users.create')->with('roles',$roles);
    }

    protected function validator(Request $request)
    {
        return Validator::make($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required']
        ]);
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required']
        ]);
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role()->associate($request->role_id);
        $user->save();


        return redirect()->route('users.index');
    }



    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit')->with(['user' => $user]);
    }


    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);


        $user = User::findOrFail($id);

        $name = $request->name;

        $data = [
            'name' => $name ,
        ];


        if($user->update($data)) {
            return redirect()->route('users.index');
        }
    }


    public function destroy(Request $request,$id)
    {
        if (Auth::id() == $id) {
            
            return redirect()->route('users.index')->withErrors("لا يمكنك حذف حسابك");
        }

        $user = User::findOrFail($id);
        
        $user->delete();
        return redirect()->route('register.index')->with('success',"تم حذف المستخدم بنجاح");;
    }


    public function resetPasswordForm($id)
    {
        $user = User::findOrFail($id);
        return view('users.resetPassword')->with('user',$user);
    }

    public function resetPassword(Request $request,$id)
    {

        $this->validate($request,[
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required','string', 'min:8']
        ]);

        $user = User::findOrFail($id);
        
       
        if ($request->password === $request->confirm_password) {

        $hashed_password = Hash::make($request->password);

        $user->update([
            'password' => $hashed_password
        ]);

        if (Auth::id() == $id) {

             Auth::guard()->logout();

             $request->session()->invalidate();

             $request->session()->regenerateToken();

             return  redirect()->route('login');
        }else {
            $request->session()->flash('success','تم تحديث كلمة المرور بنجاح');
            return redirect()->route('users.index');
        }
        


        }else {
            
            return  redirect()->route('user.resetPasswordForm',$user->id)->with('error','كلمتي المرور غير متطابقات');
        }
       
    }

   
  
    

   
}
