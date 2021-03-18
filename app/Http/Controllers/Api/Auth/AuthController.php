<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Auth;

class AuthController extends Controller 
{
    //
    use GeneralTrait;
    //register
    public function register(Request $request){
        //validation
        try{
            $rules =[
                "name" => "required|string",
                "email" => "required|unique:users,email",
                "password" => "required",
                "phone" => "required|unique:users"
            ];
            $validator = Validator::make($request->all(), $rules);
             //register

             if ($validator->fails()) {
                return $this->returnValidationError('e001',$validator);
                   
             }
             else {
             $newuser = new User;
             $newuser -> name = request('name');
             $newuser -> email = request('email');
             $newuser -> password = bcrypt(request('password'));
             $newuser -> phone = request('phone');

             
             $newuser -> save();
             return $this -> returnData('user successful register', $newuser);
             }
        }catch(\Exception $ex){
            return $this -> returnError($ex->getCode(), $ex->getMessage());
        } 
    }   

    //login
    public function login(Request $request){
        //validation
        try{
        $rules =[
            
            "email" => "required|exists:users,email",
            "password" => "required|string"
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            $code = $this -> returnCodeAccordingToInput($validator);
            return $this -> returnValidationError($code,$validator);
        } 

        //login
        $login = $request -> only(['email','password']);
        $token = Auth::guard('user-api') -> attempt($login);
        if(!$token){
            return $this -> returnError('E001','password or email invalid');
        }
        $user = Auth::guard('user-api') -> user();
        $user -> api_token =$token;
        //return token
        return $this -> returnData('users', $user);

        }catch(\Exception $e){
          return $this -> returnError($e->getCode(), $e->getMessage());
        }
    }

    //logout
    Public function logout(Request $request){
        $token = $request ->header('auth-token');
        if($token){
            try{
            JWTAuth::setToken($token)->invalidate();
            }catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                return  $this ->returnError('','some thing sent wrong');
            }
            return $this->returnSuccessMessage('logged out successfully');
        }else{
            $this ->returnError('','some thing sent wrong');
        }
    }

    // protected function createNewToken($token){
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => auth()->factory()->getTTL() * 60,
    //         'user' => auth()->user()
    //     ]);
    // }


    
}
