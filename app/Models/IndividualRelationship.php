<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndividualRelationship extends Model
{
    use SoftDeletes;

    protected $table = 'individual_relationships';

    protected $fillable = [
        'individual_id1',
        'individual_id2',
        'relationship_type_id',
        'relationship_start_date',
    ];

    public function individual()
    {
        return $this->belongsTo(Individual::class, 'individual_id1');
    }

    public function relatedIndividual()
    {
        return $this->belongsTo(Individual::class, 'individual_id2');
    }

    public function relationshipType()
    {
        return $this->belongsTo(TypesIndividualRelationship::class, 'relationship_type_id');
    }
}
