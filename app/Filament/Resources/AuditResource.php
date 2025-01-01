<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuditResource\Pages;
use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Models\Audit;

class AuditResource extends BaseResource
{
    protected static ?string $model = Audit::class;
    protected static ?string $navigationLabel = 'Auditoria';
    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';
    protected static ?string $navigationGroup = 'Configurações';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Placeholder::make('auditable_type')
                ->label('Modelo Auditado')
                ->content(fn ($record) => class_basename($record->auditable_type ?? 'Desconhecido')),

            Placeholder::make('event')
                ->label('Evento')
                ->content(function ($record) {
                    $translations = [
                        'created' => 'Criado',
                        'updated' => 'Editado',
                        'deleted' => 'Excluído',
                    ];

                    $event = $record->event ?? 'Sem evento';

                    return $translations[$event] ?? ucfirst($event);
                }),


            Placeholder::make('user_name')
                ->label('Usuário')
                ->content(fn ($record) => $record->user?->name ?? 'Usuário desconhecido'),

            Placeholder::make('ip_address')
                ->label('IP')
                ->content(fn ($record) => $record->ip_address ?? 'IP desconhecido'),

            Placeholder::make('old_values')
                ->label('Valores Antigos')
                ->content(fn ($record) => $record && $record->old_values
                    ? json_encode($record->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
                    : 'Sem dados antigos'),

            Placeholder::make('new_values')
                ->label('Novos Valores')
                ->content(fn ($record) => $record && $record->new_values
                    ? json_encode($record->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
                    : 'Sem dados novos'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('event')
                    ->label('Evento')
                    ->formatStateUsing(function ($state) {
                        $translations = [
                            'created' => 'Criado',
                            'updated' => 'Editado',
                            'deleted' => 'Excluído',
                        ];
                        return $translations[$state] ?? ucfirst($state);
                    }),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuário'),

                Tables\Columns\TextColumn::make('auditable_type')
                    ->label('Módulo')
                    ->formatStateUsing(fn ($state) => class_basename($state)),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                // Filtro por Data
                Tables\Filters\Filter::make('data')
                    ->form([
                        Forms\Components\DatePicker::make('data_inicial')->label('Data Inicial'),
                        Forms\Components\DatePicker::make('data_final')->label('Data Final'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['data_inicial'], fn ($q) => $q->whereDate('created_at', '>=', $data['data_inicial']))
                            ->when($data['data_final'], fn ($q) => $q->whereDate('created_at', '<=', $data['data_final']));
                    }),

                // Filtro por Modelo
                Tables\Filters\SelectFilter::make('modulo')
                    ->options(fn () => Audit::query()
                        ->distinct()
                        ->pluck('auditable_type')
                        ->mapWithKeys(fn ($type) => [$type => class_basename($type)])
                        ->toArray()
                    )
                    ->attribute('auditable_type')
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }
    public static function canCreate(): bool
    {
        return false;
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAudits::route('/'),
            'view' => Pages\ViewAudit::route('/{record}'),
        ];
    }
}
