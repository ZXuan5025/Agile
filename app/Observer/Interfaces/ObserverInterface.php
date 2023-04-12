<?php
namespace App\Observer\Interfaces;
use App\Observer\Interfaces\SubjectInterface;

interface ObserverInterface {
/* Methods */
    public function update ( $announcement );
}