<?php

namespace App\Filament\Pages;

use Dotswan\FilamentCodeEditor\Fields\CodeEditor;
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MigrationManager extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
    protected static ?string $navigationLabel = 'Migrations';
    protected static ?string $navigationGroup = 'Developer';
    protected static string $view = 'filament.pages.migration-manager';
    protected static ?int $navigationSort = 79;

    public $migrations = [];
    public $formData = [];
    public $editData = [];
    public $editingMigration = null;
    public $showCreateForm = false;

    public function mount(): void
    {
        $this->loadMigrations();
        $this->showCreateForm = false;
    }

    public function loadMigrations(): void
    {
        $this->migrations = collect(File::files(database_path('migrations')))
            ->map(fn($file) => [
                'name' => $file->getFilename(),
                'path' => $file->getPathname(),
                'executed' => $this->isExecuted($file->getFilename()),
                'lastModified' => date('d/m/Y H:i', filemtime($file->getPathname()))
            ])->toArray();
    }

    private function isExecuted(string $filename): bool
    {
        $executedMigrations = DB::table('migrations')->pluck('migration')->toArray();
        return in_array(pathinfo($filename, PATHINFO_FILENAME), $executedMigrations);
    }

    // Criação de nova migração
    public function createMigration(): void
    {
        $fileName = now()->format('Y_m_d_His') . '_' . Str::snake($this->formData['migrationName']) . '.php';
        $filePath = database_path('migrations/' . $fileName);
        $content = $this->formData['migrationContent'] ?? $this->getDefaultMigrationContent('example_table');

        File::put($filePath, $content);
        Notification::make()
            ->title('Migração Criada com Sucesso!')
            ->success()
            ->send();

        $this->resetForm();
        $this->loadMigrations();
    }

    // Edição de migração
    public function editMigration($path): void
    {
        $this->editingMigration = $path;
        $this->editData = [
            'migrationName' => pathinfo($path, PATHINFO_FILENAME),
            'migrationContent' => File::get($path)
        ];
    }

    // Atualizar migração editada
    public function updateMigration(): void
    {
        File::put($this->editingMigration, $this->editData['migrationContent']);
        Notification::make()
            ->title('Migração Atualizada com Sucesso!')
            ->success()
            ->send();

        $this->resetForm();
        $this->loadMigrations();
    }

    public function deleteMigration($path): void
    {
        File::delete($path);
        Notification::make()
            ->title('Migração Excluída com Sucesso!')
            ->success()
            ->send();

        $this->loadMigrations();
    }

    public function toggleCreateForm(): void
    {
        $this->showCreateForm = !$this->showCreateForm;

        // Preenche apenas para criação
        $this->formData['migrationContent'] = $this->getDefaultMigrationContent('example_table');
    }

    public function cancelEdit(): void
    {
        $this->resetForm();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('migrationName')
                    ->label('Nome da Migração')
                    ->required(),

                CodeEditor::make('migrationContent')
                    ->label('Conteúdo da Migração')
                    // Additional configuration goes here, if needed
                    ->id('unique_field_id')
                    ->minHeight(768)
                    ->showCopyButton(true)
                    ->darkModeTheme('gruvbox-dark')
                    ->lightModeTheme('basic-light')
                    ->columnSpanFull(),

            ])
            ->statePath('formData');
    }

    private function resetForm(): void
    {
        $this->formData = [];
        $this->editData = [];
        $this->editingMigration = null;
    }

    private function getDefaultMigrationContent($tableName): string
    {
        return <<<PHP
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('{$tableName}', function (Blueprint \$table) {
            \$table->id();
            \$table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('{$tableName}');
    }
};
PHP;
    }

    public function runMigration($path): void
    {
        Artisan::call('migrate', ['--path' => str_replace(base_path(), '', $path)]);
        Notification::make()
            ->title('Migração Executada com Sucesso!')
            ->success()
            ->send();

        $this->loadMigrations();
    }

    public function rollbackMigration($path): void
    {
        Artisan::call('migrate:rollback', ['--path' => str_replace(base_path(), '', $path)]);
        Notification::make()
            ->title('Rollback Realizado com Sucesso!')
            ->success()
            ->send();

        $this->loadMigrations();
    }

}
