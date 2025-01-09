<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Individual extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name',
        'birth_date',
        'death_date',
        'sex',
        'gender_id',
        'nationality',
        'birth_place_id',
        'naturalness_id',
        'social_name',
    ];

    public function addresses()
    {
        return $this->hasMany(IndividualAddress::class, 'individual_id');
    }

    public function gender()
    {
        return $this->belongsTo(IndividualGender::class, 'gender_id');
    }


}

