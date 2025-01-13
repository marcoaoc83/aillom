<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    protected $table = 'level_1_planet'; // Nome da view no banco

    public $timestamps = false; // Remove created_at e updated_at

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
