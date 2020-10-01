<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Auth\RegisterController;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
     public function __construct()
     {
        parent::__construct();
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
     }
 
     /**
      * Get a JWT via given credentials.
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function login()
     {
        $credentials = request(['name', 'password']);
 
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Incorrect name or password'], 401);
        }
 
        return $this->respondWithToken($token);
     }

     public function register(Request $request)
     {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'company' => ['required', 'string']

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // dd($request->all());
        $res = User::create($request->all());
        if ($res) {
            return response()->json($res, 200);
        } else {
            return response()->json('注册失败，请重试', 200);
        }
        // $data = [];
        // $data = $data.append($request->all());
        // $RegisterController->create($data);
     }
 
     /**
      * Get the authenticated User.
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function me()
     {  
        return response()->json(auth()->user());
     }
 
     /**
      * Log the user out (Invalidate the token).
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function logout()
     {
         auth()->logout();
 
         return response()->json(['message' => 'Successfully logged out']);
     }
 
     /**
      * Refresh a token.
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function refresh()
     {
         return $this->respondWithToken(auth()->refresh());
     }
 
     /**
      * Get the token array structure.
      *
      * @param  string $token
      *
      * @return \Illuminate\Http\JsonResponse
      */
     protected function respondWithToken($token)
     {
         return response()->json([
             'access_token' => $token,
             'token_type' => 'bearer',
             'expires_in' => auth()->factory()->getTTL()
         ]);
     }
}
