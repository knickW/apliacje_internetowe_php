<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition()
    {
        $sender = User::factory()->create();
        $receiver = User::factory()->create();

        return [
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'content' => $this->faker->sentence,
        ];
    }
}
