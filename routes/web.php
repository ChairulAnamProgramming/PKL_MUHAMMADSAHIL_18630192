<?php

use App\Http\Controllers\Backend\DefendantController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\LawyerController;
use App\Http\Controllers\Backend\PlaintiffController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\FilingOfMetterController;
use App\Http\Controllers\Backend\FilingOfMattersController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Backend\SubmissionController;
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


    Route::resource('/user', UserController::class);
    Route::resource('/employee', EmployeeController::class);
    Route::resource('/lawyer', LawyerController::class);
    Route::resource('/plaintiff', PlaintiffController::class);
    Route::resource('/defendant', DefendantController::class);

    Route::resource('/filing-of-matters', FilingOfMattersController::class);
    Route::resource('/filing-of-matter', FilingOfMetterController::class);

    Route::resource('/submission', SubmissionController::class);

    Route::resource('/room', RoomController::class);
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
