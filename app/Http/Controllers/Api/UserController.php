<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Hash;
use Session;

class UserController extends BaseController
{
	public function login(Request $request)
	{	
		$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
		
		$array = ['email' => $request->email, 'password' => $request->password];
		
		if (Auth::attempt($array)) 
		{
			$now = Carbon::now()->addDays(1);
			$user = Auth::user(); 
			$token = $user->createToken($user->name);
			//untuk dapet tokennya => $data['token'] = $token->accessToken;
			$data['token'] = $token->token->id;			
			$data['id'] = $user->id;
			$data['name'] = $user->name;
			$data['email'] = $user->email;
			$data['is_admin'] = $user->is_admin;
			
			return $this->sendResponse(true, $data, 'Successfully login');
		}
		else
		{
			return $this->sendError('Email or Password not found in database', []);
		}
	}
	
	public function logout(Request $request)
	{
		$token = $request->bearerToken();
		$cekdata = DB::table('oauth_access_tokens')->where('id', $token)->delete();
		//Session::flush();
		//Auth::logout();
		return $this->sendResponse(true, [], 'Account successfully logout');
	}
}
