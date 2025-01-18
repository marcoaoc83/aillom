<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'companies_address';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'company_id',
        'address_id',
        'number_address',
        'complement',
        'address_type_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function type()
    {
        return $this->belongsTo(TypesAddress::class, 'address_type_id');
    }
}
