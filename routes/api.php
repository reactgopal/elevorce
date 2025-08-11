<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\API;

// Get logged-in user (using Sanctum)
Route::middleware('auth:sanctum')->get('/user', fn(Request $request) => $request->user());

/*
|--------------------------------------------------------------------------
| EMPLOYER ROUTES
|--------------------------------------------------------------------------
| Employer can manage: Profile, Sites, Shifts, Site Managers, Employees,
| Holidays, Leave Types, Tasks, and Announcements.
*/

Route::get('test', [API\SiteManager\AttendanceManagementController::class, 'testing']);
Route::get('py-employee-list', [API\SiteManager\EmployeeController::class, 'pyEmployeeList']);
Route::get('py-sitemanager-list', [API\Employer\SiteManagerController::class, 'pySiteManagerList']);

Route::prefix('employer')->group(function () {

    // Public Auth
    Route::post('register', [API\Employer\AuthController::class, 'register']);
    Route::post('login',    [API\Employer\AuthController::class, 'login']);

    Route::group(['middleware' => ['assign.guard:employer', 'jwt.verify:employer']], function () {

        // Profile
        Route::get('logout',         [API\Employer\AuthController::class, 'logout']);
        Route::get('get-profile',    [API\Employer\AuthController::class, 'getProfile']);
        Route::post('edit-profile',  [API\Employer\AuthController::class, 'editProfile']);
        Route::post('change-password', [API\Employer\AuthController::class, 'changeEmployerPassword']);

        // Sites
        Route::prefix('site')->group(function () {
            Route::post('add',         [API\Employer\SiteController::class, 'store']);
            Route::get('list',         [API\Employer\SiteController::class, 'index']);
            Route::get('show/{id}',    [API\Employer\SiteController::class, 'show']);
            Route::post('update/{id}', [API\Employer\SiteController::class, 'update']);
            Route::get('delete/{id}',  [API\Employer\SiteController::class, 'destroy']);
        });

        // Shifts
        Route::prefix('shift')->group(function () {
            Route::post('add',         [API\Employer\ShiftController::class, 'store']);
            Route::get('list',         [API\Employer\ShiftController::class, 'index']);
            Route::get('show/{id}',    [API\Employer\ShiftController::class, 'show']);
            Route::post('update/{id}', [API\Employer\ShiftController::class, 'update']);
            Route::get('delete/{id}',  [API\Employer\ShiftController::class, 'destroy']);
        });

        // Site Managers
        Route::prefix('site-manager')->group(function () {
            Route::post('add',         [API\Employer\SiteManagerController::class, 'store']);
            Route::get('list',         [API\Employer\SiteManagerController::class, 'index']);
            Route::get('show/{id}',    [API\Employer\SiteManagerController::class, 'show']);
            Route::post('update/{id}', [API\Employer\SiteManagerController::class, 'update']);
            Route::get('delete/{id}',  [API\Employer\SiteManagerController::class, 'destroy']);
        });

        // Employees
        Route::prefix('employees')->group(function () {
            Route::post('add',         [API\SiteManager\EmployeeController::class, 'store']);
            Route::get('list/{id}',    [API\SiteManager\EmployeeController::class, 'index']);
            Route::get('show/{id}',    [API\SiteManager\EmployeeController::class, 'show']);
            Route::post('update/{id}', [API\SiteManager\EmployeeController::class, 'update']);
            Route::get('delete/{id}',  [API\SiteManager\EmployeeController::class, 'destroy']);
        });

        // Holidays
        Route::prefix('holiday')->group(function () {
            Route::post('add',         [API\Employer\HolidayController::class, 'store']);
            Route::get('list',         [API\Employer\HolidayController::class, 'index']);
            Route::get('show/{id}',    [API\Employer\HolidayController::class, 'show']);
            Route::post('update/{id}', [API\Employer\HolidayController::class, 'update']);
            Route::get('delete/{id}',  [API\Employer\HolidayController::class, 'destroy']);
        });

        // Leave Types
        Route::prefix('leave-type')->group(function () {
            Route::post('add',         [API\Employer\LeaveTypeController::class, 'store']);
            Route::get('list',         [API\Employer\LeaveTypeController::class, 'index']);
            Route::get('show/{id}',    [API\Employer\LeaveTypeController::class, 'show']);
            Route::post('update/{id}', [API\Employer\LeaveTypeController::class, 'update']);
            Route::get('delete/{id}',  [API\Employer\LeaveTypeController::class, 'destroy']);
        });


        Route::get('task-list',         [API\Employer\TaskManagementController::class, 'index']);
        Route::post('add-task',         [API\Employer\TaskManagementController::class, 'addTask']);
        Route::get('task-details/{id}', [API\Employer\TaskManagementController::class, 'taskDetails']);
        Route::post('employee-promotion',  [API\Employer\EmployeePromotionController::class, 'employeePromotion']);
        Route::get('get-announcement',  [API\Employer\EmployerAnnouncementController::class, 'getEmployerAnnouncement']);
        Route::post('add-announcement', [API\Employer\EmployerAnnouncementController::class, 'addAnnouncement']);
        Route::post('get-sitemanager-attendance-management',   [API\Employer\AttendanceManagementController::class, 'getAttendanceList']);
        Route::get('get-employer-dashboard-count',   [API\Employer\AttendanceManagementController::class, 'getSiteManagerTodayAttendanceCount']);



        Route::get('employee-request-correction-list', [API\Employer\RequestCorrectionController::class, 'requestCorrectionList']);
        Route::post('update-request-correction-status', [API\Employer\RequestCorrectionController::class, 'updateRequestCorrectionStatus']);

        // promotion employee
        Route::get('get-all-site-employee-list',   [API\Employer\EmployeePromotionController::class, 'getEmployeeForPromotion']);

        Route::get('employee-visa-expiry-list',   [API\Employer\AttendanceManagementController::class, 'employeeVisaExpiryList']);

    });
});


/*
|--------------------------------------------------------------------------
| SITE MANAGER ROUTES
|--------------------------------------------------------------------------
| Site Managers can manage employees, attendance, leaves, and corrections.
*/


Route::prefix('site-manager')->group(function () {

    Route::post('login', [API\SiteManager\AuthController::class, 'login']);

    Route::group(['middleware' => ['assign.guard:site-manager', 'jwt.verify:site-manager']], function () {

        // Profile
        Route::get('logout',                     [API\SiteManager\AuthController::class, 'logout']);
        Route::get('get-site-manager-profile',   [API\SiteManager\AuthController::class, 'getSiteManagerProfile']);
        Route::post('edit-profile', [API\SiteManager\AuthController::class, 'editSiteManagerProfile']);
        Route::post('change-password', [API\SiteManager\AuthController::class, 'changeSiteManagerPassword']);

        // Employees
        Route::prefix('employees')->group(function () {
            Route::post('add',         [API\SiteManager\EmployeeController::class, 'store']);
            Route::get('list/{id}',    [API\SiteManager\EmployeeController::class, 'index']);
            Route::get('show/{id}',    [API\SiteManager\EmployeeController::class, 'show']);
            Route::post('update/{id}', [API\SiteManager\EmployeeController::class, 'update']);
            Route::get('delete/{id}',  [API\SiteManager\EmployeeController::class, 'destroy']);
        });

        // Attendance & Leaves
        Route::get('get-leave-request',             [API\SiteManager\LeaveManagementController::class, 'getLeaveRequest']);
        Route::post('leave-status-update',          [API\SiteManager\LeaveManagementController::class, 'leaveStatusUpdate']);
        Route::post('check-in',                     [API\SiteManager\AttendanceManagementController::class, 'checkInEmployee']);
        Route::post('check-out',                    [API\SiteManager\AttendanceManagementController::class, 'checkOut']);
        Route::post('get-attendance-list-employee', [API\SiteManager\AttendanceManagementController::class, 'getAttendanceListEmployee']);

        // Shift Replacements & Corrections
        Route::post('shift-replace',                   [API\SiteManager\ShiftReplacementController::class, 'shiftReplace']);
        Route::get('shift-replace-list',               [API\SiteManager\ShiftReplacementController::class, 'shiftReplacementList']);

        Route::post('add-request-correction',     [API\SiteManager\RequestCorrectionController::class, 'addRequestCorrection']);
        Route::get('employee-request-correction-list', [API\SiteManager\RequestCorrectionController::class, 'requestCorrectionList']);
        Route::post('update-request-correction-status', [API\SiteManager\RequestCorrectionController::class, 'updateRequestCorrectionStatus']);

        Route::get('get-site-manager-dashboard-count', [API\SiteManager\AttendanceManagementController::class, 'getSiteManagerCurrentMonthAttendanceCount']);


        Route::post('check-in-check-out-sitemanager', [API\SiteManager\AttendanceManagementController::class, 'checkInCheckOutSiteManager']);
        Route::post('get-site-manager-attendance-management',   [API\SiteManager\AttendanceManagementController::class, 'getSiteManagerAttendanceManagement']);
        Route::get('holiday/list',         [API\Employer\HolidayController::class, 'getHolidayList']);
    });
});

/*
|--------------------------------------------------------------------------
| EMPLOYEE ROUTES
|--------------------------------------------------------------------------
| Employees can manage their own profile, tasks, leaves, and corrections.
*/

Route::prefix('employee')->group(function () {

    Route::post('login', [API\Employee\AuthController::class, 'login']);

    Route::group(['middleware' => ['assign.guard:employee', 'jwt.verify:employee']], function () {

        // Profile
        Route::get('logout',                 [API\Employee\AuthController::class, 'logout']);
        Route::get('get-employee-profile',   [API\Employee\AuthController::class, 'getEmployeeProfile']);
        Route::post('edit-profile', [API\Employee\AuthController::class, 'editEmployeeProfile']);
        Route::post('change-password',       [API\Employee\AuthController::class, 'changeEmployeePassword']);

        // Tasks
        Route::get('task-list',             [API\Employee\TaskManagementController::class, 'index']);
        Route::post('task-status-update',   [API\Employee\TaskManagementController::class, 'updateTaskStatus']);

        // Leaves
        Route::get('get-leaves',            [API\Employee\LeaveManagementController::class, 'getLeaves']);
        Route::post('add-leave',            [API\Employee\LeaveManagementController::class, 'addLeave']);
        Route::get('cancel-leave/{id}',     [API\Employee\LeaveManagementController::class, 'cancelLeave']);
        Route::get('leave-type',     [API\Employee\LeaveManagementController::class, 'leaveType']);
        Route::get('leave-used-count',     [API\Employee\LeaveManagementController::class, 'leaveUsed']);

        Route::post('get-employee-attendance-management',     [API\Employee\AttendanceManagementController::class, 'getAttendanceManagement']);
        Route::post('get-current-month-attendance-count',     [API\Employee\AttendanceManagementController::class, 'getCurrentMonthAttendanceCount']);

        // Shift Replacements & Corrections
        Route::get('employee-shift-replace-list', [API\Employee\ShiftReplacementController::class, 'employeeShiftReplacementList']);
        Route::post('add-request-correction',     [API\Employee\RequestCorrectionController::class, 'addRequestCorrection']);

        Route::get('holiday/list',         [API\Employer\HolidayController::class, 'getHolidayList']);
    });
});
