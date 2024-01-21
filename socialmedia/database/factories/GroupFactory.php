<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Group $group) {
            $users = User::inRandomOrder()->limit(5)->get();
            $group->users()->attach($users);
        });
    }
}
