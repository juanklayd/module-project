<?php

use Illuminate\Database\Seeder;
use App\UserTypes;

class user_type extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	UserTypes::create([
    		'type_name' => 'Admin',
    	]);

    	UserTypes::create([
    		'type_name' => 'Task Master',
    	]);

    	UserTypes::create([
    		'type_name' => 'User',
    	]);
    }
}
