<?php

namespace Database\Factories;
use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AccountFactory extends Factory
{
    protected $model = Account::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'account_name' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // デフォルトのパスワードは 'password' ですが、適切な方法でハッシュ化してください。
            'remember_token' => Str::random(10)
        ];
    }
}
