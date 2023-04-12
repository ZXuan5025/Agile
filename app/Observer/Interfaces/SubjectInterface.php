<?php
namespace App\Observer\Interfaces;
use App\Observer\Interfaces\ObserverInterface;
use App\Observer\EmailObserver;

interface SubjectInterface {
/* Methods */

    public function attach($observer);

    public function detach($observer);

    public function notify($announcement);
}