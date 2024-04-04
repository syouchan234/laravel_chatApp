<?php

namespace Database\Factories;
use App\Models\Post;
use App\Models\Account;
use App\Models\Comments;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentsFactory extends Factory
{
    protected $model = Comments::class;
    public function definition(): array
    {
        return [
            'parent_id' => null,
            'account_id' => Account::factory()->create()->id,
            'post_id' => Post::factory()->create()->id,
            'content' => $this->faker->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
