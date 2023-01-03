<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('messages')->truncate();
		DB::table('groups')->truncate();
		DB::table('participants')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
		
		for($i = 1; $i < 4; $i++)
		{
			$name = 'user'.$i;
			$password = Hash::make($name);
			$now = Carbon::now();
			DB::table('users')->insert([
					'name' => $name,
					'email' => $name.'@email.com',
					'password' => $password,
					'created_at' => $now,
			]);			
		}
    }
}
