<?php

namespace App\Http\Controllers\API\SiteManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReplacementShift;
use App\Models\Employee;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class ShiftReplacementController extends Controller
{

    public function shiftReplace(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_id'      => 'required|exists:sites,id',
            'employee_id'  => 'required|exists:employees,id',
            'shift_id'     => 'required|exists:shifts,id',
            'note'         => 'nullable|string',
            'date'         => 'required|date_format:d-m-Y',
        ]);


        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        $replacement = ReplacementShift::create([
            'site_id'      => $request->site_id,
            'employee_id'  => $request->employee_id,
            'shift_id'     => $request->shift_id,
            'note'         => $request->note ?? '',
            'date'         => \Carbon\Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d'),
        ]);

        return $this->success(true, 'Shift replacement recorded successfully.', $replacement);
    }


    public function shiftReplacementList(Request $request)
    {
        $siteManager = auth()->user();

        $replacements = ReplacementShift::with(['employee', 'shift'])
            ->where('site_id', $siteManager->site_id)
            ->orderByDesc('date')
            ->get();

        return $this->success(true, 'Shift replacement list retrieved successfully.', $replacements);
    }
}

