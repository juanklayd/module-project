<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(user_type::class);
        $this->call(AdminDefault::class);
        $this->call(AdminDetails::class);
    }
}
