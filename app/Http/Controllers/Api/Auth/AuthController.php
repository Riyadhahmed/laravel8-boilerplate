<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ResponseController as ResponseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp;
use Validator;

class AuthController extends ResponseController
{
   public function login(Request $request)
   {
      if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
         $user = Auth::user();
         $success['token'] = $user->createToken('userApiToken')->accessToken;
         $success['name'] = $user->name;
         return $this->sendResponse($success, 'User logged successfully.');
      } else {
         return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
      }
   }

   /**
    * Register api
    *
    * @return \Illuminate\Http\Response
    */
   public function register(Request $request)
   {
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'c_password' => 'required|same:password',
      ]);
      if ($validator->fails()) {
         return $this->sendError('Unauthorised.', ['error' => $validator->errors()]);
      }
      $input = $request->all();
      $input['password'] = bcrypt($input['password']);
      $user = User::create($input);
      $success['token'] = $user->createToken('userApiToken')->accessToken;
      $success['name'] = $user->name;
      return $this->sendResponse($success, 'User Registered successfully.');
   }

}
