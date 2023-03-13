<?php
namespace App\Repositories\Interfaces;
use App\Models\User;

Interface RepositoryInterface{

    public function allUser();
    public function storeUser($data);
    // public function loginStudent($sEmail, $sPassword);
    public function checkexistingUser($email, $phone);
    // public function getProfileStu($sID);
}
