<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
    	{
        DB::table('users')->insert([
            'username' => 'admin',
            'type_id' => '1',
            'password' => bcrypt('123123123'),
        ]);
        DB::table('users')->insert([
            'username' => 'taskmaster',
            'type_id' => '2',
            'password' => bcrypt('123123123'),
        ]);
        DB::table('users')->insert([
            'username' => 'user',
            'type_id' => '3',
            'password' => bcrypt('123123123'),
        ]);
    	}
}
