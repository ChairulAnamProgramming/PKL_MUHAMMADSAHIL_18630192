<?php

use App\Http\Controllers\Backend\DefendantController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\LawyerController;
use App\Http\Controllers\Backend\PlaintiffController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\FilingOfMetterController;
use App\Http\Controllers\Backend\FilingOfMattersController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Backend\SubmissionController;
use App\Http\Controllers\Backend\V1\DashboardController;
use App\Http\Controllers\Backend\V1\DataFOMController;
use App\Http\Controllers\Backend\V1\JudgeController;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => 'auth:sanctum', 'verified'], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/check/{employee:nip}/employee', [EmployeeController::class, 'check'])->name('employee.check');
    Route::resource('/user', UserController::class);
    Route::resource('/employee', EmployeeController::class);
    Route::resource('/judge', JudgeController::class);
    Route::resource('/lawyer', LawyerController::class);
    Route::resource('/plaintiff', PlaintiffController::class);
    Route::resource('/defendant', DefendantController::class);

    Route::resource('/filing-of-matters', FilingOfMattersController::class);
    Route::resource('/filing-of-matter', FilingOfMetterController::class);
    Route::get('/data-fom', [DataFOMController::class, 'index'])->name('data-fom.index');

    Route::resource('/submission', SubmissionController::class);

    Route::resource('/room', RoomController::class);

    // Laporan
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::patch('/report/{filing_of_matter}', [ReportController::class, 'filing_of_matter'])->name('report.filing_of_matter');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
