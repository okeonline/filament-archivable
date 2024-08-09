<?php

namespace Okeonline\FilamentArchivable\Tests\TestResources\ModelWithArchivableTraitResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Okeonline\FilamentArchivable\Actions\ArchiveAction;
use Okeonline\FilamentArchivable\Actions\UnArchiveAction;
use Okeonline\FilamentArchivable\Tests\TestResources\ModelWithArchivableTraitResource;

class EditPage extends EditRecord
{
    protected static string $resource = ModelWithArchivableTraitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ArchiveAction::make(),
            UnArchiveAction::make(),
        ];
    }
}
