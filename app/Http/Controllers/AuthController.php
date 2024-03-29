<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $AuthService;
    public function __construct(AuthService $AuthService)
    {
        $this->AuthService = $AuthService;
    }
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $login = $this->AuthService->login($credentials);
        if ($login) {
            return redirect('/')->with('success', 'Sukses login!');
        } else {
            return redirect()->back()->withErrors('Gagal login!');
        }
    }
    public function register(Request $request)
    {
        $data = $request->only('username', 'password');
        $this->AuthService->register($data);
        return redirect('/login')->with('success', 'Sukses register, silakan login!');
    }
    public function logout() {
        $this->AuthService->logout();
        return redirect('/login')->with('success', 'Sukses logout!');
    }
}
