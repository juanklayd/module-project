<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminDefault extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
        	'username' => 'admin',
        	'password' => Hash::make('admin'),
        	'type_id' => 1,
        ]);
    }
}
