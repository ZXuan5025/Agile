<?php
namespace App\Http\Controllers;
use App\Models\Announcement;
use App\Observer\Interfaces\SubjectInterface;
use Illuminate\Http\Request;
class AnnouncementController extends Controller
{

    protected $announcement;

    public function __construct()
    {
        $this->announcement = new Announcement();
    }

    public function create(SubjectInterface $announcement)
    {
        $this->announcement = $announcement;
        
        // Return a response
    }

    public function studentIndex(){
        $announcement = Announcement::all();
        return view("student.announcement",["announcements"=>$announcement]);
    }

    public function adminIndex(){
        $announcement = Announcement::all();
        return view("admin.announcement",["announcements"=>$announcement]);
    }

    public function addAnnouncement(Request $request) 
    {    
        $validatedData = $request->validate([
            'aTitle' => 'required|max:100',
            'aContent' => 'required',
        ], [
            'aTitle.required' => 'The title field is required.',
            'aContent.required' => 'The content field is required.',
        ]);

        $this->announcement->adminID = $request->input('adminID');
        $this->announcement->aTitle = $validatedData['aTitle'];
        $this->announcement->aContent = $validatedData['aContent'];
        $this->announcement->aDate = date('Y-m-d H:i:s');
        $this->announcement->version = "ori";
        $this->announcement->save();
        return redirect()->back()->with('success', 'User created successfully!');
    }

}