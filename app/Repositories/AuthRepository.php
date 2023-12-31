<?php

namespace App\Repositories;

use App\Contracts\AuthInterface;
use App\Models\User;
use App\Validators\AuthenticateValidator;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthInterface
{
    protected $validate;
    public function __construct(AuthenticateValidator $validate)
    {
        $this->validate = $validate;
    }
    public function login($credentials)
    {
        $rules = [
            'username' => 'required|max:25',
            'password' => 'required|min:8'
        ];
        $this->validate->validate($credentials, $rules);
        return Auth::attempt($credentials);
    }
    public function register($data)
    {
        $rules = [
            'username' => 'required|max:25|unique:users',
            'password' => 'required|min:8'
        ];
        $this->validate->validate($data, $rules);
        return User::create($data);
    }
    public function logout()
    {
        return Auth::logout();
    }
}
