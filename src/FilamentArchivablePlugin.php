<?php

namespace Okeonline\FilamentArchivable;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class FilamentArchivablePlugin implements Plugin
{
    public function getId(): string
    {
        return 'archivable';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function register(Panel $panel): void
    {
        Table::macro('archivedRecordClasses', function (array|string|bool|null $classes = true) {
            /** @var Table $this */
            if ($classes === false) {
                return $this;
            } elseif ($classes === true) {
                $this->recordClasses(fn (Model $record) => in_array(\LaravelArchivable\Archivable::class, class_uses($record)) && $record->isArchived() ? FilamentArchivable::$archivedRecordClasses : null); //
            } else {
                $this->recordClasses(fn (Model $record) => in_array(\LaravelArchivable\Archivable::class, class_uses($record)) && $record->isArchived() ? $classes : null);
            }

            return $this;
        });
    }

    // @codeCoverageIgnoreStart
    public function boot(Panel $panel): void {}
    // @codeCoverageIgnoreEnd

    public function archivedTableRowClasses(string|array $classes): static
    {
        FilamentArchivable::$archivedRecordClasses = $classes;

        return $this;
    }
}
