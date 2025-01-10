<?php

namespace App\Filament\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HandlesPermissions
{
    /**
     * Controla permissões para ações específicas.
     */
    public static function can(string $action, ?Model $record = null): bool
    {
        // Verifica se o usuário é super_admin
        if (Auth::check() && Auth::user()->hasRole('super_admin')) {
            return true;
        }

        // Normaliza o nome da permissão
        $resource = static::formatResourceName();

        $permission = Str::snake($action) . "_{$resource}"; // Formata a permissão

        $hasPermission = Auth::check() && Auth::user()->can($permission);

        return $hasPermission;
    }

    /**
     * Verifica se o recurso deve aparecer no menu de navegação.
     */
    public static function shouldRegisterNavigation(): bool
    {
        // Verifica se o usuário é super_admin
        if (Auth::check() && Auth::user()->hasRole('super_admin')) {
            return true;
        }

        // Normaliza o nome da permissão
        $resource = static::formatResourceName();

        $permission = "view_any_{$resource}"; // Formata a permissão

        $hasPermission = Auth::check() && Auth::user()->can($permission);

        return $hasPermission;
    }

    /**
     * Formata o nome do recurso em snake_case com "::" para palavras compostas.
     */
    private static function formatResourceName(): string
    {
        // Obtém o nome da classe e remove o sufixo "Resource"
        $resource = str_replace('Resource', '', class_basename(static::class));

        // Converte para snake_case e substitui o primeiro "_" por "::"
        $resource = Str::snake($resource);
        if (Str::contains($resource, '_')) {
            $resource = preg_replace('/_/', '::', $resource, 1);
        }

        return $resource;
    }
}
