<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'companies_files';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'company_id',
        'title',
        'description',
        'file_path',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

}
