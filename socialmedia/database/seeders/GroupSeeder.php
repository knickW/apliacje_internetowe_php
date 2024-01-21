<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Group::factory(5)->create();
    }
}

