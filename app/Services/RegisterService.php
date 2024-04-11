<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

trait RegisterService
{
    /**
     * Create new user
     * @param array $data
     * 
     * @return App\Models\User $user
     */
    public function createUser(array $data) : Model
    {
        // user password hashed
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        return $user;
    }
}