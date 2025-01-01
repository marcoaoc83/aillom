<?php

namespace App\Filament\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
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
        $resource = strtolower(str_replace('Resource', '', class_basename(static::class)));
        $permission = Str::snake($action) . "_{$resource}"; // Garante o formato snake_case

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
        $resource = strtolower(str_replace('Resource', '', class_basename(static::class)));
        $permission = "view_any_{$resource}";
        $hasPermission = Auth::check() && Auth::user()->can($permission);

        return $hasPermission;
    }

}
