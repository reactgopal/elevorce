<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReplacementShift;
use Illuminate\Support\Facades\Auth;

class ShiftReplacementController extends Controller
{
    public function employeeShiftReplacementList(Request $request)
    {

        $employee = Auth::user();

        $shifts = ReplacementShift::where('employee_id', $employee->id)
            ->with(['shift', 'site']) 
            ->orderBy('date', 'desc')
            ->get();
        return $this->success(true, 'Shift replacement list retrieved successfully.', $shifts);
    }
}
