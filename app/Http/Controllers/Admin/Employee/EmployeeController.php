<?php



namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index($employer_id)
    {
        $employees = Employee::with('visa_details')->where('site_id', $employer_id)->get();
        return view('admin.view.employee.index', compact('employees', 'employer_id'));
    }
}
