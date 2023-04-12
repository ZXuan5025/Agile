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
        $achievement = Achievement::join('enrollments','enrollments.id','=','achievements.eID')
        ->where('enrollments.sID','=',$sID)
        ->where('progress','=',100)
        ->get();
        return $achievement;
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

        //edit achievement
        if($achievement){
            if($request->input('progress')!=100){
                $achievement->acTitle = "";
                $achievement->acResult = "";
            }else{
                $validatedData = $request->validate([
                    'title' => 'required|max:50',
                    'result' => 'required|max:100',
                ], [
                    'title.required' => 'The title field is required.',
                    'title.max' => 'The title field should not be more than 50 characters.',
                    'result.required' => 'The result field is required.',
                    'result.max' => 'The result field should not be more than 100 characters.',
                ]);
                $achievement->acTitle = $validatedData['title'];
                $achievement->acResult = $validatedData['result'];

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
            return redirect()->back()->with('success', 'alert("Achievement updated!")');
        }
        //insert new achievement
        else{
            $achievement = new Achievement();
            $achievement->eID = $enrollmentID;
            $achievement->progress = $request->input('progress');
            $achievement->acTitle = "";
            $achievement->acResult = "";
            $achievement->save();
            return redirect()->back()->with('success', 'alert("Achievement added!")');
        }

    }
}
