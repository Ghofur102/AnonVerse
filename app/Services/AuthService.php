<?php

namespace App\Services;

use App\Repositories\AuthRepository;

class AuthService
{
    protected $AuthRepository;
    public function __construct(AuthRepository $AuthRepository)
    {
        $this->AuthRepository = $AuthRepository;
    }
    public function login($credentials)
    {
        $this->AuthRepository->login($credentials);
    }
    public function register($data)
    {
        $this->AuthRepository->register($data);
    }
    public function logout()
    {
        $this->AuthRepository->logout();
    }
}
