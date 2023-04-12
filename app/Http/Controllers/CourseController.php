<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\FacadePattern\CourseRepository;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\File;
use Illuminate\Support\Facades\Auth;
use DB;

class CourseController extends Controller{

    protected  $courseRepository;

    public function __construct(CourseRepository $courseRepository)
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
        $staffs = User::where('role','staff')
        ->select('id','name')
        ->get();
        return view('admin.adminCourse', compact('courses'),['staffs'=>$staffs]);
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
            'staffID' => 'required',
            'cName' => 'required|string|max:255',
            'cDescription' => 'required|string|max:255',
            'cPrice' => 'required',
            'cDay' => 'required',
            'cStartTime' => 'required',
            'cEndTime' => 'required',
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

    public function display($id)
    {
        $course = Course::findOrFail($id);
        $evaController = new EvaluationController();
        $evaluations = $evaController->blogIndex($id);
        return view('student.blog', compact('course'), ['evaluations'=>$evaluations]);
    }

    public function uploadMaterials(Request $request)
{
    $file = $request->file('file');
    $courseID = $request->input("courseID");

    $filename = $courseID . '.' . $file->getClientOriginalExtension();
    $path = 'materials/' . $filename;

    // Delete the existing file if it exists
    if (Storage::exists($path)) {
        Storage::delete($path);
    }

    // Upload the new file
    Storage::putFileAs('materials', $file, $filename);

    return redirect()->back()->with('success', 'File "' . $filename . '" uploaded successfully.');
}

public function staffCourse(){
    $id = Auth::user()->id;
    $courses = Course::where('staffID',$id)->get();
    return view("admin.myCourse",["courses"=>$courses]);
}

}
