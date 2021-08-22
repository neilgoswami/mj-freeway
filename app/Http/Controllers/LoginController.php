<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function login()
    {
        if (session('token')) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    public function authenticate(Request $request)
    {
        $response = Http::post(API_URL . 'login', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($response->failed()) {
            return redirect()->route('login');
        }

        session(['token' => $response->json()['token']]);

        return redirect()->route('dashboard');
    }
}
