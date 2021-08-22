<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddConsumptionRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\Consumption;
use App\Models\Drink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function signup(SignupRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('token_name')->plainTextToken;

        return response()->json([
            "message" => "Signup successfully.",
            "data" => [
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token
            ]
        ], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) return response(['message' =>  'Invalid credentials.'], Response::HTTP_UNAUTHORIZED);

        $auth = Auth::attempt($request->all());
        if (!$auth) return response(['message' =>  'Invalid credentials.'], Response::HTTP_UNAUTHORIZED);

        $token = $user->createToken('token_name')->plainTextToken;
        return response(['user' => $user, 'token' => $token], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response(['message' => 'Logout successfully.'], Response::HTTP_OK);
    }

    public function profile()
    {
        $userObj = new User();

        $consumptions = $userObj->getConsumptions(Auth::user());
    }

    public function consumptions()
    {
        $userObj = new User();

        $consumptions = $userObj->getConsumptions(Auth::user());

        return response(["data" => $consumptions], Response::HTTP_OK);
    }

    public function addConsumption(AddConsumptionRequest $request)
    {
        $result = Consumption::create([
            'user_id' => Auth::id(),
            'drink_id' => $request->drink,
        ]);

        if (!$result) return response(["message" => "Drink added successfully."], Response::HTTP_BAD_REQUEST);

        return response(["message" => "Drink added successfully."], Response::HTTP_OK);
    }

    public function removeConsumption()
    {
    }

    public function getDrinks()
    {
        return response(["data" => Drink::all()], Response::HTTP_OK);
    }
}
