<?php

namespace App\Http\Controllers\API\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Employee;
use App\Models\EmployerAnnouncement;
use App\Models\Notification;
use App\Models\Site;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class EmployerAnnouncementController extends Controller
{
    // POST: add-announcement
    public function addAnnouncement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_id'      => 'required|exists:sites,id',
            'employee_id'  => 'required|exists:employees,id',
            'message'      => 'required|string|max:255',
            'description'  => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        $announcement = EmployerAnnouncement::create([
            'employer_id' => auth()->id(),
            'site_id'     => $request->site_id,
            'employee_id' => $request->employee_id,
            'message'     => $request->message,
            'description' => $request->description,
        ]);

        // if($announcement) {
        //     $site = Site::where('employer_id',auth()->id())->pluck('id')->toArray();
        //     $employees = Employee::whereIn('site_id', $site)->get();
        //     foreach ($employees as $employee) {
        //         $notifications = [
        //             'device_token' => $employee->device_token,
        //             'device_type'  => $employee->device_type,
        //             'title'        => 'Add Announcement',
        //             'message'      => 'New announcement added by '.auth()->user()->name,
        //             'type'         => 'add announcement',
        //         ];
        //         $this->sendPushNotification($notifications['device_token'], $notifications['device_type'], $notifications['title'], $notifications['message'], $notifications['type']);
        //     }
        // }

        return $this->success(true, 'Announcement added successfully.', $announcement);
    }


    public function getEmployerAnnouncement(Request $request)
    {
        $announcements = EmployerAnnouncement::with(['employee','site'])->where('employer_id', auth()->id())
            ->latest()
            ->get();
        return $this->success(true, 'Announcement added successfully.', $announcements);
    }
}
