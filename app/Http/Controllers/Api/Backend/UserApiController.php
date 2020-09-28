<?php

namespace App\Http\Controllers\Api\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponseController;
use DB;
use Illuminate\Support\Facades\Auth;

class UserApiController extends ResponseController
{
   public function index(Request $request)
   {
      $users = User::all();

      if ($users) {
         return $this->sendResponse($users, 'success');
      } else {
         return $this->sendError('No records have found');
      }

   }

   public function details()
   {
      $user = Auth::user();

      if ($user) {
         return $this->sendResponse($user, 'success');
      } else {
         return $this->sendError('No records have found');
      }
   }
}
