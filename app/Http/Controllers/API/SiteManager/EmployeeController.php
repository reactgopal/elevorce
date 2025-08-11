<?php

namespace App\Http\Controllers\API\SiteManager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\Employee;
use App\Models\VisaDetail;  // Make sure you have this model for visa details
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{

    public function index($id)
    {
        $employees = Employee::with(['visa_details'])->where('site_id', $id)->orderBy('created_at', 'desc')->get();
        return $this->success(true, 'Employees retrieved successfully', $employees);
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'type' => 'required|string|in:site_manager,employer',
            'name'           => 'required',
            'site_id'          => 'required',
            'email'         => 'required|email|unique:employees,email',
            'number'         => 'required|unique:employees,number',
            'address'         => 'required',
            'password'          => 'required',
            'visa_issue_date'       => 'required',
            'visa_number'       => 'required',
            'visa_expiry_date'       => 'required',
            'share_code'       => 'required',
            'country'       => 'required',
            'image'         => 'required|mimes:jpg,jpeg,png,gif|max:2048',
            'visa_document'  => 'required|mimes:jpg,jpeg,png,,gif,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }



        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $imageName = time() . rand(1000, 9999) . '.' . $extension;
            $selfieName = time() . rand(1000, 9999) . '.' . $extension;
            $file->move(public_path('images/employee'), $imageName);
            File::copy(public_path('images/employee/' . $imageName), public_path('images/employee/selfie/' . $selfieName));
        }

        $data = [
            'site_id'    => $request->site_id,
            'name'       => $request->name,
            'email'      => $request->email,
            'image'      => $imageName ?? null,
            'selfie'     => $selfieName ?? null,
            'number'     => $request->number,
            'password'   => Hash::make($request->password),
            'created_by' => $request->type,
            'address'    => $request->address,
        ];

        if ($request->type == 'site_manager') {
            $data['site_manager_id'] = auth()->user()->id;
        } elseif ($request->type == 'employer') {
            $data['employer_id'] = auth()->user()->id;
        }

        $employee = Employee::create($data);

        $visaDocName = null;
        if ($request->hasFile('visa_document')) {
            $visaDocName = time() . rand(1000, 9999) . '.' . $request->file('visa_document')->extension();
            $request->file('visa_document')->move(public_path('images/employee/visa_document'), $visaDocName);
        }

        $visaStatus = Carbon::parse($request->visa_expiry_date)->isFuture() ? 'active' : 'expired';
        VisaDetail::create([
            'employee_id'      => $employee->id,
            'visa_status'      => $visaStatus,
            'visa_issue_date'  => \Carbon\Carbon::createFromFormat('d-m-Y', $request->visa_issue_date)->format('Y-m-d'),
            'visa_number'      => $request->visa_number,
            'visa_expiry_date' => \Carbon\Carbon::createFromFormat('d-m-Y',  $request->visa_expiry_date)->format('Y-m-d'),
            'share_code'       => $request->share_code,
            'visa_document'    => $visaDocName,
            'country'          => $request->country,
        ]);
        return $this->success(true, 'Employee  created successfully.', $employee);
    }


    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return $this->error('Employee not found.');
        }

        $employee->status = 0;
        $employee->save();
        $employee->delete();
        return $this->success(true, 'Employee deleted successfully.');
    }

    public function pyEmployeeList(){
        $employee = Employee::select('id','selfie')->get();
        return $this->success(true, 'Employee get successfully.',$employee);
    }
}
