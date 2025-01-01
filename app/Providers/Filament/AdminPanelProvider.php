<?php

namespace App\Providers\Filament;

use App\Filament\VersionProviders\MyVersionProvider;
use App\Http\Middleware\IsSuperAdmin;
use App\Navigation\AdminPanelNavigation;
use App\Services\PluginManager;
use Awcodes\FilamentVersions\VersionsPlugin;
use Awcodes\FilamentVersions\VersionsWidget;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use DutchCodingCompany\FilamentSocialite\FilamentSocialitePlugin;
use DutchCodingCompany\FilamentSocialite\Provider;
use Filament\Facades\Filament;
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
use HusamTariq\FilamentDatabaseSchedule\FilamentDatabaseSchedulePlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Saade\FilamentLaravelLog\FilamentLaravelLogPlugin;
use Stephenjude\FilamentDebugger\DebuggerPlugin;
use TomatoPHP\FilamentArtisan\FilamentArtisanPlugin;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {

        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
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
            ->navigationGroups(AdminPanelNavigation::groups())
            ->navigationItems(AdminPanelNavigation::items())
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
                FilamentDatabaseSchedulePlugin::make(),
                FilamentSocialitePlugin::make()
                    ->providers([
                        Provider::make('govbr')
                            ->label('Gov.br')
                            ->icon('heroicon-o-user-group')
                            ->color(Color::hex('#009B3A')), // Azul do logotipo Gov.br

                        Provider::make('google')
                            ->label('Google')
                            ->icon('fab-google')
                            ->color(Color::hex('#EA4335')), // Vermelho oficial do Google


                        Provider::make('azure')
                            ->label('Azure')
                            ->icon('heroicon-o-cloud')
                            ->color(Color::hex('#0078D4')), // Azul oficial do Microsoft Azure

                        Provider::make('github')
                            ->label('Github')
                            ->icon('fab-github')
                            ->color(Color::hex('#181717')), // Preto do logotipo do GitHub

                        Provider::make('instagram')
                            ->label('Instagram')
                            ->icon('fab-instagram')
                            ->color(Color::hex('#E4405F')), // Rosa principal no degradê do Instagram

                        Provider::make('facebook')
                            ->label('Facebook')
                            ->icon('fab-facebook')
                            ->color(Color::hex('#1877F2')), // Azul oficial do Facebook



                    ])
                    ->registration(false)
                    ->userModelClass(\App\Models\User::class),

                FilamentShieldPlugin::make(),

                ThemesPlugin::make(),

                FilamentEnvEditorPlugin::make()
                    ->navigationGroup('Configurações')
                    ->navigationLabel('.Env')
                    ->navigationIcon('heroicon-o-cog-8-tooth')
                    ->navigationSort(1)
                    ->authorize(fn () => auth()->check() && auth()->user()->isSuperAdmin())
                    ->slug('env-editor'),

                DebuggerPlugin::make()
                    ->navigationGroup(condition: true, label: 'Logs')
                    ->horizonNavigation(
                        condition: fn () => auth()->check() && auth()->user()->isSuperAdmin(),
                        label: 'Horizon',
                        url: url('horizon'),
                        openInNewTab: fn () => true
                    )
                    ->telescopeNavigation(
                        condition: fn()=> auth()->check() && auth()->user()->isSuperAdmin(),
                        label: 'Telescope',
                        url: url('telescope'),
                        openInNewTab: fn () => true
                    )
                    ->pulseNavigation(
                        condition: fn () => auth()->check() && auth()->user()->isSuperAdmin(),
                        label: 'Pulse',
                        url: url('pulse'),
                        openInNewTab: fn () => true
                    ),

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
                FilamentArtisanPlugin::make(),

            ])

            ->authMiddleware([
                IsSuperAdmin::class,
                Authenticate::class,
            ]);
    }

}
