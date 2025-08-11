<?php

namespace App\Http\Controllers\API\Employer;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\CorrectionRequest;
use App\Models\Employee;
use App\Models\Shift;
use App\Models\SiteManager;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RequestCorrectionController extends Controller
{

    public function requestCorrectionList(Request $request)
    {
        $employer = Auth::user();

        $siteManager = SiteManager::where('employer_id', $employer->id)->pluck('id')->toArray();

        $requests = CorrectionRequest::with('siteManager')
            ->whereIn('site_manager_id', $siteManager)
            ->orderBy('created_at', 'DESC')->where('status', 'pending')
            ->get();

        return $this->success(true, 'Correction request list fetched successfully.', $requests);
    }

    function getShiftForCheckIn($siteId, $checkInTime)
    {
        $shifts = Shift::where('site_id', $siteId)->get();
        $checkIn = Carbon::parse($checkInTime);

        foreach ($shifts as $shift) {
            $shiftStart = Carbon::parse($shift->start_time);
            $shiftEnd = Carbon::parse($shift->end_time);


            if ($shiftEnd->lt($shiftStart)) {
                $shiftEnd->addDay();
            }

            $startWithDate = $checkIn->copy()->setTimeFrom($shiftStart);
            $endWithDate = $checkIn->copy()->setTimeFrom($shiftEnd);
            if ($endWithDate->lt($startWithDate)) {
                $endWithDate->addDay();
            }

            if ($checkIn->between($startWithDate->copy()->subHour(), $endWithDate->copy()->addHour())) {
                return $shift->id;
            }
        }

        return null;
    }

    public function updateRequestCorrectionStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'request_id' => 'required|exists:correction_requests,id',
            'status'     => 'required|in:approved,rejected',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        $correction = CorrectionRequest::find($request->request_id);
        $correction->status = $request->status;
        $correction->save();

        // if ($request->status == 'approved') {
        //     if ($correction->type = 'check-in') {
        //         $employee = Employee::find($correction->employee_id);
        //         $siteId     = $employee->site_id;
        //         $checkIn    = date('Y-m-d H:i:s');
        //         $shiftId = $this->getShiftForCheckIn($siteId, $checkIn);
        //         if (!$shiftId) {
        //             return $this->error('No shift matched for this check-in time.');
        //         }
        //         Attendance::create([
        //             'employee_id' => $employee->id,
        //             'site_id'     => $siteId,
        //             'shift_id'    => $shiftId,
        //             'check_in'    => date('Y-m-d H:i:s'),
        //         ]);
        //     }
        // }

        return $this->success(true, 'Correction request status updated successfully.');
    }




}
