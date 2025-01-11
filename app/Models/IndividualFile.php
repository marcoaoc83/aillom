<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndividualFile extends Model
{
    protected $table = 'individual_files';

    protected $fillable = [
        'individual_id',
        'title',
        'description',
        'file_path',
    ];

    /**
     * Relacionamento com o modelo Individual.
     */
    public function individual()
    {
        return $this->belongsTo(Individual::class);
    }
}
