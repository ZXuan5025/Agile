<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observer\Interfaces\SubjectInterface;
use App\Observer\Interfaces\ObserverInterface;
use Illuminate\Support\Facades\DB;

class Announcement extends Model implements SubjectInterface
{
    public $timestamps = false;
    use HasFactory;
    
    protected $observers = [];

    public function deleteAnnouncement($announcementID)
    {
        $announcement = Announcement::find($announcementID);
        if($announcement){
            $announcement->delete();
            $this->notify($announcement);
        }
        
    }

    public function attach(ObserverInterface $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(ObserverInterface $observer)
    {
        $key = array_search($observer, $this->observers, true);
        if ($key !== false) {
            unset($this->observers[$key]);
        }
    }

    public function notify($announcement)
    {
        foreach ($this->observers as $observer) {
            $observer->update($announcement);
        }
    }
}
