<?php
namespace App\Observer;
use App\Observer\Interfaces\ObserverInterface;
use App\Observer\Interfaces\SubjectInterface;

class EmailObserver implements ObserverInterface{

    private $subject;

    // protected $email;

    public function __construct(SubjectInterface $subject)
    {
        $this->subject = $subject;
        $this->subject->attach($this);
    }

    public function update(SubjectInterface $subject)
    {
        // Send an email to $this->email with details of the update
        $message = "The subject with ID " . $subject->id . " has been updated.";
        mail($this->email, "Subject updated", $message);
    }

    

}