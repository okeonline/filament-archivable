<?php

namespace Okeonline\FilamentArchivable\Tests\TestModels;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelArchivable\Archivable;
use Okeonline\FilamentArchivable\Tests\TestFactories\ModelWithArchivableTraitFactory;

class ModelWithArchivableTrait extends Model
{
    use Archivable;
    use HasFactory;

    protected $table = 'with';

    protected static function newFactory(): Factory
    {
        return ModelWithArchivableTraitFactory::new();
    }
}
