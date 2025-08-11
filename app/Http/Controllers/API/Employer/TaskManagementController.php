<?php

namespace App\Http\Controllers\API\Employer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class TaskManagementController extends Controller
{

    public function index(Request $request)
    {
         $query = Task::with('employee')->where('employer_id', auth()->user()->id)->orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }

        $tasks = $query->get();

        return $this->success(true, 'Tasks retrieved successfully.', $tasks);
    }

    public function addTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'site_id'      => 'required',
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'end_date' => 'nullable|date_format:d-m-Y',
        ]);

        if ($validator->fails()) {
           return $this->error($validator->errors()->first());
        }

        $task = Task::create([
            'employer_id'  => auth()->user()->id,
            'employee_id'  => $request->employee_id,
            'site_id'      => $request->site_id,
            'title'        => $request->title,
            'description'  => $request->description,
            'end_date'     => \Carbon\Carbon::createFromFormat('d-m-Y', $request->end_date)->format('Y-m-d'),
        ]);
        return $this->success(true ,'Task created successfully.',$task);
    }


    public function taskDetails($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return $this->error('Task not found.');
        }
        return $this->success(true ,'Task details retrieved successfully.',$task);
    }
}
