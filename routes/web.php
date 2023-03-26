<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Auth;
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

//Student Homepage
Route::get('/', function () {
    return view('student/homepage');
});



//Student page
Route::middleware(['auth', 'role:student'])->group(function () {
    // Route::get('/profileStudent', function () {
    //     return view('student/profileStudent');  //return achievement and timetable
    // });
    Route::get('/profileStudent', [UserController::class, 'studentProfile']);   //edited by ks
    Route::post('/profileUpdatestudent',[UserController::class,'update']);
    Route::post('/logoutStudent', function () {
        Auth::logout();
        session()->flush();
        return redirect('/');
    })->name('logoutStudent');
});

//Admin page
Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/homepageadmin', function () {
        return view('admin/homepage');
    });
    Route::get('/adminHeader',function() {
        return view('admin/adminHeader');
    });
    Route::post('/profileUpdateadmin', [UserController::class, 'update'])->middleware('role:admin,staff')->name('profileUpdateadmin');
    Route::post('/logoutAdmin', function(){
        Auth::logout();
        session()->flush();
        return redirect('/')->with('successlogout', 'You have been logged out successfully!');
    });
    Route::get('/adminProfile', function(){
        return view('admin/adminProfile');
    });
    Route::get('/adminStudent', [UserController::class, 'retrieveStudent']);
    Route::put('/updateStudentadmin/{id}', [UserController::class, 'updateStudentAdmin']);
    Route::get('/deleteStudentadmin/{id}', [UserController::class, 'deleteStudentadmin']);
    // Route::get('/adminStaff', [UserController::class, 'retrieveStaff']->middleware('role:admin'));
    // Route::get('/registerAdminsubmit', [UserController::class, 'registerAdminsubmit']->middleware('role:admin'));
    Route::post('/deleteAdmin', [UserController::class, 'deleteAdmin'])->name('deleteAdmin');

});


//register Student page
Route::get('/registerStudent', function () {
    return view('student/registerStudent');
});
Route::post('/registersubmit',[UserController::class,'registersubmit']);


//login Student page
Route::get('/loginStudent',[UserController::class, 'redirect'])->name('login');
Route::post('/loginStudentsubmit', [UserController::class, 'login']);

//logout admin
Route::post('/logoutAdmin', function () {
    Auth::logout();
    session()->flush();
    return redirect('/');
})->name('logoutAdmin');

//Ker Siu
Route::get('/announcement', [AnnouncementController::class, 'studentIndex']);
Route::get('/adminAnnouncement', [AnnouncementController::class, 'adminIndex']);

Route::post('/addAnnouncement',[AnnouncementController::class,'addAnnouncement']);
Route::put('/updateAnnouncement/{id}', [AnnouncementController::class, 'updateAnnouncement']);
Route::get('/deleteAnnouncement/{id}', [AnnouncementController::class, 'deleteAnnouncement']);

Route::get('/myCourse', [AchievementController::class, 'myCourse']);
Route::get('/staffCourse', [AchievementController::class, 'staffCourse']);
Route::get('/getStudents/{id}', [AchievementController::class, 'courseStudent']);
Route::put('/assignAchievement/{aID}', [AchievementController::class, 'assignAchievement']);

//Course
Route::get('/adminCourse', [CourseController::class, 'adminIndex']);
Route::any('/createCourse', [CourseController::class, 'createCourse']); 
Route::any('/updateCourse/{id}', [CourseController::class, 'updateCourse']);
Route::delete('/deleteCourse/{id}', [CourseController::class, 'deleteCourse'])->name('course.deleteCourse');
Route::get('/timetable', [CourseController::class, 'timetable'])->name('course.timetable');
Route::get('/course', [CourseController::class, 'index']);
Route::get('/blog/{id}', [CourseController::class, 'display']);