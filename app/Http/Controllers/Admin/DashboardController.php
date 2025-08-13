<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
     // public function index(){
     //      return view('Admin.view.dashboard');
     // }
public function index(){
        $user = User::count();
        $data = [
            'user' => $user,
        ];
        return view('Admin.view.dashboard',compact('data'));
     }

}

