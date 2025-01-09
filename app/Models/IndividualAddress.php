<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndividualAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'individual_address';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'individual_id',
        'address_id',
        'number_address',
        'complement',
        'address_type_id',
    ];

    public function individual()
    {
        return $this->belongsTo(Individual::class, 'individual_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
}
