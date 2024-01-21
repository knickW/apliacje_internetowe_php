<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Utwórz 20 przykładowych postów
        Post::factory(20)->create();
    }
}

