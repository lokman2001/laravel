<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // login Page
    public function loginPage(){
        return view('auth.login');
    }

    // register page
    public function registerPage(){
        return view('auth.register');
    }

    //change password
    public function adminchangePasswordView(){
        return view('admin.changepwd');
    }

    public function userchangePasswordView(){
        return view('user.changepwd');
    }

    public function adminchangePassword(request $request){

        $this->vailPassword($request);
        // current user id
        $CUID = Auth::user()->id;
        //old password
        $OP = User::where('id', $CUID)->first();
        $OP = $OP->password;
        // new password
        $NP = Hash::make($request->newPassword);

        if(Hash::check($request->currentPassword,$OP)){
            User::where('id',$CUID)->update(['password' => $NP]);
        }else{
            return back()->with(['error' => 'incorrect password']);
        }
        return redirect()->route('admin#profile');
    }

    public function userchangePassword(request $request){

        $this->vailPassword($request);
        // current user id
        $CUID = Auth::user()->id;
        //old password
        $OP = User::where('id', $CUID)->first();
        $OP = $OP->password;
        // new password
        $NP = Hash::make($request->newPassword);

        if(Hash::check($request->currentPassword,$OP)){
            User::where('id',$CUID)->update(['password' => $NP]);
        }else{
            return back()->with(['error' => 'incorrect password']);
        }
        return redirect()->route('user#profile');
    }


    private function vailPassword($data){
        Validator::Make($data->all(),[
            'currentPassword' => ['required','min:8' ],
            'newPassword' => ['required','min:8'],
            'comfirmPassword' => ['required','min:8','same:newPassword'],
        ])->validate();


    }

    // dashboard
    public function authdashboard(){
        if(Auth::user()->role == 'admin'){
            return redirect()->route('admin#dashboard');
        }else if(Auth::user()->role == 'user'){
            return redirect()->route('user#dashboard');
        }


    }

}
