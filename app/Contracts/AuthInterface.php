<?php

namespace App\Contracts;

interface AuthInterface{
    public function login(array $credentials);
    public function register(array $data);
    public function logout();
}


