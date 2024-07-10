<?php

namespace Okeonline\FilamentArchivable;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Okeonline\FilamentArchivable\Commands\FilamentArchivableCommand;

class FilamentArchivableServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-archivable')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament-archivable_table')
            ->hasCommand(FilamentArchivableCommand::class);
    }
}
