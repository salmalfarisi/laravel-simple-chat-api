<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Session;

class ChatController extends BaseController
{
	//melihat percakapan detail berdasarkan group id yang dipilih
	public function indexbychat(Request $request, $id)
	{
		$database = DB::table('messages')->where('group_id', $id)->orderBy('id', 'desc')->get();
		$participants = DB::table('participants')->where('group_id', $id)->get();
		$title = 'Percakapan antara ';
		$i = 0;
		foreach($participants as $getname)
		{
			$getnamevalue = DB::table('users')->where('id', $getname->user_id)->limit(1)->value('name');
			
			$title = $title.$getnamevalue;
			if($i == count($participants) - 1)
			{
				$title = $title.'.';
			}
			else
			{
				$title = $title.' dan ';
			}
			$i++;
		}
		return $this->sendResponse(true, $database, $title);
	}
	
	//mencari list percakapan berdasarkan target yang dipilih dan si pengirim berdasarkan token
	public function indexbyuser(Request $request)
	{
		
	}
	
	//membuat percakapan baru serta membalas pesan para user
    public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'to' => 'required',
			'group' => 'nullable|numeric',
			'message' => 'required|string',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
		
		$now = Carbon::now();
		DB::beginTransaction();
		try
		{
			$checkgroup = false;
			if($request->group == null)
			{
				$group = $this->creategroup($request->userid, $request->to);
			}
			else
			{
				$checkgroup = true;
				$group = $request->group;
			}
			
			DB::table('messages')->insert([
				'group_id' => $group,
				'messages' => $request->message,
				'created_at' => $now,
				'created_by' => $request->userid,
				'updated_by' => $request->userid,
			]);
			
			DB::table('participants')->where('group_id', $group)->update(['read_status' => false]);
			DB::table('participants')->where('group_id', $group)->where('user_id', $request->userid)->update(['read_status' => true]);
			
			$inputdata = [
				'from' => $request->userid,
				'message' => $request->message,
				'group_id' => $group,
			];
			
			DB::commit();
			
			$message = ($checkgroup == true ? 'Successfully reply message' : 'Successfully send message to receiver');
			
			return $this->sendResponse(true, $inputdata, $message);
			
		}
		catch(Throwable $e)
		{
			DB::rollback();
			return $this->handlingErrorCatch($e);
		}
	}
	
	public function creategroup($from, $to)
	{
		$now = Carbon::now();
		
		DB::table('groups')->insert([
			'user_id' => $from,
			'created_at' => $now,
			'created_by' => $from,
			'updated_by' => $from,
		]);
		
		$getid = DB::table('groups')->where('user_id', $from)->where('created_at', $now)->limit(1)->value('id');
		
		$getarraytarget = explode("|", $to);
		
		array_push($getarraytarget, $from);
		
		foreach($getarraytarget as $inputparticipant)
		{
			DB::table('participants')->insert([
				'group_id' => $getid,
				'user_id' => $inputparticipant,
				'read_status' => ($inputparticipant == $from ? true : false),
				'created_at' => $now,
				'created_by' => $from,
				'updated_by' => $from,
			]);
		}
		
		return $getid;
	}
	
	//ubah status read berdasarkan group yang dipilih
	public function changeReadStatus(Request $request, $id)
	{
		DB::beginTransaction();
		try
		{
			DB::table('participants')->where('group_id', $id)->where('user_id', $request->userid)->update([ 'read_status' => true ]);
			DB::commit();
			
			return $this->sendResponse(true, [], 'Message successfully readed');
		}
		catch(Throwable $e)
		{
			DB::rollback();
			return $this->handlingErrorCatch($e);
		}
	}
}
