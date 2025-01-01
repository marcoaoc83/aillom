<?php

namespace App\Providers\Filament;

use App\Filament\VersionProviders\MyVersionProvider;
use App\Navigation\AdminPanelNavigation;
use Awcodes\FilamentVersions\VersionsPlugin;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use DutchCodingCompany\FilamentSocialite\FilamentSocialitePlugin;
use DutchCodingCompany\FilamentSocialite\Provider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use GeoSot\FilamentEnvEditor\FilamentEnvEditorPlugin;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Saade\FilamentLaravelLog\FilamentLaravelLogPlugin;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('user')
            ->path('web')
            ->login()
            ->spa(true)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,

            ])
            ->sidebarCollapsibleOnDesktop()
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
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class
            ])
            ->plugins([
                FilamentEnvEditorPlugin::make()
                    ->navigationGroup('Configurações')
                    ->navigationLabel('.Env')
                    ->navigationIcon('heroicon-o-cog-8-tooth')
                    ->navigationSort(1)
                    ->authorize(fn () => auth()->check() && auth()->user()->isSuperAdmin())
                    ->slug('env-editor'),
                FilamentSocialitePlugin::make()
                    ->providers([
                        Provider::make('google')
                            ->label('Google')
                            ->icon('fab-google')
                            ->color(Color::Blue),
                        Provider::make('govbr')
                            ->label('Gov.br')
                            ->icon('heroicon-o-user-group')
                            ->color(Color::Yellow),
                    ])
                    ->registration(true)
                    ->userModelClass(\App\Models\User::class),
                FilamentShieldPlugin::make(),
                ThemesPlugin::make(),
                VersionsPlugin::make()
                    ->items([
                        new MyVersionProvider(),
                    ])
                    ->hasDefaults(false)
                    ->widgetColumnSpan(12)
                    ->widgetSort(12),
                FilamentLaravelLogPlugin::make()
                    ->navigationGroup('Logs')
                    ->navigationLabel('Logs')
                    ->navigationIcon('heroicon-o-bug-ant')
                    ->navigationSort(1)
                    ->logDirs([
                        storage_path('logs'),
                    ])
                    ->authorize(fn () => auth()->check() && auth()->user()->isSuperAdmin())
                    ->slug('logs'),

            ])

            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
