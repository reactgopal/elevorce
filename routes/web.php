<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(url('admin/login'));
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('Admin.view.index');
// })->name('home');


Route::prefix('admin')->group(function () {

    Route::get('/login',[Admin\Auth\AuthController::class,'login'])->name('login');
    Route::post('login', [Admin\Auth\AuthController::class, 'loginSubmit'])->name('admin.login.submit');

    Route::get('/register',[Admin\Auth\AuthController::class,'register']);
    Route::post('register', [Admin\Auth\AuthController::class, 'registerSubmit'])->name('admin.register.submit');

    Route::get('/logout', [Admin\Auth\AuthController::class, 'logout']);

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', function(){
            return redirect()->route('company.index');
        })->name('home');
        Route::resource('company', Admin\Company\CompanyController::class);
        Route::get('site/{id}', [Admin\Site\SiteController::class, 'index']);
        Route::get('create/{id}', [Admin\Site\SiteController::class, 'create']);
        Route::get('edit/{id}/{employer_id}', [Admin\Site\SiteController::class, 'edit']);
        Route::resource('site', Admin\Site\SiteController::class)->except(['index','create','edit']);
        Route::get('employee-list/{id}', [Admin\Employee\EmployeeController::class,'index']);
        Route::get('site-manager-list/{id}', [Admin\SiteManager\SiteManagerController::class,'index']);
    });

});





