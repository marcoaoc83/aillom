<div>
    @if($record)
        @livewire($relationManagerClass::getLivewireComponentName(), ['ownerRecord' => $record])
    @else
        <p>Salve o recurso principal antes de gerenciar este relacionamento.</p>
    @endif
</div>
