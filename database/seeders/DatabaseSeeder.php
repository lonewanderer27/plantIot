<?php

namespace Database\Seeders;

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
        \App\Models\DeviceUserPairing::factory(1)->create();
        \App\Models\Reading::factory(100)->create();
    }
}
