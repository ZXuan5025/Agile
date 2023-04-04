<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\FacadePattern\CourseInterface;
use App\FacadePattern\CourseRepository;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class EnrollmentController extends Controller
{

    protected  $enrollRepository;

    public function __construct(CourseRepository $enrollRepository)
    {
        $this->enrollRepository = $enrollRepository;
    }

    public function store($cID)
    {
        $sID = Auth::user()->id;
        // validate no existing enrollment
        $existingEnrollment = Enrollment::where('sID', $sID)
        ->where('cID', $cID)
        ->first();

        if ($existingEnrollment) {
            return redirect()->back()->withErrors(['message' => 'You have already registered for this course.']);
        }else{
            $enrollment = [
                'sID' => $sID,
                'cID' => $cID
            ];

            $this->enrollRepository->store($enrollment);

            return redirect()->back()->with('success', 'Course registered successfully!');
    }
    }

    public function showEnrollmentForm()
    {
        $user = Auth::user(); // or use the appropriate method to retrieve the user record
        $course = Course::find(); // replace 1 with the actual course ID

        return view('enrollment', compact('user', 'course'));
    }

    public function showCourseName()
    {
        $resultSet = Enrollment::join('courses', 'enrollments.cid', '=', 'courses.id')
                    ->select('enrollments.sID','courses.cName', 'courses.id')
                    ->get();
        return view('student.registered', compact('resultSet'));
    }

    public function dropCourse()
    {
        $resultSet = Enrollment::join('courses', 'enrollments.cid', '=', 'courses.id')
                    ->select('enrollments.sID','courses.cName', 'courses.id')
                    ->delete();
            if($resultSet){
                return redirect()->back()->with('success', 'Drop course successfully.');
        } else {
            return redirect()->back()->with('error', 'Course not found.');
        }
    }

    public function myCourse(Request $request){
        //$user = Auth::user();
        $id = 1;
        $enrollments = Enrollment::join('courses', 'courses.id', '=', 'enrollments.cID')
        ->join('achievements', 'enrollments.id', '=', 'achievements.eID')
        ->select('enrollments.sID', 'enrollments.cID','courses.*', 'achievements.progress')
        ->where('enrollments.sID','=', $id)
        ->get();

        foreach ($enrollments as $enrollment) {
            $fileName = $enrollment->cID . '.pdf';
            $sourcePath = storage_path('app/materials/' . $fileName);
            $destinationPath = 'materials/' . $fileName;
            $fileContent = file_get_contents($sourcePath);
            Storage::disk('public')->put($destinationPath, $fileContent);
            $enrollment->url = Storage::url($destinationPath);
        }

        return view("Student.myCourse",["enrollments"=>$enrollments]);
    }

    public function timetable()
    {
        $sID = Auth::user()->id;
        $timetables = Enrollment::join('courses', 'enrollments.cid', '=', 'courses.id')
                    ->join('users','users.id','=','courses.staffID')
                    ->select('enrollments.sID','courses.*','users.name','users.image')
                    ->where('enrollments.sID','=',$sID)
                    ->orderBy('courses.cDay', 'asc')
                    ->orderBy('courses.cStartTime', 'asc')
                    ->get();
        return $timetables;
    }

}
