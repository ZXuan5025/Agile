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

    public function adminIndex()
    {
        $courses = $this->courseRepository->getAll();
        return view('admin.adminCourse', compact('courses'));
    }

    public function display($id)
    {
        $course = Course::findOrFail($id);
        return view('student.blog', compact('course'));
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

    public function createCourse(Request $request)
    {    
        $data = $request->validate([
            'staffID' => 'required|string|max:255',
            'cName' => 'required|string|max:255',
            'cDescription' => 'required|string|max:255',
            'cPrice' => 'required|string|max:255',
            'cDay' => 'required|string|max:255',
            'cStartTime' => 'required|string|max:255',
            'cEndTime' => 'required|string|max:255',
        ]);

        $existingDay = Course::where('cDay', $data['cDay'])
        ->where('cStartTime', '=', $data['cStartTime'])
        ->first();
        if ($existingDay) {
            // A course with the same cDay value already exists in the database
            // return response()->json([
            //     'message' => 'The selected time has been clashed with another class.'
            // ], 422);
            return redirect()->back()->withErrors(['message' => 'The selected time has been clashed with another class.']);
        } else {
            $this->courseRepository->storeCourse($data);
            return redirect()->back()->with('success', 'Course created successfully!');
        }
    
    }

    public function updateCourse(Request $request, $id)
    {   
        $data = $request->validate([
            'cName' => 'required|string|max:255',
            'cDescription' => 'required|string|max:255',
            'cPrice' => 'required|string|max:255',
            'cDay' => 'required|string|max:255',
            'cStartTime' => 'required|string|max:255',
            'cEndTime' => 'required|string|max:255',
        ]);
        $data = $this->courseRepository->updateCourse($data,$id);
        return redirect()->back()->with('success', 'Course updated successfully!');
    }

    public function deleteCourse($id)
    {
        $course = Course::find($id);
        if ($course) {
            $course->delete();
            return redirect()->back()->with('success', 'Course deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Course not found.');
        }
    }
}