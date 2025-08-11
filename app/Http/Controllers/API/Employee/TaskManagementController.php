<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class TaskManagementController extends Controller
{

    public function index(Request $request)
    {
        $employeeId = auth()->user()->id;
        $query = Task::with('employee')->where('employee_id', $employeeId)->orderBy('created_at', 'desc');
        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }
        $tasks = $query->get();
        return $this->success(true, 'Task list retrieved successfully.', $tasks);
    }


    public function updateTaskStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task_id' => 'required',
            'status'  => 'required|in:pending,inprogress,complete,overdue',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }
        $task = Task::where('id', $request->task_id)
                    ->where('employee_id', auth()->user()->id)
                    ->first();
        if (!$task) {
            return $this->success(false, 'Task not found or not assigned to you.', 404);
        }
        $task->status = $request->status;
        $task->save();
        return $this->success(true, 'Task status updated successfully.', $task);
    }


}
