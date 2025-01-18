<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypesCompany extends Model
{
    protected $fillable = ['code', 'description'];
    protected $table = 'types_company';

    public function companies()
    {
        return $this->hasMany(Company::class, 'type_company_id', 'id');
    }
}
