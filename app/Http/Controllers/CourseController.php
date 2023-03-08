<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\FacadePattern\CourseInterface;
use App\FacadePattern\CourseRepository;
use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller{

    protected  $courseRepository;

    public function __construct(CourseInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function index()
    {
        $courses = $this->courseRepository->getAll();
        return view('student.course', compact('courses'));
    }

    public function timetable()
    {
        $timetables = $this->courseRepository->getAll();
        return view('student.timetable', compact('timetables'));
    }

    public function adminTimetable()
    {
        $adminTimetables = $this->courseRepository->getAdminTimetable();
        return view('admin.adminTimetable', ["adminTimetables"=>$adminTimetables]);
    }

    public function updateTimetable(Request $request, $id)
    {
        $adminTimetable = Course::find($id);
        $adminTimetable->cStartTime = $request->input('cStartTime');
        $adminTimetable->cEndTime = $request->input('cEndTime');
        $adminTimetable->save();
        $adminTimetables = $this->courseRepository->getAdminTimetable();
        return redirect()->back()->with('');
    }

}