<?php

namespace App\Http\Controllers\API\SiteManager;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LeaveManagementController extends Controller
{

    public function getLeaveRequest(Request $request)
    {
        $siteManager = Auth::user();
        $leaveStatus = $request->query('status');
        $employeeId = $request->query('employee_id');
        $employee = Employee::where('site_id', $siteManager->site_id)->pluck('id')->toArray();

        $query = Leave::query();

        if ($leaveStatus) {
            $query->where('status', $leaveStatus);
        }

        $leaves = $query->with(['leaveType','employee'])->whereIn('employee_id',$employee)->orderBy('created_at', 'desc')->get();
        return $this->success(true, 'Leave requests fetched successfully.', $leaves);
    }


    public function leaveStatusUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'leave_id'     => 'required',
            'status' => 'required|in:approved,rejected,pending',
            'rejected_reason' => 'nullable',
        ]);
        if ($validator->fails()) {
           return $this->error($validator->errors()->first());
        }
        $leave = Leave::find($request->leave_id);
        $leave->status = $request->status;
        if ($request->status === 'rejected') {
            $leave->rejected_reason = $request->rejected_reason ?? null;
        } else {
            $leave->rejected_reason = null;
        }
        $leave->save();
        return $this->success(true, 'Leave status updated successfully.', $leave);
    }

}
