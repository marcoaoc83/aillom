<?php

namespace App\Models;

use App\Enums\EntityType;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
class TypesDocument extends Model implements AuditableContract {

    use Auditable;
    protected $fillable = ['description', 'entity_type', 'regex', 'mask'];
    protected $table = 'types_document';
    protected function casts(): array
    {
        return [
            'entity_type' => EntityType::class,
        ];
    }

    public function documents()
    {
        return $this->hasMany(IndividualDocument::class, 'document_type_id');
    }

    public function scopeForPF($query)
    {
        return $query->where('entity_type', EntityType::PF);
    }

    public function scopeForPJ($query)
    {
        return $query->where('entity_type', EntityType::PJ);
    }
}
