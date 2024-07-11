<?php

namespace Okeonline\FilamentArchivable\Tests\TestFactories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Okeonline\FilamentArchivable\Tests\TestModels\ModelWithArchivableTrait;

class ModelWithArchivableTraitFactory extends Factory
{
    protected $model = ModelWithArchivableTrait::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'archived_at' => null,
        ];
    }
}