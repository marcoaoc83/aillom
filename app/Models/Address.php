<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Address extends Model implements AuditableContract {

    use Auditable;

    protected $fillable = ['parent_id', 'description', 'abbreviation', 'postal_code', 'area_code', 'country_code'];

    public function parent()
    {
        return $this->belongsTo(Address::class, 'parent_id');
    }

    // Relação self-referencing: Endereços filhos
    public function children()
    {
        return $this->hasMany(Address::class, 'parent_id');
    }

    public function getFullPathAttribute(): string
    {
        $path = [];
        $current = $this;

        // Subir na hierarquia e construir o caminho
        while ($current) {
            // Adiciona apenas se não for o planeta
            if ($current->is_country_or_below()) {
                $path[] = $current->description; // Adiciona o nome atual
            }
            $current = $current->parent; // Vai para o pai
        }

        // Reverte a ordem para ficar do país até o nó atual
        return implode(' > ', array_reverse($path));
    }

    /**
     * Verifica se o nó atual é o país ou abaixo
     */
    public function is_country_or_below(): bool
    {
        // Substitua 'Brasil' por uma lógica dinâmica, como um atributo ou identificação no banco
        return $this->description === 'Brasil' || $this->parent_id !== null;
    }

}
