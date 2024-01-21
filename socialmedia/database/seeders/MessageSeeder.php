<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Message::factory(5)->create();
    }
}
