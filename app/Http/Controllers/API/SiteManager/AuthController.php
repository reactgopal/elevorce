<?php

namespace App\Http\Controllers\API\SiteManager;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\SiteManager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

        $user = SiteManager::with(['site'])->where('email', $request->username)->orwhere('number', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->success(false, 'Invalid credentials', 401);
        }

        if ($user->status == 0) {
            return $this->error('This account is suspended. Please contact your administrator.');
        }
        $user->device_type = $request->device_type;
        $user->device_token = $request->device_token;
        $user->app_version = $request->app_version;
        $user->mobile_version = $request->mobile_version;
        $token =  Auth::guard('site-manager')->login($user);
        $today = Carbon::today()->toDateString();
        $employeeIds = Employee::where('site_id', $user->site_id)->pluck('id')->toArray();
        $totalEmployees = count($employeeIds);
        $presentCount = Attendance::whereDate('check_in', $today)
            ->whereIn('employee_id', $employeeIds)
            ->where(function ($q) {
                $q->whereNull('site_manager_id')
                    ->orWhere('is_site_manager', 0);
            })
            ->distinct('employee_id')
            ->count('employee_id');
        $absentCount = $totalEmployees - $presentCount;
        $totalLeaveRequest = Leave::whereIn('employee_id', $employeeIds)
            ->where('status', 'pending')
            ->count();
        $user['token']                = $token;
        $user['total_employee']       = $totalEmployees;
        $user['total_present']        = $presentCount;
        $user['total_absent']         = $absentCount;
        $user['employee_count']       = $totalEmployees;
        $user['leave_request_count']  = $totalLeaveRequest;
        return $this->success(true, 'SiteManager Login successfully.', $user);
    }


    public function changeSiteManagerPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required',
        ]);
        $user = SiteManager::find(auth()->user()->id);
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

    public function getSiteManagerProfile(Request $request)
    {
        $user = auth()->user();

        $user = SiteManager::find(auth()->user()->id);

        return $this->success(true, 'Profile retrieved successfully.', $user);
    }


    public function editSiteManagerProfile(Request $request)
    {
         $user = SiteManager::find(auth()->user()->id);

        $validator = Validator::make($request->all(), [
            'name'     => 'nullable',
            'email'    => 'nullable',
            'phone' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        $email = SiteManager::where('email', $request->email)
            ->where('id', '!=', $user->id)
            ->exists();

        if ($email) {
            return $this->error('Email is already taken by another employee.');
        }


        $number = SiteManager::where('number', $request->number)
            ->where('id', '!=', $user->id)
            ->exists();

        if ($number) {
            return $this->error('Number is already taken by another employee.');
        }
        if ($request->hasFile('image')) {
            $oldImagePath = public_path('images/site_manager/' . $user->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
            $imageName = time() . rand(1000, 9999) . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images/site_manager'), $imageName);
            File::copy(public_path('images/site_manager/' . $imageName), public_path('images/site_manager/selfie/' . $imageName));
            $user->image = $imageName;
            $user->selfie = $imageName;

        }

        // if ($request->hasFile('selfie')) {
        //     $oldImagePath = public_path('images/site_manager/selfie/' . $user->selfie);
        //     if (File::exists($oldImagePath)) {
        //         File::delete($oldImagePath);
        //     }
        //     $imageName = time() . rand(1000, 9999) . '.' . $request->file('selfie')->extension();
        //     $request->file('selfie')->move(public_path('images/site_manager/selfie'), $imageName);
        //     $user->selfie = $imageName;
        // }

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->number = $request->number;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return $this->success(true, 'Site Manager profile updated successfully.', $user);
    }

    public function logout()
    {
        $user = Auth::guard('site-manager')->logout();
        return $this->success(true, 'User Logout successfully.');
    }
}
