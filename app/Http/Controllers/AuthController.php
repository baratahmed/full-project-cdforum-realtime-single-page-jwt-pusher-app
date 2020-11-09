<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\SignupRequest;
use App\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login','signup']]);
        //$this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->claims(['nam' => 'CherishedDream'])->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function signup(SignupRequest $request){
        
        User::create($request->all());

        return $this->login($request);       
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'username'  => auth()->user()->name,
        ]);
    }

    public function payload(){
        return auth()->payload();
    }
}





//For New Version of JWT (Not Working Properly)

// public function login(Request $request)
// {
//     $credentials = $request->only('email', 'password');

//     if ($token = $this->guard()->attempt($credentials)) {
//         return $this->respondWithToken($token);
//     }

//     return response()->json(['error' => 'Unauthorized'], 401);
// }

// public function me()
// {
//     return response()->json($this->guard()->user());
// }

// public function logout()
// {
//     $this->guard()->logout();

//     return response()->json(['message' => 'Successfully logged out']);
// }

// public function refresh()
//     {
//         return $this->respondWithToken($this->guard()->refresh());
//     }

//     protected function respondWithToken($token)
//     {
//         return response()->json([
//             'access_token' => $token,
//             'token_type' => 'bearer',
//             'expires_in' => $this->guard()->factory()->getTTL() * 60,
//             'username' => auth()->user()->name,
//         ]);
//     }

//     public function guard()
//     {
//         return Auth::guard();
//     }
