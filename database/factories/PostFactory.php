<?php

namespace Database\Factories;
use App\Models\Post;
use App\Models\Account;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'account_id' => Account::factory()->create()->id,
        ];
    }
}
