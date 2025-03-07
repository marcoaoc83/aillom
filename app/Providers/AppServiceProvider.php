<?php

namespace App\Providers;

use Dotswan\FilamentCodeEditor\Fields\CodeEditor;
use Filament\Facades\Filament;

use HusamTariq\FilamentDatabaseSchedule\FilamentDatabaseSchedulePlugin;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            Gate::define('viewFilament', function ($user) {
                return true;
            });
        });
        Livewire::component(
            'filament.resources.user.relation-managers.audits-relation-manager',
            \App\Filament\Resources\UserResource\RelationManagers\AuditsRelationManager::class
        );
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('govbr', \SocialiteProviders\GovBR\Provider::class);
        });
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('azure', \SocialiteProviders\Azure\Provider::class);
        });
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('instagram', \SocialiteProviders\Instagram\Provider::class);
        });
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('facebook', \SocialiteProviders\Facebook\Provider::class);
        });
    }
}
