<?php

namespace Okeonline\FilamentArchivable\Tests\TestResources\ModelWithArchivableTraitResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Okeonline\FilamentArchivable\Tests\TestResources\ModelWithArchivableTraitResource;

class ListPage extends ListRecords
{
    protected static string $resource = ModelWithArchivableTraitResource::class;
}
