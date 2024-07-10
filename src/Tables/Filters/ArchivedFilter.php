<?php

namespace Okeonline\FilamentArchivable\Tables\Filters;

use Filament\Tables\Filters\Indicator;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use LaravelArchivable\Scopes\ArchivableScope;

class ArchivedFilter extends TernaryFilter
{
    public static function getDefaultName(): ?string
    {
        return 'archived';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('filament-archivable::table.filters.archived.label'));

        $this->placeholder(__('filament-archivable::table.filters.archived.without_archived'));

        $this->trueLabel(__('filament-archivable::table.filters.archived.with_archived'));

        $this->falseLabel(__('filament-archivable::table.filters.archived.only_archived'));

        $this->queries(
            true: fn ($query) => $query->withArchived(),
            false: fn ($query) => $query->onlyArchived(),
            blank: fn ($query) => $query->withoutArchived(),
        );

        $this->baseQuery(fn (Builder $query) => $query->withoutGlobalScopes([
            ArchivableScope::class,
        ]));

        $this->indicateUsing(function (array $state): array {
            if ($state['value'] ?? null) {
                return [Indicator::make($this->getTrueLabel())];
            }

            if (blank($state['value'] ?? null)) {
                return [];
            }

            return [Indicator::make($this->getFalseLabel())];
        });
    }
}
