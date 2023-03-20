<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observer\Interfaces\SubjectInterface;
use Illuminate\Support\Facades\DB;

class Achievement extends Model implements SubjectInterface
{
    public $timestamps = false;
    use HasFactory;

    protected $observers = [];
    
    public function addAchievement($achievement)
    {
        $this->notify($achievement);
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

    public function notify($achievement)
    {
        foreach ($this->observers as $observer) {
            $observer->update($achievement);
        }
    }
}

