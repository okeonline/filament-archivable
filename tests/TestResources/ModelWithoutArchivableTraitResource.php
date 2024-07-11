<?php

namespace Okeonline\FilamentArchivable\Tests\TestResources;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Okeonline\FilamentArchivable\Tables\Actions\ArchiveAction;
use Okeonline\FilamentArchivable\Tables\Actions\UnArchiveAction;
use Okeonline\FilamentArchivable\Tests\TestModels\ModelWithoutArchivableTrait;
use Okeonline\FilamentArchivable\Tests\TestResources\ModelWithoutArchivableTraitResource\Pages\ListPage;

class ModelWithoutArchivableTraitResource extends Resource
{
    protected static ?string $model = ModelWithoutArchivableTrait::class;

    public static ?string $modelLabel = 'without';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                DatePicker::make('archived_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('archived_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ArchiveAction::make(),
                UnArchiveAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPage::route('/'),
        ];
    }
}
