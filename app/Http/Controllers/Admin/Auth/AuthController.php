<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     public function login(Request $request){
          return view('Admin.auth.login');
     }

     public function register(Request $request){
        return view('Admin.auth.register');
     }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // return redirect(url('admin/dashboard'))->with('success', 'Logging in successfully');
            return  redirect()->route('company.index')->with('success', 'Logging in successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function registerSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('admin')->login($admin);
        // return redirect(url('admin/dashboard'))->with('success', 'Registration successfully');
        // return redirect(url('admin/dashboard'))->with('success', 'Registration successfully');
         return  redirect()->route('company.index')->with('success', 'Registration successfully');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect(url('admin/login'))->with('success', 'Logged out successfully');
    }

}

