<?php

namespace App\Http\Controllers;

use App\Strategy\Interface\EvaluationStrategyInterface;
use Illuminate\Http\Request;
use App\Strategy\Strategy;
use App\Models\Evaluations;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\EvaluationStrategy;

// class EvaluationController extends Controller
// {
//     public function adminIndex(Request $request){
//         $evaluations = Evaluations::all();
//         return view("admin.evaluation",["evaluations"=>$evaluations]);
//     }

//     public function blogIndex(Request $request){
//         $evaluations = Evaluations::where('cid', 1)->get();
//         return view("student.blog",["evaluations"=>$evaluations]);
//     }

//     protected $evaluation;

//     public function __construct(EvaluationFormInterface $evaluation)
//     {
//         $this->evaluation = $evaluation;
//     }

//     public function storeEvaluation(Request $request)
//     {
//         $request->validate([
//             'cID' => 'required',
//             'evaRate' => 'required',
//             'evaCourse' => 'required',
//             'evaStaff' => 'required',
//         ]);

//         if ($request) {
//             $this->evaluation->cID = $request->input('cID');
//             $this->evaluation->evaRate = $request->input('evaRate');
//             $this->evaluation->evaCourse = $request->input('evaCourse');
//             $this->evaluation->evaStaff = $request->input('evaStaff');
//             $this->evaluation->saveEvaluationData($request);
//         }

//         return redirect()->back()->with('success', 'Evaluation added successfully.');
//     }



//     public function updateEvaluation(Request $request, $id)
//     {
//     $evaluation = Evaluations::find($id);
//     if ($evaluation) {
//         $cID = $request->cID;
//         $evaluation->evaRate = $request->input('evaRate', $request->input('currentRating'));
//         $evaluation->evaCourse = $request->input('evaCourse');
//         $evaluation->evaStaff = $request->input('evaStaff');
//         $evaluation->save();
//     }
//     return redirect()->back()->with('success1', 'Evaluation updated successfully.');
//     }

//     public function deleteStudentEvaluation($evaID)
//     {
//     $evaluations = Evaluations::findOrFail($evaID);
//     $evaluations->delete();
//     return redirect()->back()->with('success2', 'Evaluation deleted successfully.');
//     }
// }



// class EvaluationController extends Controller {

//     protected  $strategy;

//     public function __construct(EvaluationStrategyInterface $strategy)
//     {
//         $this->strategy = $strategy;
//     }

//     public function createEvaluation(Request $request) {

//         $validatedData = $request->validate([
//             'cID' => 'required',
//             'vote1' => 'required',
//             'vote2' => 'required',
//             'vote3' => 'required',
//             'vote4' => 'required',
//             'vote5' => 'required',
//             'vote6' => 'required',
//             'vote7' => 'required',
//             'vote8' => 'required',
//             'vote9' => 'required',
//             'vote10' => 'required',
//             'evaComment' => 'required|string|max:500',
//         ]);

//         $evaCourse = [$validatedData['vote1'],
//             $validatedData['vote2'],
//             $validatedData['vote3'],
//             $validatedData['vote4'],
//             $validatedData['vote5']];

//         $evaStaff = [$validatedData['vote6'],
//             $validatedData['vote7'],
//             $validatedData['vote8'],
//             $validatedData['vote9'],
//             $validatedData['vote10']];

//             $strategy = new Strategy();

//             // Save evaluation
//             $evaluation = new Evaluations();
//             $evaluation->cID = $validatedData['cID'];
//             $evaluation->evaRate = $strategy->evaRate($evaCourse, $evaStaff);
//             $evaluation->evaCourse = $strategy->eva($evaCourse);
//             $evaluation->evaStaff = $strategy->eva($evaStaff);
//             $evaluation->evaComment = $validatedData['evaComment'];

//             $evaluation->saveEvaluationData($request);
//             return response()->json([
//                 'message' => 'Evaluation saved successfully'
//             ]);
//     }
// }

class EvaluationController extends Controller
{
    protected $strategy;

    public function __construct()
    {
        $this->strategy = new Evaluations();
    }

    public function evaluation($id){
        $evaluation = Evaluations::where('eID','=',$id)
        ->first();
        return view("student.evaluation",["evaluation"=>$evaluation]);
    }

    // public function createEvaluation(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'cID' => 'required',
    //         'vote1' => 'required',
    //         'vote2' => 'required',
    //         'vote3' => 'required',
    //         'vote4' => 'required',
    //         'vote5' => 'required',
    //         'vote6' => 'required',
    //         'vote7' => 'required',
    //         'vote8' => 'required',
    //         'vote9' => 'required',
    //         'vote10' => 'required',
    //         'evaComment' => 'required|string|max:500',
    //         'eID' => 'required',
    //     ]);

    //     $evaCourse = [
    //         $validatedData['vote1'],
    //         $validatedData['vote2'],
    //         $validatedData['vote3'],
    //         $validatedData['vote4'],
    //         $validatedData['vote5']
    //     ];

    //     $evaStaff = [
    //         $validatedData['vote6'],
    //         $validatedData['vote7'],
    //         $validatedData['vote8'],
    //         $validatedData['vote9'],
    //         $validatedData['vote10']
    //     ];

    //     $evaRate = $this->strategy->evaRate($evaCourse, $evaStaff);

    //     $evaCourse = $this->strategy->eva($evaCourse);
    //     $evaStaff = $this->strategy->eva($evaStaff);

    //     $evaluation = new Evaluations();
    //     $evaluation->cID = $validatedData['cID'];
    //     $evaluation->evaRate = $evaRate;
    //     $evaluation->evaCourse = $evaCourse;
    //     $evaluation->evaStaff = $evaStaff;
    //     $evaluation->evaComment = $validatedData['evaComment'];
    //     $evaluation->eID = $validatedData['eID'];
    //     $evaluation->save();

    //     return redirect()->back()->with('success', 'Evaluation added successfully.');
    // }

    public function adminIndex()
    {
        // Fetch all evaluations from the database
        $evaluations = Evaluations::all();

        // Pass the evaluations variable to the view
        return view('admin.evaluation', ['evaluations' => $evaluations]);
    }

    public function deleteEvaluation(Request $request, $id)
    {
        $evaluations = Evaluations::find($id);

        $evaluations->deleteEvaluationData($request);
        return redirect()->back()->with('success1', 'Evaluation deleted successfully.');
    }

    public function blogIndex($cID){
        $evaluations = Evaluations::join('enrollments', 'evaluations.eid', '=', 'enrollments.id')
            ->join('users', 'enrollments.sID', '=', 'users.id')
            ->where('enrollments.cID', '=', $cID)
            ->select('evaluations.*', 'users.name')
            ->get();

        return $evaluations;
    }

    public function deleteStudentEvaluation($evaID)
    {
    $evaluations = Evaluations::findOrFail($evaID);
    $evaluations->delete();
    return redirect()->back()->with('success2', 'Evaluation deleted successfully.');
    }

    // public function myCourseIndex(Request $request){
    //     $evaluations = Evaluations::where('cid', 1)->get();
    //     return view("student.myCourse",["evaluations"=>$evaluations]);
    // }

    public function assignEvaluation(Request $request, $id)
    {
    $validatedData = $request->validate([
        'cID' => 'required',
        'vote1' => 'required',
        'vote2' => 'required',
        'vote3' => 'required',
        'vote4' => 'required',
        'vote5' => 'required',
        'vote6' => 'required',
        'vote7' => 'required',
        'vote8' => 'required',
        'vote9' => 'required',
        'vote10' => 'required',
        'evaComment' => 'required|string|max:500',
        'eID' => 'required',
    ]);

    $evaCourse = [
        $validatedData['vote1'],
        $validatedData['vote2'],
        $validatedData['vote3'],
        $validatedData['vote4'],
        $validatedData['vote5']
    ];

    $evaStaff = [
        $validatedData['vote6'],
        $validatedData['vote7'],
        $validatedData['vote8'],
        $validatedData['vote9'],
        $validatedData['vote10']
    ];

    $evaRate = $this->strategy->evaRate($evaCourse, $evaStaff);
    $evaCourse = $this->strategy->eva($evaCourse);
    $evaStaff = $this->strategy->eva($evaStaff);

    $evaluation = Evaluations::find($id);

    $evaluation->cID = $validatedData['cID'];
    $evaluation->evaRate = $evaRate;
    $evaluation->evaCourse = $evaCourse;
    $evaluation->evaStaff = $evaStaff;
    $evaluation->evaComment = $validatedData['evaComment'];
    $evaluation->eID = $validatedData['eID'];
    $evaluation->save();

    //edit
    if ($evaluation) {
        return redirect()->back()->with('success1', 'Evaluation updated successfully.');
    }
    //create
    else {
        $evaluation = new Evaluations();
        return redirect()->back()->with('success', 'Evaluation added successfully.');
    }
}


}

