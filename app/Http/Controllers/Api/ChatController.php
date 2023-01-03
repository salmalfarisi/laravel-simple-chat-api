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
	//melihat percakapan terakhir, participant dan total pesan yang belum terbaca berdasarkan group id yang dipilih
	public function indexbychat(Request $request, $id)
	{
		$chat = DB::table('messages')->where('group_id', $id)->orderBy('id', 'desc')->first();
		$participants = DB::table('participants')->where('group_id', $id)->get();
		$title = 'Percakapan antara ';
		$member = '';
		$unread = 0;
		$i = 0;
		foreach($participants as $getname)
		{
			$getnamevalue = DB::table('users')->where('id', $getname->user_id)->limit(1)->value('name');
			
			if($getname->user_id == $request->userid)
			{
				$unread = $getname->read_count;
			}
			
			$title = $title.$getnamevalue;
			
			if($getname->user_id != $request->userid)
			{
				$member = $member.$getnamevalue;
			}
			
			if($i == count($participants) - 1)
			{
				$title = $title.'.';
				$member = $member.'.';
			}
			else
			{
				$title = $title.' dan ';
				$member = $member.', ';
			}
			$i++;
		}
		$senddata = [
			'recent_message' => $chat->messages,
			'participant' => $member,
			'unread_count' => $unread,
		];
		
		return $this->sendResponse(true, $senddata, $title);
	}
	
	public function show(Request $request, $id)
	{
		$chat = DB::table('messages')->where('group_id', $id)->orderBy('id', 'desc')->get();
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
		
		return $this->sendResponse(true, $chat, $title);
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
			
			DB::table('participants')->where('group_id', $group)->where('user_id', $request->userid)->update(['read_count' => 0]);
			$getdata = DB::table('participants')->where('group_id', $group)->where('user_id', '<>', $request->userid)->get();
			foreach($getdata as $showdata)
			{
				DB::table('participants')
					->where('group_id', $group)
					->where('user_id', $showdata->user_id)
					->update([
						'read_count' => (int) $showdata->read_count + 1,
					]);
			}
			
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
				'read_count' => 0,
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
			DB::table('participants')->where('group_id', $id)->where('user_id', $request->userid)->update([ 'read_count' => 0 ]);
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
