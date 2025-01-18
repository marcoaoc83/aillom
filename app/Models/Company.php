<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_name',
        'trade_name',
        'opening_date',
        'level_id',
        'type_company_id'
    ];

    public function level()
    {
        return $this->belongsTo(CompaniesLevel::class, 'level_id', 'id');
    }
    public function typeCompany()
    {
        return $this->belongsTo(TypesCompany::class, 'type_company_id', 'id');
    }

    public function addresses()
    {
        return $this->hasMany(CompanyAddress::class, 'company_id');
    }
    public function files()
    {
        return $this->hasMany(CompanyFile::class, 'company_id');
    }
    public function documents()
    {
        return $this->hasMany(CompanyDocument::class, 'company_id');
    }
    public function relationships()
    {
        return $this->hasMany(CompanyIndividual::class, 'company_id');
    }
}
