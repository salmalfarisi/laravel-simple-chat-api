<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class CheckAdmin
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
			$data = DB::table('oauth_access_tokens')->where('id', $token)->first();
			$checkadmin = DB::table('users')->where('id', $data->user_id)->limit(1)->value('is_admin');
			if($checkadmin == true)
			{
				return $next($request);				
			}
			else
			{
				return response(['error'=>'Forbidden', 'status' => 403], 403);
			}
		}
		else
		{
			return response(['error'=>'Unauthorized', 'status' => 401], 401);
		}
    }
}
