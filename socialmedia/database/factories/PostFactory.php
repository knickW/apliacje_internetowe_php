<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            // Dodaj od 1 do 3 losowych zdjęć dla każdego posta
            $numberOfImages = rand(1, 3);

            for ($i = 0; $i < $numberOfImages; $i++) {
                $post->addMedia($this->faker->image())->save();
            }
        });
    }
}

