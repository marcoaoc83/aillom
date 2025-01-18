<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyIndividual extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'companies_individuals';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'individual_id',
        'company_id',
        'relationship_type_id',
        'relationship_start_date'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function individual()
    {
        return $this->belongsTo(Individual::class, 'individual_id');
    }

    public function relationshipType()
    {
        return $this->belongsTo(TypesCompanyRelationship::class, 'relationship_type_id');
    }

}
