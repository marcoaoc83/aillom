<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndividualFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'individual_files';
    protected $primaryKey = 'id';
    public $timestamps = true;

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
