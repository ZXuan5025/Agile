<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tests\TestCase;

class UserTest extends TestCase
{
   
    /** @test */
    public function it_creates_a_new_user()
    {
        $data = [
            'name' => 'Too Wei Chin',
            'phone' => '012-5541222',
            'dob' => '2022-11-24',
            'email'=> 'joan-choo98@hotmail.com',
            'password'=> Hash::make('123'),
            'role' => 'student',
            'image' => 'profileimage.jpg',
        ];

        User::create($data);
        unset($data['password']);
        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'phone' => $data['phone'],
            'dob' => $data['dob'],
            'email' => $data['email'],
        ]);
    }

    /** @test */
    public function error_when_clashing_email_creates_a_new_user()
    {
        $data = [
            'name' => 'Too Wei Chin',
            'phone' => '012-5541222',
            'dob' => '2022-11-24',
            'email'=> 'kahlok200257@gmail.com',
            'password'=> password_hash('123', PASSWORD_DEFAULT),
            'role'=> 'student',
            'image'=> 'profileimage.jpg',
        ];

        $this->post('/registersubmit', $data);
        unset($data['password']);
        //to test db having this email
        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
        ]);
        //to test the existing user is not from $data
        $this->assertDatabaseMissing('users', [
            'email' => $data['email'],
            'name' => $data['name'],
        ]);
    }

    /** @test */
    public function error_when_login_with_wrong_emails_or_password()
    {
        $data = [
            'email'=> 'kahlok200251@gmail.com',
            'password'=> '1234',
        ];

        $this->post('/loginStudentsubmit', $data);
        $this->assertFalse(Auth::check());

    }
    
}
