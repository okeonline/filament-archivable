<?php

use Statik\FilamentArchivable\Actions\ArchiveAction as ActionsArchiveAction;
use Statik\FilamentArchivable\Actions\ArchiveAction as TableArchiveAction;
use Statik\FilamentArchivable\Actions\UnArchiveAction as ActionsUnArchiveAction;
use Statik\FilamentArchivable\Actions\UnArchiveAction as TableUnArchiveAction;
use Statik\FilamentArchivable\FilamentArchivablePlugin;
use Statik\FilamentArchivable\Tables\Filters\ArchivedFilter;
use Statik\FilamentArchivable\Tests\TestModels\ModelWithArchivableTrait;
use Statik\FilamentArchivable\Tests\TestModels\ModelWithoutArchivableTrait;
use Statik\FilamentArchivable\Tests\TestResources\ModelWithArchivableTraitResource;
use Statik\FilamentArchivable\Tests\TestResources\ModelWithoutArchivableTraitResource;

use function Pest\Livewire\livewire;

it('can test', function () {
    expect(true)->toBeTrue();
});

it('is a valid plugin', function () {
    $plugin = new FilamentArchivablePlugin;

    expect($plugin->getId())
        ->toBe('filament-archivable');

    expect(FilamentArchivablePlugin::make())
        ->toBeInstanceOf(FilamentArchivablePlugin::class);

});

it('registers archivedRecordClasses macro to Table', function () {
    // cant find a good way to test macros
})->todo();

it('shows items when Archivable-trait is used, unfiltered, so only the unarchived items', function () {
    $modelWithArchivedAt = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => now()]);
    $modelWithoutArchivedAt = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => null]);

    livewire(ModelWithArchivableTraitResource\Pages\ListPage::class)
        ->assertSuccessful()
        ->assertCanSeeTableRecords($modelWithoutArchivedAt)
        ->assertCanNotSeeTableRecords($modelWithArchivedAt)
        ->assertCountTableRecords(1);
});

it('shows all models when Archivable-trait is not used', function () {
    $modelWithArchivedAt = ModelWithoutArchivableTrait::factory()->count(1)->create(['archived_at' => now()]);
    $modelWithoutArchivedAt = ModelWithoutArchivableTrait::factory()->count(1)->create(['archived_at' => null]);
    $both = $modelWithArchivedAt->merge($modelWithoutArchivedAt);

    livewire(ModelWithoutArchivableTraitResource\Pages\ListPage::class)
        ->assertSuccessful()
        ->assertCanSeeTableRecords($both)
        ->assertCountTableRecords(2);
});

it('does not show (un)ArchivedActions when Archivable-trait is not used', function () {
    $modelWithArchivedAt = ModelWithoutArchivableTrait::factory()->count(1)->create(['archived_at' => now()]);
    $modelWithoutArchivedAt = ModelWithoutArchivableTrait::factory()->count(1)->create(['archived_at' => null]);
    $both = $modelWithArchivedAt->merge($modelWithoutArchivedAt);

    livewire(ModelWithoutArchivableTraitResource\Pages\ListPage::class)
        ->assertSuccessful()
        ->assertCanSeeTableRecords($both)
        ->assertCountTableRecords(2)
        ->assertTableActionDoesNotExist(TableUnArchiveAction::class, record: $modelWithArchivedAt->nth(1))
        ->assertTableActionDoesNotExist(TableArchiveAction::class, record: $modelWithArchivedAt->nth(2));
});

// filters
it('filters rows based on ArchiveFilter = blank', function () {

    $modelWithArchivedAt = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => now()]);
    $modelWithoutArchivedAt = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => null]);

    livewire(ModelWithArchivableTraitResource\Pages\ListPage::class)
        ->filterTable(ArchivedFilter::class, null)
        ->assertSuccessful()
        ->assertCanSeeTableRecords($modelWithoutArchivedAt)
        ->assertCanNotSeeTableRecords($modelWithArchivedAt)
        ->assertCountTableRecords(1);

});

it('filters rows based on ArchiveFilter = true', function () {

    $modelWithArchivedAt = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => now()]);
    $modelWithoutArchivedAt = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => null]);
    $both = $modelWithArchivedAt->merge($modelWithoutArchivedAt);

    livewire(ModelWithArchivableTraitResource\Pages\ListPage::class)
        ->filterTable(ArchivedFilter::class, true)
        ->assertSuccessful()
        ->assertCanSeeTableRecords($both)
        ->assertCountTableRecords(2);

});

it('filters rows based on ArchiveFilter = false', function () {

    $modelWithArchivedAt = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => now()]);
    $modelWithoutArchivedAt = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => null]);

    livewire(ModelWithArchivableTraitResource\Pages\ListPage::class)
        ->filterTable(ArchivedFilter::class, false)
        ->assertSuccessful()
        ->assertCanSeeTableRecords($modelWithArchivedAt)
        ->assertCanNotSeeTableRecords($modelWithoutArchivedAt)
        ->assertCountTableRecords(1);

});

// actions
it('shows row-action archive, only on unarchived rows', function () {

    $modelWithoutArchivedAt = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => null]);

    livewire(ModelWithArchivableTraitResource\Pages\ListPage::class)
        ->filterTable(ArchivedFilter::class, true)
        ->assertSuccessful()
        ->assertCanSeeTableRecords($modelWithoutArchivedAt)
        ->assertCountTableRecords(1)
        ->assertTableActionVisible(TableArchiveAction::class, record: $modelWithoutArchivedAt->first())
        ->assertTableActionHidden(TableUnArchiveAction::class, record: $modelWithoutArchivedAt->first());

});

it('shows row-action unarchive, only on archived rows', function () {

    $modelWithArchivedAt = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => now()]);

    livewire(ModelWithArchivableTraitResource\Pages\ListPage::class)
        ->filterTable(ArchivedFilter::class, true)
        ->assertSuccessful()
        ->assertCanSeeTableRecords($modelWithArchivedAt)
        ->assertCountTableRecords(1)
        ->assertTableActionVisible(TableUnArchiveAction::class, record: $modelWithArchivedAt->first())
        ->assertTableActionHidden(TableArchiveAction::class, record: $modelWithArchivedAt->first());

});

it('archives the model if ArchiveAction is called', function () {

    $modelWithoutArchivedAt = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => null]);

    livewire(ModelWithArchivableTraitResource\Pages\ListPage::class)
        ->filterTable(ArchivedFilter::class, true)
        ->assertSuccessful()
        ->assertCanSeeTableRecords($modelWithoutArchivedAt)
        ->assertCountTableRecords(1)
        ->assertTableActionExists(TableArchiveAction::class, record: $modelWithoutArchivedAt->first())

        ->callTableAction(TableArchiveAction::class, $modelWithoutArchivedAt->first())
        ->assertHasNoTableActionErrors();

    expect($modelWithoutArchivedAt->first()->refresh()->archived_at)
        ->not->toBe(null);
});

it('unarchives the model if UnarchiveAction is called', function () {

    $modelWithArchivedAt = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => now()]);

    livewire(ModelWithArchivableTraitResource\Pages\ListPage::class)
        ->filterTable(ArchivedFilter::class, true)
        ->assertSuccessful()
        ->assertCanSeeTableRecords($modelWithArchivedAt)
        ->assertCountTableRecords(1)
        ->assertTableActionExists(TableUnArchiveAction::class, record: $modelWithArchivedAt->first())
        ->assertTableActionHidden(TableArchiveAction::class, record: $modelWithArchivedAt->first())

        ->callTableAction(TableUnArchiveAction::class, $modelWithArchivedAt->first())
        ->assertHasNoTableActionErrors();

    expect($modelWithArchivedAt->first()->refresh()->archived_at)
        ->toBe(null);
});

it('can show archive Action on Edit page', function () {

    $unArchivedModels = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => null]);

    livewire(ModelWithArchivableTraitResource\Pages\EditPage::class, ['record' => $unArchivedModels->first()->getKey()])
        ->assertSuccessful()
        ->assertActionExists(ActionsArchiveAction::class)
        ->assertActionVisible(ActionsArchiveAction::class);

});

it('can show unarchive Action on Edit page', function () {

    $archivedModels = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => now()]);

    livewire(ModelWithArchivableTraitResource\Pages\EditPage::class, ['record' => $archivedModels->first()->getKey()])
        ->assertSuccessful()
        ->assertActionExists(ActionsUnArchiveAction::class)
        ->assertActionVisible(ActionsUnArchiveAction::class);

});

it('does not show the unarchived action on a unarchived record', function () {

    $unArchivedModels = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => null]);

    livewire(ModelWithArchivableTraitResource\Pages\EditPage::class, ['record' => $unArchivedModels->first()->getKey()])
        ->assertSuccessful()
        ->assertActionExists(ActionsUnArchiveAction::class)
        ->assertActionHidden(ActionsUnArchiveAction::class);

});

it('does not show the archive action on a archived record', function () {

    $archivedModels = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => now()]);

    livewire(ModelWithArchivableTraitResource\Pages\EditPage::class, ['record' => $archivedModels->first()->getKey()])
        ->assertSuccessful()
        ->assertActionExists(ActionsArchiveAction::class)
        ->assertActionHidden(ActionsArchiveAction::class);

});

it('can archive a model on Edit page', function () {

    $unArchivedModel = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => null])->first();

    livewire(ModelWithArchivableTraitResource\Pages\EditPage::class, ['record' => $unArchivedModel->getKey()])
        ->assertSuccessful()
        ->assertActionVisible(ActionsArchiveAction::class)
        ->callAction(ActionsArchiveAction::class);

    $unArchivedModel->refresh();

    expect($unArchivedModel->archived_at)->not->toBeNull();
});

it('can unarchive a model on Edit page', function () {

    $archivedModel = ModelWithArchivableTrait::factory()->count(1)->create(['archived_at' => now()])->first();

    livewire(ModelWithArchivableTraitResource\Pages\EditPage::class, ['record' => $archivedModel->getKey()])
        ->assertSuccessful()
        ->assertActionVisible(ActionsUnArchiveAction::class)
        ->callAction(ActionsUnArchiveAction::class);

    $archivedModel->refresh();

    expect($archivedModel->archived_at)->toBeNull();

});
