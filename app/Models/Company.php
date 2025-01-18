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
}
