<?php


namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Forms;

class AuditsRelationManager extends RelationManager
{
    protected static string $relationship = 'audits';

    protected static ?string $recordTitleAttribute = 'event';

    public static function getLivewireComponentName(): string
    {
        return 'filament.resources.user.relation-managers.audits-relation-manager';
    }


    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('event')->label('Evento')->required(),
                Forms\Components\Textarea::make('changes')->label('Mudanças')->disabled(),
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('event')->label('Evento'),
                Tables\Columns\TextColumn::make('created_at')->label('Data')->dateTime(),
            ]);
    }

    public function getPageClass(): string
    {
        return \Filament\Resources\Pages\ListRecords::class;
    }
}
