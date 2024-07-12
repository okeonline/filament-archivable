<?php

namespace Okeonline\FilamentArchivable\Tests\TestResources\ModelWithArchivableTraitAndCustomClassesResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Okeonline\FilamentArchivable\Tests\TestResources\ModelWithArchivableTraitAndCustomClassesResource;

class ListPage extends ListRecords
{
    protected static string $resource = ModelWithArchivableTraitAndCustomClassesResource::class;
}
