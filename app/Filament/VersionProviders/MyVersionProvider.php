<?php

namespace App\Filament\VersionProviders;

use Awcodes\FilamentVersions\Providers\Contracts\VersionProvider;

class MyVersionProvider implements VersionProvider
{
    public function getName(): string
    {
        return 'v'; // Nome exibido no widget
    }

    public function getVersion(): string
    {
        return  env('APP_VERSION', '1.0.0');
    }


}

