<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypesIndividualRelationship extends Model
{
    protected $fillable = ['description'];
    protected $table = 'types_individual_relationship';

    public function relationships()
    {
        return $this->hasMany(IndividualRelationship::class, 'relationship_type_id');
    }
}
