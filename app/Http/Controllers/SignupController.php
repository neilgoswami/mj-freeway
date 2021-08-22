<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SignupController extends Controller
{
    public function signup()
    {
        return view('signup');
    }

    public function register(Request $request)
    {
        $response = Http::post(API_URL . 'signup', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->failed()) {
            return redirect('signup');
        }

        session(['token' => json_decode($response->body())->data->token]);

        return redirect()->route('dashboard');
    }
}
