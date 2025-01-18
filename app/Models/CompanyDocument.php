<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'companies_documents';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'company_id',
        'document_type_id',
        'description',
        'document_number',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function documentType()
    {
        return $this->belongsTo(TypesDocument::class, 'document_type_id');
    }
}
