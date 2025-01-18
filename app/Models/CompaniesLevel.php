<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompaniesLevel extends Model
{
    protected $fillable = ['description'];
    protected $table = 'companies_level';

    public function companies()
    {
        return $this->hasMany(Company::class, 'level_id', 'id');
    }
}
