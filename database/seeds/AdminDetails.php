<?php

use Illuminate\Database\Seeder;
use App\UserDetails;

class AdminDetails extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        UserDetails::create([
        	'user_id' => '1',
        	'first_name' => 'Admin',
        	'last_name' => 'Admin',
        	'mid_name' => 'Default',
        	'profile_picture' => 'default.png',
        ]);
    }
}
