<?php

namespace Okeonline\FilamentArchivable\Tests\TestFactories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Okeonline\FilamentArchivable\Tests\TestModels\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    protected static ?string $password;

    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
