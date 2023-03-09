<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\SendMail;


class UserController extends Controller
{


    protected  $Repository;

    public function __construct(RepositoryInterface $Repository)
    {
        $this->Repository = $Repository;
    }


    /**
     * Store a newly created resource in storage.
     */
    
//     public function loginCust(Request $request)
// {
//     $cEmail = $request->input('cEmail');
//     $cPassword = $request->input('cPassword');

//     if ($this->customerRepository->loginCustomer($cEmail, $cPassword)) {
//         return redirect()->intended('profileCustomer');
//     }else{
//        return redirect('loginCustomer')->with('wrong' ,'Invalid Email or Password');
//     }
// }

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        if ($user->role === 'student') {
            return redirect('/header');
        } else {
            return redirect('/');
        }
    }

    return redirect()->back()->with('wrong' ,'Invalid Email or Password');
}

// public function getProfileCust(Request $request)
// {
//     $cID = $request->session()->get('cID');
//     $profile = $this->customerRepository->getProfileCus($cID);
//     return view('Customer/profileCustomer', ['profile' => $profile]);
// }

public function redirect(){
    return view('Student.loginStudent');
}

}
