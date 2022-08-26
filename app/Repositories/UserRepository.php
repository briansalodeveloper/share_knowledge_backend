<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepository
 * @package App\Repositories
 * @method User all()
 * @method User get($id)
 * @method User insert($request)
 * @method User remake()
 * @method User delete($id)
 * 
 */
class UserRepository 
{
    /**
     * Model
     *
     * @return string
     */
    protected function model()
    {
        return User::class;
    }

    /**
     * create new user
     *
     * @return collection
     */
    public function createUser()
    {
        return $this->model()::create([
            'name' => request()->get('name'),
            'email' => request()->get('email'),
            'password' => Hash::make(request()->get('password'))
        ]);
    }
}