<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\UserRegionalModel;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');

        // check if already exist in table `user_regionals`
        if (Auth::guard('user_regionals')->attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        // check if already exist in table `user_pos`
        if (Auth::guard('user_pos')->attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        // check if already exist in table `user_pic`
        if (Auth::guard('user_pic')->attempt($credentials)) {
            return redirect()->intended('dashboard');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function register()
    {
        return view('auth.register');
    }
      
    public function customRegister(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data, $request->flag);
         
        return redirect("login")->withSuccess('You have signed-in');
    }

    public function create(array $data, $flag)
    {
        UserRegionalModel::create([
            'username' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }    
    
    public function dashboard()
    {

        if(Auth::guard('user_regionals')->check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        
        if (!empty(Auth::guard('user_regionals')->user()->username)) {
            Auth::guard('user_regionals')->logout();
        }
    
        if (!empty(Auth::guard('user_pos')->user()->username)) {
            Auth::guard('user_pos')->logout();
        }
    
        if (!empty(Auth::guard('user_pic')->user()->username)) {
            Auth::guard('user_pic')->logout();
        }
  
        return Redirect('login');
    }
}
