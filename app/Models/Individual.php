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

    public function documents()
    {
        return $this->hasMany(IndividualDocument::class, 'individual_id');
    }

    public function relationships()
    {
        return $this->hasMany(IndividualRelationship::class, 'individual_id1');
    }

    public function contacts()
    {
        return $this->hasMany(IndividualContact::class, 'individual_id');
    }

    public function files()
    {
        return $this->hasMany(IndividualFile::class, 'individual_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'individual_id'); // Relacionamento 1:N com users
    }
}

