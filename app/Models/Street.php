<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    protected $table = 'level_6_streets'; // Nome da view no banco

    public $timestamps = false;

    protected $fillable = [
        'id',
        'description',
        'abbreviation',
        'postal_code',
        'latitude',
        'longitude',
        'ibge_code',
        'area_code',
        'country_code',
        'hierarchical_code',
        'parent_id',
    ];
}
