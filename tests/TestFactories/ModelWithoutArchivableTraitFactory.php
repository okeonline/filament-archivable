<?php

namespace Okeonline\FilamentArchivable\Tests\TestFactories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Okeonline\FilamentArchivable\Tests\TestModels\ModelWithoutArchivableTrait;

class ModelWithoutArchivableTraitFactory extends Factory
{
    protected $model = ModelWithoutArchivableTrait::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'archived_at' => null,
        ];
    }
}
