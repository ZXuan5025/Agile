<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Student page
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/header', function () {
        return view('student/header');
    });
});

//Student page
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/homepageadmin', function () {
        return view('admin/homepage');
    });
});

//register Student page
Route::get('/registerStudent', function () {
    return view('student/registerStudent');
});
Route::post('/registersubmit',[UserController::class,'registersubmit']);

//login Student page
Route::get('/loginStudent',[UserController::class, 'redirect'])->name('login');

Route::post('/loginStudentsubmit', [UserController::class, 'login']);

Route::get('/adminAnnouncement', [AnnouncementController::class, 'adminIndex']);

Route::get('/adminTimetable', [CourseController::class, 'adminTimetable']);

Route::get('/updateTimetable/{id}', [CourseController::class, 'updateTimetable']);

