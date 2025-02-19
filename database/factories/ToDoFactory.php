<?php

/**
 * このコードはサンプルコードです
 * 他の実装が終わり次第削除します。
 */

namespace Database\Factories;

use App\Models\ToDo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ToDo>
 */
class ToDoFactory extends Factory
{
    protected $model = ToDo::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->name()
        ];
    }
}
