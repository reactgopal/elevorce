<?php

namespace App\Http\Controllers\API\SiteManager;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\CorrectionRequest;
use App\Models\Employee;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RequestCorrectionController extends Controller
{

    public function requestCorrectionList(Request $request)
    {
        $siteManager = Auth::user();
        $employee = Employee::where('site_id',$siteManager->site_id)->pluck('id')->toArray();
        $requests = CorrectionRequest::with('employee')
            ->whereIn('employee_id', $employee)
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


    public function addRequestCorrection(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'text'     => 'required|string|max:500',
            'type'     => 'required',
        ]);

        if ($validator->fails()) {
             return $this->error($validator->errors()->first());
        }

        CorrectionRequest::create([
            'site_manager_id' => auth()->user()->id,
            'site_id'     => auth()->user()->site_id,
            'name'     => auth()->user()->name,
            'check_in'    => $request->date ." ".$request->time,
            'text'        => $request->text,
            'type'        => $request->type,
        ]);

        return $this->success(true, 'Request Correction Add successfully.',[]);
    }

}
