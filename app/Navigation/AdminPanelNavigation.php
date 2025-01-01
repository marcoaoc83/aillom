<?php

namespace App\Navigation;

use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;

class AdminPanelNavigation
{
    /**
     * Retorna os grupos de navegação.
     *
     * @return array
     */
    public static function groups(): array
    {
        return [
            NavigationGroup::make()->label('Configurações'),
            NavigationGroup::make()->label('Logs'),
        ];
    }

    public static function items(): array
    {
        return [
            // Itens do grupo "Configurações"
            NavigationItem::make('Agendamentos')
                ->url('/admin/agendador')
                ->group('Configurações')

                ->sort(-1),

        ];
    }
}
