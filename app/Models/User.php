<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Models\Audit;
use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class User extends Authenticatable implements AuditableContract, FilamentUser
{
    use HasFactory, Notifiable, HasRoles, Auditable;

    protected $fillable = [
        'name',
        'login',
        'individual_id',
        'email',
        'password',
        'avatar_url',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function audits(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(\OwenIt\Auditing\Models\Audit::class, 'auditable');
    }

    public function isSuperAdmin(): bool
    {
        $superAdminRoleName = config('filament-shield.super_admin.name', 'super_admin');

        return $this->hasRole($superAdminRoleName);
    }

    public function individual()
    {
        return $this->belongsTo(Individual::class);
    }

    public function username(): string
    {
        return 'login';
    }

    public function getAvatarUrlAttribute($value): string
    {
        if(!$value) return '';
        $url=config('config.url');
        return str_starts_with($value, 'storage/') ? $url.'/'.$value : $url."/storage/{$value}";
    }

    // 📌 Adicione este método para que o Filament saiba se o usuário pode acessar o painel
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return true;
    }
}
