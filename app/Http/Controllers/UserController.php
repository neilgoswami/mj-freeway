<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    public function logout(Request $request)
    {
        Http::withToken(session('token'))->get(Config::get('app.url') . 'api/logout');

        $request->session()->flush();

        return redirect()->route('login');
    }

    public function dashboard()
    {
        $drinksResponse = Http::withToken(session('token'))->get(Config::get('app.url') . 'api/user/drinks');
        if ($drinksResponse->failed()) {
            return redirect()->route('login');
        }
        $drinks = $drinksResponse->json()['data'];

        $consumptionResponse = Http::withToken(session('token'))->get(Config::get('app.url') . 'api/user/consumptions');
        if ($consumptionResponse->failed()) {
            return redirect()->route('login');
        }
        $consumptions = $consumptionResponse->json()['data'];

        return view('user', compact('drinks', 'consumptions'));
    }

    public function addConsumption(Request $request)
    {
        $response = Http::withToken(session('token'))->post(Config::get('app.url') . 'api/user/consumptions/add', ["drink" => $request->id]);

        if ($response->failed()) {
            return redirect()->route('login');
        }

        return redirect()->route('dashboard');
    }
}
