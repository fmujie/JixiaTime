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
    // 预定义response数组、状态码(格式设定)
    protected $statusCode = 200;
    protected $returned = [
        'result' => [
            'code' => 0,
            'status' => 'error',
            'msg' => null
        ],
        'data' => null
    ];
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
            $this->returned['result']['msg'] = 'Incorrect name or password';
            $this->statusCode = 401;
        } else {
            $this->returned['result']['code'] = 1;
            $this->returned['result']['status'] = 'success';
            $this->returned['result']['msg'] = '获取token成功';
            $ret = $this->returnWithToken($token);
            $this->returned['data'] = $ret;
        }
 
        return response()->json($this->returned, $this->statusCode);
     }

     public function register(Request $request)
     {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'company' => ['required', 'string']

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $retErr = $validator->errors();
            $errMsgs = [];
            foreach ($retErr->all() as $message) {
                array_push($errMsgs, $message);
            }
            $this->returned['result']['msg'] = $errMsgs;
            $this->statusCode = 400;
        } else {
            $res = User::create($request->all());
            if ($res) {
                $this->returned['result']['code'] = 1;
                $this->returned['result']['status'] = 'success';
                $this->returned['result']['msg'] = '注册成功';
                $this->returned['data'] = $res;
            } else {
                $this->returned['result']['msg'] = '注册失败，请重试';
            }
        }

        return response()->json($this->returned, $this->statusCode);
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
     protected function returnWithToken($token)
     {
         return [
             'access_token' => $token,
             'token_type' => 'bearer',
             'expires_in' => auth()->factory()->getTTL()
         ];
     }
}
