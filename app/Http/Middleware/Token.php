<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class Token
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		$token = $request->bearerToken();
		$cekdata = DB::table('oauth_access_tokens')->where('id', $token)->count();
		if($cekdata == 1)
		{
			$getid = DB::table('oauth_access_tokens')->where('id', $token)->first();
			$data = DB::table('users')->where('id', $getid->user_id)->first();
			$request->merge([
				"userid" => $data->id,
				"name" => $data->name,
				"email" => $data->email,
			]);
			
			return $next($request);
		}
		else
		{
			return response(['error'=>'Unauthorized', 'status' => 401], 401);
		}		
    }
}
