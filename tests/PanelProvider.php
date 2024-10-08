<?php

namespace Okeonline\FilamentArchivable\Tests;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider as FilamentPanelProvider;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Okeonline\FilamentArchivable\FilamentArchivablePlugin;
use Okeonline\FilamentArchivable\Tests\TestResources\ModelWithArchivableTraitAndCustomClassesResource;
use Okeonline\FilamentArchivable\Tests\TestResources\ModelWithArchivableTraitAndFalseCustomClassesResource;
use Okeonline\FilamentArchivable\Tests\TestResources\ModelWithArchivableTraitResource;
use Okeonline\FilamentArchivable\Tests\TestResources\ModelWithoutArchivableTraitResource;

class PanelProvider extends FilamentPanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('test')
            ->login()
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->resources([
                ModelWithArchivableTraitResource::class,
                ModelWithoutArchivableTraitResource::class,
                ModelWithArchivableTraitAndCustomClassesResource::class,
                ModelWithArchivableTraitAndFalseCustomClassesResource::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                FilamentArchivablePlugin::make(),
            ]);
    }
}
