<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndividualGender extends Model
{
    protected $fillable = ['description'];
    protected $table = 'individual_genders';

    public function individuals()
    {
        return $this->hasMany(Individual::class, 'gender_id');
    }
}
