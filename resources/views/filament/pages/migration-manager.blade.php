<x-filament::page>
    <div class="space-y-6">
        <!-- Cabeçalho -->
        <div class="flex justify-between items-center">
            <x-filament::button color="primary" wire:click="toggleCreateForm">
                Criar Nova Migração
            </x-filament::button>
        </div>

        <!-- Formulário de Criação de Nova Migração -->
        @if($showCreateForm)
            <form wire:submit.prevent="createMigration" class="p-6 bg-white rounded-lg shadow">
                {{ $this->form }}
                <div class="mt-4 flex justify-end space-x-2">
                    <x-filament::button type="submit" color="success">
                        Salvar
                    </x-filament::button>
                    <x-filament::button color="gray" wire:click="toggleCreateForm">
                        Cancelar
                    </x-filament::button>
                </div>
            </form>
        @endif

        <!-- Listagem de Migrações -->
        @include('filament.pages.migration-list')
    </div>
</x-filament::page>
