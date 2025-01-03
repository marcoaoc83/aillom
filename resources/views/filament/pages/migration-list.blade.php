<div class="space-y-4">
    @foreach($migrations as $migration)
        <div class="p-4 border rounded-lg flex justify-between items-center">
            <div>
                <p class="font-medium">{{ $migration['name'] }}</p>
                <p class="text-sm text-gray-500">Última modificação: {{ $migration['lastModified'] }}</p>
            </div>

            <div class="flex space-x-2">
                <!-- Botão Executar -->
                @if(!$migration['executed'])
                    <x-filament::button color="success" wire:click="runMigration('{{ $migration['path'] }}')">
                        Executar
                    </x-filament::button>
                @else
                    <!-- Botão Rollback -->
                    <x-filament::button color="warning" wire:click="rollbackMigration('{{ $migration['path'] }}')">
                        Rollback
                    </x-filament::button>
                @endif

                <!-- Botão Editar -->
                <x-filament::button color="primary" wire:click="editMigration('{{ $migration['path'] }}')">
                    Editar
                </x-filament::button>

                <!-- Botão Excluir -->
                <x-filament::button color="danger" wire:click="deleteMigration('{{ $migration['path'] }}')">
                    Excluir
                </x-filament::button>
            </div>
        </div>

        <!-- Formulário de Edição Inline (Aparece abaixo da linha) -->
        @if($editingMigration === $migration['path'])
            <div class="mt-4 p-4 border rounded-lg bg-gray-50">
                <form wire:submit.prevent="updateMigration">
                    <textarea
                        id="editor"
                        wire:model.defer="editData.migrationContent"
                        class="w-full rounded-lg border-gray-300"
                        rows="10"
                    ></textarea>

                    <div class="flex justify-end space-x-2 mt-4">
                        <x-filament::button type="submit" color="success">
                            Salvar
                        </x-filament::button>

                        <x-filament::button color="gray" wire:click="cancelEdit">
                            Cancelar
                        </x-filament::button>
                    </div>
                </form>
            </div>
        @endif
    @endforeach
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editor = CodeMirror.fromTextArea(document.getElementById('editor'), {
            mode: 'application/x-httpd-php',
            lineNumbers: true,
            theme: 'dracula'
        });
    });
</script>
