<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Repository implements RepositoryInterface
{

    public function allUser()
    {
        return User::latest()->paginate(10);
    }

    public function storeUser($data)
    {
        return User::create($data);
    }

    public function checkexistingUser($email, $phone)
    {
        $user = User::where('email', $email)
        ->orWhere('phone', $phone)
        ->first();
        return $user != null;
    }


    // public function loginStudent($sEmail, $sPassword)
    // {
    //     $customer = Customer::where('cEmail', $cEmail)->first();
    //     if (!$customer) {
    //         return false;
    //     }
    //     if (!Hash::check($cPassword, $customer->cPassword)) {
    //         return false;
    //     }
    //     Session::put('cID', $customer->cID);
    //     return true;
    // }

    // public function getProfileCus($cID)
    // {

    //     return Customer::where('cID', $cID)->first();
    // }


}
