<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndividualDocument extends Model
{
    use SoftDeletes;

    protected $table = 'individual_documents';

    protected $fillable = [
        'individual_id',
        'document_type_id',
        'description',
    ];

    public function individual()
    {
        return $this->belongsTo(Individual::class, 'individual_id');
    }

    public function documentType()
    {
        return $this->belongsTo(TypesDocument::class, 'document_type_id');
    }
}
