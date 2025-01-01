<?php

namespace App\Filament\Resources;



use App\Filament\Traits\HandlesPermissions;
use Filament\Resources\Resource;

abstract class BaseResource extends Resource
{
    use HandlesPermissions;
}
