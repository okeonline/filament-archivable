<?php

namespace Okeonline\FilamentArchivable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Okeonline\FilamentArchivable\FilamentArchivable
 */
class FilamentArchivable extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Okeonline\FilamentArchivable\FilamentArchivable::class;
    }
}
