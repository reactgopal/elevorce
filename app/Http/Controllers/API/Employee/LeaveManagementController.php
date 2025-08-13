<?php


namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Notification;
use App\Models\Site;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LeaveManagementController extends Controller
{
    public function getLeaves(Request $request)
    {
        $query = Leave::with(['leaveType'])
            ->where('employee_id', auth()->user()->id)->orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status); // e.g., pending, approved, rejected
        }

        $leaves = $query->get();

        return $this->success(true, 'Leaves fetched successfully.', $leaves);
    }

    public function addLeave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'leave_type_id'    => 'required',
            'leave_reason'     => 'nullable',
            'leave_status'     => 'nullable',
            'from_date'        => 'required|date_format:d-m-Y',
            'to_date'          => 'required|date_format:d-m-Y',
            'time_range'       => 'nullable|in:half,full',
            'report_sickness'  => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        $input = [
            'employee_id'     => auth()->user()->id,
            'leave_type_id'   => $request->leave_type_id,
            'leave_reason'    => $request->leave_reason,
            'leave_status'    => $request->leave_status ?? 'unpaid',
            'from_date'       => \Carbon\Carbon::createFromFormat('d-m-Y', $request->from_date)->format('Y-m-d'),
            'to_date'         => \Carbon\Carbon::createFromFormat('d-m-Y', $request->to_date)->format('Y-m-d'),
            'time_range'      => $request->time_range ?? 'full',
        ];

        if ($request->hasFile('report_sickness')) {
            $rand = rand(111111111, 999999999);
            $fileName = time() . $rand . '.' . $request->report_sickness->extension();
            $request->report_sickness->move(public_path('images/leave/report_sickness/'), $fileName);
            $input['report_sickness'] = $fileName;
        }
        $leave = Leave::create($input);
        // if($leave){
        //     $employee = auth()->user();
        //     $site = Site::find($employee->site_id);
        //     if($site){
        //         $employer = User::find($site->employer_id);
        //         if($employer){
        //             $data = [
        //                 'device_token' =>  $employer->device_token,
        //                 'device_type' =>  $employer->device_type,
        //                 'title' =>  $request->title,
        //                 'msg' => $request->msg,
        //                 'type' => $request->type,
        //            ];
        //            $this->sendPushNotification($data['device_token'], $data['device_type'], $data['title'], $data['msg'], $data['type']);
        //            Notification::create([
        //               'employee_id' => $leave->employee_id,
        //               'employer_id' => $site->employer_id,
        //               'message' =>  $request->title,
        //               'description' => $request->msg,
        //               'type' => $request->type,
        //            ]);
        //         }
        //     }
        // }
        return $this->success(true, 'Leave request submitted successfully.', $leave);
    }

    public function cancelLeave($id)
    {
        $leave = Leave::where('id', $id)->first();

        if (!$leave) {
            return $this->error('Leave not found or cannot be cancelled.');
        }

        $leave->update(['status' => 'cancelled']);

        if ($leave) {
            $employee = auth()->user();
            $site = Site::find($employee->site_id);
            // if ($site) {
            //     $employer = User::find($site->employer_id);
            //     if ($employer) {
            //         $title = 'Leave Cancelled';
            //         $msg = 'The employee has cancelled their leave request.';
            //         $type = 'leave_cancelled';
            //         $data = [
            //             'device_token' =>  $employer->device_token,
            //             'device_type' =>  $employer->device_type,
            //             'title' => $title,
            //             'msg' => $msg,
            //             'type' => $type,
            //         ];
            //         $this->sendPushNotification($data['device_token'], $data['device_type'], $data['title'], $data['msg'], $data['type']);
            //         Notification::create([
            //             'employee_id' => $leave->employee_id,
            //             'employer_id' => $site->employer_id,
            //             'message' => $title,
            //             'description' => $msg,
            //             'type' => $type,
            //         ]);
            //     }
            // }
        }
        return $this->success(true, 'Leave cancelled successfully.', $leave);
    }


    public function leaveType()
    {
        $employee = auth()->user();
        $site = Site::where('id', $employee->site_id)->first();
        $leaveTypes = LeaveType::where('employer_id', $site->employer_id)->get();
        return $this->success(true, 'Leave types fetched successfully.', $leaveTypes);
    }

    public function leaveUsed()
    {
        $employee = auth()->user();

        $site = Site::find($employee->site_id);
        if (!$site) {
            return $this->error('Site not found.');
        }
        $leaveTypes = LeaveType::where('employer_id', $site->employer_id)->get();
        $response = [];
        foreach ($leaveTypes as $type) {
            $usedLeaves = Leave::where('employee_id', $employee->id)
                ->where('leave_type_id', $type->id)
                ->where('status', 'approved')
                ->sum(DB::raw("DATEDIFF(to_date, from_date) + 1"));
            $response[] = [
                'leave_type_id'    => $type->id,
                'leave_type_name'  => $type->leave_name,
                'total_leaves'     => $type->count,
                'used_leaves'      => intval($usedLeaves),
                'remaining_leaves' => max(0, $type->count - $usedLeaves),
            ];
        }

        return $this->success(true, 'Leave usage data fetched successfully.', $response);
    }
}
