<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class WebTinkerPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-code-bracket-square';
    protected static string $view = 'filament.pages.web-tinker-page';
    protected static ?string $title = 'Tinker';
    protected static ?int $navigationSort = 89;
    protected static ?string $navigationGroup = 'Developer';

    public static function canAccess(): bool
    {
        return auth()->user()->isSuperAdmin();
    }
}
