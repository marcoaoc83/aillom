<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Support\Facades\Storage;

class CompanyFileRelationManager extends RelationManager
{
    protected static string $relationship = 'files'; // Relacionamento no modelo Individual

    protected static ?string $recordTitleAttribute = 'description';
    protected static ?string $label = 'Arquivo';
    protected static ?string $title = 'Arquivos';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(12) // Define uma grade de 12 colunas
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Título')
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(6), // Ocupa 6 colunas

                    Forms\Components\Textarea::make('description')
                        ->label('Descrição')
                        ->maxLength(65535)
                        ->columnSpan(6), // Ocupa 6 colunas
                ])->columnSpan(12),

                FileUpload::make('file_path')
                    ->label('Arquivo')
                    ->required() // Campo obrigatório
                    ->directory('uploads/individuals/files') // Diretório onde o arquivo será salvo
                    ->disk('public') // Disco configurado no `config/filesystems.php`
                    ->maxSize(5120) // Tamanho máximo do arquivo em KB (5 MB)
                    ->imagePreviewHeight('150') // Altura da pré-visualização para imagens
                    ->acceptedFileTypes([
                        'image/jpeg', 'image/png', // Imagens
                        'application/pdf',         // PDFs
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // Word (DOCX)
                        'text/plain',              // Arquivos de texto
                    ])
                    ->visibility('public') // Torna os arquivos publicamente acessíveis
                    ->columnSpan(12)
                    ->helperText('Arquivos permitidos: JPEG, PNG, PDF, DOCX, TXT (máx: 5 MB).')
                    ->preserveFilenames()
            ]);
    }



    public  function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->sortable()
                    ->searchable(),
                IconColumn::make('file_path')
                    ->label('Arquivo')
                    ->icon(fn ($state): ?string => $state ? 'heroicon-o-document-arrow-down' : null) // Define o ícone dinamicamente
                    ->url(fn ($state) => $state ? Storage::disk('public')->url($state) : null) // Gera a URL pública do arquivo
                    ->openUrlInNewTab() // Abre o link em uma nova aba
                    ->tooltip(fn ($state) => $state ? 'Baixar Arquivo' : 'Sem arquivo')
                    ->width('10px'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
