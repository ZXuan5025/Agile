<?php
namespace App\Http\Controllers;
use App\Models\Achievement;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Auth;
use App\Observer\EmailObserver;
class AchievementController extends Controller
{

    protected $achievement;

    public function __construct()
    {
        $this->achievement = new Achievement();
    }

    public function getAchievementByStudent(){
        $sID = Auth::user()->id;
        $achievement = Achievement::where('sid',$sID)
        ->where('progress','=',100)
        ->get();
        return $achievement;
    }

    //ze xuan course controller
    public function myCourse(Request $request){
        //$user = Auth::user();
        $id = 1;
        $enrollments = Enrollment::join('courses', 'courses.id', '=', 'enrollments.cID')
        ->leftJoin('achievements', 'enrollments.id', '=', 'achievements.eID')
        ->select('enrollments.sID', 'courses.*', 'achievements.progress')
        ->where('enrollments.sID','=', $id)
        ->get();
        return view("Student.myCourse",["enrollments"=>$enrollments]);
    }

    //ze xuan course controller
    public function staffCourse(){
        //$user = Auth::user();
        $id = 2;
        $courses = Course::where('staffID',$id)->get();
        return view("admin.myCourse",["courses"=>$courses]);
    }

    public function courseStudent($courseID){
        $students = Enrollment::join('users', 'users.id', '=', 'enrollments.sID')
        ->leftJoin('achievements', 'enrollments.id', '=', 'achievements.eID')
        ->select('users.id', 'users.name', 'enrollments.id as eID', 'achievements.id as aID', 'achievements.progress', 'achievements.acTitle', 'achievements.acResult')
        ->where('enrollments.cID', '=', $courseID)
        ->get();
        return $students;
    }
 
    public function assignAchievement(Request $request, $enrollmentID){
        $achievementID = $request->input('aID');
        $achievement = Achievement::find($achievementID);
        if($achievement){
            if($request->input('progress')!=100){
                $achievement->acTitle = "";
                $achievement->acResult = "";
            }else{
                $achievement->acTitle = $request->input('title');
                $achievement->acResult = $request->input('result');

                if($achievement->progress!=100){
                    $email = User::join('enrollments','users.id','=','enrollments.sID')
                    ->select('users.email')
                    ->where('enrollments.id','=',$achievement->eID)
                    ->first();
                    $observer = new EmailObserver($email);
                    $achievement->attach($observer);
                    $achievement->sendAchievement($achievement);
                }
            }
            $achievement->progress = $request->input('progress');
            $achievement->save();
        }
        else{
            $achievement = new Achievement();
            $achievement->sID=1;
            $achievement->eID = $enrollmentID;
            $achievement->progress = $request->input('progress');
            $achievement->acTitle = "";
            $achievement->acResult = "";
            $achievement->save();   
        }
        return redirect()->back()->with('success', 'Achievement updated!');
    }
}