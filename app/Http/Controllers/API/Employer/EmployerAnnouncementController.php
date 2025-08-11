<?php

namespace App\Http\Controllers\API\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\EmployerAnnouncement;
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
