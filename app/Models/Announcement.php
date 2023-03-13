<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observer\Interfaces\SubjectInterface;
use Illuminate\Support\Facades\DB;

class Announcement extends Model implements SubjectInterface
{
    public $timestamps = false;
    use HasFactory;
    
    protected $observers = [];

    public function deleteAnnouncement($announcement)
    {
        $this->notify();
    }

    public function attach($observer)
    {
        $this->observers[] = $observer;
    }

    public function detach($observer)
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
