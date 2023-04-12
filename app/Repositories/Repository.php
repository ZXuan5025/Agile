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

    public function allStudent()
    {
        return User::where('role', 'student')->get();
    }

    public function allStaff()
    {
        return User::where('role', 'staff')->get();
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

    public function checkexistingUserupdate($email, $phone, $id)
{
        $user = User::where(function($query) use ($email, $phone) {
            $query->where('email', $email)
                ->orWhere('phone', $phone);
        })
        ->where('id', '<>', $id) // exclude current user
        ->first();
        return $user != null;
}

    public function update(int $id, array $data): bool {
        $user = User::find($id);
        if (!$user) {
            return false;
        }
        $user->fill($data);
        return $user->save();
    }

    public function delete($id) {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return true;
        }

        return false;
    }


}
