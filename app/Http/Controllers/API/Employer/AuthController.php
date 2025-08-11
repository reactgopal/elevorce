<?php

namespace App\Http\Controllers\API\Employer;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AuthController extends Controller
{


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'    => 'required',
            'password' => 'required',
            'device_type' => 'required',
            'device_token' => 'required',
            'app_version' => 'required',
            'mobile_version' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        $user = User::where('email', $request->username)->orwhere('number',$request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->success(false, 'Invalid credentials', 401);
        }
         if($user->status == 0){
            return $this->error('This account is suspended. Please contact your administrator.');
        }
        $user->device_type = $request->device_type;
        $user->device_token = $request->device_token;
        $user->app_version = $request->app_version;
        $user->mobile_version = $request->mobile_version;
        $token =  Auth::guard('employer')->login($user);
        $totalsites = Site::where('employer_id',$user->id)->count();
        $totalsitesData = Site::where('employer_id',$user->id)->pluck('id')->toArray();
        $totalEmployees = Employee::whereIn('site_id',$totalsitesData)->count();
        $user['token'] = $token;
        $user['employee_count'] = $totalEmployees;
        $user['site_count'] = $totalsites;
        return $this->success(true, 'Employer Login successfully.', $user);
    }



    public function changeEmployerPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required',
        ]);

        $user = User::find(auth()->user()->id);
        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        if (!Hash::check($request->current_password, $user->password)) {
           return $this->error('Current password is incorrect.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        return $this->success(true, 'Password changed successfully.', []);

    }


    public function getProfile(Request $request)
    {
        $user = auth()->user();

        $user = User::find(auth()->user()->id);

        return $this->success(true, 'Profile retrieved successfully.', $user);
    }


    public function editProfile(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $validator = Validator::make($request->all(), [
            'name'     => 'nullable|string|max:255',
            'email'    => 'nullable',
            'number'   => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        $email = User::where('email', $request->email)
            ->where('id', '!=', $user->id)
            ->exists();

        if ($email) {
            return $this->error('Email is already taken by another employee.');
        }


        $number = User::where('number', $request->number)
            ->where('id', '!=', $user->id)
            ->exists();

        if ($number) {
            return $this->error('Number is already taken by another employee.');
        }

        if ($request->hasFile('image')) {
            $oldImagePath = public_path('images/employer/' . $user->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
            $imageName = time() . rand(1000, 9999) . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images/employer'), $imageName);
            $user->image = $imageName;
        }

        // if ($request->hasFile('company_cover_image')) {
        //     $oldImagePath = public_path('images/employer/' . $user->company_cover_image);
        //     if (File::exists($oldImagePath)) {
        //         File::delete($oldImagePath);
        //     }
        //     $imageName = time() . rand(1000, 9999) . '.' . $request->file('company_cover_image')->extension();
        //     $request->file('company_cover_image')->move(public_path('images/employer'), $imageName);
        //     $user->company_cover_image = $imageName;
        // }

        // if ($request->hasFile('company_logo')) {
        //     $oldImagePath = public_path('images/employer/' . $user->company_logo);
        //     if (File::exists($oldImagePath)) {
        //         File::delete($oldImagePath);
        //     }
        //     $imageName = time() . rand(1000, 9999) . '.' . $request->file('company_logo')->extension();
        //     $request->file('company_logo')->move(public_path('images/employer'), $imageName);
        //     $user->company_logo = $imageName;
        // }

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->number = $request->number;
        // $user->company_name = $request->company_name;
        // $user->company_address = $request->company_address;
        // if (!empty($request->password)) {
        //     $user->password = Hash::make($request->password);
        // }
        $user->save();

        return $this->success(true , 'Employer profile updated successfully.', $user);
    }

    public function logout()
    {
        $user = Auth::guard('employer')->logout();
        return $this->success(true, 'User Logout successfully.');
    }

}

