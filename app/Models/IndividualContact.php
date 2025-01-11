<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndividualContact extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'individual_contacts';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'individual_id',
        'contact_type',
        'description',
    ];

    public function individual()
    {
        return $this->belongsTo(Individual::class, 'individual_id');
    }


    public function contactType()
    {
        return $this->belongsTo(TypesContact::class, 'contact_type');
    }
}
