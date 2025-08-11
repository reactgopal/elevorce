<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Correction;
use App\Models\CorrectionRequest;
use Illuminate\Support\Facades\Validator;

class RequestCorrectionController extends Controller
{
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
            'employee_id' => auth()->user()->id,
            'site_id'     => auth()->user()->site_id,
            'name'        => auth()->user()->name,
            'check_in'    => $request->date ." ".$request->time,
            'text'        => $request->input('text'),
            'type'        => $request->input('type'),
        ]);

        return $this->success(true, 'Request Correction Add successfully.',[]);
    }


}
