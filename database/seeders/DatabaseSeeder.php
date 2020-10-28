<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\EventSeeder;
use Database\Seeders\ParticipantSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call([
            EventSeeder::class,
            ParticipantSeeder::class,
        ]);

    }
}
